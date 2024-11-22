@extends('layouts.main')

@section('title', 'Task')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Topshiriq</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>Barchasi - {{$countAll}}</h3>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="/management/{{1}}" class="small-box-footer">Hammasini ko'rish <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>2 kun - {{$countTwo}}</h3>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="/management/{{2}}" class="small-box-footer">Hammasini ko'rish <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>Ertaga - {{$countTomorrow}}</h3>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="/management/{{3}}" class="small-box-footer">Hammasini ko'rish <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>Bugun - {{$countToday}}</h3>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="/management/{{4}}" class="small-box-footer">Hammasini ko'rish <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>Muddati buzilgan - {{$countExpired}}</h3>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="/management/{{5}}" class="small-box-footer">Hammasini ko'rish <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>Hal etilgan - {{$countAccepted}}</h3>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="/management/{{6}}" class="small-box-footer">Hammasini ko'rish <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>





                    <!-- Button trigger modal -->


                    <div class="card mt-2">

                        <!-- /.card-header -->
                        <div class="card-body">


                            <table id="" class="table table-bordered table-striped mt-2">
                                <thead>
                                    <tr>
                                        <th>Hudud</th>
                                        @foreach ($categories as $category)
                                            <th>{{ $category->name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($territories as $territory)
                                                                    <tr>
                                                                        <td>{{ $territory->name }}</td>

                                                                        @foreach ($categories as $category)
                                                                                                            <td>
                                                                                                                @php
                                                                                                                    $count = $models->where('territory_id', $territory->id)->where('category_id', $category->id)->count() 
                                                                                                                @endphp
                                                                                                                @if ($count != 0)
                                                                                                                    <form action="/onetask" method="POST">
                                                                                                                        @csrf
                                                                                                                        <input type="hidden" name="territory_id" value="{{$territory->id}}">
                                                                                                                        <input type="hidden" name="category_id" value="{{$category->id}}">
                                                                                                                        <button type="submit" class="btn btn-outline-{{$btnColor}}">{{$count}}</button>
                                                                                                                    </form>
                                                                                                                @endif
                                                                                                            </td>
                                                                        @endforeach
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