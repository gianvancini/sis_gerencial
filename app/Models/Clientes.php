<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = "clientes";
    protected $fillable = ['nome', 'endereco', 'uf', 'cidade', 'telefone', 'data_nascimento'];

    public function vendas()
        {
            return $this->hasMany(Venda::class, 'cliente_id');
        }
}