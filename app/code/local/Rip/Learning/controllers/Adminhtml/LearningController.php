<?php 
class Rip_Learning_Adminhtml_LearningController extends Mage_Adminhtml_Controller_Action
{
	


protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('rip_learning')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        return $this;
    }  
    
    public function indexAction() {
		
        $this->_initAction();   
        $this->_addContent($this->getLayout()->createBlock('learning/adminhtml_learning_edit'));

		
        $this->_addContent($this->getLayout()->createBlock('learning/adminhtml_learning_edit_tab_form'));
	   
	   
	  /* $this->getResponse()->setBody(
               $this->getLayout()->createBlock('learning/adminhtml_learning_grid')->toHtml());
	   
	   */
        $this->renderLayout();
		
		
		
    }

	
	public function refreshAction()
    {

//calling ftp==========================================================================================
		
		 $model = Mage::getModel('learning/learning')->load(1);
        $link = $model->getHost();
		$username = $model->getUsername();
		$password = $model->getPassword();
		$filename = $model->getFilename();

		//echo $username;
		$url_test = Mage::getStoreConfig(Mage_Core_Model_Url::XML_PATH_SECURE_URL);
		$url = Mage::getBaseUrl();
		
		
$remote_file = $filename;
$ftp_host = $link; 
$ftp_user_name = $username.'@'.$link; 
$ftp_user_pass = $password;
 
$local_file = 'consta.xml';
$connect_it = ftp_connect( $ftp_host )or die("Couldn't connect to $ftp_server");
 
$login_result = ftp_login( $connect_it, $ftp_user_name, $ftp_user_pass );
 
if ( ftp_get( $connect_it, $local_file, $remote_file, FTP_BINARY ) ) {
    //echo "WOOT! Successfully written to $local_file\n";
}
else {
   // echo "Doh! There was a problem\n";
}
 
ftp_close( $connect_it );

  

function call($sku)
{
 $url = Mage::getBaseUrl();			
$proxy = new SoapClient($url.'api/v2_soap/?wsdl'); // TODO : change url
$sessionId = $proxy->login('admmin', 'main12354'); // TODO : change login and pwd if necessary

$resultp = $proxy->catalogProductList($sessionId);
//echo"<pre>";
//print_r($resultp);
foreach($resultp as $key => $value1)
{
	$product_sku=$value1->sku;
	//echo"prosku-".$key."<br>";
	
	if($sku == $product_sku)
	{
		$data = 1;
		$prokey=$key;
		break;
	}
	else
	{
		$data =  0;
		
	}
}
//return $data;
return array('keyp' => $prokey, 'datap' => $data);
}


function customer_call($email)
{
	 $url = Mage::getBaseUrl();
	$proxy = new SoapClient($url.'api/v2_soap/?wsdl'); // TODO : change url
$sessionId = $proxy->login('admmin', 'main12354'); // TODO : change login and pwd if necessary

$result_cust = $proxy->customerCustomerList($sessionId);
//echo"<pre>";
//print_r($result_cust);

foreach($result_cust as $key2 => $custemail)
{
	$ct_email=$custemail->email;
	
	if($email == $ct_email)
	{
		$datac = 1;
		$cus_key=$key2;
		break;
	}
	else
	{
		$datac =  0;
		
	}
}
//return $datac;	
return array('key' => $cus_key, 'data' => $datac);
}


$client = new SoapClient($url.'api/v2_soap/?wsdl');

// If some stuff requires api authentification,
// then get a session token
$apiuser='admmin';
$apikey='main12354';

$session = $client->login($apiuser, $apikey);

$headers = array(
"Content-type: application/atom+xml"
); 
$curl = curl_init();  
curl_setopt($curl, CURLOPT_URL, "".$url_test."consta.xml");
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$info = curl_getinfo($curl);
$response = curl_exec($curl);
//print_r($response);
		
		$responseDoc = new DOMDocument();
        $responseDoc->loadXML($response);

        $response = simplexml_import_dom($responseDoc);
		//print_r($info);
		//echo "<pre>";
		//print_r($response);
		//echo "</pre>";
		
		$sales=$response->SalesOrder; 
		//print_r($sales);
		 
		foreach($sales as $ss)
		{ 
			//print_r($ss);
		
		$order_id=$ss->OrderId; 
		//echo "<br>order-".$order_id;
		$FirstName=$ss->BillingAddress->FirstName;
		$LasttName=$ss->BillingAddress->LasttName;
		$Street=$ss->BillingAddress->Street;
		$City=$ss->BillingAddress->City;
		$Country=$ss->BillingAddress->Country;
		$State_Province=$ss->BillingAddress->State_Province;
		$Zip=$ss->BillingAddress->Zip;
		$Telephone=$ss->BillingAddress->Telephone;
		
		$FirstNames=$ss->ShippingAddress->FirstName;
		$LasttNames=$ss->ShippingAddress->LasttName;
		$Streets=$ss->ShippingAddress->Street;
		$Citys=$ss->ShippingAddress->City;
		$Countrys=$ss->ShippingAddress->Country;
		$State_Provinces=$ss->ShippingAddress->State_Province;
		$Zips=$ss->ShippingAddress->Zip;
		$Telephones=$ss->ShippingAddress->Telephone;
		
		$product=$ss->Lines->Item;

//print_r($resultp);
   
		foreach($product as $value)
		{
			$ProductId=$value->ProductId;
			$ProductName=$value->ProductName;
			$ProductSku=$value->ProductSku;
			$Quantity=$value->Quantity;
			$UnitPrice=$value->UnitPrice;
			$weight=$value->weight;
			$Description=$value->Description;
			$ShortDescription=$value->ShortDescription;
			
			//echo"Appterra sku-".$ProductSku."<br>";
			// get attribute set
$pro_result=call($ProductSku);
$datap=$pro_result['datap'];
//echo"result-".$datap."<br>";
	if($datap==0)
	{
		
$client = new SoapClient($url.'api/v2_soap/?wsdl');
$apiuser='admmin';
$apikey='main12354';

$session = $client->login($apiuser, $apikey);
		
$attributeSets = $client->catalogProductAttributeSetList($session);
$attributeSet = current($attributeSets);

$result1 = $client->catalogProductCreate($session, 'simple', $attributeSet->set_id, $ProductSku, array(
    'name' => $ProductName,
    'description' => $Description,
    'short_description' => $ShortDescription,
    'weight' => $weight,
    'status' => '1',
    'visibility' => '4',
    'price' => $UnitPrice,
    'tax_class_id' => 1
));

//echo"<pre>";
//print_r($result1);
		
 

$proxy = new SoapClient($url.'api/v2_soap/?wsdl');  
$sessionId = $proxy->login('admmin','main12354'); 
 
$result = $proxy->catalogInventoryStockItemUpdate($sessionId, ''.$ProductSku.'', array(
'qty' => '100', 
'is_in_stock' => 1
));
   
//print_r($result);
	 
	}		
 

		}
		$BuyerFirstName=$ss->BuyerFirstName;
		//echo"<br>".$BuyerFirstName;
		$BuyerLasttName=$ss->BuyerLasttName;
		$BuyerEmail=$ss->BuyerEmail;
			
$buyer_email=customer_call($BuyerEmail);
$datacus=$buyer_email['data'];
		//echo"resultc-".$datacus."<br>";
if($datacus == 0)
	{

$result = $client->customerCustomerCreate($session, array('email' => $BuyerEmail, 'firstname' => $BuyerFirstName, 'lastname' => $BuyerLasttName, 'password' => 'password', 'website_id' => 1, 'store_id' => 1, 'group_id' => 1));
//var_dump ($session);
//echo"<pre>";
//print_r($result);
//echo"</pre>";
		}

		}
		
//create order
foreach($sales as $ss)
		{ 
		
		$BuyerFirstName=$ss->BuyerFirstName;
		//echo"<br>".$BuyerFirstName;
		$BuyerLasttName=$ss->BuyerLasttName;
		$BuyerEmail=$ss->BuyerEmail;
$user = $apiuser;
$password = $apikey;
    $proxy = new SoapClient($url.'api/v2_soap/?wsdl');
    $sessionId = $proxy->login($user, $password);
    $cartId = $proxy->shoppingCartCreate($sessionId, 1);
    // load the customer list and select the first customer from the list
    $customerList = $proxy->customerCustomerList($sessionId, array());
    //print_r($customerList);
	//$customer = (array) $customerList[2];
	//$customer = end($customerList);

	$cust_key = customer_call($BuyerEmail);
	$datakey=$cust_key['key'];
	
	$customer = (array) $customerList[$datakey];
	
    $customer['mode'] = 'customer';
    $proxy->shoppingCartCustomerSet($sessionId, $cartId, $customer);
	
$product=$ss->Lines->Item;
	foreach($product as $value)
		{
			$ProductSku=$value->ProductSku;
			$Quantity=$value->Quantity;
			
			$pro_ky=call($ProductSku);
			$datakey=$pro_ky['keyp'];
	$productList = $proxy->catalogProductList($sessionId);
   $product = (array) $productList[$datakey];
   $product['qty'] = $Quantity;
   $proxy->shoppingCartProductAdd($sessionId, $cartId, array($product));
		}
    $address = array(
        array(
            'mode' => 'shipping',
            'firstname' => $customer['firstname'],
            'lastname' => $customer['lastname'],
            'street' => 'street address',
            'city' => 'city',
            'region' => 'region',
            'telephone' => 'phone number',
            'postcode' => 'postcode',
            'country_id' => 'country ID',
            'is_default_shipping' => 0,
            'is_default_billing' => 0
        ),
        array(
            'mode' => 'billing',
            'firstname' => $customer['firstname'],
            'lastname' => $customer['lastname'],
            'street' => 'street address',
            'city' => 'city',
            'region' => 'region',
            'telephone' => 'phone number', 
            'postcode' => 'postcode',
            'country_id' => 'country ID',
            'is_default_shipping' => 0,
            'is_default_billing' => 0
        ),
    );
     // add customer address
    $proxy->shoppingCartCustomerAddresses($sessionId, $cartId, $address);
    // add shipping method
    $proxy->shoppingCartShippingMethod($sessionId, $cartId, 'flatrate_flatrate');

    $paymentMethod =  array(
        'po_number' => null,
        'method' => 'checkmo',
        'cc_cid' => null,
        'cc_owner' => null,
        'cc_number' => null,
        'cc_type' => null,
        'cc_exp_year' => null,
        'cc_exp_month' => null
    );
     // add payment method
    $proxy->shoppingCartPaymentMethod($sessionId, $cartId, $paymentMethod);
     // place the order
    $orderId = $proxy->shoppingCartOrder($sessionId, $cartId,null,null);
    //print_r($orderId);
		} 




Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Purchase order successfully imported'));


		
		$this->_forward('index');
		
    }
	
	
	
	
	
	
	
	

	    public function editAction()
    {
		
		
        $learningId     = $this->getRequest()->getParam('id');
        $learningModel  = Mage::getModel('learning/learning')->load($learningId);
  
        if ($learningModel->getId() || $learningId == 0) {
  
            Mage::register('learning_data', $learningModel);
  
            $this->loadLayout();
            $this->_setActiveMenu('learning/items');
            
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
            
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            
            $this->_addContent($this->getLayout()->createBlock('learning/adminhtml_learning_edit'))
                 ->_addLeft($this->getLayout()->createBlock('learning/adminhtml_learning_edit_tabs'));
                
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('learning')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }
    
    public function newAction()
    {
        $this->_forward('edit');
    }
	
	
	
	
	 public function saveAction()
    {
		


		
	if ( $this->getRequest()->getPost() ) {
            try {
				
                $postData = $this->getRequest()->getPost();
				
					
					if($postData['Host'] and $postData['Username'] and $postData['Password'] and $postData['Filename']!=''){
						
				/*		
				$learningModel = Mage::getModel('learning/learning')->load($this->getRequest()->getParam('id'));

                $learningModel->setLink($postData['Link'])
                
                ->save();	
				*/
					
					 $id = 1;
					 echo "<script>alert('".$postData['Host']."');</script>";
					 
					 $arrcustData = array('host'=>$postData['Host'],'username'=>$postData['Username'],'password'=>$postData['Password'],'filename'=>$postData['Filename']);
					
					$model = Mage::getModel('learning/learning')->load($id)->addData($arrcustData );  
					
					$model->setId($id)->save();
					
					
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('FTP Details was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setlearningData(false);

					}
					
					
					else {
		   Mage::getSingleton('adminhtml/session')->addError(Mage::helper('learning')->__('Invalid Input'));
           
		}
					
					
				
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setlearningData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');	
		
		
		
		
		
		
		
		
    }
    
    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $learningModel = Mage::getModel('learning/learning');
                
                $learningModel->setId($this->getRequest()->getParam('id'))
                    ->delete();
                    
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
    /**
     * Product grid for AJAX request.
     * Sort and filter result for example.
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
               $this->getLayout()->createBlock('learning/adminhtml_learning_grid')->toHtml()
        );
    }
	
	
	
	
	
	
	
	

	
}
