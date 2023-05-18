@extends('layouts.default')

@section('content')
    <br>
    {!! Form::open(['name'=>'form_name', 'route'=>'clientes']) !!}
        <div class="sidebar-form">
            <div class="input-group">
                <input type="text" name="desc_filtro" class="form-control" style="width:80% !important;" placeholder="Pesquisa por nome">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-default"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div> 
    {!! Form::close() !!}
    <br>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <th>Nome</th>
            <th>Endereço</th>
            <th>UF</th>
            <th>Cidade</th>
            <th>Telefone</th>
            <th>Data de Nascimento</th>
            <th>Funções</th>
            
        </thead>  
        <tbody>   
            @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->endereco }}</td> 
                    <td>{{ $cliente->uf }}</td> 
                    <td>{{ $cliente->cidade }}</td> 
                    <td>{{ $cliente->telefone }}</td> 
                    <td>{{ $cliente->data_nascimento }}</td> 

                    <td>
                        <a href="{{ route('clientes.edit', ['id' =>\Crypt::encrypt($cliente->id)]) }}" class="btn-sm btn-success">Editar</a>
                        <a href="#" onclick="return ConfirmaExclusao('{{\Crypt::encrypt($cliente->id)}}')" class="btn-sm btn-danger">Remover</a>
                    </td> 
                    
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $clientes->links() }}
    <br>
    <a href="{{ route('clientes.create', [])}}" class="btn-sm btn-info">Adicionar</a>
@stop
@section('table-delete')
"clientes"
@endsection

