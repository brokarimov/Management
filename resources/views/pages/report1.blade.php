@extends('layouts.main')

@section('title', 'Report')

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
                    <div class="card mt-2">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mt-2"
                                    style="border-collapse: collapse; width: 100%; border: 1px solid #ccc;">
                                    <thead>
                                        <tr>
                                            <th style=" border: 1px solid #ccc;">№</th>
                                            <th style=" border: 1px solid #ccc;">Territories
                                                /<br>Performance<br>documents</th>
                                            <th style=" border: 1px solid #ccc;">
                                                The<br>state<br>of<br>executive<br>discipline</th>
                                            @foreach ($territories as $territory)
                                            <th
                                                style="writing-mode: vertical-rl; transform: rotate(180deg); padding: 10px;  vertical-align: middle; border: 1px solid #ccc;">
                                                {{ $territory->name }}
                                            </th>
                                            @endforeach
                                            <th style=" border: 1px solid #ccc;">
                                                By<br>all<br>territories</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                        <tr>
                                            <td style=" vertical-align: middle; border: 1px solid #ccc;">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td style=" vertical-align: middle; border: 1px solid #ccc;">
                                                {{ $category->name }}
                                            </td>
                                            <td style="padding: 0; border: 1px solid #ccc;">
                                                <table class="table table-bordered"
                                                    style="border-collapse: collapse; width: 100%; margin: 0;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="padding: 8px;  border: 1px solid #ccc;">
                                                                In checking</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 8px;  border: 1px solid #ccc;">
                                                                Successfull</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 8px;  border: 1px solid #ccc;">
                                                                Expired</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 8px;  border: 1px solid #ccc;">
                                                                In process</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            @foreach ($territories as $territory)
                                            <td style="padding: 0; border: 1px solid #ccc;">
                                                <table style="border-collapse: collapse; width: 100%; margin: 0;">
                                                    <tbody>

                                                        <tr>
                                                            <td style="padding: 8px;  border: 1px solid #ccc;">
                                                                <button class="btn btn-warning"
                                                                    style="font-size: 10px; padding: 2px 5px;">
                                                                    {{$models->where('territory_id', $territory->id)->where('category_id', $category->id)->where('status', 3)->count()}}
                                                                </button>


                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 8px;  border: 1px solid #ccc;">
                                                                <button class="btn btn-success"
                                                                    style="font-size: 10px; padding: 2px 5px;">
                                                                    {{$models->where('territory_id', $territory->id)->where('category_id', $category->id)->where('status', 4)->count()}}
                                                                </button>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 8px;  border: 1px solid #ccc;">
                                                                <button class="btn btn-danger"
                                                                    style="font-size: 10px; padding: 2px 5px;">
                                                                    {{$models->where('territory_id', $territory->id)->where('category_id', $category->id)->where('period', '<', now()->yesterday()->startOfDay())->count()}}
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 8px;  border: 1px solid #ccc;">
                                                                <button class="btn btn-info"
                                                                    style="font-size: 10px; padding: 2px 5px;">
                                                                    {{$models->where('category_id', $category->id)->where('territory_id', $territory->id)
                                                                            ->filter(function ($item) {
                                                                            return in_array($item->status, [1, 2]);
                                                                            })->count();}}
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            @endforeach
                                            <td style="padding: 0; border: 1px solid #ccc;">
                                                <table style="border-collapse: collapse; width: 100%; margin: 0;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="padding: 8px;  border: 1px solid #ccc;">
                                                                <button class="btn btn-warning"
                                                                    style="font-size: 10px; padding: 2px 5px;">
                                                                    {{$models->where('category_id', $category->id)->where('status', 3)->count()}}
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 8px;  border: 1px solid #ccc;">
                                                                <button class="btn btn-success"
                                                                    style="font-size: 10px; padding: 2px 5px;">
                                                                    {{$models->where('category_id', $category->id)->where('status', 4)->count()}}
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 8px;  border: 1px solid #ccc;">
                                                                <button class="btn btn-danger"
                                                                    style="font-size: 10px; padding: 2px 5px;">
                                                                    {{$models->where('category_id', $category->id)->where('period', '<', now()->yesterday()->startOfDay())->count()}}
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 8px;  border: 1px solid #ccc;">
                                                                <button class="btn btn-info"
                                                                    style="font-size: 10px; padding: 2px 5px;">
                                                                    {{$models->where('category_id', $category->id)
                                                                        ->filter(function ($item) {
                                                                        return in_array($item->status, [1, 2]);
                                                                        })->count();}}
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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