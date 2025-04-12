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
                                <a href="/taskUser/{{1}}" class="small-box-footer">See all <i
                                        class="fas fa-arrow-circle-right"></i></a>
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
                                <a href="/taskUser/{{2}}" class="small-box-footer">See all <i
                                        class="fas fa-arrow-circle-right"></i></a>
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
                                <a href="/taskUser/{{3}}" class="small-box-footer">See all <i
                                        class="fas fa-arrow-circle-right"></i></a>
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
                                <a href="/taskUser/{{4}}" class="small-box-footer">See all <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>Date expired - {{$countExpired}}</h3>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="/taskUser/{{5}}" class="small-box-footer">See all <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Button trigger modal -->
                    <div class="row mt-2">
                        <div class="col-12">
                            <form action="/filterUser" method="POST" class="form-inline">
                                @csrf
                                <label for="start_date" class="mr-2"> from</label>
                                <input type="date" id="start_date" class="form-control mr-2" name="start_date">

                                <label for="end_date" class="mr-2"> to</label>
                                <input type="date" id="end_date" class="form-control mr-2" name="end_date">

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
                                        <th>Territory</th>
                                        <th>Performer</th>
                                        <th>Title</th>
                                        <th>File</th>
                                        <th>Sent time</th>
                                        <th>Period</th>
                                        <th>Status</th>
                                        <th>Answer</th>

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
                                                <a href="{{ asset($model->tasks->file) }}" target="_blank"
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
                                            <td>
                                                @if ($model->status == 1)
                                                    <form action="/accept/{{$model->id}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="accept" value="2">
                                                        <button class="btn btn-outline-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @elseif($model->status == 2)

                                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                                        data-target="#exampleModal{{$model->id}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                                                            <path
                                                                d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z" />
                                                        </svg>
                                                    </button>

                                                    <div class="modal fade" id="exampleModal{{$model->id}}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">ID:
                                                                        {{$model->id}}
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="/answerStore" method="POST"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input type="hidden" name="task_id"
                                                                            value="{{$model->id}}">
                                                                        @error('task_id')
                                                                            <span class="text-danger">
                                                                                {{$message}}<br>
                                                                            </span>
                                                                        @enderror
                                                                        <input type="hidden" name="territory_id"
                                                                            @foreach(auth()->user()->territories as $territory)
                                                                            value="{{$territory->id}}" @endforeach>
                                                                        @error('territory_id')
                                                                            <span class="text-danger">
                                                                                {{$message}}<br>
                                                                            </span>
                                                                        @enderror
                                                                        <label for="Answer">Title</label>
                                                                        <input type="text" class="form-control" name="title"
                                                                            placeholder="Sarlavha"
                                                                            value="{{$model->tasks->title}}">
                                                                        @error('title')
                                                                            <span class="text-danger">
                                                                                {{$message}}<br>
                                                                            </span>
                                                                        @enderror
                                                                        <label for="Answer">File</label>
                                                                        <input type="file" name="file" class="form-control">
                                                                        @error('file')
                                                                            <span class="text-danger">
                                                                                {{$message}}<br>
                                                                            </span>
                                                                        @enderror

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">
                                                                        Submit
                                                                    </button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($model->status == 3)
                                                    <p style="color:blue">Answer was sent</p>
                                                @elseif($model->status == 4)
                                                    <p style="color:green">Successful</p>
                                                @elseif($model->status == 5)
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                                        data-target="#exampleModal{{$model->id}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                            <path
                                                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                                        </svg>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{$model->id}}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Anser was declined: {{$model->id}}
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <label for="">Comment: </label>
                                                                    @foreach ($model->answers as $answer)
                                                                        {{$answer->comment}}
                                                                    @endforeach

                                                                    <form action="/reanswer/{{$model->id}}" method="POST"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input type="hidden" name="reanswer" value="3">
                                                                        <input type="hidden" name="status" value="1">
                                                                        <label for="Answer">Title</label>
                                                                        <input type="text" class="form-control" name="title"
                                                                            placeholder="{{$model->tasks->title}}">

                                                                        @error('title')
                                                                            <span class="text-danger">
                                                                                {{$message}}<br>
                                                                            </span>
                                                                        @enderror
                                                                        <label for="Answer">File</label>
                                                                        <input type="file" name="file" class="form-control">
                                                                        @error('file')
                                                                            <span class="text-danger">
                                                                                {{$message}}<br>
                                                                            </span>
                                                                        @enderror

                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">
                                                                                Re-send
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                @endif


                                            </td>
                                            <td>
                                                @if ($model->answers)
                                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                                        data-target="#exampleModal{{$model->id}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                            <path
                                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                        </svg>
                                                    </button>


                                                    <div class="modal fade" id="exampleModal{{$model->id}}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Answer
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @foreach ($model->answers as $answer)
                                                                        <label for="Answer">Title: </label>
                                                                        {{$answer->title}}<br>
                                                                        <label for="Answer">File: </label>
                                                                        <a href="{{ asset($model->tasks->file) }}"
                                                                            style="text-decoration: underline;"
                                                                            target="_blank">Open file</a><br>
                                                                    @endforeach
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

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