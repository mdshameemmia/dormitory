@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row card p-2 ">
            <h3 class="col-md-12 text-center text-dark">Student Dormitory Management</h3>
        </div>
        <div class="card row p-3 shadow-sm shadow-rounded">

            <form action="{{ route('student-dormitory.store') }}" method="POST">
                @csrf
                <div class="form-group col-md-6 offset-md-3">
                    <label for="">Student Name </label>
                    <input type="text" class="form-control" name="student_name" required>
                </div>

                <div class="form-group col-md-6 offset-md-3">
                    <label for="">Dormitory</label>
                    <select name="dormitory_id" class="form-control handle_room" id="dormitory_id" required>
                        <option value="">Select One</option>
                        @foreach ($dormitories as $key => $dormitory)
                            <option value="{{ $dormitory->id ?? '' }}">{{ $dormitory->name ?? '' }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6 offset-md-3">
                    <label for="">Room Type</label>
                    <select name="room_type_id" class="form-control handle_room" id="room_type_id" required>
                        <option value="">Select One</option>
                        @foreach ($room_types as $key => $room_type)
                            <option value="{{ $room_type->id ?? '' }}">{{ $room_type->type ?? '' }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6 offset-md-3">
                    <label for="">Room</label>
                    <select name="room_id" class="form-control" id="room_id" required>
                        <option value="">Select One</option>

                    </select>
                </div>

                <div class="form-group col-md-6 offset-md-3">
                    <label for="">Status</label>
                    <select name="status" class="form-control" id="" required>
                        <option value="">Select One</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="form-group col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>

            </form>

        </div>
    </div>
@endsection

@push('js')
    <script>
        $(".handle_room").on('change', function() {

            let dormitory_id = document.getElementById('dormitory_id').value;
            let room_type_id = document.getElementById('room_type_id').value;

            if (dormitory_id && room_type_id) {
                $.ajax({
                    url: '/student-dormitory/get-room-by-dormitory',
                    type: 'POST',
                    data: {
                        _token: "{!! csrf_token() !!}",
                        dormitory_id,
                        room_type_id,
                    },
                    success: function(res) {
                        let roomContainer = $('#room_id')
                        let roomOption = `<option value=''>Select One</option>`;

                        if (res.error) {
                            toastr.error(res.error);
                        } else {
                            res.rooms.map(room => {
                                roomOption +=
                                    `<option value="${room.id}">${room.room_number}</option>`
                            })
                        }
                        roomContainer.html(roomOption)
                    }
                })
            }
        })
    </script>
@endpush
