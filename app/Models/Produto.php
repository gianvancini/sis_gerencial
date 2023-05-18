<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = "produtos";
    protected $fillable = ['nome', 'marca_id', 'tipo_id','preco_custo', 'preco_venda', 'estoque', 'observacao'];

    public function marca(){
        return $this->belongsTo("App\Models\Marca", 'marca_id');
    }

    public function tipo(){
        return $this->belongsTo("App\Models\Tipo", 'tipo_id');
    }
}
