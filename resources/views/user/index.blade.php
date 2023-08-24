@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="card px-2">
            <h3 class="text-center my-2">User list</h3>
            <div class="row px-3 d-flex justify-content-between">
                <div>
                  
                </div>
                <div>
                    <button class="btn btn-primary  my-1"><a href="{{ route('user.create') }}"
                            class="text-white">Add</a></button>
                </div>
            </div>
            <div class="row px-3">
                <table border="1" class="table table-bordered my-2">
                    <thead>
                        <tr>
                            <th>Ser No</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $key => $user)
                          <tr>
                            <td>{{$loopt->iteration ?? ''}}</td>
                            <td>{{$user->name??''}}</td>
                            <td>{{$user->role??''}}</td>
                            <td>{{$user->email??''}}</td>
                            <td class="d-flex justify-content-center">
                                <button class="btn btn-sm btn-info mx-1">
                                    <a href="{{ route('user.edit', $user->id) }}" class="text-white"><i
                                            class="fas fa-pen"></i></a>
                                </button>
                                <button class="btn btn-sm btn-danger delete" data-url="/user/delete/"
                                    data-id="{{ $user->id }}" data-csrf="{{ csrf_token() }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                          </tr>
                        @empty
                            <tr>
                                <td colspan="5">No record here</td>
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
