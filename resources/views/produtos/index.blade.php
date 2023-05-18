@extends('layouts.default')

@section('content')
    <br>
    {!! Form::open(['name'=>'form_name', 'route'=>'produtos']) !!}
        <div class="sidebar-form">
            <div class="input-group">
                <input type="text" name="desc_filtro" class="form-control" style="width:80% !important;" placegolder="Pesquisa...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-default"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div> 
    {!! Form::close() !!}

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <th>Nome</th>
            <th>Marca</th>
            <th>Tipo</th>
            <th>Preço Custo</th>
            <th>Preço Venda</th>
            <th>Estoque</th>
            <th>Observação</th>
            
        </thead>  
        <tbody>   
            @foreach($produtos as $produto)
                <tr>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->marca->nome }}</td> 
                    <td>{{ $produto->tipo->nome }}</td> 
                    <td>{{ $produto->preco_custo }}</td> 
                    <td>{{ $produto->preco_venda }}</td> 
                    <td>{{ $produto->estoque }}</td> 
                    <td>{{ $produto->observacao }}</td> 

                    <td>
                        <a href="{{ route('produtos.edit', ['id' =>\Crypt::encrypt($produto->id)]) }}" class="btn-sm btn-success">Editar</a>
                        <a href="#" onclick="return ConfirmaExclusao('{{\Crypt::encrypt($produto->id)}}')" class="btn-sm btn-danger">Remover</a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $produtos->links() }}
    <br>
    <a href="{{ route('produtos.create', [])}}" class="btn-sm btn-info">Adicionar</a>
@stop
@section('table-delete')
"produtos"
@endsection

