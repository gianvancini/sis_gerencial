<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vendedor;
use App\Http\Requests\VendedorRequest;
use Illuminate\Support\Facades\Redirect;

class VendedorController extends Controller
{
    public function index(Request $filtro) {
        $filtragem = $filtro->get('desc_filtro');
        if($filtragem == null){
            $vendedores = Vendedor::orderBy('nome')->SimplePaginate(7);
        }
        else{
            $vendedores = Vendedor::where('nome', 'like', '%'.$filtragem.'%')
                ->orderBy("nome")
                ->paginate(10)
                ->setpath('vendedores?desc_filtro='.$filtragem);
        }
    
        return view('vendedores.index', ['vendedores' => $vendedores]);
    }

    public function create() {
        return view('vendedores.create');
    }

    public function store(VendedorRequest $request) {
        $novo_vendedor = $request->all();
        Vendedor::create($novo_vendedor);
        return redirect()->route('vendedores');
    }

    public function destroy(Request $request) {
        try {
            Vendedor::find(\Crypt::decrypt($request->get('id')))->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        } catch (\Illuminate\Database\QueryException $e) {
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        } catch (\PDOException $e) {
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret;
    }

    public function edit(Request $request) {
        $vendedor = Vendedor::find(\Crypt::decrypt($request->get('id')));
        $estados = json_decode(file_get_contents('https://servicodados.ibge.gov.br/api/v1/localidades/estados'), true);
        $cidades = json_decode(file_get_contents('https://servicodados.ibge.gov.br/api/v1/localidades/estados/'.$vendedor->estado.'/municipios'), true);
   
        return view('vendedores.edit', compact('vendedor', 'estados', 'cidades'));
    }

    public function update(VendedorRequest $request, $id) {
        Vendedor::find($id)->update($request->all());
        return redirect()->route('vendedores');
    }
}
