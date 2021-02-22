<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User ;
use GuzzleHttp\Client;

class PagesController extends Controller
{
	
	  public function __construct()
    {
        $this->middleware('auth');
    } 
	 
 
      public function index()
    { 
         return view('home');
    }
	
      public function catalog($type,$famille1)
    { 
	return view('catalog',['type'=>$type,'famille1'=>$famille1]);
    }
	
	  public function orders()
    { 
	
	
	$endpoint = "https://express.api.dhl.com/mydhlapi/test";
$client = new \GuzzleHttp\Client();
/*
accountNumber=220136396&originCountryCode=FR&originPostalCode=75000&originCityName=Paris&destinationCountryCode=FR&
destinationPostalCode=75001&destinationCityName=Paris&weight=5&length=15&width=10&height=5&plannedShippingDate=2020-02-26&isCustomsDeclarable=true&unitOfMeasurement=metric" -H  "accept: application/json" -H  "Message-Reference: d0e7832e-5c98-11ea-bc55-0242ac13" -H  "Message-Reference-Date: Wed, 21 Oct 2015 07:28:00 GMT" -H  "Plugin-Name:  " -H  "Plugin-Version:  " -H  "Shipping-System-Platform-Name:  " -H  "Shipping-System-Platform-Version:  " -H  "Webstore-Platform-Name:  " -H  "Webstore-Platform-Version:  " -H  "authorization: Basic ZGVtby1rZXk6ZGVtby1zZWNyZXQ="
$accountNumber = 220136396;

*/
$originCountryCode = "FR";
$originPostalCode = "75000";
$originCityName = "Paris";
$destinationCountryCode = "FR";
$destinationPostalCode = "75001";
$destinationCityName = "75001";
$weight = 5;
$length = 15;
$width = 10;
$height = 5;
$plannedShippingDate = 2020-02-26;
$isCustomsDeclarable = true;
$unitOfMeasurement = "metric";
 


$response = $client->request('GET', $endpoint, [  /*'query' => [
   
	
'originCountryCode' =>$originCountryCode ,
'originPostalCode' =>$originPostalCode  ,
'originCityName' =>$originCityName  ,
'destinationCountryCode' =>$destinationCountryCode  ,
'destinationPostalCode' =>$destinationPostalCode  ,
'destinationCityName' =>$destinationCityName  ,
'weight' =>$weight ,
'length' =>$length ,
'width' =>$width ,
'height' =>$height ,
'plannedShippingDate' =>$plannedShippingDate ,
'isCustomsDeclarable' =>$isCustomsDeclarable  ,
'unitOfMeasurement' =>$unitOfMeasurement  ,
],
	'headers' => [
	'accept'=> 'application/json',
	'Message-Reference'=> 'd0e7832e-5c98-11ea-bc55-0242ac13',
	'Message-Reference-Date'=> 'Wed, 21 Oct 2015 07:28:00 GMT',
	'Plugin-Name'=> '',
	'Plugin-Version'=> '',
	'Shipping-System-Platform-Name'=> '',
	'Shipping-System-Platform-Version'=> '',
	'Webstore-Platform-Name'=> '',
	'Webstore-Platform-Version'=> '',
	'authorization'=> 'Basic ZGVtby1rZXk6ZGVtby1zZWNyZXQ=',
	 
  	]*/ 
	 'auth' => ['saampFR', 'A@0eV^1zW!3x']

]);

// url will be: http://my.domain.com/test.php?key1=5&key2=ABC;

$statusCode = $response->getStatusCode();
$content = $response->getBody();

         return view('orders',['statusCode'=>$statusCode,'result'=>$statusCode]);
    }
	
