@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Car Details</h1>
                </div>
                <div class="col-sm-6 mt-5">
                    <a class="btn btn-default float-right backButton"
                       href="{{ route('cars.index') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">

            <div class="card-body">
                <div class="row content">
                    @include('cars.show_fields')
                </div>
            </div>

        </div>
    </div>
@endsection