<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ClientesController;
use App\Models\Clientes;

class ClientesController extends Controller
{
    public function index(Request $filtro) {
        $filtragem = $filtro->get('desc_filtro');
        if($filtragem == null){
            $clientes = Clientes::orderBy('nome')->SimplePaginate(7);
        }
        else{
            $clientes = Clientes::where('nome', 'like', '%'.$filtragem.'%')
                ->orderBy("nome")
                ->simplePaginate(7)
                ->setpath('clientes?desc_filtro='.$filtragem);
        }
    
        return view('clientes.index', ['clientes' => $clientes]);
    }

    public function create() {
        return view('clientes.create');
    }

    public function store(ClienteRequest $request) {
        $novo_cliente = $request->all();
        Clientes::create($novo_cliente);
        return redirect()->route('clientes');
    }

    public function destroy(Request $request) {
        try {
            Clientes::find(\Crypt::decrypt($request->get('id')))->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        } catch (\Illuminate\Database\QueryException $e) {
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        } catch (\PDOException $e) {
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret;
    }

    public function edit(Request $request) {
        $cliente = Clientes::find(\Crypt::decrypt($request->get('id')));
        $estados = json_decode(file_get_contents('https://servicodados.ibge.gov.br/api/v1/localidades/estados'), true);
        $cidades = json_decode(file_get_contents('https://servicodados.ibge.gov.br/api/v1/localidades/estados/'.$cliente->estado.'/municipios'), true);

        return view('clientes.edit', compact('cliente', 'estados', 'cidades'));

    }

    public function update(ClienteRequest $request, $id) {
        Clientes::find($id)->update($request->all());
        return redirect()->route('clientes');
    }
}
