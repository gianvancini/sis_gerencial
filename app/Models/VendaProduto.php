<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaProduto extends Model
{
    protected $table = "venda_produtos";
    protected $fillable = ['venda_id', 'produto_id', 'quantidade', 'desconto', 'item_total'];

    public function venda() {
        return $this->belongsTo("App\Models\Venda", 'venda_id');
    }

    public function produto() {
        return $this->belongsTo("App\Models\Produto", 'produto_id');
    }
}
