<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tipo;
use App\Http\Requests\TipoRequest;
use Illuminate\Support\Facades\Redirect;

class TipoController extends Controller
{
    public function index(Request $filtro) {
        $filtragem = $filtro->get('desc_filtro');
        if($filtragem == null){
            $tipos = Tipo::orderBy('nome')->SimplePaginate(7);
        }
        else{
            $tipos = Tipo::where('nome', 'like', '%'.$filtragem.'%')
                ->orderBy("nome")
                ->simplePaginate(7)
                ->setpath('tipos?desc_filtro='.$filtragem);
        }
    
        return view('tipos.index', ['tipos' => $tipos]);
    }

    public function create() {
        return view('tipos.create');
    }

    public function store(TipoRequest $request) {
        $novo_tipo = $request->all();
        Tipo::create($novo_tipo);
        return redirect()->route('tipos');
    }

    public function destroy(Request $request) {
        try {
            Tipo::find(\Crypt::decrypt($request->get('id')))->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        } catch (\Illuminate\Database\QueryException $e) {
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        } catch (\PDOException $e) {
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret;
    }

    public function edit(Request $request) {
        $tipo = Tipo::find(\Crypt::decrypt($request->get('id')));
        return view('tipos.edit', compact('tipo'));
    }

    public function update(TipoRequest $request, $id) {
        Tipo::find($id)->update($request->all());
        return redirect()->route('tipos');
    }
}
