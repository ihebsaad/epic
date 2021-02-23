<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;


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
	 
	 
	 
	public static function shipment() 
	 {
		 
  
$credentials = new Credentials(true);
$credentials
            ->setUsername('saampFR')
            ->setPassword('A@0eV^1zW!3x');

$specialService = new SpecialService();
$specialService->setServiceType(SpecialService::SATURDAY_DELIVERY);

$shipmentInfo = new ShipmentInfo();
$shipmentInfo
    ->setDropOffType(ShipmentInfo::DROP_OFF_TYPE_REGULAR_PICKUP)
    ->setServiceType(ShipmentInfo::SERVICE_TYPE_DOMESTIC_EXPRESS)
    ->setAccount('220136396')
    ->setCurrency('EUR')
    ->setUnitOfMeasurement(ShipmentInfo::UNIT_OF_MEASRUREMENTS_KG_CM)
    ->setLabelType(ShipmentInfo::LABEL_TYPE_PDF)
    ->setLabelTemplate(ShipmentInfo::LABEL_TEMPLATE_ECOM26_A6_002)
    ->addSpecialService($specialService);

$shipperContact = new Contact();
$shipperContact
    ->setPersonName('Max Mustermann')
    ->setCompanyName('Acme Inc.')
    ->setPhoneNumber('0123456789')
    ->setEmailAddress('max.mustermann@example.com');

$shipperAddress = new Address();
$shipperAddress
    ->setStreetLines('Hauptstrasse 1')
    ->setCity('Paris')
    ->setPostalCode('75000')
    ->setCountryCode('FR');

$shipper = new Shipper();
$shipper
    ->setContact($shipperContact)
    ->setAddress($shipperAddress);

$recipientContact = new Contact();
$recipientContact
    ->setPersonName('Max Mustermann')
    ->setCompanyName('Acme Inc.')
    ->setPhoneNumber('0123456789')
    ->setEmailAddress('max.mustermann@example.com');

$recipientAddress = new Address();
$recipientAddress
    ->setStreetLines('Hauptstrasse 1')
    ->setCity('Paris')
    ->setPostalCode('75001')
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
    ->setWeight(2)
    ->setDimensions(1, 2, 3)
    ->setCustomerReferences('test 1');

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

$timestamp = new \DateTime("now", new DateTimeZone("Europe/Paris"));
$timestamp->modify('+3 days');

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

if ($response->isSuccessful()) {
    return($response->getTrackingNumber());
   // file_put_contents('label_1.pdf', base64_decode($response->getLabel()));
} else {
    return($response->getErrors());
}		 
		 
		 
	 }
	 
	 
	 
	 
}
