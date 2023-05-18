@extends('layouts.default')

@section('content')
 <br>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="card-title"><i class="fas fa-dollar-sign"></i> Cotação do Dólar Turismo</h4>
                    </div>
                    <div class="card-body">
                        @if ($cotacao)
                            <h5 class="card-text">R$ {{ number_format($cotacao, 2, ',', '.') }}</h5>
                        @else
                            <p class="card-text">Falha ao obter cotação do dólar turismo</p>
                        @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-success">
                        <h4 class="card-title"><i class="fas fa-chart-line"></i> Vendas do Dia</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Total: R$ {{ number_format($valor_vendas_dia, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-info">
                        <h4 class="card-title"><i class="fas fa-chart-line"></i> Vendas do Mês</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Total: R$ {{ number_format($valor_vendas_mes, 2, ',', '.') }}</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-warning">
                        <h4 class="card-title"><i class="fas fa-chart-line"></i> Vendas do Ano</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Total: R$ {{ number_format($valor_vendas_ano, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-danger">
                        <h4 class="card-title"><i class="fas fa-chart-bar"></i> Gráfico de Vendas</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="grafico-vendas"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <a href="{{ route('vendas.create', [])}}" class="btn btn-info btn-lg"><i class="fas fa-plus"></i> Nova Venda</a>
                <a href="{{ route('vendas.receber', [])}}" class="btn btn-primary btn-lg"><i class="fas fa-money-bill"></i> Adicionar Pagamento</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var vendasPorMes = {!! $vendas_por_mes->toJson() !!};

            var meses = [];
            var valores = [];

            // Separando as chaves e valores do objeto
            for (var mes in vendasPorMes) {
                meses.push('Mês ' + mes);
                valores.push(vendasPorMes[mes]);
            }

            var ctx = document.getElementById('grafico-vendas').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: meses,
                    datasets: [{
                        label: 'Vendas por Mês',
                        data: valores,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1000 // Defina o intervalo do eixo y de acordo com a sua necessidade
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
