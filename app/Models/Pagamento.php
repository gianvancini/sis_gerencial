<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $table = "pagamentos";
    protected $fillable = ['descricao', 'valor', 'data_pag', 'id_venda'];
}
