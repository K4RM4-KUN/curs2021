@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Golosina</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($golosina, ['route' => ['golosinas.update', $golosina->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('golosinas.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary saveButton']) !!}
                <a href="{{ route('golosinas.index') }}" class="btn btn-default cancelButton">Cancel</a>
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection
