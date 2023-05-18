<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = "tipos";
    protected $fillable = ['nome'];

    public function produtos(){
        return $this->hasMany("App\Models\Produto");
    }
}
