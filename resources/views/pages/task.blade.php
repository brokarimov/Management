@extends('layouts.main')

@section('title', 'Task')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Task</h1>
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
                    <button type="button" class="btn btn-outline-primary btn-lg" style="font-size: 24px;"
                        data-toggle="modal" data-target="#exampleModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-file-plus-fill" viewBox="0 0 16 16">
                            <path
                                d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M8.5 6v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 1 0" />
                        </svg>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Category Create</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <form action="/task" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <label for="Category">Ijrochi:</label>
                                        <input type="text" class="form-control" name="employee" placeholder="Ijrochi">
                                        @error('employee')
                                            <span class="text-danger">
                                                {{$message}}<br>
                                            </span>
                                        @enderror

                                        <label for="Category">Sarlavha:</label>
                                        <input type="text" class="form-control" name="title" placeholder="Sarlavha">
                                        @error('title')
                                            <span class="text-danger">
                                                {{$message}}<br>
                                            </span>
                                        @enderror

                                        <label for="Category">Tavsif:</label>
                                        <input type="text" class="form-control" name="description" placeholder="Tavsif">
                                        @error('description')
                                            <span class="text-danger">
                                                {{$message}}<br>
                                            </span>
                                        @enderror

                                        <label for="Category">File:</label>
                                        <input type="file" class="form-control" name="file">
                                        @error('file')
                                            <span class="text-danger">
                                                {{$message}}<br>
                                            </span>
                                        @enderror

                                        <label for="Category">Muddat:</label>
                                        <input type="date" class="form-control" name="period">
                                        @error('period')
                                            <span class="text-danger">
                                                {{$message}}<br>
                                            </span>
                                        @enderror

                                        <label for="Category">Category:</label>
                                        <select name="category_id" class="form-control">
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">
                                                {{$message}}<br>
                                            </span>
                                        @enderror

                                        <div class="form-group">
                                            <label for="hudud">Hudud</label>
                                            <div class="select2-purple">
                                                <select class="select2" multiple data-placeholder="Select a State"
                                                    style="width: 100%;" name="territory_id[]">
                                                    @foreach ($territories as $territory)
                                                        <option value="{{$territory->id}}">{{$territory->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        @error('territory_id')
                                            <span class="text-danger">
                                                {{$message}}<br>
                                            </span>
                                        @enderror
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
                    <div class="row mt-2">
                        <div class="col-12">
                            <form action="/filter" method="POST" class="form-inline">
                                @csrf
                                <input type="date" id="start_date" class="form-control mr-2" name="start_date">
                                <label for="start_date" class="mr-2"> dan</label>

                                <input type="date" id="end_date" class="form-control mr-2" name="end_date">
                                <label for="end_date" class="mr-2"> gacha</label>

                                <button type="submit" class="btn btn-outline-primary">Filter</button>
                            </form>
                        </div>
                    </div>
                    <div class="card mt-2">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="/task-search" method="GET">
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
                                        <th>Hudud</th>
                                        <th>Ijrochi</th>
                                        <th>Sarlavha</th>
                                        <th>File</th>
                                        <th>Yuborilgan vaqti</th>
                                        <th>Muddat</th>
                                        <th>Holati</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @foreach ($models as $model)
                                        <tr>
                                            <td>{{ $model->id }}</td>
                                            <td>{{ $model->territories->name }}</td>
                                            <td>{{ $model->tasks->employee }}</td>
                                            <td>{{ $model->tasks->title }}</td>
                                            <td>
                                                <a href="{{$model->tasks->file}}" target="_blank"
                                                    class="btn btn-outline-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                        <path
                                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                                        <path
                                                            d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                                                    </svg>
                                                </a>
                                            </td>
                                            <td>{{ $model->created_at }}</td>
                                            <td>{{ $model->tasks->period }}</td>
                                            <td>{{ $model->status }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <button type="button" class="btn btn-outline-primary mx-2"
                                                        data-toggle="modal" data-target="#showModal{{$model->id}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                            <path
                                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                        </svg>
                                                    </button>

                                                    <!-- Show Modal -->
                                                    <div class="modal fade" id="showModal{{$model->id}}" tabindex="-1"
                                                        role="dialog" aria-labelledby="showModalLabel{{$model->id}}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="showModalLabel{{$model->id}}">Topshiriq</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <label for="User">Hudud:</label>
                                                                    {{$model->territories->name}}<br>
                                                                    <label for="User">Ijrochi:</label>
                                                                    {{$model->tasks->employee}}<br>
                                                                    <label for="User">Category:</label>
                                                                    {{$model->tasks->categories->name}}<br>
                                                                    <label for="User">Sarlavha:</label>
                                                                    {{$model->tasks->title}}<br>
                                                                    <label for="User">Tavsifi:</label>
                                                                    {{$model->tasks->description}}<br>
                                                                    <label for="User">File: </label>
                                                                    <a href="{{$model->tasks->file}}"
                                                                        style="text-decoration: underline;"
                                                                        target="_blank">Fileni ochish</a><br>
                                                                    <label for="User">Yuborilgan vaqti:</label>
                                                                    {{$model->created_at}}<br>
                                                                    <label for="User">Muddat:</label>
                                                                    {{$model->tasks->period}}<br>
                                                                    <label for="User">Holati:</label>
                                                                    {{$model->status}}<br>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Update Button -->
                                                    <button type="button" class="btn btn-outline-warning mx-2"
                                                        data-toggle="modal" data-target="#updateModal{{$model->id}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                            <path
                                                                d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                                                        </svg>
                                                    </button>

                                                    <!-- Update Modal -->
                                                    <div class="modal fade" id="updateModal{{$model->id}}" tabindex="-1"
                                                        role="dialog" aria-labelledby="updateModalLabel{{$model->id}}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="updateModalLabel{{$model->id}}">Update:
                                                                        {{$model->id}}
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="/task/{{$model->id}}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <label for="Category">Ijrochi:</label>
                                                                        <input type="text" class="form-control"
                                                                            name="employee" placeholder="Ijrochi"
                                                                            value="{{$model->tasks->employee}}">
                                                                        @error('employee')
                                                                            <span class="text-danger">
                                                                                {{$message}}<br>
                                                                            </span>
                                                                        @enderror

                                                                        <label for="Category">Sarlavha:</label>
                                                                        <input type="text" class="form-control" name="title"
                                                                            placeholder="Sarlavha"
                                                                            value="{{$model->tasks->title}}">
                                                                        @error('title')
                                                                            <span class="text-danger">
                                                                                {{$message}}<br>
                                                                            </span>
                                                                        @enderror

                                                                        <label for="Category">Tavsif:</label>
                                                                        <input type="text" class="form-control"
                                                                            name="description" placeholder="Tavsif"
                                                                            value="{{$model->tasks->description}}">
                                                                        @error('description')
                                                                            <span class="text-danger">
                                                                                {{$message}}<br>
                                                                            </span>
                                                                        @enderror

                                                                        <label for="file">File:</label>

                                                                        

                                                                        <input type="file" class="form-control" name="file">

                                                                        @error('file')
                                                                        <span class="text-danger">
                                                                            {{$message}}<br>
                                                                        </span>
                                                                        @enderror

                                                                        <label for="Category">Muddat:</label>
                                                                        <input type="date" class="form-control"
                                                                            name="period" value="{{$model->tasks->period}}">
                                                                        @error('period')
                                                                            <span class="text-danger">
                                                                                {{$message}}<br>
                                                                            </span>
                                                                        @enderror

                                                                        <label for="Category">Category:</label>
                                                                        <select name="category_id" class="form-control">
                                                                            @foreach ($categories as $category)
                                                                                <option value="{{$category->id}}"
                                                                                    @if($category->id == $model->tasks->category_id)
                                                                                    selected @endif>
                                                                                    {{$category->name}}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('category_id')
                                                                            <span class="text-danger">
                                                                                {{$message}}<br>
                                                                            </span>
                                                                        @enderror

                                                                        <div class="form-group">
                                                                            <label for="hudud">Hudud</label>
                                                                            <div class="select2-purple">
                                                                                <select class="select2" multiple
                                                                                    data-placeholder="Select a State"
                                                                                    style="width: 100%;"
                                                                                    name="territory_id[]">
                                                                                    @php
                                                                                    $array = [];
                                                                                    @endphp
                                                                                    @foreach ($territoryTasks as $territoryTask)
                                                                                        @if ($model->task_id == $territoryTask->task_id)
                                                                                            @php
                                                                                            $array[] = $territoryTask->territory_id
                                                                                            @endphp
                                                                                        @endif
                                                                                    @endforeach
                                                                                    @foreach ($territories as $territory)
                                                                                        
                                                                                        <option value="{{$territory->id}}"
                                                                                            @if(in_array($territory->id, $array)) selected
                                                                                            @endif>
                                                                                            {{$territory->name}}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        @error('territory_id')
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
                                                    <form action="/task/{{$model->id}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                                <path
                                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                            </svg>
                                                        </button>
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