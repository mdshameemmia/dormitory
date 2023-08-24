@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row card p-2 ">
            <h3 class="col-md-12 text-center text-dark">Add User</h3>
        </div>
        <div class="card row p-3 shadow-sm shadow-rounded">

            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="form-group col-md-6 offset-md-3">
                    <label for="">User Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="form-group col-md-6 offset-md-3">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="form-group col-md-6 offset-md-3">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <div class="form-group col-md-6 offset-md-3">
                    <label for="">Role</label>
                    <select name="role" class="form-control" id="" required>
                        <option value="">Select One</option>
                        <option value="Admin">Admin</option>
                        <option value="Super Admin">Super Admin</option>
                        
                    </select>
                </div>

                <div class="form-group col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>

            </form>

        </div>
    </div>
@endsection
