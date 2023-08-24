@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="card px-2">
            <h3 class="text-center my-2">Student Dormitory Manangement</h3>
            <div class="row px-3 d-flex justify-content-between">
                <div>
                    <form action="{{ route('student-dormitory.search') }}" class="d-flex justify-content-between" method="POST">
                        @csrf

                        <select name="sorting" id="" class="form-control mx-1">
                            <option value="">Select Sorting Order</option>
                            <option @if (isset($data) && $data['sorting'] == 'ASC') selected @endif value="ASC">ASC</option>
                            <option @if (isset($data) && $data['sorting'] == 'DESC') selected @endif value="DESC">DESC</option>
                        </select>

                        <input type="text" class="form-control" placeholder="Student Name" name="student_name">

                        <select name="status" id="" class="form-control mx-1">
                            <option value="">Select Status</option>
                            <option @if (isset($data) && $data['status'] == '1') selected @endif value="1">Active</option>
                            <option @if (isset($data) && $data['status'] == '0') selected @endif value="0">Inactive</option>
                        </select>

                        <div>
                            <button type="submit" class="btn  m-0  btn-primary d-flex "> <i
                                class="fa fa-search  mx-1 mt-1"></i> Search </button>
                        </div>
                    </form>
                </div>
                <button class="btn btn-primary btn-sm my-1"><a href="{{ route('student-dormitory.create') }}"
                        class="text-white">Add</a></button>
            </div>
            <div class="row px-3">
                <table border="1" class="table table-bordered my-3">
                    <thead>
                        <tr>
                            <th>Ser No</th>
                            <th>Student Name</th>
                            <th>Dormitory</th>
                            <th>Room Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($student_dormitories as $key => $student_dormitory)
                            <tr class="@if($student_dormitory->status == 1) available @else  unavailable   @endif">
                                <td>{{ $student_dormitory->id ?? '' }}</td>
                                <td>{{$student_dormitory->student_name??''}}</td>
                                <td>{{$student_dormitory->dormitory->name??\App\Models\Dormitory::where('id',$student_dormitory->dormitory_id)->pluck('name')->first()??''}}</td>
                                <td>{{$student_dormitory->room->room_number??\App\Models\Room::where('id',$student_dormitory->room_id)->pluck('room_number')->first() ??''}}</td>
                                <td>{{$student_dormitory->status == 1? 'Active':'Inactive'}}</td>
                                <td class="d-flex justify-content-center">
                                    <button class="btn btn-sm btn-info mx-1">
                                        <a href="{{ route('student-dormitory.edit', $student_dormitory->id) }}" class="text-white"><i
                                                class="fas fa-pen"></i></a>
                                    </button>
                                    <button class="btn btn-sm btn-danger delete" data-url="/student-dormitory/delete/"
                                        data-id="{{ $student_dormitory->id }}" data-csrf="{{ csrf_token() }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">No record here</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        h3 {
            color: black;
        }

        .table {
            color: black;
        }

        .table tr th,
        .table tr td {
            text-align: center
        }
        
    </style>
@endpush

@push('js')
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
