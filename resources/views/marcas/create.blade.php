@extends('adminlte::page')

@section('content')

    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <br>
    {!! Form::open(['route'=>'marcas.store'])!!}
        <div class="form-group">
            {!! Form::label('nome', 'Nome:') !!}
            {!! Form::text('nome', null, ['class' => 'form-control', 'required']) !!}
        </div>
        <br>
        <div class="form-group">
            {!! Form::submit('Criar marca', ['class' => 'btn btn-primary']) !!}
            {!! Form::reset ('Limpar',     ['class' => 'btn btn-default']) !!}
        </div>
    {!! Form::close() !!}
@stop
