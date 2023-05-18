@extends('layouts.default')

@section('content')
    <br>
    {!! Form::open(['name'=>'form_name', 'route'=>'vendas']) !!}
        <div class="sidebar-form">
            <div class="input-group">
                <input type="text" name="desc_filtro" class="form-control" style="width:80% !important;" placeholder="Pesquisa por nome">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-default"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div> 
    {!! Form::close() !!}

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <th>Data da venda</th>
            <th>Cliente</th>
            <th>Vendedor</th>
            <th>Total venda</th> 
            <th></th>           
        </thead>  
        <tbody>   
            @foreach($vendas as $venda)
                <tr>
                    <td>{{ $venda->data_venda }}</td>
                    <td>{{ $venda->cliente->nome }}</td> 
                    <td>{{ $venda->vendedor->nome}}</td> 
                    <td>{{ $venda->total_venda }}</td> 
                    <td>
                        <a href="{{ route('vendas.detalhes', ['venda' => $venda->id]) }}" class="btn-sm btn-success">Ver detalhes</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $vendas->links() }}
    <br>
    <a href="{{ route('vendas.create', [])}}" class="btn-sm btn-info">Nova Venda</a>
@stop
@section('table-delete')
"vendas"
@endsection

