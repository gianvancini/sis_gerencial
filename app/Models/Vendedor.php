<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = "vendedors";
    protected $fillable = ['nome', 'endereco', 'uf', 'cidade', 'telefone', 'data_nascimento', 'data_admissao'];
    
    public function vendas()
        {
            return $this->hasMany(Venda::class, 'vendedor_id');
        }
}

