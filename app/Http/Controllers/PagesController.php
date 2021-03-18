<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;
use App\User ;
use GuzzleHttp\Client;
use App\Http\Controllers\DHLController ;

class PagesController extends Controller
{
	
	  public function __construct()
    {
        $this->middleware('auth');
    } 
	 
 
 
 	  public function test()
    { 	
	 //	 shipment($testmode,$username,$password,$account,$company,$adresse,$ville,$codep,$phone,$email,$poids,$longeur,$largeur,$hauteur) 

	  $content = DHLController::shipment(true,'saampFR','A@0eV^1zW!3x','220136396','Metafont','AVENUE DE LYON','BOURG LES VALENCES','26500','','',2520,1,2,3) ;
	 return view('test',[ 'result'=>$content]) ;   

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
	
	
	$endpoint = "https://api-mock.dhl.com/mydhlapi/rates";
	$endpoint = "https://api-mock.dhl.com/mydhlapi/shipments";
$client = new \GuzzleHttp\Client();
 
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
 
$data='

{
  "plannedShippingDateAndTime": "2021-02-25T14:00:31GMT+01:00",
  "pickup": {
    "isRequested": false,
    "closeTime": "18:00",
    "location": "reception",
    "specialInstructions": [
      {
        "value": "please ring door bell",
        "typeCode": "TBD"
      }
    ]
 
  },
  "productCode": "D",
  "localProductCode": "D",
  "getRateEstimates": false,
  "accounts": [
    {
      "typeCode": "shipper",
      "number": "123456789"
    }
  ],
 
 
 
  "customerDetails": {
    "shipperDetails": {
      "postalAddress": {
        "postalCode": "14800",
        "cityName": "Prague",
        "countryCode": "CZ",
        "provinceCode": "CZ",
        "addressLine1": "V Parku 2308/10",
        "addressLine2": "addres2",
        "addressLine3": "addres3",
        "countyName": "Central Bohemia"
      },
      "contactInformation": {
        "email": "that@before.de",
        "phone": "+1123456789",
        "mobilePhone": "+60112345678",
        "companyName": "Company Name",
        "fullName": "John Brew"
      },
      "registrationNumbers": [
        {
          "typeCode": "VAT",
          "number": "CZ123456789",
          "issuerCountryCode": "CZ"
        }
      ],
      "bankDetails": [
        {
          "name": "Russian Bank Name",
          "settlementLocalCurrency": "RUB",
          "settlementForeignCurrency": "USD"
        }
      ]
    },
    "receiverDetails": {
      "postalAddress": {
        "postalCode": "14800",
        "cityName": "Prague",
        "countryCode": "CZ",
        "provinceCode": "CZ",
        "addressLine1": "V Parku 2308/10",
        "addressLine2": "addres2",
        "addressLine3": "addres3",
        "countyName": "Central Bohemia"
      },
      "contactInformation": {
        "email": "that@before.de",
        "phone": "+1123456789",
        "mobilePhone": "+60112345678",
        "companyName": "Company Name",
        "fullName": "John Brew"
      },
      "registrationNumbers": [
        {
          "typeCode": "VAT",
          "number": "CZ123456789",
          "issuerCountryCode": "CZ"
        }
      ],
      "bankDetails": [
        {
          "name": "Russian Bank Name",
          "settlementLocalCurrency": "RUB",
          "settlementForeignCurrency": "USD"
        }
      ]
    },
    "buyerDetails": {
      "postalAddress": {
        "postalCode": "14800",
        "cityName": "Prague",
        "countryCode": "CZ",
        "provinceCode": "CZ",
        "addressLine1": "V Parku 2308/10",
        "addressLine2": "addres2",
        "addressLine3": "addres3",
        "countyName": "Central Bohemia"
      },
      "contactInformation": {
        "email": "buyer@domain.com",
        "phone": "+44123456789",
        "mobilePhone": "+42123456789",
        "companyName": "Customer Company Name",
        "fullName": "Mark Companer"
      },
      "registrationNumbers": [
        {
          "typeCode": "VAT",
          "number": "CZ123456789",
          "issuerCountryCode": "CZ"
        }
      ],
      "bankDetails": [
        {
          "name": "Russian Bank Name",
          "settlementLocalCurrency": "RUB",
          "settlementForeignCurrency": "USD"
        }
      ]
    }
  },
  "content": {
    "packages": [
      {
        "typeCode": "2BP",
        "weight": 22.5,
        "dimensions": {
          "length": 15,
          "width": 15,
          "height": 40
        },
        "customerReferences": [
          {
            "value": "Customer reference",
            "typeCode": "CU"
          }
        ],
        "identifiers": [
          {
            "typeCode": "shipmentId",
            "value": "1111111111"
          }
        ],
        "description": "Piece content description",
        "labelBarcodes": [
          {
            "position": "left",
            "symbologyCode": "93",
            "content": "string",
            "textBelowBarcode": "text below left barcode"
          }
        ],
        "labelText": [
          {
            "position": "left",
            "caption": "text caption",
            "value": "text value"
          }
        ],
        "labelDescription": "bespkoe label description"
      }
    ],
    "isCustomsDeclarable": true,
    "declaredValue": 150,
    "declaredValueCurrency": "CZK",
    "exportDeclaration": {
      "lineItems": [
        {
          "number": 1,
          "description": "line item description",
          "price": 150,
          "priceCurrency": "CZK",
          "quantity": {
            "value": 1,
            "unitOfMeasurement": "BOX"
          },
          "commodityCodes": [
            {
              "typeCode": "outbound",
              "value": "HS1111111111"
            }
          ],
          "exportReasonType": "permanent",
          "manufacturerCountry": "CZ",
          "exportControlClassificationNumber": "US123456789",
          "weight": {
            "netValue": 10,
            "grossValue": 10
          }
        }
      ],
      "invoice": {
        "number": "12345-ABC",
        "date": "2020-03-18",
        "signatureName": "Brewer",
        "signatureTitle": "Mr.",
        "signatureImage": "Base64 encoded image"
      },
      "remarks": [
        {
          "value": "declaration remark"
        }
      ],
      "additionalCharges": [
        {
          "value": 10,
          "caption": "fee"
        }
      ],
      "destinationPortName": "port details",
      "payerVATNumber": "12345ED",
      "recipientReference": "recipient reference",
      "exporter": {
        "id": "123",
        "code": "EXPCZ"
      },
      "packageMarks": "marks",
      "declarationNotes": [
        {
          "value": "up to three declaration notes"
        }
      ],
      "exportReference": "export reference",
      "exportReason": "export reason",
      "licenses": [
        {
          "typeCode": "export",
          "value": "license"
        }
      ]
    },
    "description": "shipment description",
    "USFilingTypeValue": "12345",
    "incoterm": "DAP",
    "unitOfMeasurement": "metric"
  }
 
  
}
 ';
//$credentials = base64_encode('saampFR' .':' . 'A@0eV^1zW!3x' ) ;
$credentials = base64_encode('demo-key' .':' . 'demo-secret' ) ;




$response = $client->request('GET', $endpoint, [
        ['body' => $data],
/*
'query' => [
 
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
],*/
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
	//'authorization'=> 'Basic {'.$credentials.'}',
	'Content-Type' => 'application/json'
	 
  	]
]);

// url will be: http://my.domain.com/test.php?key1=5&key2=ABC;

$statusCode = $response->getStatusCode();
$content = $response->getBody();

