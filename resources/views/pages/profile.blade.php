@extends('layouts.main')

@section('title', 'User')

@section('content')

<div class="content-wrapper">


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
                    <h1>Shaxsiy kabinet</h1>
                    <form action="/profile" method="POST">
                        @csrf
                        <div class="col-4">
                            <label for="">Ism:</label>
                            <input type="text" name="name" placeholder="name" class="form-control">
                            <label for="">Email</label>
                            <input type="email" name="email" placeholder="Email" class="form-control">
                            <label for="">Parol</label>
                            <input type="password" name="password" class="form-control" placeholder="Parol">
                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
                        </div>
                    </form>


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