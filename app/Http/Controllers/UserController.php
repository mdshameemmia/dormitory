<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('access-any');
        $users = User::all();
        return view('user.index',compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:users',
                'name' => 'required|min:5|max:100',
                'password' => 'required|min:8|max:20',
                'role' => 'required',
            ]);

            if ($validator->fails()) {
                $validator = $validator->errors();
                $error_message = customErrorHandler($validator);
                return redirect()->back()->withError($error_message ?? 'Please check again');
            }

            $data = $request->all();
            $data['password'] =  Hash::make($data['password']);
            User::create($data);

            return redirect()->route('user.index')->withSuccess('Sucessfully saved!');
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            User::findOrFail($id)->delete();
            return response()->json([
                'success' => "Successfully deleted"
            ]);
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'name' => 'required|min:5|max:100',
                'password' => 'required|min:8|max:20',
                'role' => 'required',
            ]);

            if ($validator->fails()) {
                $validator = $validator->errors();
                $error_message = customErrorHandler($validator);
                return redirect()->back()->withError($error_message ?? 'Please check again');
            }

            $data = $request->except("_token",'_method');
            $data['password'] =  Hash::make($data['password']);
            User::where('id',$id)->update($data);
            return redirect()->route('user.index')->withSuccess('Sucessfully saved!');
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    
}
