<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Room;
use App\Models\User;
use App\Models\RoomType;
use App\Models\Dormitory;
use Illuminate\Http\Request;
use App\Models\StudentDormitory;
use Illuminate\Support\Facades\Validator;

class StudentDormitoryController extends Controller
{
    public function index()
    {
        $this->authorize('access');
        $student_dormitories = StudentDormitory::all();
        return view('student-dormitory.index', compact('student_dormitories'));
    }

    public function create()
    {
        $this->authorize('access');
        $dormitories = Dormitory::all();
        $rooms = Room::all();
        $room_types = RoomType::all();

        return view('student-dormitory.create', compact('dormitories', 'rooms', 'room_types'));
    }

    public function getRoomByDormitory(Request $request)
    {
        try {
            $rooms = Room::where('dormitory_id', $request->dormitory_id)
                ->where('room_type_id', $request->room_type_id)
                ->whereColumn('number_of_bed', '<>', 'number_of_booked')
                ->get();

            if (count($rooms) == 0) {
                return response()->json(['error' => "No room available of this Dormitory & Room type"]);
            }
            return response()->json(['rooms' => $rooms]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'room_id' => 'required',
                'dormitory_id' => 'required',
                'room_type_id' => 'required',
                'student_name' => 'required|min:4|max:50'
            ]);

            if ($validator->fails()) {
                $validator = $validator->errors();
                $error_message = customErrorHandler($validator);
                return redirect()->back()->withError($error_message ?? 'Please check again');
            }

            $data = $request->except("room_type_id");
            StudentDormitory::create($data);

            //update booked room status 
            if($request->status == 1){
                $room = Room::where('id', $data['room_id'])->first();
                $room->number_of_booked = $room->number_of_booked + 1;
                $room->save();
            }

            $room = Room::where('id', $data['room_id'])->first();
            if ($room->number_of_booked >= $room->number_of_bed) {
                $room->status = User::OCCUPIED;
                $room->save();
            }
            return redirect()->route('student-dormitory.index')->withSuccess('Sucessfully saved!');
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->authorize('access');
            $student_dormitory = StudentDormitory::findOrFail($id);

            // update room status 
            $room =  Room::where('id', $student_dormitory->room_id)->first();
            $room->number_of_booked = $room->number_of_booked - 1;
            $room->status = 'Vacant';
            $room->save();

            // delete student dormitories
            $student_dormitory->delete();

            return response()->json([
                'success' => "Successfully deleted"
            ]);
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->authorize('access');
        $dormitories = Dormitory::all();
        $rooms = Room::all();
        $room_types = RoomType::all();
        $student_dormitory = StudentDormitory::findOrFail($id);

        return view('student-dormitory.edit', compact('rooms', 'room_types', 'dormitories', 'student_dormitory'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'room_id' => 'required',
                'dormitory_id' => 'required',
                'room_type_id' => 'required',
                'student_name' => 'required|min:4|max:50'
            ]);

            if ($validator->fails()) {
                $validator = $validator->errors();
                $error_message = customErrorHandler($validator);
                return redirect()->back()->withError($error_message ?? 'Please check again');
            }

            $data = $request->except("room_type_id", '_token', "_method");

            $previous_student_dormitory = StudentDormitory::findOrFail($id);
            if (($previous_student_dormitory->status != $request->status) && $request->status == User::INACTIVE) {

                //update booked room status 
                $room = Room::where('id', $data['room_id'])->first();
                $room->number_of_booked = $room->number_of_booked - 1;
                $room->status = User::VACANT;
                $room->save();
            } elseif (($previous_student_dormitory->status != $request->status) && $request->status == User::ACTIVE) {
                // Room number update
                $room = Room::where('id', $data['room_id'])->first();
                if ($room->number_of_booked >= $room->number_of_bed) {
                    return redirect()->route('student-dormitory.index')->withError('Room is unavailable!');
                } else {
                    $room->number_of_booked = $room->number_of_booked + 1;
                    $room->save();
                }
                // Room status update
                $room = Room::where('id', $data['room_id'])->first();
                if ($room->number_of_booked >= $room->number_of_bed) {
                    $room->status = User::OCCUPIED;
                } else {
                    $room->status = User::VACANT;
                }
                $room->save();
            }

            StudentDormitory::where('id', $id)->update($data);

            return redirect()->route('student-dormitory.index')->withSuccess('Sucessfully Updated!');
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $student_dormitory = new StudentDormitory();
            $table_name = $student_dormitory->getTable();
            $student_dormitories = customSearch($table_name,$request);
            $data = $request->all();
            return view('student-dormitory.index', compact('student_dormitories', 'data'));
            
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

}
