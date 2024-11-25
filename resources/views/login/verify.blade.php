@extends('layouts.main')


@section('title', 'Post')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="/password" method="POST">
                        @csrf
                        <div class="col-5">
                            <div class="mb-3 mt-2">
                                <label for="">Emailga yuborilgan kodni kiriting:</label>

                                <input type="text" name="code" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection