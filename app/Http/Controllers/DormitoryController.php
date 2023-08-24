<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Dormitory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DormitoryController extends Controller
{
    public function index()
    {
        $this->authorize('access');
        $dormitories = Dormitory::all();
        return view('dormitory.index', compact('dormitories'));
    }

    public function create()
    {
        $this->authorize('access');
        return view('dormitory.create');
    }

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:dormitories|min:5|max:50',
                'address' => 'required|min:5|max:100'
            ]);

            if ($validator->fails()) {
                $validator = $validator->errors();
                $error_message = customErrorHandler($validator);
                return redirect()->back()->withError($error_message ?? 'Please check again');
            }

            $data = $request->all();
            Dormitory::create($data);
            return redirect()->route('dormitory.index')->withSuccess('Sucessfully saved!');
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->authorize('access');
        $dormitory = Dormitory::findOrFail($id);
        return view('dormitory.edit', compact('dormitory'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:5|max:50',
                'address' => 'required|min:5|max:100'
            ]);

            if ($validator->fails()) {
                $validator = $validator->errors();
                $error_message = customErrorHandler($validator);
                return redirect()->back()->withError($error_message ?? 'Please check again');
            }

            $data = $request->except('_method', '_token');
            Dormitory::where('id', $id)->update($data);
            return redirect()->route('dormitory.index')->withSuccess('Sucessfully updated!');
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->authorize('access');
            Dormitory::findOrFail($id)->delete();
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
            
            $dormitory = new Dormitory();
            $table_name = $dormitory->getTable();
            $dormitories = customSearch($table_name,$request);
            $data = $request->all();

            return view('dormitory.index', compact('dormitories', 'data'));
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
