<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use App\Models\Venda;
use Illuminate\Http\Request;
use App\Http\Requests\PagamentoRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class PagamentoController extends Controller
{
    public function index(Request $filtro) {
        $filtragem = $filtro->get('desc_filtro');
        if($filtragem == null){
            $pagamentos = Pagamento::orderBy('data_pag')->SimplePaginate(7);
        }
        else{
            $pagamentos = Pagamento::where('id_venda', 'like', '%'.$filtragem.'%')
                ->orderBy("data_pag")
                ->simplePaginate(7)
                ->setpath('pagamentos?desc_filtro='.$filtragem);
        }
    
        return view('pagamentos.index', ['pagamentos' => $pagamentos]);
    }

    public function create() {
        return view('pagamentos.create');
    }

    public function store(PagamentoRequest $request) {
        $pagamento = new Pagamento();
        $pagamento->id_venda = $request->input('venda_id');

        // Teste para verificar o ID da venda
        //dd($pagamento->id_venda);
        
        if ($request->input('pagamento') == 1) {
            $pagamento->valor = $request->input('valor');
            $pagamento->descricao = $request->input('descricao');
            $pagamento->data_pag = $request->input('data_pag');
            $pagamento->save();
    
            // Buscar a venda correspondente
            $venda = Venda::find($pagamento->id_venda);
    
            // Subtrair o valor do pagamento da coluna 'falta_pagar'
            $faltaPagar = $venda->falta_pagar - $pagamento->valor;
            $venda->update(['falta_pagar' => $faltaPagar]);
        }
        
        return redirect()->route('pagamentos.pago');
    }

    public function destroy(Request $request) {
        try {
            Pagamento::find(\Crypt::decrypt($request->get('id')))->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        } catch (\Illuminate\Database\QueryException $e) {
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        } catch (\PDOException $e) {
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret;
    }

    public function edit(Request $request) {
        $pagamento = Pagamento::find(\Crypt::decrypt($request->get('id')));
        return view('pagamentos.edit', compact('pagamento'));
    }

    public function update(PagamentoRequest $request, $id) {
        Pagamento::find($id)->update($request->all());
        return redirect()->route('pagamentos');
    }

    public function escolherPagamento($venda, Request $request) {
        $venda = Venda::findOrFail($venda);
        $faltaPagar = $request->query('falta_pagar');
        return view('pagamentos.pagamento', compact('venda', 'faltaPagar'));
    }

    public function pago() {
        return view('pagamentos.pago');
    }

    public function obterFaltaPagar(Request $request){
        $vendaId = $request->input('venda_id');

        try {
            $venda = Venda::findOrFail($vendaId); // Obter o produto com base no ID

            $faltaPagar = $venda->falta_pagar;

            return response()->json(['falta_pagar' => $faltaPagar]);
        } catch (\Exception $e) {
            // Tratar o caso em que o produto não é encontrado ou ocorre um erro
            return response()->json(['error' => 'Ocorreu um erro ao obter o valor que falta pagar.'], 500);
        }
    }
}
