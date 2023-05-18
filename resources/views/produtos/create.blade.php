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
    {!! Form::open(['route'=>'produtos.store'])!!}
        <div class="form-group">
            {!! Form::label('nome', 'Nome:') !!}
            {!! Form::text('nome', null, ['class' => 'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('marca_id', 'Marca:') !!}
            {!! Form::select('marca_id', \App\Models\Marca::orderBy('nome')->pluck('nome', 'id')->toArray(),
                                            null, ['class'=>'form-control', 'placeholder' => 'Selecione a marca']) !!}
        </div>  
        <div class="form-group">
            {!! Form::label('tipo_id', 'Tipo:') !!}
            {!! Form::select('tipo_id', \App\Models\Tipo::orderBy('nome')->pluck('nome', 'id')->toArray(),
                                            null, ['class'=>'form-control', 'required', 'placeholder' => 'Selecione o tipo']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('preco_custo', 'Preço Custo:') !!}
            {!! Form::text('preco_custo', null, ['class' => 'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('preco_venda', 'Preço Venda:') !!}
            {!! Form::text('preco_venda', null, ['class' => 'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('estoque', 'Estoque:') !!}
            {!! Form::number('estoque', null, ['class' => 'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            <label for="observacao">Observações:</label>
            <textarea class="form-control" id="observacao" name="observacao" rows="3" ></textarea>
        </div>
        <div class="form-group">
            {!! Form::submit('Criar Produto', ['class' => 'btn btn-primary']) !!}
            {!! Form::reset ('Limpar',     ['class' => 'btn btn-default']) !!}
        </div>
    {!! Form::close() !!}
@stop
