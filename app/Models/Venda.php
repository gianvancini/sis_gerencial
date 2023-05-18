<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $table = "vendas";
    protected $fillable = ['data_venda', 'cliente_id', 'vendedor_id', 'total_venda', 'falta_pagar'];

    public function cliente(){
        return $this->belongsTo("App\Models\Clientes", 'cliente_id');
    }
    
    public function vendedor(){
        return $this->belongsTo("App\Models\Vendedor", 'vendedor_id');
    }
}
