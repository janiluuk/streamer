<?php
class Checkout 
{
  private $version= "0001";
  private $language= "FI";
  private $country= "FIN";
  private $currency= "EUR";
  private $device= "1";
  private $content= "1";
  private $type= "0";
  private $algorithm= "2";
  private $merchant= "";
  private $password= "";
  private $stamp= 0;
  private $amount= 0;
  private $reference= "";
  private $message= "";
  private $return= "";
  private $cancel= "";
  private $reject= "";
  private $delayed= "";
  private $delivery_date= "";
  private $firstname= "";
  private $familyname= "";
  private $address= "";
  private $postcode= "";
  private $postoffice= "";
  private $status= "";
  private $email= "";
  
  public function __construct($merchant, $password) 
  {
    $this->merchant= $merchant; // merchant id
    $this->password= $password; // security key (about 80 chars)
  }

  /*
   * generates MAC and prepares values for creating payment
   */
  public function getCheckoutObject($data) 
  {
    // overwrite default values
    foreach($data as $key => $value) 
      {
	$this->{$key} = $value;
      }

    $mac = 
      strtoupper(md5("{$this->version}+{$this->stamp}+{$this->amount}+{$this->reference}+{$this->message}+{$this->language}+{$this->merchant}+{$this->return}+{$this->cancel}+{$this->reject}+{$this->delayed}+{$this->country}+{$this->currency}+{$this->device}+{$this->content}+{$this->type}+{$this->algorithm}+{$this->delivery_date}+{$this->firstname}+{$this->familyname}+{$this->address}+{$this->postcode}+{$this->postoffice}+{$this->password}"));
    $mac_plain = 
      strtoupper("{$this->version}+{$this->stamp}+{$this->amount}+{$this->reference}+{$this->message}+{$this->language}+{$this->merchant}+{$this->return}+{$this->cancel}+{$this->reject}+{$this->delayed}+{$this->country}+{$this->currency}+{$this->device}+{$this->content}+{$this->type}+{$this->algorithm}+{$this->delivery_date}+{$this->firstname}+{$this->familyname}+{$this->address}+{$this->postcode}+{$this->postoffice}+{$this->password}");

    $post['VERSION']= $this->version;
    $post['STAMP']= $this->stamp;
    $post['AMOUNT']= $this->amount;
    $post['REFERENCE']= $this->reference;
    $post['MESSAGE']= $this->message;
    $post['LANGUAGE']= $this->language;
    $post['MERCHANT']= $this->merchant;
    $post['RETURN']= $this->return;
    $post['CANCEL']= $this->cancel;
    $post['REJECT']= $this->reject;
    $post['DELAYED']= $this->delayed;
    $post['COUNTRY']= $this->country;
    $post['CURRENCY']= $this->currency;
    $post['DEVICE']= $this->device;
    $post['CONTENT']= $this->content;
    $post['TYPE']= $this->type;
    $post['ALGORITHM']= $this->algorithm;
    $post['DELIVERY_DATE']= $this->delivery_date;
    $post['FIRSTNAME']= $this->firstname;
    $post['FAMILYNAME']= $this->familyname;
    $post['ADDRESS']= $this->address;
    $post['POSTCODE']= $this->postcode;
    $post['POSTOFFICE']= $this->postoffice;
    $post['MAC']= $mac;

    if($this->device == 10){
      $post['EMAIL']=$this->email;
    }


    return $post;
  }
  
  /*
   * returns payment information in XML
   */
  public function getCheckoutXML($data) 
  {
    $this->device = "10";
    return $this->sendPost($this->getCheckoutObject($data));
  }
  
  private function sendPost($post) {
    $options = array(
		     CURLOPT_POST => 1,
		     CURLOPT_HEADER => 0,
		     CURLOPT_URL => 'https://payment.checkout.fi',
		     CURLOPT_FRESH_CONNECT => 1,
		     CURLOPT_RETURNTRANSFER => 1,
		     CURLOPT_FORBID_REUSE => 1,
		     CURLOPT_TIMEOUT => 20,
		     CURLOPT_POSTFIELDS => http_build_query($post)
		     );
    
    $ch = curl_init();
    curl_setopt_array($ch, $options);

    $result = curl_exec($ch);

    curl_close($ch);

    return $result; 
  }
  
  public function validateCheckout($data) 
  {
    $generatedMac = 
      strtoupper(md5("{$this->password}&{$data['VERSION']}&{$data['STAMP']}&{$data['REFERENCE']}&{$data['PAYMENT']}&{$data['STATUS']}&{$data['ALGORITHM']}"));
    
    if($data['MAC'] == $generatedMac) 
      return true;
    else
      return false;
  }
  
  public function isPaid($status)
  {
    if(in_array($status, array(2, 4, 5, 6, 7, 8, 9, 10))) 
      return true;
    else
      return false;
  }
}  // class Checkout
?>
