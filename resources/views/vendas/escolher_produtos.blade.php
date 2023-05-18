@extends('adminlte::page')

@section('content')
    <br>
    <div class="card-header">{{ __('Selecione o(s) produto(s)') }}</div>
    <br>

    <form action="{{ route('vendas.produtos', ['venda' => $venda->id]) }}" method="POST">
        @csrf
        <div id="produtos-container">
            <div class="produto-form form-row align-items-center">
                <div class="form-group">
                    <label for="produto-select">Produto:</label>
                    <select class="form-control produto-select" name="produtos[0][id]">
                        <option value="">Selecione um produto</option>
                        @foreach ($produtos as $produto)
                            @if ($produto->estoque > 0)
                                <option value="{{ $produto->id }}" data-valor="{{ $produto->valor }}">{{ $produto->nome }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantidade">Quantidade:</label>
                    <input class="form-control quantidade quantidade-produto" type="number" name="produtos[0][quantidade]" required>
                </div>
                <div class="form-group">
                    <label for="desconto">Desconto:</label>
                    <input class="form-control desconto" type="number" name="produtos[0][desconto]" value="0">
                </div>
                <div class="form-group">
                    <label for="valor-final">Valor Final:</label>
                    <input class="form-control valor-final" type="text" name="produtos[0][valor_final]" readonly>
                </div>
                    <input type="hidden" name="venda_id" value="{{ $venda->id }}">
                    <button type="button" class="btn btn-sm btn-danger remover-produto mb-2" style="height: 35px; margin-top: 20px;">Remover</button>
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-primary adicionar-produto">Adicionar Produto</button>
        <button type="submit" id="btn-salvar-produtos" class="btn btn-sm btn-success">Salvar Produtos</button>
    </form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var contador = 1;

        // Adicionar produto
        $(".adicionar-produto").click(function() {
            var novoProduto = $(".produto-form").first().clone();

            novoProduto.find(".produto-select").attr("name", "produtos[" + contador + "][id]");
            novoProduto.find(".quantidade").attr("name", "produtos[" + contador + "][quantidade]");
            novoProduto.find(".desconto").attr("name", "produtos[" + contador + "][desconto]");
            novoProduto.find(".valor-final").attr("name", "produtos[" + contador + "][valor_final]");

            novoProduto.find(".produto-select").val("");
            novoProduto.find(".quantidade").val("");
            novoProduto.find(".desconto").val("0");
            novoProduto.find(".valor-final").val("");

            novoProduto.appendTo("#produtos-container");

            contador++;
        });

        // Remover produto
        $(document).on("click", ".remover-produto", function() {
            $(this).closest(".produto-form").remove();
            atualizarEstadoBotaoEscolher();
        });

        function atualizarEstadoBotaoEscolher() {
            var quantidadeProdutos = $(".produto-form").length;
            var produtosSelecionados = 0;

            $(".produto-select").each(function() {
                var produtoId = $(this).val();

                if (produtoId !== "") {
                    produtosSelecionados++;
                }
            });

            if (produtosSelecionados === 0) {
                $("#btn-salvar-produtos").prop("disabled", true);
            } else {
                $("#btn-salvar-produtos").prop("disabled", false);
            }
        }

        // Calcular valor final
        $(document).on("change", ".produto-select, .quantidade, .desconto", function() {
            var produtoForm = $(this).closest(".produto-form");
            var produtoId = produtoForm.find(".produto-select option:selected").val();
            var quantidade = parseInt(produtoForm.find(".quantidade").val());
            var desconto = parseInt(produtoForm.find(".desconto").val());

            atualizarEstadoBotaoEscolher();
            

            if (!isNaN(produtoId) && !isNaN(quantidade) && !isNaN(desconto)) {
                $.ajax({
                    url: "{{ route('obter.preco_venda') }}", // Substitua pela rota correta que retorna o preço de venda do produto
                    method: 'GET',
                    data: {
                        produto_id: produtoId
                    },
                    success: function(response) {
                        var valorProduto = parseFloat(response.preco_venda);
                        var valorFinal = (valorProduto * quantidade) - desconto;
                        produtoForm.find(".valor-final").val(valorFinal.toFixed(2));
                    },
                    error: function() {
                        alert("Ocorreu um erro ao obter o preço de venda do produto.");
                    }
                });
            }
        });

        // Atualizar estoque
        $(document).on("change", ".produto-select", function() {
            var produtoForm = $(this).closest(".produto-form");
            var produtoId = $(this).val();
            var quantidadeInput = produtoForm.find(".quantidade");

            if (!isNaN(produtoId)) {
                $.ajax({
                    url: "{{ route('obter.estoque') }}",
                    method: 'GET',
                    data: {
                        produto_id: produtoId
                    },
                    success: function(response) {
                    var estoque = response.estoque;
                    atualizarQuantidadeMaxima(estoque);
                },
                error: function() {
                    alert("Ocorreu um erro ao obter o estoque do produto.");
                }
                });
            }

        // Evento de alteração do produto selecionado
        $(document).on("change", ".produto-select", function() {
            var produtoId = $(this).val();
            obterEstoque(produtoId);
        });

        // Função para atualizar a quantidade máxima do campo de quantidade
        function atualizarQuantidadeMaxima(estoque) {
            $(".quantidade").attr("max", estoque);
        }

        // Verificar quantidade máxima
        $(document).on("input", ".quantidade", function() {
            var quantidadeInput = $(this);
            var estoque = parseFloat(quantidadeInput.attr("max"));
            verificarQuantidadeMaxima(quantidadeInput, estoque);
        });

        function verificarQuantidadeMaxima(quantidadeInput, estoque) {
            var quantidade = parseFloat(quantidadeInput.val());

            if (!isNaN(quantidade) && quantidade > estoque) {
                quantidadeInput.val(estoque);
            }
        }
    });
        atualizarEstadoBotaoEscolher();
    });
</script>

@endsection



