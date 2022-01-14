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
})->name('welcome');

//Route::get('/', 'PagesController@welcome')->name('welcome');
Route::get('/verify', 'UsersController@verify')->name('verify');


Route::get('users/loginas/{id}', 'UsersController@loginAs')->name('loginas');

Route::post('/data', 'ProductsController@data')->name('data');
Route::get('/single/{type}/{famille1}/{famille2}/{famille3}', 'ProductsController@single')->name('single');
Route::post('/modelabel', 'ProductsController@modelabel')->name('modelabel');
Route::post('/addproduct', 'ProductsController@addproduct')->name('addproduct');
Route::get('/deleteproduct/{id}', 'ProductsController@deleteproduct')->name('deleteproduct');
Route::get('/deletemodel/{id}', 'ProductsController@deletemodel')->name('deletemodel');
Route::get('/deletemodellab/{id}', 'ProductsController@deletemodellab')->name('deletemodellab');
Route::get('/deletemodelrmp/{id}', 'ProductsController@deletemodelrmp')->name('deletemodelrmp');
Route::get('/suppmodel/{id}', 'ProductsController@suppmodel')->name('suppmodel');
Route::get('/suppmodellab/{id}', 'ProductsController@suppmodellab')->name('suppmodellab');
Route::get('/suppmodelrmp/{id}', 'ProductsController@suppmodelrmp')->name('suppmodelrmp');
Route::post('/details', 'ProductsController@details')->name('details');
Route::post('/checkproduct', 'ProductsController@checkproduct')->name('checkproduct');
Route::post('/forfait', 'ProductsController@forfait')->name('forfait');
Route::post('/tarifcmd', 'ProductsController@tarifcmd')->name('tarifcmd');
Route::post('/tariflabo', 'ProductsController@tariflabo')->name('tariflabo');
Route::post('/tarifrmp', 'ProductsController@tarifrmp')->name('tarifrmp');
Route::post('/updatecart', 'ProductsController@updatecart')->name('updatecart');
Route::post('/updateben', 'ProductsController@updateben')->name('updateben');


Route::get('/orders', 'PagesController@orders')->name('orders');
Route::get('/test', 'PagesController@test')->name('test');
Route::get('/findings', 'PagesController@findings')->name('findings');
Route::get('/products', 'PagesController@products')->name('products');
Route::get('/jewelry', 'PagesController@jewelry')->name('jewelry');
Route::get('/galvano', 'PagesController@galvano')->name('galvano');
Route::get('/refining', 'PagesController@refining')->name('refining');
Route::get('/laboratory', 'PagesController@laboratory')->name('laboratory');
Route::get('/catalog/{type}/{famille1}', 'PagesController@catalog')->name('catalog');



Route::get('/panier', 'PagesController@panier')->name('panier');
Route::get('/livraison', 'PagesController@livraison')->name('livraison');
Route::get('/livraisonmod', 'PagesController@livraisonmod')->name('livraisonmod');
Route::get('/trading', 'PagesController@trading')->name('trading');
Route::get('/virement', 'PagesController@virement')->name('virement');
Route::get('/ajout', 'PagesController@ajout')->name('ajout');
Route::get('/beneficiaires', 'PagesController@beneficiaires')->name('beneficiaires');
Route::get('/beneficiaire/{id}', 'PagesController@beneficiaire')->name('beneficiaire');
Route::post('/updatebenif/', 'ProductsController@updatebenif')->name('updatebenif');
Route::get('/orders', 'PagesController@orders')->name('orders');
Route::get('/euros', 'PagesController@euros')->name('euros');
Route::get('/poids', 'PagesController@poids')->name('poids');
Route::get('/spot', 'PagesController@spot')->name('spot');


Route::get('/affinage', 'PagesController@affinage')->name('affinage');
Route::get('/modele', 'PagesController@modele')->name('modele');
Route::get('/viewmodele/{id}', 'PagesController@viewmodele')->name('viewmodele');
Route::get('/commande/{id}', 'PagesController@commande')->name('commande');
Route::post('/addmodele', 'ModelesController@addmodele')->name('addmodele');
Route::post('/updatemodele', 'ModelesController@updatemodele')->name('updatemodele');
Route::post('/validatemodels', 'ModelesController@validatemodels')->name('validatemodels');
Route::post('/validatemodelsliv', 'ModelesController@validatemodelsliv')->name('validatemodelsliv');
Route::post('/validateproducts', 'ModelesController@validateproducts')->name('validateproducts');


Route::get('/laboratoire', 'PagesController@laboratoire')->name('laboratoire');
Route::get('/viewmodelelab/{id}', 'PagesController@viewmodelelab')->name('viewmodelelab');
Route::get('/modelelab', 'PagesController@modelelab')->name('modelelab');
Route::get('/commandelab/{id}', 'PagesController@commandelab')->name('commandelab');
Route::post('/addmodelelab', 'ModelesController@addmodelelab')->name('addmodelelab');
Route::post('/updatemodelelab', 'ModelesController@updatemodelelab')->name('updatemodelelab');


