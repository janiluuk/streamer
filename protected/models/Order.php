<?php

Yii::import('application.models._base.BaseOrder');

class Order extends BaseOrder
{
    /**
     * @return Order
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    
    public static function label($n = 1)
    {
        return Yii::t('app', 'Order|Orders', $n);
    }


    public function validatePurchase($data=array()) {
      Yii::import("application.components.Checkout");
      $checkout = new Checkout(375917, "SAIPPUAKAUPPIAS");


      if($checkout->validateCheckout($data)) {
	if (!empty($data['STATUS']) && $checkout->isPaid($data['STATUS'])) {
	  error_log("Payment received!");
	  return true;
	} else {
	
	  error_log("Payment NOT received!");            
	}
	
      } else {

	throw new Exception("Checkout validation failed!");
	error_log("Checkout debug: " . serialize($data));

      }
      return false;

    }

    public function isValid() {
      return (strtotime($this->valid_to) > time());
    }


    public function validateCode($code) {
      if ($order = Order::model()->find("code=:code",array("code" => $code))) {
	return $order;

      }
      else return false;
      
    }
    
    public function generateCode() {
      $code = substr(md5(time() . rand(0,100)),0,8);
      return $code;

    }

    public function purchase($email,$channel_id, $payment_type=1) {
      
      if (!$channel = Channel::model()->findByPk($channel_id)) throw new Exception("No such channel {$channel_id} found!");

      
      $type = (int)$channel->priceclass->type;
      $type_text = Priceclass::getType($type);
      $type_duration = Priceclass::getDuration($type);      
      $code = $this->generateCode();
      $channel_name = $channel->name;
      $order = new Order;
      $order->amount = (int)$channel->priceclass->amount * 100;
      $order->email = $email;
      $order->code = $this->generateCode();
      $order->channel_id = $channel_id;
      $order->status = 0;
      $order->price_class_id = $channel->priceclass->id;
      $order->payment_type = $payment_type;
      $order->valid_from = date('Y-m-d H:i:s');
      $order->valid_to = date('Y-m-d H:i:s',(time()+$type_duration));
      
      if ($order->validate()) {

	if ($order->save()) {
	  return $order;	  
	  
	}

      } else {
	var_dump($order->getErrors());


      }
      


    }


    public function prepareCheckoutPurchase() {

      Yii::import("application.components.Checkout");
      //      $co = new Checkout(Yii::app()->params["merchantId"], Yii::app()->params["merchantKey"]);  
      $co = new Checkout(375917, "SAIPPUAKAUPPIAS");
      // Order information
      $coData= array();
      $coData["stamp"]= time(); // unique timestamp
      $coData["reference"]= $this->id;
      $coData["message"]= "Tilaus kanavalle " . $this->channel->name; 
      $coData["return"]= "http://www.citystream.tv/order/checkIn?test=1";
      $coData["amount"]= $this->amount; // price in cents
      $coData["delivery_date"]= date("Ymd");
      $coData["firstname"]= "Tero";
      $coData["familyname"]= "Testaaja";
      $coData["address"]= "Ääkköstie 5b3\nKulmaravintolan yläkerta";
      $coData["postcode"]= "33100";
      $coData["postoffice"]= "Tampere";
      $coData["email"]= $this->email;
      
      // coObject for old method
      $coObject = $co->getCheckoutObject($coData);
      // change stamp for xml method
      $coData['stamp'] = time() + 1;
      
      $response =$co->getCheckoutXML($coData); // get payment button data
      $xml = simplexml_load_string($response);

if($xml === false)
  {
    die('XML rajapinnan käyttö ei onnistunut. Käytä vanhaa tapaa.');
  }
else
  {
	  // paymentURL link is used if a payer somehow manages to fail paying. You can
	  // save it to the webstore and later (if needed) send it by email.
	  $link = $xml->paymentURL;
	}      

      return $xml;

    }

}