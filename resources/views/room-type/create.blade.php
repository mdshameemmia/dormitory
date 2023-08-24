@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row card p-2 ">
            <h3 class="col-md-12 text-center text-dark">Add Room Type</h3>
        </div>
        <div class="card row p-3 shadow-sm shadow-rounded">

            <form action="{{ route('room-type.store') }}" method="POST">
                @csrf
                <div class="form-group col-md-6 offset-md-3">
                    <label for="">Room Type</label>
                    <input type="text" class="form-control" name="type" required>
                </div>

                <div class="form-group col-md-6 offset-md-3">
                    <label for="">Fee</label>
                    <input type="number" class="form-control" name="fee" required>
                </div>

                <div class="form-group col-md-6 offset-md-3">
                    <label for="">Status</label>
                    <select name="status" class="form-control" id="" required>
                        <option value="">Select One</option>
                        @foreach (getStatus() as $status)
                            <option value="{{ $status ?? '' }}">{{ $status ?? '' }}</option>
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