Route::get('/rachat', 'PagesController@rachat')->name('rachat');
Route::get('/modelermp', 'PagesController@modelermp')->name('modelermp');
Route::post('/addmodelermp', 'ModelesController@addmodelermp')->name('addmodelermp');
Route::post('/updatemodelermp', 'ModelesController@updatemodelermp')->name('updatemodelermp');
Route::get('/commandermp/{id}', 'PagesController@commandermp')->name('commandermp');
Route::get('/viewmodelermp/{id}', 'PagesController@viewmodelermp')->name('viewmodelermp');

Route::get('/commandeprod/{id}', 'PagesController@commandeprod')->name('commandeprod');

Route::post('/ajoutvirement', 'ProductsController@ajoutvirement')->name('ajoutvirement');
Route::post('/ajoutbenefic', 'ProductsController@ajoutbenefic')->name('ajoutbenefic');



Route::post('/agence', 'HomeController@agence')->name('agence');

Route::post('/order/updating','ProductsController@updating')->name('orders.updating');





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



//Auth::routes();
Auth::routes(['verify' => true] );

Route::post('/setlanguage', 'HomeController@setlanguage')->name('setlanguage');


Route::get('/profile', 'UsersController@profile')->name('profile');
Route::get('/adduser', 'UsersController@adduser')->name('adduser');
Route::get('/users', 'UsersController@index')->name('users');
Route::get('/view/{id}', 'UsersController@view')->name('view');
Route::post('/adding','UsersController@adding')->name('adding');
Route::post('/checkexiste','HomeController@checkexiste')->name('checkexiste');
Route::post('/registration','UsersController@registration')->name('registration');
Route::post('/updatinguser','UsersController@updatinguser')->name('updatinguser');
Route::post('/updatingusertype','UsersController@updatingusertype')->name('updatingusertype');
Route::get('/users/destroy/{id}','UsersController@destroy')->name('users.destroy');
Route::post('/users/updating','UsersController@updating')->name('users.updating');
Route::post('/updateuser','UsersController@updateuser')->name('updateuser');
Route::post('/updatecomp','UsersController@updatecomp')->name('updatecomp');
Route::post('/updateclient','UsersController@updateclient')->name('updateclient');

//beneficiaires 
Route::get('/beneficiaires', 'UsersController@beneficiaires')->name('beneficiaires');
Route::get('/beneficiairesvalides', 'UsersController@beneficiairesvalides')->name('beneficiairesvalides');
Route::get('/validatebenef/{id}', 'UsersController@validatebenef');



Route::post('/listetrading','TradingController@listetrading')->name('listetrading');






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

//Route::get('/home', 'PagesController@index')->name('home');
Route::get('/home', 'PagesController@index')->name('home')->middleware('verified');

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

Route::post('/entetecommande', 'ModelesController@entetecommande')->name('entetecommande');
Route::post('/lignecommande', 'ModelesController@lignecommande')->name('lignecommande');

Route::get('/listecommandes/{id_cl}/{lg}', 'HomeController@listecommandes')->name('listecommandes');
Route::get('/listemodeles/{id_cl}/{lg}', 'HomeController@listemodeles')->name('listemodeles');
Route::get('/detailscommande/{id_cmd}/{id_cl}/{lg}', 'HomeController@detailscommande')->name('detailscommande');
Route::get('/tarifdetails/{nature_id}/{titre_or}/{titre_argent}/{titre_platine}/{titre_palladium}/{poids}/{poids_cendres}/{id_cl}/{lg}', 'HomeController@tarifdetails')->name('tarifdetails');
Route::get('/tarifforfait/{nature_id}/{titre_or}/{titre_argent}/{titre_platine}/{titre_palladium}/{poids}/{id_cl}/{lg}', 'HomeController@tarifforfait')->name('tarifforfait');

Route::get('/listeprestations/{id_cl}/{lg}', 'ModelesController@listeprestations')->name('listeprestations');
Route::get('/listecommandeslabo/{id_cl}/{lg}', 'ModelesController@listecommandeslabo')->name('listecommandeslabo');
Route::get('/listemodeleslabo/{id_cl}/{lg}', 'ModelesController@listemodeleslabo')->name('listemodeleslabo');
Route::get('/detailscommandelabo/{id_cmd}/{id_cl}/{lg}', 'ModelesController@detailscommandelabo')->name('detailscommandelabo');
//Route::get('/tariflabo/{id_cl}/{choix_id}/{titre_or}/{titre_argent}/{titre_platine}/{titre_palladium}/{lg}', 'HomeController@tariflabo')->name('tariflabo');


Route::get('/listecommandesrmp/{id_cl}/{lg}', 'ModelesController@listecommandesrmp')->name('listecommandesrmp');
Route::get('/listemodelesrmp/{id_cl}/{lg}', 'ModelesController@listemodelesrmp')->name('listemodelesrmp');
Route::get('/detailscommandermp/{id_cmd}/{id_cl}/{lg}', 'ModelesController@detailscommandermp')->name('detailscommandermp');
//Route::get('/tarifrmp/{nature_id}/{titre_or}/{titre_argent}/{titre_platine}/{titre_palladium}/{poids}/{id_cl}/{lg}', 'HomeController@tarifrmp')->name('tarifrmp');


/*

});

*/
 