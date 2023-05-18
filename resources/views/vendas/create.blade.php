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
    {!! Form::open(['route'=>'vendas.store']) !!}
        <div class="form-group">
            {!! Form::label('data_venda', 'Data da Venda:') !!}
            {!! Form::date('data_venda', \Carbon\Carbon::now(), ['class' => 'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('cliente_id', 'Cliente:') !!}
            {!! Form::select('cliente_id', \App\Models\Clientes::orderBy('nome')->pluck('nome', 'id')->toArray(),
                                            null, ['class'=>'form-control', 'placeholder' => 'Selecione o cliente']) !!}
        </div>  
        <div class="form-group">
            {!! Form::label('vendedor_id', 'Vendedor:') !!}
            {!! Form::select('vendedor_id', \App\Models\Vendedor::orderBy('nome')->pluck('nome', 'id')->toArray(),
                                            null, ['class'=>'form-control', 'required', 'placeholder' => 'Selecione o vendedor']) !!}
        </div>
            {!! Form::hidden('total_venda', 0) !!} <!-- Campo oculto para total_venda com valor zero -->
        <div class="form-group">
            {!! Form::submit('Próximo', ['class' => 'btn btn-primary']) !!}
            {!! Form::reset ('Limpar',     ['class' => 'btn btn-default']) !!}
        </div>
    {!! Form::close() !!}
@stop
