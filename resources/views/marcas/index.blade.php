@extends('layouts.default')

@section('content')
    <br>
    {!! Form::open(['name'=>'form_name', 'route'=>'marcas']) !!}
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
            <th>Funções</th>
            
        </thead>  
        <tbody>   
            @foreach($marcas as $marca)
                <tr>
                    <td>{{ $marca->nome }}</td>

                    <td>
                        <a href="{{ route('marcas.edit', ['id' =>\Crypt::encrypt($marca->id)]) }}" class="btn-sm btn-success">Editar</a>
                        <a href="#" onclick="return ConfirmaExclusao('{{\Crypt::encrypt($marca->id)}}')" class="btn-sm btn-danger">Remover</a>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $marcas->links() }}
    <br>
    <a href="{{ route('marcas.create', [])}}" class="btn-sm btn-info">Adicionar</a>
@stop
@section('table-delete')
"marcas"
@endsection

