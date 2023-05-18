@extends('layouts.default')

@section('content')
    <br>
    <form name="form_name" action="{{ route('vendas.detalhes', ['venda' => $venda->id]) }}" method="GET">
        <div class="sidebar-form">
            <div class="input-group">
                <input type="text" name="desc_filtro" class="form-control" style="width:80% !important;" placeholder="Pesquisa...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-default"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div> 
    {!! Form::close() !!}

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Desconto</th>
            <th>Item Total</th>           
        </thead>  
        <tbody>   
        @foreach($produtosVenda as $produtoVenda)
            <tr>
                <td>{{ $produtoVenda->produto->nome }}</td>
                <td>{{ $produtoVenda->quantidade }}</td>
                <td>{{ $produtoVenda->desconto }}</td>
                <td>{{ $produtoVenda->item_total }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ route('vendas', [])}}" class="btn-sm btn-info">Voltar</a>
@stop

