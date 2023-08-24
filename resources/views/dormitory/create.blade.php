@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row card p-2 ">
            <h3 class="col-md-12 text-center text-dark">Add Dormitory</h3>
        </div>
        <div class="card row p-3 shadow-sm shadow-rounded">

            <form action="{{ route('dormitory.store') }}" method="POST">
                @csrf

                <div class="form-group col-md-6 offset-md-3">
                    <label for="">Name</label>
                    <input type="text" class="form-control"  name="name" required>
                </div>

                <div class="form-group col-md-6 offset-md-3">
                    <label for="">Type</label>
                    <select name="type" class="form-control" id="" required>
                        <option value="">Select One</option>
                        <option value="boys">Boys</option>
                        <option value="girls">Girls</option>
                    </select>
                </div>
                
                <div class="form-group col-md-6 offset-md-3">
                    <label for="">Address</label>
                    <textarea name="address" id="" required class="form-control" cols="30" rows="2"></textarea>
                </div>

                <div class="form-group col-md-6 offset-md-3">
                    <label for="">Status</label>
                    <select name="status" class="form-control" id="" required>
                        <option value="">Select One</option>
                        @foreach (getStatus() as $status)
                            <option value="{{$status??''}}">{{$status??''}}</option>                            
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>

            </form>

        </div>
    </div>
@endsection
