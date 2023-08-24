<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Dormitory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function index()
    {
        $this->authorize('access');
        $rooms = Room::all();
        $dormitories = Dormitory::all();
        return view('room.index', compact('rooms', 'dormitories'));
    }

    public function create()
    {
        $this->authorize('access');
        $dormitories = Dormitory::where('status', 'Vacant')->get();
        $room_types = RoomType::where('status', 'Vacant')->get();
        return view('room.create', compact('dormitories', 'room_types'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'room_number' => 'required|numeric|unique:rooms',
                'room_type_id' => 'required',
                'dormitory_id' => 'required',
                'number_of_bed' => 'required|numeric',
                'status' => 'required',
                'description' => 'required|min:5|max:100',
            ]);

            if ($validator->fails()) {
                $validator = $validator->errors();
                $error_message = customErrorHandler($validator);
                return redirect()->back()->withError($error_message ?? 'Please check again');
            }

            $data = $request->all();
            $data['number_of_booked'] = 0;
            Room::create($data);

            return redirect()->route('room.index')->withSuccess('Sucessfully saved!');
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->authorize('access');
        $dormitories = Dormitory::all();
        $room_types = RoomType::all();
        $room = Room::findOrFail($id);

        return view('room.edit', compact('room', 'room_types', 'dormitories'));
    }

    public function update(Request $request, $id)
    {
        try {

            $validator = Validator::make($request->all(), [
                'room_number' => 'required|numeric',
                'room_type_id' => 'required',
                'dormitory_id' => 'required',
                'number_of_bed' => 'required|numeric',
                'status' => 'required',
                'description' => 'required|min:5|max:100',
            ]);

            if ($validator->fails()) {
                $validator = $validator->errors();
                $error_message = customErrorHandler($validator);
                return redirect()->back()->withError($error_message ?? 'Please check again');
            }

            $data = $request->except("_method", "_token");
            Room::where('id', $id)->update($data);

            return redirect()->route('room.index')->withSuccess('Sucessfully updated!');
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->authorize('access');
            $room = Room::findOrFail($id);
            $room->students()->delete();
            $room->delete();
            
            return response()->json([
                'success' => "Successfully deleted"
            ]);
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $room = new Room();
            $table_name = $room->getTable();
            $rooms = customSearch($table_name, $request);
            $data = $request->all();
            $dormitories = Dormitory::all();
            
            return view('room.index', compact('rooms', 'data','dormitories'));
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
