<?php

use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function(){

    Route::group(['prefix'=>'clientes', 'namespace'=>'App\Http\Controllers', 'where'=>['id'=>'[0-9]+']], function(){
        Route::any('',              ['as'=>'clientes',           'uses'=>'ClientesController@index'   ]);
        Route::get('create',        ['as'=>'clientes.create',    'uses'=>'ClientesController@create'  ]);
        Route::get('destroy',       ['as'=>'clientes.destroy',   'uses'=>'ClientesController@destroy' ]);
        Route::get('edit',          ['as'=>'clientes.edit',      'uses'=>'ClientesController@edit'    ]);
        Route::put('{id}/update',   ['as'=>'clientes.update',    'uses'=>'ClientesController@update'  ]);
        Route::post('store',        ['as'=>'clientes.store',     'uses'=>'ClientesController@store'   ]);
    });

    Route::group(['prefix'=>'vendedores', 'namespace'=>'App\Http\Controllers', 'where'=>['id'=>'[0-9]+']], function(){
        Route::any('',              ['as'=>'vendedores',           'uses'=>'VendedorController@index'   ]);
        Route::get('create',        ['as'=>'vendedores.create',    'uses'=>'VendedorController@create'  ]);
        Route::get('destroy',       ['as'=>'vendedores.destroy',   'uses'=>'VendedorController@destroy' ]);
        Route::get('edit',          ['as'=>'vendedores.edit',      'uses'=>'VendedorController@edit'    ]);
        Route::put('{id}/update',   ['as'=>'vendedores.update',    'uses'=>'VendedorController@update'  ]);
        Route::post('store',        ['as'=>'vendedores.store',     'uses'=>'VendedorController@store'   ]);
    });

    Route::group(['prefix'=>'marcas', 'namespace'=>'App\Http\Controllers', 'where'=>['id'=>'[0-9]+']], function(){
        Route::any('',              ['as'=>'marcas',           'uses'=>'MarcaController@index'   ]);
        Route::get('create',        ['as'=>'marcas.create',    'uses'=>'MarcaController@create'  ]);
        Route::get('destroy',       ['as'=>'marcas.destroy',   'uses'=>'MarcaController@destroy' ]);
        Route::get('edit',          ['as'=>'marcas.edit',      'uses'=>'MarcaController@edit'    ]);
        Route::put('{id}/update',   ['as'=>'marcas.update',    'uses'=>'MarcaController@update'  ]);
        Route::post('store',        ['as'=>'marcas.store',     'uses'=>'MarcaController@store'   ]);
    });

    Route::group(['prefix'=>'tipos', 'namespace'=>'App\Http\Controllers', 'where'=>['id'=>'[0-9]+']], function(){
        Route::any('',              ['as'=>'tipos',           'uses'=>'TipoController@index'   ]);
        Route::get('create',        ['as'=>'tipos.create',    'uses'=>'TipoController@create'  ]);
        Route::get('destroy',       ['as'=>'tipos.destroy',   'uses'=>'TipoController@destroy' ]);
        Route::get('edit',          ['as'=>'tipos.edit',      'uses'=>'TipoController@edit'    ]);
        Route::put('{id}/update',   ['as'=>'tipos.update',    'uses'=>'TipoController@update'  ]);
        Route::post('store',        ['as'=>'tipos.store',     'uses'=>'TipoController@store'   ]);
    });

    Route::group(['prefix'=>'produtos', 'namespace'=>'App\Http\Controllers', 'where'=>['id'=>'[0-9]+']], function(){
        Route::any('',                  ['as'=>'produtos',              'uses'=>'ProdutoController@index'           ]);
        Route::get('create',            ['as'=>'produtos.create',       'uses'=>'ProdutoController@create'          ]);
        Route::get('destroy',           ['as'=>'produtos.destroy',      'uses'=>'ProdutoController@destroy'         ]);
        Route::get('edit',              ['as'=>'produtos.edit',         'uses'=>'ProdutoController@edit'            ]);
        Route::put('{id}/update',       ['as'=>'produtos.update',       'uses'=>'ProdutoController@update'          ]);
        Route::post('store',            ['as'=>'produtos.store',        'uses'=>'ProdutoController@store'           ]);
        Route::get('obter/preco_venda', ['as'=>'obter.preco_venda',     'uses'=>'ProdutoController@obterPrecoVenda' ]);
        Route::get('obter/estoque',     ['as'=>'obter.estoque',         'uses'=>'ProdutoController@obterEstoque'    ]);
    }); 

    Route::group(['prefix'=>'pagamentos', 'namespace'=>'App\Http\Controllers', 'where'=>['id'=>'[0-9]+']], function(){
        Route::any('',                          ['as'=>'pagamentos',           'uses'=>'PagamentoController@index'              ]);
        Route::get('create',                    ['as'=>'pagamentos.create',    'uses'=>'PagamentoController@create'             ]);
        Route::get('destroy',                   ['as'=>'pagamentos.destroy',   'uses'=>'PagamentoController@destroy'            ]);
        Route::get('edit',                      ['as'=>'pagamentos.edit',      'uses'=>'PagamentoController@edit'               ]);
        Route::put('{id}/update',               ['as'=>'pagamentos.update',    'uses'=>'PagamentoController@update'             ]);
        Route::post('store',                    ['as'=>'pagamentos.store',     'uses'=>'PagamentoController@store'              ]);
        Route::get('pago',                      ['as'=>'pagamentos.pago',      'uses'=>'PagamentoController@pago'               ]);
        Route::get('obter/falta_pagar',         ['as'=>'obter.faltaPagar',     'uses'=>'PagamentoController@obterFaltaPagar'    ]);
    });

    Route::group(['prefix'=>'vendas', 'namespace'=>'App\Http\Controllers', 'where'=>['id'=>'[0-9]+']], function(){
        Route::any('',                  ['as'=>'vendas',               'uses'=>'VendaController@index'              ]);
        Route::any('receber',           ['as'=>'vendas.receber',       'uses'=>'VendaController@index'              ]);
        Route::get('create',            ['as'=>'vendas.create',        'uses'=>'VendaController@create'             ]);
        Route::get('destroy',           ['as'=>'vendas.destroy',       'uses'=>'VendaController@destroy'            ]);
        Route::get('edit',              ['as'=>'vendas.edit',          'uses'=>'VendaController@edit'               ]);
        Route::put('{id}/update',       ['as'=>'vendas.update',        'uses'=>'VendaController@update'             ]);
        Route::post('store',            ['as'=>'vendas.store',         'uses'=>'VendaController@store'              ]);
        Route::get('{venda}/produtos',  ['as'=>'vendas.produtos',      'uses'=>'VendaController@escolherProdutos'   ]);
        Route::post('{venda}/produtos', ['as'=>'vendas.salvarProdutos','uses'=>'VendaController@salvarProdutos'     ]);
        Route::get('{venda}/pagamento', ['as'=>'vendas.pagamento',     'uses'=>'PagamentoController@escolherPagamento'  ]);
        Route::get('{venda}/detalhes',  ['as'=>'vendas.detalhes',      'uses'=>'VendaController@detalhes'           ]);
    });

    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/estados', 'IBGEController@listarEstados');
    Route::get('/estados/{estado_id}/cidades', 'IBGEController@listarCidades');
    Route::get('/cotacao-dolar', [HomeController::class, 'getCotacao']);

});

Auth::routes();