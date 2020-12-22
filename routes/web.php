<?php

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


Route::post('/data', 'HomeController@data')->name('home.data');
Route::get('/single/{type}/{famille1}/{famille2}/{famille3}', 'HomeController@single')->name('single');
Route::post('/modelabel', 'HomeController@modelabel')->name('modelabel');


Route::get('/orders', 'PagesController@orders')->name('orders');
Route::get('/test', 'PagesController@test')->name('test');
Route::get('/findings', 'PagesController@findings')->name('findings');
Route::get('/products', 'PagesController@products')->name('products');
Route::get('/jewelry', 'PagesController@jewelry')->name('jewelry');
Route::get('/galvano', 'PagesController@galvano')->name('galvano');
Route::get('/refining', 'PagesController@refining')->name('refining');
Route::get('/laboratory', 'PagesController@laboratory')->name('laboratory');
Route::get('/catalog/{type}/{famille1}', 'PagesController@catalog')->name('catalog');
Route::post('/details', 'HomeController@details')->name('home.details');






// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');
$this->get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/request', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');;
$this->post('password/reset', 'Auth\ResetPasswordController@reset');
$this->post('password/reset/{token}', 'Auth\ResetPasswordController@reset');



Auth::routes();

Route::post('/setlanguage', 'HomeController@setlanguage')->name('setlanguage');


Route::get('/profile', 'UsersController@profile')->name('profile');
Route::post('/users/updating','UsersController@updating')->name('users.updating');






/*
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/filtres/{code}', 'HomeController@filtres')->name('filtres');
Route::get('/filtres2/{code}', 'HomeController@filtres2')->name('filtres2');
//Route::get('/catalogue', 'HomeController@catalogue')->name('catalogue');
Route::get('/catalogue/{code}', 'HomeController@catalogue')->name('catalogue');
Route::get('/metaldemiproduit/{type}/{fam}', 'HomeController@metal_demi_produit')->name('metaldemiproduit');
Route::get('/tarifarticle', 'HomeController@tarif_article')->name('tarifarticle');

Route::get('/referentiel', 'HomeController@referentiel')->name('referentiel');
Route::get('/referentiel1', 'HomeController@referentiel1')->name('referentiel1');
Route::get('/referentiel2', 'HomeController@referentiel2')->name('referentiel2');
Route::get('/referentiel3', 'HomeController@referentiel3')->name('referentiel3');
Route::get('/referentielmetal', 'HomeController@referentielmetal')->name('referentielmetal');
Route::get('/referentieltitre', 'HomeController@referentieltitre')->name('referentieltitre');
Route::get('/referentielcouleur', 'HomeController@referentielcouleur')->name('referentielcouleur');
Route::get('/referentielalliage', 'HomeController@referentielalliage')->name('referentielalliage');


Route::get('/requete1/{code}', 'HomeController@requete1')->name('requete1');
Route::get('/requete2', 'HomeController@requete2')->name('requete2');


Route::get('/doc', 'SwaggerController@index');
*/


Route::get('/home', 'PagesController@index')->name('home');
 Route::get('api/documentation', '\L5Swagger\Http\Controllers\SwaggerController@api')->name('l5swagger.api');

 
 
 Route::post('/commande', 'HomeController@commande')->name('commande');

	
//Route::group(['middleware' => 'web'], function () {
	/*
Route::group(['middleware' => ['client', 'web']], function () {
	*/
	
	

Route::get('/filtres/{code}', 'HomeController@filtres')->name('filtres');
Route::get('/filtres2/{code}', 'HomeController@filtres2')->name('filtres2');
//Route::get('/catalogue', 'HomeController@catalogue')->name('catalogue');
Route::get('/catalogue/{code}', 'HomeController@catalogue')->name('catalogue');
Route::get('/metaldemiproduit/{type}/{fam}', 'HomeController@metal_demi_produit')->name('metaldemiproduit');
Route::get('/tarifarticle', 'HomeController@tarif_article')->name('tarifarticle');

