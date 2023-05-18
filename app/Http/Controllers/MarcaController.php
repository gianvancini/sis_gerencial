<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Marca;
use App\Http\Requests\MarcaRequest;
use Illuminate\Support\Facades\Redirect;

class MarcaController extends Controller
{
    public function index(Request $filtro) {
        $filtragem = $filtro->get('desc_filtro');
        if($filtragem == null){
            $marcas = Marca::orderBy('nome')->SimplePaginate(7);
        }
        else{
            $marcas = Marca::where('nome', 'like', '%'.$filtragem.'%')
                ->orderBy("nome")
                ->simplePaginate(7)
                ->setpath('marcas?desc_filtro='.$filtragem);
        }
    
        return view('marcas.index', ['marcas' => $marcas]);
    }

    public function create() {
        return view('marcas.create');
    }

    public function store(MarcaRequest $request) {
        $nova_marca = $request->all();
        Marca::create($nova_marca);
        return redirect()->route('marcas');
    }

    public function destroy(Request $request) {
        try {
            Marca::find(\Crypt::decrypt($request->get('id')))->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        } catch (\Illuminate\Database\QueryException $e) {
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        } catch (\PDOException $e) {
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret;
    }

    public function edit(Request $request) {
        $marca = Marca::find(\Crypt::decrypt($request->get('id')));
        return view('marcas.edit', compact('marca'));
    }

    public function update(MarcaRequest $request, $id) {
        Marca::find($id)->update($request->all());
        return redirect()->route('marcas');
    }
}
