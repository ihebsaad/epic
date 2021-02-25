<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\User ;
use DB ;

use alexLE\DHLExpress\Ship;
use alexLE\DHLExpress\Address;
use alexLE\DHLExpress\Shipper;
use alexLE\DHLExpress\Contact;
use alexLE\DHLExpress\Packages;
use alexLE\DHLExpress\Recipient;
use alexLE\DHLExpress\Commodities;
use alexLE\DHLExpress\Credentials;
use alexLE\DHLExpress\ShipmentInfo;
use alexLE\DHLExpress\SpecialService;
use alexLE\DHLExpress\ShipmentRequest;
use alexLE\DHLExpress\RequestedPackage;
use alexLE\DHLExpress\RequestedShipment;
use alexLE\DHLExpress\InternationalDetail;

 
class DHLController extends Controller
{
	
	  public function __construct()
    {
        $this->middleware('auth');
    } 
	 
	 
	 
	public static function shipment($testmode,$username,$password,$account,$company,$adresse,$ville,$codep,$phone,$email,$poids,$longeur,$largeur,$hauteur) 
	 {
 $user = auth()->user();  
 $cl_ident=$user['cl_ident'];	

 $client=DB::table('client')->where('cl_ident',$cl_ident)->first();
	$company= 
	$name= $user['name'] .' '.$user['lastname'] ;
	
	// poids de g vers KG
	$poids=floatval($poids/1000);
	if($email==''){$email= $user['email'];}
	if($phone==''){$phone= $user['phone'];}
 	if($company==''){$company=$client->raison_sociale;}
	
   
$credentials = new Credentials($testmode);
$credentials
            ->setUsername($username)
            ->setPassword($password);

$specialService = new SpecialService();
$specialService->setServiceType(SpecialService::SATURDAY_DELIVERY);

$shipmentInfo = new ShipmentInfo();
$shipmentInfo
    ->setDropOffType(ShipmentInfo::DROP_OFF_TYPE_REGULAR_PICKUP)
    ->setServiceType(ShipmentInfo::SERVICE_TYPE_DOMESTIC_EXPRESS)
    ->setAccount($account)
    ->setCurrency('EUR')
    ->setUnitOfMeasurement(ShipmentInfo::UNIT_OF_MEASRUREMENTS_KG_CM)
    ->setLabelType(ShipmentInfo::LABEL_TYPE_PDF)
    ->setLabelTemplate(ShipmentInfo::LABEL_TEMPLATE_ECOM26_A6_002)
    ->addSpecialService($specialService);

$shipperContact = new Contact();
$shipperContact
    ->setPersonName($name)
    ->setCompanyName($company)
    ->setPhoneNumber($phone)
    ->setEmailAddress($email);
$shipperAddress = new Address();
$shipperAddress
	->setStreetLines($adresse)
    ->setCity($ville)
    ->setPostalCode($codep)
    ->setCountryCode('FR');

$shipper = new Shipper();
$shipper
    ->setContact($shipperContact)
    ->setAddress($shipperAddress);

$recipientContact = new Contact();
$recipientContact
    ->setPersonName('Saamp Paris')
    ->setCompanyName('SAAMP')
    ->setPhoneNumber('+33(0)1 44 61 80 32')
    ->setEmailAddress('contact@saamp.com');

$recipientAddress = new Address();
$recipientAddress
    ->setStreetLines('145 rue de temple')
    ->setCity('Paris')
    ->setPostalCode('75003')
    ->setCountryCode('FR');

$recipient = new Recipient();
$recipient
    ->setContact($recipientContact)
    ->setAddress($recipientAddress);

$ship = new Ship();
$ship
    ->setShipper($shipper)
    ->setRecipient($recipient);

$package1 = new RequestedPackage();
$package1
    ->setWeight($poids)  // in KG
    ->setDimensions($longeur, $largeur, $hauteur)   // in CM
    ->setCustomerReferences( 'ID CLient : '.$cl_ident);

$packages = new Packages();
$packages
    ->addRequestedPackage($package1);

$commodities = new Commodities();
$commodities->setDescription('Modèles SAAMP');

// The InternationalDetail seems to be required even if its a domestic package
$internationalDetail = new InternationalDetail();
$internationalDetail
    ->setCommodities($commodities)
    ->setContent(InternationalDetail::CONTENT_DOCUMENTS);

$timestamp = new \DateTime("now", new \DateTimeZone("Europe/Paris"));
//$timestamp->modify('+3 days');
$timestamp->modify('+3 Weekday');

$requestedShipment = new RequestedShipment();
$requestedShipment
    ->setShipmentInfo($shipmentInfo)
    ->setShipTimestamp($timestamp)
    ->setPaymentInfo(RequestedShipment::PAYMENT_INFO_DELIVERED_AT_PLACE)
    ->setShip($ship)
    ->setPackages($packages)
    ->setInternationalDetail($internationalDetail);

$shipment = new ShipmentRequest($credentials);
$shipment->setRequestedShipment($requestedShipment);
$response = $shipment->send();
/*
if ($response->isSuccessful()) {
    return($response->getTrackingNumber());
   // file_put_contents('label_1.pdf', base64_decode($response->getLabel()));
} else {
    dd($response->getErrors());
   // return($response->getErrors());
}		 
*/
return $response;		 
		 
	 }
	 
	 
	 
	 
}
