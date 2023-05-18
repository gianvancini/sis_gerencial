@extends('layouts.default')

@section('content')
    <br>
    {!! Form::open(['name'=>'form_name', 'route'=>'vendas.receber']) !!}
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
            <tr>
                <th>Data da venda</th>
                <th>Cliente</th>
                <th>Total venda</th> 
                <th>Falta Pagar</th>
                <th></th>
            </tr>
        </thead>  
        <tbody>   
            @foreach($vendas as $venda)
                <tr>
                    <td>{{ $venda->data_venda }}</td>
                    <td>{{ $venda->cliente->nome }}</td>  
                    <td>{{ $venda->total_venda }}</td> 
                    <td>{{ $venda->falta_pagar }}</td> 
                    <td>
                        <a href="{{ route('vendas.pagamento', ['venda' => $venda->id]) }}" class="btn-sm btn-success">Adicionar pagamento</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $vendas->links() }}
    <br>
@stop