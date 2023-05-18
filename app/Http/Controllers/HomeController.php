<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Venda;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Valor das vendas do dia
        $valor_vendas_dia = Venda::whereDate('data_venda', now()->toDateString())->sum('total_venda');

        // Valor das vendas do mês
        $valor_vendas_mes = Venda::whereMonth('data_venda', now()->month)->sum('total_venda');

        // Valor das vendas do ano
        $valor_vendas_ano = Venda::whereYear('data_venda', now()->year)->sum('total_venda');

        // Dados das vendas por mês no ano atual
        $vendas_por_mes = Venda::select(DB::raw('MONTH(data_venda) as mes'), DB::raw('SUM(total_venda) as total'))
            ->whereYear('data_venda', now()->year)
            ->groupBy(DB::raw('MONTH(data_venda)'))
            ->pluck('total', 'mes');

        $cotacao = $this->getCotacao();

        return view('home', compact('valor_vendas_dia', 'valor_vendas_mes', 'valor_vendas_ano', 'cotacao', 'vendas_por_mes'));
    }

    public function getCotacao()
    {
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/USD');

        if ($response->ok()) {
            $data = $response->json();
            $cotacao = $data['rates']['BRL'];

            return $cotacao;
        }

        return null;
    }
}
