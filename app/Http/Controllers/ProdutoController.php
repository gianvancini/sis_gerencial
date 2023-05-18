<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Http\Requests\ProdutoRequest;
use Illuminate\Support\Facades\Redirect;

class ProdutoController extends Controller
{
    public function index(Request $filtro) {
        $filtragem = $filtro->get('desc_filtro');
        if($filtragem == null){
            $produtos = Produto::orderBy('nome')->SimplePaginate(7);
        }
        else{
            $produtos = Produto::where('nome', 'like', '%'.$filtragem.'%')
                ->orderBy("nome")
                ->simplePaginate(7)
                ->setpath('produtos?desc_filtro='.$filtragem);
        }
    
        return view('produtos.index', ['produtos' => $produtos]);
    }

    public function create() {
        return view('produtos.create');
    }

    public function store(ProdutoRequest $request) {
        $novo_produto = $request->all();
        Produto::create($novo_produto);
        return redirect()->route('produtos');
    }

    public function destroy(Request $request) {
        try {
            Produto::find(\Crypt::decrypt($request->get('id')))->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        } catch (\Illuminate\Database\QueryException $e) {
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        } catch (\PDOException $e) {
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret;
    }

    public function edit(Request $request) {
        $produto = Produto::find(\Crypt::decrypt($request->get('id')));
        return view('produtos.edit', compact('produto'));
    }

    public function update(ProdutoRequest $request, $id) {
        Produto::find($id)->update($request->all());
        return redirect()->route('produtos');
    }

    public function obterPrecoVenda(Request $request)
    {
        $produtoId = $request->input('produto_id');

        try {
            $produto = Produto::findOrFail($produtoId); // Obter o produto com base no ID

            $precoVenda = $produto->preco_venda;

            return response()->json(['preco_venda' => $precoVenda]);
        } catch (\Exception $e) {
            // Tratar o caso em que o produto não é encontrado ou ocorre um erro
            return response()->json(['error' => 'Ocorreu um erro ao obter o preço de venda do produto.'], 500);
        }
    }

    public function obterEstoque(Request $request)
    {
        $produtoId = $request->input('produto_id');

        try {
            $produto = Produto::findOrFail($produtoId); // Obter o produto com base no ID

            $estoque = $produto->estoque;

            return response()->json(['estoque' => $estoque]);
        } catch (\Exception $e) {
            // Tratar o caso em que o produto não é encontrado ou ocorre um erro
            return response()->json(['error' => 'Ocorreu um erro ao obter o preço de venda do produto.'], 500);
        }
    }
}
