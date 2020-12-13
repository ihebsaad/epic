<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
 
//Route::group(['middleware' => 'client'], function () {
Route::group(['middleware' => ['client', 'web']], function () {
  Route::apiResource('country','CountryController');

  	
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/filtres/{code}', 'HomeController@filtres')->name('filtres');
Route::get('/filtres2/{code}', 'HomeController@filtres2')->name('filtres2');
//Route::get('/catalogue', 'HomeController@catalogue')->name('catalogue');
Route::get('/catalogue/{code}', 'HomeController@catalogue')->name('catalogue');
Route::get('/metaldemiproduit/{type}/{fam}', 'HomeController@metal_demi_produit')->name('metaldemiproduit');
Route::get('/tarifarticle', 'HomeController@tarif_article')->name('tarifarticle');

Route::get('/referentiels', 'HomeController@referentiels')->name('referentiels');
Route::get('/referentiel', 'HomeController@referentiel')->name('referentiel');
Route::get('/referentiel1', 'HomeController@referentiel1')->name('referentiel1');
Route::get('/referentiel2', 'HomeController@referentiel2')->name('referentiel2');
Route::get('/referentiel3', 'HomeController@referentiel3')->name('referentiel3');
Route::get('/referentielmetal', 'HomeController@referentielmetal')->name('referentielmetal');
Route::get('/referentieltitre', 'HomeController@referentieltitre')->name('referentieltitre');
Route::get('/referentielcouleur', 'HomeController@referentielcouleur')->name('referentielcouleur');
Route::get('/referentielalliage', 'HomeController@referentielalliage')->name('referentielalliage');
Route::get('/referentielphoto', 'HomeController@referentielphoto')->name('referentielphoto');
Route::get('/referentielunite', 'HomeController@referentielunite')->name('referentielunite');
Route::get('/referentieletat', 'HomeController@referentieletat')->name('referentieletat');
Route::get('/referentielcomplement', 'HomeController@referentielcomplement')->name('referentielcomplement');
Route::get('/referentielmodefacturation', 'HomeController@referentielmodefacturation')->name('referentielmodefacturation');
Route::get('/referentielmodefacturation', 'HomeController@referentielmodefacturation')->name('referentielmodefacturation');
Route::get('/produit/{type_id}/{fam1}/{fam2}/{fam3}', 'HomeController@produit')->name('produit');
Route::get('/produitcomplement/{typeid}/{fam1}/{fam2}/{fam3}', 'HomeController@produitcomplement')->name('produitcomplement');
Route::get('/produitmesure1/{typeid}/{fam1}/{fam2}/{fam3}', 'HomeController@produitmesure1')->name('produitmesure1');
Route::get('/produitmesure2/{typeid}/{fam1}/{fam2}/{fam3}/{mes1}', 'HomeController@produitmesure2')->name('produitmesure2');
Route::get('/produitpoids/{typeid}/{fam1}/{fam2}/{fam3}/{mes1}/{mes2}/{all}', 'HomeController@produitpoids')->name('produitpoids');
Route::get('/detailsproduit/{typeid}/{fam1}/{fam2}/{fam3}/{mes1}/{mes2}/{all}/{qte}/{id_comp}/{val_comp}/{id_cl}', 'HomeController@detailsproduit')->name('detailsproduit');
Route::get('/tarif/{id_comp}/{val_comp}/{id_cl}', 'HomeController@tarif')->name('tarif');
Route::get('/compprix/{id_comp}/{qte}/{poids}/{id_cl}/{val_comp}', 'HomeController@compprix')->name('compprix');
Route::get('/prix/{type_id}/{article_id}/{alliage_id}/{qte}/{poids}/{id_cl}', 'HomeController@prix')->name('prix');

Route::get('/clients', 'HomeController@clients')->name('clients');
Route::get('/contact/{email}', 'HomeController@contact')->name('contact');
Route::get('/agences/{code_pays}', 'HomeController@agences')->name('agences');
Route::get('/listeclients/{contact_id}', 'HomeController@listeclients')->name('listeclients');
Route::get('/adresse/{client_id}', 'HomeController@adresse')->name('adresse');
Route::get('/detailsclient/{client_id}', 'HomeController@detailsclient')->name('detailsclient');


 
Route::get('/requete1/{code}', 'HomeController@requete1')->name('requete1');
Route::get('/requete2', 'HomeController@requete2')->name('requete2');


    Route::get('api/documentation', '\L5Swagger\Http\Controllers\SwaggerController@api')->name('l5swagger.api');

 
  
} );

/*
  Route::get('/countries','CountryController@countries');
  Route::get('/country/{id}','CountryController@country');
*/
 // Route::apiResource('country','CountryController');
  
  Route::apiResource('adresse','AdresseController');
  
  Route::apiResource('client','ClientController');

Route::get('/doc', 'SwaggerController@index');
Route::get('/testing', 'TestController@index');
