@extends('adminlte::page')

@section('js')
<script>
    $.getJSON('https://servicodados.ibge.gov.br/api/v1/localidades/estados', function(data) {
        var items = '<option value="">Selecione o estado</option>';
        data.sort(function(a, b) {
            var nameA = a.nome.toUpperCase();
            var nameB = b.nome.toUpperCase();
            if (nameA < nameB) {
                return -1;
            }
            if (nameA > nameB) {
                return 1;
            }
            return 0;
        });
        $.each(data, function(key, value) {
            items += '<option value="' + value.sigla + '">' + value.nome + '</option>';
        });
        $('#uf').html(items);
        $('#uf').val('{{ $cliente->uf }}');
        // Verifica se há um estado selecionado para carregar a lista de cidades correspondente
        if ('{{ $cliente->uf }}') {
            $.getJSON('https://servicodados.ibge.gov.br/api/v1/localidades/estados/{{ $cliente->uf }}/municipios', function(data) {
                var items = '<option value="">Selecione a cidade</option>';
                $.each(data, function(key, value) {
                    items += '<option value="' + value.nome + '">' + value.nome + '</option>';
                });
                $('#cidade').html(items);
                $('#cidade').val('{{ $cliente->cidade }}');
            });
        }
    });

    // Buscar lista de cidades do IBGE
    $('#uf').change(function() {
        var uf = $(this).val();
        if (uf) {
            $.getJSON('https://servicodados.ibge.gov.br/api/v1/localidades/estados/' + uf + '/municipios', function(data) {
                var items = '<option value="">Selecione a cidade</option>';
                $.each(data, function(key, value) {
                    items += '<option value="' + value.nome + '">' + value.nome + '</option>';
                });
                $('#cidade').html(items);
            });
        } else {
            $('#cidade').html('<option value="">Selecione o estado primeiro</option>');
            $('#cidade').val('');
        }
    });

</script>
@stop

@section('content')

    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <br>
    <div class="card-header">{{ __('Editando produto') }}</div>
    <br>
    {!! Form::open(['route'=>["clientes.update", 'id'=>$cliente->id], 'method' => 'put'])  !!}
        <div class="form-group">
            {!! Form::label('nome', 'Nome:') !!}
            {!! Form::text('nome', $cliente->nome, ['class' => 'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('endereco', 'Endereço:') !!}
            {!! Form::text('endereco', $cliente->endereco, ['class' => 'form-control', 'required']) !!}
        </div>
        <div class="form-group">
        <label for="uf">UF:</label>
            <select class="form-control" name="uf" id="uf" required>
                @foreach ($estados as $estado)
                    <option value="{{ $estado['sigla'] }}" {{ $estado['sigla'] == $cliente->uf ? 'selected' : '' }}>
                        {{ $estado['nome'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="cidade">Cidade:</label>
            <select class="form-control" name="cidade" id="cidade" required>
                <option value="">Selecione a cidade</option>
                @foreach ($cidades as $cidade)
                    <option value="{{ $cidade['nome'] }}" {{ $cidade['nome'] == $cliente->cidade ? 'selected' : '' }}>
                        {{ $cidade['nome'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('telefone', 'Telefone:') !!}
            {!! Form::text('telefone', $cliente->telefone, ['class' => 'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('data_nascimento', 'Data de Nascimento:') !!}
            {!! Form::date('data_nascimento', $cliente->data_nascimento, ['class' => 'form-control', 'required']) !!}
        <br>
        <div class="form-group">
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
            {!! Form::reset ('Limpar',     ['class' => 'btn btn-default']) !!}
        </div>

    {!! Form::close() !!}
@stop