         return view('orders',['statusCode'=>$statusCode,'result'=>$content]);
    }
	
/*	  public function test()
    {  
 
  	 	$endpoint = "https://api-mock.dhl.com/mydhlapi/rates";
  //$endpoint = "https://api-mock.dhl.com/mydhlapi/shipments";

$client = new \GuzzleHttp\Client();
 
$accountNumber = 220136396;

 
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
 
$credentials = base64_encode('demo-key' .':' . 'demo-secret' ) ;


$response = $client->request('GET', $endpoint, ['query' => [
    
	
'accountNumber' =>$accountNumber ,
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
	//'authorization'=> 'Basic ZGVtby1rZXk6ZGVtby1zZWNyZXQ=',
	 'authorization'=> 'Basic {'.$credentials.'}',
	 
  	]
]);

// url will be: http://my.domain.com/test.php?key1=5&key2=ABC;

$statusCode = $response->getStatusCode();
$content = $response->getBody();

  $result= response()->json(  $content ,200,array(),JSON_PRETTY_PRINT);
 return view('test',['statusCode'=>$statusCode,'result'=>$content]) ;   
	  
	
 //	 shipment($testmode,$username,$password,$account,$company,$adresse,$ville,$codep,$phone,$email,$poids,$longeur,$largeur,$hauteur) 
	
	$content = DHLController::shipment(true,'saampFR','A@0eV^1zW!3x','220136396','Metafont','AVENUE DE LYON','BOURG LES VALENCES','26500','','',2520,1,2,3) ;
	 return view('test',[ 'result'=>$content]) ;   

		 }
*/
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
	
	
	
	public function spot( )
    { 
       return view('trading.spot' );
    }		

}
