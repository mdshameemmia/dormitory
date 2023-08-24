@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="card px-2">
            <h3 class="text-center my-2">Room Types</h3>
            <div class="row px-3 d-flex justify-content-between">
                <div>
                    <form action="{{ route('room-type.search') }}" class="d-flex justify-content-between" method="POST">
                        @csrf

                        <select name="sorting" id="" class="form-control mx-1">
                            <option value="">Select Sorting Order</option>
                            <option @if (isset($data) && $data['sorting'] == 'ASC') selected @endif value="ASC">ASC</option>
                            <option @if (isset($data) && $data['sorting'] == 'DESC') selected @endif value="DESC">DESC</option>
                        </select>

                        <select name="type" id="" class="form-control mx-1">
                            <option value="">Select Type</option>
                            @foreach ($room_types as $key => $room_type)
                            <option @if (isset($data) && $data['type'] == $room_type->type) selected @endif value="{{$room_type->type??''}}">{{$room_type->type??""}}</option>
                            @endforeach
                        </select>
                        
                        <select name="status" id="" class="form-control mx-1">
                            <option value="">Select Status</option>
                            @foreach (getStatus() as $status)
                            <option @if(isset($data) && $data['status'] == $status) selected  @endif value="{{$status??""}}">{{$status??''}}</option>                                
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-sm m-0  btn-primary d-flex "> <i
                                class="fa fa-search  mx-1 mt-1"></i> Search </button>
                    </form>
                </div>
                <div>
                    <button class="btn btn-primary  my-1"><a href="{{ route('room-type.create') }}"
                            class="text-white">Add</a></button>
                </div>
            </div>
            <div class="row px-3">
                <table border="1" class="table table-bordered my-2">
                    <thead>
                        <tr>
                            <th>Ser No</th>
                            <th>Type Name</th>
                            <th>Fee</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($room_types as $key => $room_type)
                            <tr>
                                <td>{{ $room_type->id ?? '' }}</td>
                                <td>{{ $room_type->type ?? '' }}</td>
                                <td>{{ $room_type->fee ?? '' }}</td>
                                <td>{{ $room_type->status ?? '' }}</td>
                                <td class="d-flex justify-content-center">
                                    <button class="btn btn-sm btn-info mx-1">
                                        <a href="{{ route('room-type.edit', $room_type->id) }}" class="text-white"><i
                                                class="fas fa-pen"></i></a>
                                    </button>
                                    <button class="btn btn-sm btn-danger delete" data-url="/room-type/delete/"
                                        data-id="{{ $room_type->id }}" data-csrf="{{ csrf_token() }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No record here</td>
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