	  public function test()
    { 

//	$endpoint = "https://express.api.dhl.com/mydhlapi/test/rates";
		$endpoint = "https://api-mock.dhl.com/mydhlapi/rates";

$client = new \GuzzleHttp\Client();
/*
accountNumber=220136396&originCountryCode=FR&originPostalCode=75000&originCityName=Paris&destinationCountryCode=FR&
destinationPostalCode=75001&destinationCityName=Paris&weight=5&length=15&width=10&height=5&plannedShippingDate=2020-02-26&isCustomsDeclarable=true&unitOfMeasurement=metric" -H  "accept: application/json" -H  "Message-Reference: d0e7832e-5c98-11ea-bc55-0242ac13" -H  "Message-Reference-Date: Wed, 21 Oct 2015 07:28:00 GMT" -H  "Plugin-Name:  " -H  "Plugin-Version:  " -H  "Shipping-System-Platform-Name:  " -H  "Shipping-System-Platform-Version:  " -H  "Webstore-Platform-Name:  " -H  "Webstore-Platform-Version:  " -H  "authorization: Basic ZGVtby1rZXk6ZGVtby1zZWNyZXQ="
$accountNumber = 220136396;

*/
$originCountryCode = "FR";
$originPostalCode = "75000";
$originCityName = "Paris";
$destinationCountryCode = "FR";
$destinationPostalCode = "75001";
$destinationCityName = "75001";
$weight = 5;
$length = 15;
$width = 10;
$height = 5;
$plannedShippingDate = 2020-02-26;
$isCustomsDeclarable = true;
$unitOfMeasurement = "metric";
 


$response = $client->request('GET', $endpoint, ['query' => [
   /* 'key1' => $id, 
    'key2' => $value,*/
	
'originCountryCode' =>$originCountryCode ,
'originPostalCode' =>$originPostalCode  ,
'originCityName' =>$originCityName  ,
'destinationCountryCode' =>$destinationCountryCode  ,
'destinationPostalCode' =>$destinationPostalCode  ,
'destinationCityName' =>$destinationCityName  ,
'weight' =>$weight ,
'length' =>$length ,
'width' =>$width ,
'height' =>$height ,
'plannedShippingDate' =>$plannedShippingDate ,
'isCustomsDeclarable' =>$isCustomsDeclarable  ,
'unitOfMeasurement' =>$unitOfMeasurement  ,
],
	'headers' => [
	'accept'=> 'application/json',
	'Message-Reference'=> 'd0e7832e-5c98-11ea-bc55-0242ac13',
	'Message-Reference-Date'=> 'Wed, 21 Oct 2015 07:28:00 GMT',
	'Plugin-Name'=> '',
	'Plugin-Version'=> '',
	'Shipping-System-Platform-Name'=> '',
	'Shipping-System-Platform-Version'=> '',
	'Webstore-Platform-Name'=> '',
	'Webstore-Platform-Version'=> '',
	'authorization'=> 'Basic ZGVtby1rZXk6ZGVtby1zZWNyZXQ=',
	 
  	]
]);

// url will be: http://my.domain.com/test.php?key1=5&key2=ABC;

$statusCode = $response->getStatusCode();
$content = $response->getBody();

  $result= response()->json(  $content ,200,array(),JSON_PRETTY_PRINT);
 return view('test',['statusCode'=>$statusCode,'result'=>$content]) ;   
		 
		 }

	 public function findings()
    { 
         return view('products.findings');
    }
	
	 public function products()
    { 
         return view('products.products');
    }
	
	 public function jewelry()
    { 
         return view('products.jewelry');
    }
	
	 public function galvano()
    { 
         return view('products.galvano');
    }
	
	 public function refining()
    { 
         return view('products.refining');
    }

	 public function laboratory()
    { 
         return view('laboratory');
    }
	
      public function panier()
    { 
	return view('products.panier');
    }
	
	
 	 public function livraison()
    { 
         return view('livraison');
    }
	
 	 public function livraisonmod()
    { 
         return view('livraisonmod');
    } 	



 	 public function trading()
    { 
         return view('trading');
    }

 	 public function virement(Request $request)
    { 
	 $debut = $request->get('debut');
 	 $fin = $request->get('fin');
 	 $metal = $request->get('metal');
 
         return view('virement.virement',[ 'debut'=>$debut,'fin'=>$fin ,'metal'=>$metal]);
    }
	
	 public function ajout( )
    { 
         return view('virement.ajout',[ ]);
    }

	 public function beneficiaire($id )
    { 
         return view('virement.beneficiaire',['id'=>$id ]);
    }
	
	 public function beneficiaires( )
    { 
         return view('virement.beneficiaires',[ ]);
    }
	
  	 public function euros()
    { 
         return view('euros');
    }
	
  	 public function poids()
    { 
         return view('poids');
    }
	
	/**** Affinage ***/
	 public function affinage()
    { 
         return view('affinage.affinage');
    }
	
  	 public function modeles()
    { 
         return view('affinage.modeles');
    }
	
	 public function modele()
    { 
         return view('affinage.modele');
    }
	
	public function viewmodele($id)
    { 
         return view('affinage.viewmodele',['id'=>$id]);
    }	
	
		public function commandeprod($id)
    { 
         return view('products.commande',['id'=>$id]);
    }	
	
	
	public function commande($id)
    { 
         return view('affinage.commande',['id'=>$id]);
    }	
	
		/****  Rachat (RMP) ***/
	 public function rachat()
    { 
         return view('rachat.rachat');
    }
 	
	 public function modelermp()
    { 
         return view('rachat.modele');
    }
	
	public function viewmodelermp($id)
    { 
         return view('rachat.viewmodele',['id'=>$id]);
    }	
	
	public function commandermp($id)
    { 
         return view('rachat.commande',['id'=>$id]);
    }	
	
	/************  Laboratoire ************/
	
		public function viewmodelelab($id)
    { 
         return view('laboratoire.viewmodele',['id'=>$id]);
    }
 
 	 public function laboratoire()
    { 
         return view('laboratoire.laboratoire');
    }	
	
	 public function modelelab()
    { 
         return view('laboratoire.modele');
    }
	
	public function commandelab($id)
    { 
       return view('laboratoire.commande',['id'=>$id]);
    }	
	
	

}
