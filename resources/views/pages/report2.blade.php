@extends('layouts.main')

@section('title', 'Task')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Report</h1>
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
                    <div class="row mt-2">
                        <div class="col-12">
                            <form action="/filterReport" method="POST" class="form-inline">
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
                            <table id="" class="table table-bordered table-striped mt-2">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Territories / Perform documents</th>
                                        <th>All documents</th>
                                        <th>Succeful</th>
                                        <th>Expired</th>
                                        <th>In process</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @foreach ($categories as $category)
                                                                        <tr>
                                                                            <td>{{$category->id}}</td>
                                                                            <td>{{$category->name}}</td>
                                                                            <td>
                                                                                @if ($models->where('category_id', $category->id)->where('status', 3)->count() != 0)
                                                                                    {{$models->where('category_id', $category->id)->where('status', 3)->count()}}
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if($models->where('category_id', $category->id)->where('status', 4)->count() != 0)
                                                                                    {{$models->where('category_id', $category->id)->where('status', 4)->count()}}
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if ($models->where('category_id', $category->id)->where('period', '<', now()->yesterday()->startOfDay())->count() != 0)
                                                                                    {{$models->where('category_id', $category->id)->where('period', '<', now()->yesterday()->startOfDay())->count()}}
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @php
    $count = $models->where('category_id', $category->id)
                    ->filter(function ($item) {
                        return in_array($item->status, [1, 2]);
                    })
                    ->count();
@endphp

@if($count != 0)
    {{ $count }}
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