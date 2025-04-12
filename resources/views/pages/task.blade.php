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
                    <div class="row">
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>All - {{$countAll}}</h3>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="/task/{{1}}" class="small-box-footer">See all <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>2 days - {{$countTwo}} </h3>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="/task/{{2}}" class="small-box-footer">See all <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="col-lg-4 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>Tomorrow - {{$countTomorrow}}</h3>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="/task/{{3}}" class="small-box-footer">See all <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="col-lg-6 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>Today - {{$countToday}}</h3>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="/task/{{4}}" class="small-box-footer">See all <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="col-lg-6 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>Expired - {{$countExpired}}</h3>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="/task/{{5}}" class="small-box-footer">See all <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>


                   

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-primary btn-lg" style="font-size: 24px;"
                        data-toggle="modal" data-target="#exampleModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
  <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
</svg>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Task Create</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <form action="/task" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <label for="Category">Performer:</label>
                                        <input type="text" class="form-control" name="employee" placeholder="Performer">
                                        @error('employee')
                                            <span class="text-danger">
                                                {{$message}}<br>
                                            </span>
                                        @enderror

                                        <label for="Category">Title:</label>
                                        <input type="text" class="form-control" name="title" placeholder="Title">
                                        @error('title')
                                            <span class="text-danger">
                                                {{$message}}<br>
                                            </span>
                                        @enderror

                                        <label for="Category">Description:</label>
                                        <input type="text" class="form-control" name="description" placeholder="Description">
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

                                        <label for="Category">Period:</label>
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
                                            <label for="hudud">Territory</label>
                                            <div class="select2-purple">
                                                <select class="select2" multiple data-placeholder="Select a Territory"
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
                                <label for="start_date" class="mr-2"></label>

                                <input type="date" id="end_date" class="form-control mr-2" name="end_date">
                                <label for="end_date" class="mr-2"></label>

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
                                            class="btn btn-outline-primary form-control btn-search">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg>
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <table id="" class="table table-bordered table-striped mt-2">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Territory</th>
                                        <th>Performer</th>
                                        <th>Title</th>
                                        <th>File</th>
                                        <th>Send time</th>
                                        <th>Period</th>
                                        <th>Status</th>
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
    <a href="{{ asset( $model->tasks->file) }}" target="_blank" class="btn btn-outline-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
        </svg>
    </a>
</td>

                                            <td>{{ $model->created_at }}</td>
                                            <td>{{ $model->tasks->period }}</td>
                                            <td>
                                                @if ($model->status == 1)
                                                    <button class="btn btn-outline-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
</svg>
                                                    </button>
                                                @elseif($model->status == 2)
                                                <button class="btn btn-outline-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-open" viewBox="0 0 16 16">
  <path d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.817l5.75 3.45L8 8.917l1.25.75L15 6.217V5.4a1 1 0 0 0-.53-.882zM15 7.383l-4.778 2.867L15 13.117zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734ZM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765z"/>
</svg>
                                                </button>
                                                @elseif($model->status == 3)
                                                    <a href="/answer" class="btn btn-outline-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-reply" viewBox="0 0 16 16">
  <path d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.7 8.7 0 0 0-1.921-.306 7 7 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254l-.042-.028a.147.147 0 0 1 0-.252l.042-.028zM7.8 10.386q.103 0 .223.006c.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96z"/>
</svg>                                          
@elseif($model->status == 4)
<button class="btn btn-outline-success ">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                    fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                                                                </svg>
                                                            </button>
                                                    </a>
                                                @elseif($model->status == 5)
                                                <button class="btn btn-outline-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
</svg>
                                                </button>
                                                @endif
                                            </td>
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
                                                                        id="showModalLabel{{$model->id}}">Task</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <label for="User">Territory:</label>
                                                                    {{$model->territories->name}}<br>
                                                                    <label for="User">Ijrochi:</label>
                                                                    {{$model->tasks->employee}}<br>
                                                                    <label for="User">Category:</label>
                                                                    {{$model->tasks->categories->name}}<br>
                                                                    <label for="User">Title:</label>
                                                                    {{$model->tasks->title}}<br>
                                                                    <label for="User">Description:</label>
                                                                    {{$model->tasks->description}}<br>
                                                                    <label for="User">File: </label>
                                                                    <a href="{{ asset($model->tasks->file) }}"
                                                                        style="text-decoration: underline;"
                                                                        target="_blank">Open file</a><br>
                                                                    <label for="User">Sent time:</label>
                                                                    {{$model->created_at}}<br>
                                                                    <label for="User">Period:</label>
                                                                    {{$model->tasks->period}}<br>
                                                                    <label for="User">Status:</label>
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
                                                                        <label for="Category">Performer:</label>
                                                                        <input type="text" class="form-control"
                                                                            name="employee" placeholder="Ijrochi"
                                                                            value="{{$model->tasks->employee}}">
                                                                        @error('employee')
                                                                            <span class="text-danger">
                                                                                {{$message}}<br>
                                                                            </span>
                                                                        @enderror

                                                                        <label for="Category">Title:</label>
                                                                        <input type="text" class="form-control" name="title"
                                                                            placeholder="Sarlavha"
                                                                            value="{{$model->tasks->title}}">
                                                                        @error('title')
                                                                            <span class="text-danger">
                                                                                {{$message}}<br>
                                                                            </span>
                                                                        @enderror

                                                                        <label for="Category">Description:</label>
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

                                                                        <label for="Category">Period:</label>
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
                                                                            <label for="hudud">Territory</label>
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
                                                                                            @endif
                                                                                            >
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