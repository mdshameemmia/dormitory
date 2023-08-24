@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row card p-2 ">
            <h3 class="col-md-12 text-center text-dark">Add Room</h3>
        </div>
        <div class="card row p-3 shadow-sm shadow-rounded">

            <form action="{{ route('room.store') }}" method="POST">
                @csrf
                <div class="form-group col-md-6 offset-md-3">
                    <label for="">Dormitory</label>
                    <select name="dormitory_id" class="form-control" id="" required>
                        <option value="">Select One</option>
                        @foreach ($dormitories as $key => $dormitory)
                            <option value="{{ $dormitory->id ?? '' }}">{{ $dormitory->name ?? '' }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6 offset-md-3">
                    <label for="">Room Type</label>
                    <select name="room_type_id" class="form-control" id="" required>
                        <option value="">Select One</option>
                        @foreach ($room_types as $key => $room_type)
                            <option value="{{ $room_type->id ?? '' }}">{{ $room_type->type ?? '' }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6 offset-md-3">
                    <label for="">Room Number </label>
                    <input type="number" class="form-control" name="room_number" required>
                </div>

                <div class="form-group col-md-6 offset-md-3">
                    <label for=""> Number of Bed </label>
                    <input type="number" class="form-control" name="number_of_bed" required>
                </div>

                <div class="form-group col-md-6 offset-md-3">
                    <label for=""> Description  </label>
                    <textarea name="description" id="" class="form-control" required cols="30" rows="2"></textarea>
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