Route::get('/referentiels/{lg}', 'HomeController@referentiels')->name('referentiels');
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
Route::get('/produit/{type_id}/{fam1}/{fam2}/{fam3}/{id_cl}/{lg}', 'HomeController@produit')->name('produit');
Route::get('/produitcomplement/{typeid}/{fam1}/{fam2}/{fam3}', 'HomeController@produitcomplement')->name('produitcomplement');
Route::get('/produitmesure1/{typeid}/{fam1}/{fam2}/{fam3}', 'HomeController@produitmesure1')->name('produitmesure1');
Route::get('/produitmesure2/{typeid}/{fam1}/{fam2}/{fam3}/{mes1}', 'HomeController@produitmesure2')->name('produitmesure2');
Route::get('/produitpoids/{typeid}/{fam1}/{fam2}/{fam3}/{mes1}/{mes2}/{all}', 'HomeController@produitpoids')->name('produitpoids');
Route::get('/detailsproduit/{typeid}/{fam1}/{fam2}/{fam3}/{mes1}/{mes2}/{all}/{qte}/{id_comp}/{val_comp}/{id_cl}/{lg}', 'HomeController@detailsproduit')->name('detailsproduit');
Route::get('/tarif/{id_comp}/{val_comp}/{id_cl}', 'HomeController@tarif')->name('tarif');
Route::get('/compprix/{id_comp}/{qte}/{poids}/{id_cl}/{val_comp}', 'HomeController@compprix')->name('compprix');
Route::get('/prix/{type_id}/{article_id}/{alliage_id}/{qte}/{poids}/{id_cl}/{lg}', 'HomeController@prix')->name('prix');

Route::get('/clients', 'HomeController@clients')->name('clients');
Route::get('/checkclient/{siren}/{lg}', 'HomeController@checkclient')->name('checkclient');
Route::get('/agences/{code_pays}/{id_cl}/{lg}', 'HomeController@agences')->name('agences');
Route::get('/listeclients/{contact_id}', 'HomeController@listeclients')->name('listeclients');
Route::get('/adresse/{id_cl}', 'HomeController@adresse')->name('adresse');
Route::get('/detailsclient/{id_cl}/{lg}', 'HomeController@detailsclient')->name('detailsclient');


 
Route::get('/requete1/{code}', 'HomeController@requete1')->name('requete1');
Route::get('/requete2', 'HomeController@requete2')->name('requete2');

Route::post('/entetecommande', 'HomeController@entetecommande')->name('entetecommande');
Route::post('/lignecommande', 'HomeController@lignecommande')->name('lignecommande');

Route::get('/listecommandes/{id_cl}/{lg}', 'HomeController@listecommandes')->name('listecommandes');
Route::get('/listemodeles/{id_cl}/{lg}', 'HomeController@listemodeles')->name('listemodeles');
Route::get('/detailscommande/{id_cmd}/{id_cl}/{lg}', 'HomeController@detailscommande')->name('detailscommande');
Route::get('/tarifdetails/{nature_id}/{titre_or}/{titre_argent}/{titre_platine}/{titre_palladium}/{poids}/{poids_cendres}/{id_cl}/{lg}', 'HomeController@tarifdetails')->name('tarifdetails');
Route::get('/tarifforfait/{nature_id}/{titre_or}/{titre_argent}/{titre_platine}/{titre_palladium}/{poids}/{id_cl}/{lg}', 'HomeController@tarifforfait')->name('tarifforfait');

Route::get('/listeprestations/{id_cl}/{lg}', 'HomeController@listeprestations')->name('listeprestations');
Route::get('/listecommandeslabo/{id_cl}/{lg}', 'HomeController@listecommandeslabo')->name('listecommandeslabo');
Route::get('/listemodeleslabo/{id_cl}/{lg}', 'HomeController@listemodeleslabo')->name('listemodeleslabo');
Route::get('/detailscommandelabo/{id_cmd}/{id_cl}/{lg}', 'HomeController@detailscommandelabo')->name('detailscommandelabo');
Route::get('/tariflabo/{id_cl}/{choix_id}/{titre_or}/{titre_argent}/{titre_platine}/{titre_palladium}/{lg}', 'HomeController@tariflabo')->name('tariflabo');


Route::get('/listecommandesrmp/{id_cl}/{lg}', 'HomeController@listecommandesrmp')->name('listecommandesrmp');
Route::get('/listemodelesrmp/{id_cl}/{lg}', 'HomeController@listemodelesrmp')->name('listemodelesrmp');
Route::get('/detailscommandermp/{id_cmd}/{id_cl}/{lg}', 'HomeController@detailscommandermp')->name('detailscommandermp');
Route::get('/tarifrmp/{nature_id}/{titre_or}/{titre_argent}/{titre_platine}/{titre_palladium}/{poids}/{id_cl}/{lg}', 'HomeController@tarifrmp')->name('tarifrmp');


/*

});

*/
 