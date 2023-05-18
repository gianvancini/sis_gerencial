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
            }
        });
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
    {!! Form::open(['route'=>'vendedores.store'])!!}
        <div class="form-group">
            {!! Form::label('nome', 'Nome:') !!}
            {!! Form::text('nome', null, ['class' => 'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('endereco', 'Endereço:') !!}
            {!! Form::text('endereco', null, ['class' => 'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            <label for="uf">UF:</label>
            <select class="form-control" name="uf" id="uf" required>
                <option value="">Selecione o estado</option>
            </select>
        </div>
        <div class="form-group">
            <label for="cidade">Cidade:</label>
            <select class="form-control" name="cidade" id="cidade" required>
                <option value="">Selecione o estado primeiro</option>
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('telefone', 'Telefone:') !!}
            {!! Form::text('telefone', null, ['class' => 'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('data_nascimento', 'Data de Nascimento:') !!}
            {!! Form::date('data_nascimento', null, ['class' => 'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('data_admissao', 'Data de Admissão:') !!}
            {!! Form::date('data_admissao', null, ['class' => 'form-control', 'required']) !!}
        </div>
        <br>
        <div class="form-group">
            {!! Form::submit('Criar vendedor', ['class' => 'btn btn-primary']) !!}
            {!! Form::reset ('Limpar',     ['class' => 'btn btn-default']) !!}
        </div>
    {!! Form::close() !!}

@stop
