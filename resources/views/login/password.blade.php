@extends('layouts.main')


@section('title', 'Parol')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="/passwordUpdate" method="POST">
                        @csrf
                        <div class="col-5">
                            <div class="mb-3 mt-2">
                                <label for="">Parolni kiriting:</label>

                                <input type="password" name="password" class="form-control">
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