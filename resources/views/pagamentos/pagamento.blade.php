@extends('adminlte::page')

@section('content')
    <br>
    <div class="card-header">{{ __('Escolher Pagamento') }}</div>
    <br>

    <form action="{{ route('pagamentos.store') }}" method="POST" id="pagamentoForm">
        @csrf
        <input type="hidden" name="venda_id" value="{{ $venda->id }}">

        <div class="form-group">
            <label for="pagamento">Pagamento:</label>
            <select class="form-control" name="pagamento" id="pagamentoSelect">
                <option value="0">Não realizado</option>
                <option value="1">Realizado</option>
            </select>
        </div>

        <div class="form-group">
            {!! Form::label('data_pag', 'Data do Pagamento:') !!}
            {!! Form::date('data_pag', \Carbon\Carbon::now(), ['class' => 'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('valor', 'Valor:') !!}
            {!! Form::number('valor', null, ['class' => 'form-control', 'required', 'disabled', 'id' => 'valorInput']) !!}
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="2" disabled></textarea>
        </div>

        <button type="submit" class="btn btn-sm btn-success">Salvar Pagamento</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Função para habilitar ou desabilitar os campos de acordo com o valor selecionado no campo 'pagamento'
        function toggleCampos() {
            var pagamentoSelect = document.getElementById('pagamentoSelect');
            var valorInput = document.getElementById('valorInput');
            var descricaoTextarea = document.getElementById('descricao');
            var dataPagamento = document.getElementById('data_pag');

            if (pagamentoSelect.value == '0') {
                valorInput.value = '';
                descricaoTextarea.value = '';

                valorInput.disabled = true;
                descricaoTextarea.disabled = true;
                descricaoTextarea.disabled = true;
                dataPagamento.disabled = true;
            } else {
                valorInput.disabled = false;
                descricaoTextarea.disabled = false;
                dataPagamento.disabled = false;
            }
        }

        // Função para obter o valor que falta pagar via requisição AJAX
        function obterFaltaPagar() {
            var vendaId = $('input[name="venda_id"]').val();

            $.ajax({
                url: "{{ route('obter.faltaPagar') }}",
                method: 'GET',
                data: {
                    venda_id: vendaId
                },
                success: function(response) {
                    var faltaPagar = response.falta_pagar;
                    atualizarValorMaximo(faltaPagar);
                },
                error: function() {
                    alert("Ocorreu um erro ao obter o valor que falta pagar.");
                }
            });
        }

        // Função para atualizar o valor máximo do campo 'valor' com base no valor que falta pagar
        function atualizarValorMaximo(valorFaltaPagar) {
            var valorInput = document.getElementById('valorInput');
            valorInput.setAttribute('max', valorFaltaPagar);
        }

        // Chamar a função toggleCampos quando o valor do campo 'pagamento' for alterado
        var pagamentoSelect = document.getElementById('pagamentoSelect');
        pagamentoSelect.addEventListener('change', toggleCampos);

        // Chamar a função toggleCampos inicialmente para definir o estado inicial dos campos
        toggleCampos();

        // Chamar a função obterFaltaPagar inicialmente para obter o valor que falta pagar
        obterFaltaPagar();
    </script>
@endsection