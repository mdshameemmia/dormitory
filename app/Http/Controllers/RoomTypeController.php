<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomTypeController extends Controller
{
    public function index()
    {
        $this->authorize('access');
        $room_types = RoomType::all();
        return view('room-type.index', compact('room_types'));
    }

    public function create()
    {
        $this->authorize('access');
        return view('room-type.create');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'type' => 'required|unique:room_types|min:1|max:50'
            ]);

            if ($validator->fails()) {
                $validator = $validator->errors();
                $error_message = customErrorHandler($validator);
                return redirect()->back()->withError($error_message ?? 'Please check again');
            }

            $data = $request->all();
            RoomType::create($data);
            return redirect()->route('room-type.index')->withSuccess('Sucessfully saved!');
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->authorize('access');
        $room_type = RoomType::findOrFail($id);
        return view('room-type.edit', compact('room_type'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'type' => 'required|min:1|max:50'
            ]);

            if ($validator->fails()) {
                $validator = $validator->errors();
                $error_message = customErrorHandler($validator);
                return redirect()->back()->withError($error_message ?? 'Please check again');
            }

            $data = $request->except('_method', '_token');
            RoomType::where('id', $id)->update($data);
            return redirect()->route('room-type.index')->withSuccess('Sucessfully updated!');
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->authorize('access');
            RoomType::findOrFail($id)->delete();
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
            $room_type = new RoomType();
            $table_name = $room_type->getTable();
            $room_types = customSearch($table_name,$request);
            $data = $request->all();

            return view('room-type.index', compact('room_types', 'data'));
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
