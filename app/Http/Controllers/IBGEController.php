<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class IBGEController extends Controller
{
    public function listarEstados()
    {
        $client = new Client();
        $response = $client->get('https://servicodados.ibge.gov.br/api/v1/localidades/estados');

        $estados = json_decode($response->getBody(), true);
        $estados = collect($estados)->sortBy('nome')->values()->all();

        return response()->json($estados);
    }

    public function listarCidades($estado_id)
    {
        $client = new Client();
        $response = $client->get("https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$estado_id}/municipios");

        $cidades = json_decode($response->getBody(), true);

        return response()->json($cidades);
    }
}