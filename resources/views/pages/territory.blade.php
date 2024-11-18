@extends('layouts.main')

@section('title', 'Territory')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hudud</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Hudud</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (session('danger'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{session('danger')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session('success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{session('warning')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Create
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hudud Create</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/territory" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <label for="Category">Hudud Name:</label>
                                        <input type="text" class="form-control" name="name" placeholder="Name">
                                        @error('name')
                                            <span class="text-danger">
                                                {{$message}}<br>
                                            </span>
                                        @enderror
                                        <label for="User">User name</label>
                                        <select name="user_id" class="form-control">
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-2">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="/category-search" method="GET">
                                @csrf
                                <div class="input-group col-12 mt-2">
                                    <input type="text" name="search" class="form-control search-bar" id="search-bar"
                                        placeholder="Search">
                                    <div class="input-group-append">
                                        <button name="ok"
                                            class="btn btn-primary form-control btn-search">Search</button>
                                    </div>
                                </div>
                            </form>

                            <table id="" class="table table-bordered table-striped mt-2">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>User</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @foreach ($models as $model)
                                        <tr>
                                            <td>{{ $model->id }}</td>
                                            <td>{{ $model->name }}</td>
                                            <td>{{ $model->users->name }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <button type="button" class="btn btn-primary mx-2" data-toggle="modal"
                                                        data-target="#showModal{{$model->id}}">
                                                        Show
                                                    </button>

                                                    <!-- Show Modal -->
                                                    <div class="modal fade" id="showModal{{$model->id}}" tabindex="-1"
                                                        role="dialog" aria-labelledby="showModalLabel{{$model->id}}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="showModalLabel{{$model->id}}">Hudud</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <label for="User">Hudud Name:</label>
                                                                    {{$model->name}}<br>
                                                                    <label for="User">User Name:</label>
                                                                    {{$model->users->name}}<br>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Update Button -->
                                                    <button type="button" class="btn btn-warning mx-2" data-toggle="modal"
                                                        data-target="#updateModal{{$model->id}}">
                                                        Update
                                                    </button>

                                                    <!-- Update Modal -->
                                                    <div class="modal fade" id="updateModal{{$model->id}}" tabindex="-1"
                                                        role="dialog" aria-labelledby="updateModalLabel{{$model->id}}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="updateModalLabel{{$model->id}}">Hudud Update
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="/territory/{{$model->id}}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <label for="User">Hudud Name:</label>
                                                                        <input type="text" class="form-control" name="name"
                                                                            placeholder="Name" value="{{$model->name}}">
                                                                        @error('name')
                                                                            <span class="text-danger">
                                                                                {{$message}}<br>
                                                                            </span>
                                                                        @enderror

                                                                        <label for="User">User name</label>
                                                                        <select name="user_id" class="form-control">
                                                                            @foreach ($users as $user)
                                                                                <option value="{{ $user->id }}" {{ $user->id == $model->users->id ? 'selected' : '' }}>
                                                                                    {{ $user->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('user_id')
                                                                            <span class="text-danger">
                                                                                {{$message}}<br>
                                                                            </span>
                                                                        @enderror



                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Update</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Delete Form -->
                                                    <form action="/territory/{{$model->id}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                    <div>
                        {{$models->links()}}
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>


@endsection