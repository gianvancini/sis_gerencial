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
    <div class="card-header">{{ __('Editando tipo') }}</div>
    <br>
    {!! Form::open(['route'=>["tipos.update", 'id'=>$tipo->id], 'method' => 'put'])  !!}
        <div class="form-group">
            {!! Form::label('nome', 'Nome:') !!}
            {!! Form::text('nome', $tipo->nome, ['class' => 'form-control', 'required']) !!}
        </div>
        <br>
        <div class="form-group">
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
            {!! Form::reset ('Limpar',     ['class' => 'btn btn-default']) !!}
        </div>

    {!! Form::close() !!}
@stop
