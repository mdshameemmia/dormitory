@extends('layouts.master')
@section('content')
    <div class="container-fuild">
        <div class="card px-2">
            <h3 class="text-center my-2">Room List</h3>
            <div class="row px-3 d-flex justify-content-between">
                <div>
                    <form action="{{ route('room.search') }}" class="d-flex justify-content-between" method="POST">
                        @csrf

                        <select name="sorting" id="" class="form-control mx-1">
                            <option value="">Select Sorting Order</option>
                            <option @if (isset($data) && $data['sorting'] == 'ASC') selected @endif value="ASC">ASC</option>
                            <option @if (isset($data) && $data['sorting'] == 'DESC') selected @endif value="DESC">DESC</option>
                        </select>

                        <select name="dormitory_id" id="" class="form-control mx-1">
                            <option value="">Select Type</option>
                            @foreach ($dormitories as $key => $dormitory)
                                <option @if (isset($data) && $data['dormitory_id'] == $dormitory->id) selected @endif
                                    value="{{ $dormitory->id ?? '' }}">{{ $dormitory->name ?? '' }}</option>
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
                    <button class="btn btn-primary my-1"><a href="{{ route('room.create') }}"
                            class="text-white">Add</a></button>
                </div>
            </div>
            <div class="row px-3">
                <table border="1" class="table">
                    <thead>
                        <tr>
                            <th>Ser No</th>
                            <th>Dormitory</th>
                            <th>Room Type</th>
                            <th>Room No</th>
                            <th>Number of Bed</th>
                            <th>Available Bed</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rooms as $key => $room)
                            <tr class="@if ($room->number_of_bed - $room->number_of_booked == 0) unavailable @else available @endif">
                                <td>{{ $room->id ?? '' }}</td>
                                <td>{{ $room->dormitory->name ?? \App\Models\Dormitory::where('id',$room->dormitory_id)->pluck('name')->first()??'' }}</td>
                                <td>{{ $room->roomType->type ?? \App\Models\RoomType::where('id',$room->room_type_id)->pluck('type')->first()??'' }}</td>
                                <td>{{ $room->room_number ?? '' }}</td>
                                <td>{{ $room->number_of_bed ?? '' }}</td>
                                <td>{{ $room->number_of_bed - $room->number_of_booked }}</td>
                                <td>{{ $room->description ?? '' }}</td>
                                <td>{{ $room->status ?? '' }}</td>

                                <td class="d-flex justify-content-center">
                                    <button class="btn btn-sm btn-info mx-1">
                                        <a href="{{ route('room.edit', $room->id) }}" class="text-white"><i
                                                class="fas fa-pen"></i></a>
                                    </button>
                                    <button class="btn btn-sm btn-danger delete" data-url="/room/delete/"
                                        data-id="{{ $room->id }}" data-csrf="{{ csrf_token() }}">
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
