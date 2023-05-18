<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Produto;
use App\Models\Clientes;
use App\Models\Vendedor;
use App\Models\VendaProduto;
use App\Http\Requests\VendaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class VendaController extends Controller
{
    public function index(Request $filtro) {
        $filtragem = $filtro->get('desc_filtro');
    
        if (Route::currentRouteName() == 'vendas.receber') {
            if ($filtragem == null) {
                $vendas = Venda::where('falta_pagar', '>', 0)
                    ->orderBy('data_venda')
                    ->simplePaginate(7);
            } else {
                $vendas = Venda::join('clientes', 'vendas.cliente_id', '=', 'clientes.id')
                    ->where('clientes.nome', 'like', '%'.$filtragem.'%')
                    ->orderByDesc('data_venda')
                    ->simplePaginate(7)
                    ->setPath('vendas?desc_filtro='.$filtragem);
            }
    
            return view('vendas.receber', ['vendas' => $vendas]);
        } else {      
            if ($filtragem == null) {
                $vendas = Venda::orderByDesc('data_venda')->simplePaginate(7);
            } else {
                $vendas = Venda::join('clientes', 'vendas.cliente_id', '=', 'clientes.id')
                    ->where('clientes.nome', 'like', '%'.$filtragem.'%')
                    ->orderByDesc('data_venda')
                    ->simplePaginate(7)
                    ->setPath('vendas?desc_filtro='.$filtragem);
            }
    
            return view('vendas.index', ['vendas' => $vendas]);
        }
    }

    public function create() {
        return view('vendas.create');
    }

    public function store(VendaRequest $request) {
        $nova_venda = $request->all();
        $venda = Venda::create($nova_venda);
    
        // Redireciona o usuário para a tela de adicionar produtos com o id da venda
        return redirect()->route('vendas.produtos', ['venda' => $venda->id]);
    }

    public function destroy(Request $request) {
        try {
            Venda::find(\Crypt::decrypt($request->get('id')))->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        } catch (\Illuminate\Database\QueryException $e) {
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        } catch (\PDOException $e) {
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret;
    }

    public function edit(Request $request) {
        $venda = Venda::find(\Crypt::decrypt($request->get('id')));
        return view('vendas.edit', compact('venda'));
    }

    public function update(VendaRequest $request, $id) {
        Venda::find($id)->update($request->all());
        return redirect()->route('vendas');
    }

    public function escolherProdutos(Venda $venda){
        $produtos = Produto::all();

        return view('vendas.escolher_produtos', compact('venda', 'produtos'));
    }

    public function salvarProdutos(Request $request, Venda $venda){
        $produtos = $request->input('produtos');
        $vendaId = $request->input('venda_id');
        $totalVenda = 0;

        foreach ($produtos as $produto) {
            $produtoId = $produto['id'];
            $quantidade = $produto['quantidade'];
            $desconto = $produto['desconto'];
            $valorFinal = $produto['valor_final'];

            // Obtenha o produto pelo ID
            $produto = Produto::find($produtoId);

            if ($produto) {
                // Verifique se há estoque suficiente
                if ($produto->estoque >= $quantidade) {
                    // Desconte a quantidade escolhida do estoque
                    $produto->estoque -= $quantidade;
                    $produto->save();
                } else {
                    // Caso não haja estoque suficiente, você pode retornar uma mensagem de erro ou fazer outra ação necessária
                    return redirect()->back()->withErrors(['message' => 'Estoque insuficiente para o produto: ' . $produto->nome]);
                }

                $vendaProduto = new VendaProduto();
                $vendaProduto->venda_id = $vendaId;
                $vendaProduto->produto_id = $produto->id;
                $vendaProduto->quantidade = $quantidade;
                $vendaProduto->desconto = $desconto;
                $vendaProduto->item_total = $valorFinal;
                $vendaProduto->save();

                $totalVenda += $valorFinal;
            }
        }

        Venda::where('id', $vendaId)->update(['total_venda' => $totalVenda]);
        Venda::where('id', $vendaId)->update(['falta_pagar' => $totalVenda]);

        return redirect()->route('vendas.pagamento', ['venda' => $venda->id]);
    }

    public function detalhes(Request $request, $vendaId){
        $venda = Venda::find($vendaId);
        $produtosVenda = VendaProduto::where('venda_id', $venda->id)->get();

        return view('vendas.produtos_venda', compact('produtosVenda', 'venda'));
    }
}
