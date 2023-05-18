@extends('layouts.default')

@section('content')
    <br>
    {!! Form::open(['name'=>'form_name', 'route'=>'pagamentos']) !!}
        <div class="sidebar-form">
            <div class="input-group">
                <input type="text" name="desc_filtro" class="form-control" style="width:80% !important;" placeholder="Pesquisa por venda">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-default"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div> 
    {!! Form::close() !!}

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <th>Descrição</th>
            <th>Data do pagamento</th>
            <th>Valor</th>
            <th>Venda nº</th>      
        </thead>  
        <tbody>   
        @foreach($pagamentos as $pagamento)
                <tr>
                    <td>{{ $pagamento->descricao }}</td>
                    <td>{{ $pagamento->data_pag }}</td>
                    <td>{{ $pagamento->valor }}</td> 
                    <td>{{ $pagamento->id_venda }}</td>  
                </tr>
        @endforeach
        </tbody>
    </table>
    {{ $pagamentos->links() }}
    <br>
    <a href="{{ route('vendas.receber', [])}}" class="btn-sm btn-info">Adicionar Pagamento</a>
@stop
@section('table-delete')
    "pagamentos"
@endsection

