@extends('adminlte::page')

@section('content')
    <h3>Editando marca: {{ $marca->nome }}</h3>

    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <br>
    <div class="card-header">{{ __('Editando marca') }}</div>
    <br>
    {!! Form::open(['route'=>["marcas.update", 'id'=>$marca->id], 'method' => 'put'])  !!}
        <div class="form-group">
            {!! Form::label('nome', 'Nome:') !!}
            {!! Form::text('nome', $marca->nome, ['class' => 'form-control', 'required']) !!}
        </div>
        <br>
        <div class="form-group">
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
            {!! Form::reset ('Limpar',     ['class' => 'btn btn-default']) !!}
        </div>

    {!! Form::close() !!}
@stop
