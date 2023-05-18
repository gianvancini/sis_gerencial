@extends('layouts.default')

@section('content')
    <br>
    {!! Form::open(['name'=>'form_name', 'route'=>'vendedores']) !!}
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
            <th>Nome</th>
            <th>Endereço</th>
            <th>UF</th>
            <th>Cidade</th>
            <th>Telefone</th>
            <th>Data de Nascimento</th>
            <th>Data de Admissão</th>
            <th>Funções</th>
            
        </thead>  
        <tbody>   
            @foreach($vendedores as $vendedor)
                <tr>
                    <td>{{ $vendedor->nome }}</td>
                    <td>{{ $vendedor->endereco }}</td> 
                    <td>{{ $vendedor->uf }}</td> 
                    <td>{{ $vendedor->cidade }}</td> 
                    <td>{{ $vendedor->telefone }}</td> 
                    <td>{{ $vendedor->data_nascimento }}</td> 
                    <td>{{ $vendedor->data_admissao }}</td>

                    <td>
                        <a href="{{ route('vendedores.edit', ['id' =>\Crypt::encrypt($vendedor->id)]) }}" class="btn-sm btn-success">Editar</a>
                        <a href="#" onclick="return ConfirmaExclusao('{{\Crypt::encrypt($vendedor->id)}}')" class="btn-sm btn-danger">Remover</a>
                    </td> 
                    
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $vendedores->links() }}
    <br>
    <a href="{{ route('vendedores.create', [])}}" class="btn-sm btn-info">Adicionar</a>
@stop
@section('table-delete')
"vendedores"
@endsection

