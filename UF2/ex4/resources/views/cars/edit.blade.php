@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Car</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($car, ['route' => ['cars.update', $car->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('cars.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary saveButton']) !!}
                <a href="{{ route('cars.index') }}" class="btn btn-default cancelButton">Cancel</a>
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection
