<?php
################################################################################################
#  DIY Module Builder for Opencart 1.5.1.x From HostJars http://opencart.hostjars.com    	   #
################################################################################################
class ModelModuleWebecoup extends Model {
	public function NotificationDeActivate($NotificationId){

      $licenseCode=$this->config->get('webengage_license_code');
      $ch = curl_init();
      $urlc='?http.protocol.handle-redirects=true';
      $urlp = "https://api.webengage.com/v1/accounts/";
      $urlp = $urlp.$licenseCode.'/notifications';
      $url = $urlp.'/'.$NotificationId.'/'.'saveActivation'.$urlc;
      //echo $url;
      //echo "<br>";
      $JsonBody = '{
       "licenseCode":"58adca24",
       "title":null,
       "description":null,
       "theme":null,
       "startOn":"13-05-2015 00:00",
       "endOn":"31-05-3015 23:59",
       "skipTargetPage":true,
       "maxTimesPerUser":99,
       "status":"INACTIVE",
       "emptyTokenCheck":false,
       "canMinimize":true,
       "canClose":true,
       "showTitle":false,
       "actionLink":null,
       "actionText":null,
       "goalEId":null,
       "notificationLayoutEId":null,
       "notificationActions":[

       ],
       "id":"~10cb5a15",
       "actionTarget":"TOP",
       "tokens":[

       ],
       "layoutId":"~184fc0b7",
       "layoutConfig":null,
       "themeId":null
    }';
        $body2 = json_decode($JsonBody, true);
      $body2['id'] = $NotificationId;
      $body2['licenseCode'] = $licenseCode;
      $body3 = json_encode($body2);
       
      // 2. set the options, including the url
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                 "Authorization: bearer 1ff12cdf-996d-49ad-98c1-33fbb711b143",
                "Content-Type: application/json; charset=UTF-8"
      ));
      curl_setopt($ch, CURLOPT_POSTFIELDS,$body3);
       
      // 3. execute and fetch the resulting HTML output
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $output = (curl_exec($ch));
      var_dump($output);
      if ($output === FALSE) { 
          ////Mage::log("cURL Error: " . curl_error($ch));
      } else {
         ////Mage::log($output);
      }
       
      // 4. free up the curl handle
      curl_close($ch);
      return $NotificationId;


	}
  public function NotificationSetDropTag($NotificationId){

      $licenseCode=$this->config->get('webengage_license_code');
      $ch = curl_init();
      $urlc='?http.protocol.handle-redirects=true';
      $urlp = "https://api.webengage.com/v1/accounts/";
      $urlp = $urlp.$licenseCode.'/notifications';
      $url = $urlp.'/'.$NotificationId.'/'.'tags'.$urlc;
      //echo $url;
      //echo "<br>";
      $JsonBody = '{"tags":["magento", "magento-drop"]}';
        $body2 = json_decode($JsonBody, true);
      $body3 = json_encode($body2);
       
      // 2. set the options, including the url
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                 "Authorization: bearer 1ff12cdf-996d-49ad-98c1-33fbb711b143",
                "Content-Type: application/json; charset=UTF-8"
      ));
      curl_setopt($ch, CURLOPT_POSTFIELDS,$body3);
       
      // 3. execute and fetch the resulting HTML output
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $output = (curl_exec($ch));
      var_dump($output);
      if ($output === FALSE) { 
          ////Mage::log("cURL Error: " . curl_error($ch));
      } else {
         ////Mage::log($output);
      }
       
      // 4. free up the curl handle
      curl_close($ch);
      return $NotificationId;


  }
  public function NotificationSetLeaveTag($NotificationId){

      $licenseCode=$this->config->get('webengage_license_code');
      $ch = curl_init();
      $urlc='?http.protocol.handle-redirects=true';
      $urlp = "https://api.webengage.com/v1/accounts/";
      $urlp = $urlp.$licenseCode.'/notifications';
      $url = $urlp.'/'.$NotificationId.'/'.'tags'.$urlc;
      //echo $url;
      //echo "<br>";
      $JsonBody = '{"tags":["magento", "magento-leave"]}';
        $body2 = json_decode($JsonBody, true);
      $body3 = json_encode($body2);
       
      // 2. set the options, including the url
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                 "Authorization: bearer 1ff12cdf-996d-49ad-98c1-33fbb711b143",
                "Content-Type: application/json; charset=UTF-8"
      ));
      curl_setopt($ch, CURLOPT_POSTFIELDS,$body3);
       
      // 3. execute and fetch the resulting HTML output
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $output = (curl_exec($ch));
      var_dump($output);
      if ($output === FALSE) { 
          ////Mage::log("cURL Error: " . curl_error($ch));
      } else {
         ////Mage::log($output);
      }
       
      // 4. free up the curl handle
      curl_close($ch);
      return $NotificationId;


  }
	public function NotificationActivate($NotificationId){
    $licenseCode=$this->config->get('webengage_license_code');
	  $ch = curl_init();
      $urlc='?http.protocol.handle-redirects=true';
      $urlp = "https://api.webengage.com/v1/accounts/";
      $urlp = $urlp.$licenseCode.'/notifications';
      $url = $urlp.'/'.$NotificationId.'/'.'saveActivation'.$urlc;
      //echo $url;
      //echo "<br>";
      $JsonBody = '{
       "licenseCode":"58adca24",
       "title":null,
       "description":null,
       "theme":null,
       "startOn":"13-05-2015 00:00",
       "endOn":"31-05-3015 23:59",
       "skipTargetPage":true,
       "maxTimesPerUser":99,
       "status":"ACTIVE",
       "emptyTokenCheck":false,
       "canMinimize":true,
       "canClose":true,
       "showTitle":false,
       "actionLink":null,
       "actionText":null,
       "goalEId":null,
       "notificationLayoutEId":null,
       "notificationActions":[

       ],
       "id":"~10cb5a15",
       "actionTarget":"TOP",
       "tokens":[

       ],
       "layoutId":"~184fc0b7",
       "layoutConfig":null,
       "themeId":null
    }';
        $body2 = json_decode($JsonBody, true);
      $body2['id'] = $NotificationId;
      $body2['licenseCode'] = $licenseCode;
      $body3 = json_encode($body2);
       
      // 2. set the options, including the url
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                 "Authorization: bearer 1ff12cdf-996d-49ad-98c1-33fbb711b143",
                "Content-Type: application/json; charset=UTF-8"
      ));
      curl_setopt($ch, CURLOPT_POSTFIELDS,$body3);
       
      // 3. execute and fetch the resulting HTML output
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $output = (curl_exec($ch));
      var_dump($output);
      if ($output === FALSE) { 
          ////Mage::log("cURL Error: " . curl_error($ch));
      } else {
         ////Mage::log($output);
      }
       
      // 4. free up the curl handle
      curl_close($ch);
      return $NotificationId;


	}
	public function NotificationCreate($title,$description,$link,$linkurl,$theme){
      $licenseCode=$this->config->get('webengage_license_code');
      $ch = curl_init();
      $urlc='?http.protocol.handle-redirects=true';
      $urlp = "https://api.webengage.com/v1/accounts/";
      $urlp = $urlp.$licenseCode.'/notifications';
      $url = $urlp.$urlc;
      //echo $url; 

      //echo $url;
      $varak = '{"licenseCode":"311c48b3","title":"unique55","description":"unique bhaai unique Add a small description for your notification; this can be rich<\/b> text ...","theme":"WebEngage Classic","startOn":"","endOn":"","emptyTokenCheck":false,"canMinimize":true,"canClose":true,"showTitle":false,"actionLink":"http:\/\/www.google.com","actionText":"Click Me","actionText":"Click Me","actionLink":"http:\/\/www.google.com","tokens": [{"tokenName":"couponCode", "defaultValue":"","status":"ACTIVE"},{"tokenName":"couponName", "defaultValue":"","status":"ACTIVE"},{"tokenName":"couponDesc", "defaultValue":"", "status":"ACTIVE"},{"tokenName":"pdurl", "defaultValue":"","status":"ACTIVE"}],"layoutId":"~184fc0b7","layoutConfig":{"alignment":"BOTTOM_RIGHT","width":500,"button_alignment":"RIGHT"},"themeId":"aea1de3", "actionTarget":"TOP","status":"ACTIVE"}';
      $databucket=json_decode($varak,true);
      $databucket['licenseCode']=$licenseCode;
      $databucket['title']=$title;
      $databucket['description']=$description;
      $databucket['theme']=$theme;
      $databucket['actionLink']=$linkurl;
      $databucket['actionText']=$link;
      $databucket2 = json_encode($databucket);
      //var_dump($databucket2);
      //echo "<br>";
      // 2. set the options, including the url
      curl_setopt($ch, CURLOPT_URL,$url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                 "Authorization: bearer 1ff12cdf-996d-49ad-98c1-33fbb711b143",
                "Content-Type: application/json; charset=UTF-8"
      ));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $databucket2);
       
      // 3. execute and fetch the resulting HTML output
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $output = (curl_exec($ch));
      if ($output === FALSE) { 
          //echo ("cURL Error: " . curl_error($ch));
        ////Mage::log(curl_error($ch));
      } else {
        //echo(("working<br>"));
        //var_dump($output);
        
      }
       
      // 4. free up the curl handle
      curl_close($ch);
      $duck=json_decode($output,true);
      $NotificationId=$duck ['response']['data']['id'] ;
      
      $ch = curl_init();
      $urlc='?http.protocol.handle-redirects=true';
      $urlp = "https://api.webengage.com/v1/accounts/";
      $urlp = $urlp.$licenseCode.'/notifications';
      $url = $urlp.'/'.$NotificationId.'/'.'saveActivation'.$urlc;
      //echo $url;
      //echo "<br>";
      $JsonBody = '{
       "licenseCode":"58adca24",
       "title":null,
       "description":null,
       "theme":null,
       "startOn":"13-05-2015 00:00",
       "endOn":"31-05-3015 23:59",
       "skipTargetPage":true,
       "maxTimesPerUser":99,
       "status":"ACTIVE",
       "emptyTokenCheck":false,
       "canMinimize":true,
       "canClose":true,
       "showTitle":false,
       "actionLink":null,
       "actionText":null,
       "goalEId":null,
       "notificationLayoutEId":null,
       "notificationActions":[

       ],
       "id":"~10cb5a15",
       "actionTarget":"TOP",
       "tokens":[

       ],
       "layoutId":"~184fc0b7",
       "layoutConfig":null,
       "themeId":null
    }';
        $body2 = json_decode($JsonBody, true);
      $body2['id'] = $NotificationId;
      $body2['licenseCode'] = $licenseCode;
      $body3 = json_encode($body2);
       
      // 2. set the options, including the url
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                 "Authorization: bearer 1ff12cdf-996d-49ad-98c1-33fbb711b143",
                "Content-Type: application/json; charset=UTF-8"
      ));
      curl_setopt($ch, CURLOPT_POSTFIELDS,$body3);
       
      // 3. execute and fetch the resulting HTML output
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $output = (curl_exec($ch));
      //ECHO "<br>";
      //var_dump($output);
      if ($output === FALSE) { 
          ////Mage::log("cURL Error: " . curl_error($ch));
      } else {
         ////Mage::log($output);
      }
       
      // 4. free up the curl handle
      curl_close($ch);
      return $NotificationId;

        
     }
     public function NotificationDelete($notificationId){
			$licenseCode=$this->config->get('webengage_license_code');
			$ch = curl_init();
			$urlc=$notificationId;
			$urlp = "https://api.webengage.com/v1/accounts/";
            $urlp = $urlp.$licenseCode.'/notifications/';
			//////Mage::log($notificationId);
			$url = $urlp.$notificationId;
			//////Mage::log($url);
			$JsonBody = '{
		   "licenseCode":"58adca24",
		   "title":null,
		   "description":null,
		   "theme":null,
		   "startOn":"13-05-2015 00:00",
		   "endOn":"31-05-3015 23:59",
		   "skipTargetPage":true,
		   "maxTimesPerUser":99,
		   "status":"ACTIVE",
		   "emptyTokenCheck":false,
		   "canMinimize":true,
		   "canClose":true,
		   "showTitle":false,
		   "actionLink":null,
		   "actionText":null,
		   "goalEId":null,
		   "notificationLayoutEId":null,
		   "notificationActions":[

		   ],
		   "id":"~10cb5a15",
		   "actionTarget":"TOP",
		   "tokens":[

		   ],
		   "layoutId":"~184fc0b7",
		   "layoutConfig":null,
		   "themeId":null
		}';
		    $body2 = json_decode($JsonBody, true);
			$body2['id'] = $notificationId;
			$body2['licenseCode'] = $licenseCode;
			$body3 = json_encode($body2);
			 
			// 2. set the options, including the url
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Authorization: bearer 1ff12cdf-996d-49ad-98c1-33fbb711b143",
                "Content-Type: application/json; charset=UTF-8"
			));
			curl_setopt($ch, CURLOPT_POSTFIELDS,$body3);
			 
			// 3. execute and fetch the resulting HTML output
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$output = (curl_exec($ch));
			if ($output === FALSE) { 
			    ////Mage::log("cURL Error: " . curl_error($ch));
				return 0;
			} else {
				 //////Mage::log($output);
				 return 1;
			}
			 
			// 4. free up the curl handle
			curl_close($ch);
			
			
		}
	//Notification Edit function
	public function getNotifications()
	    {  $licenseCode=$this->config->get('webengage_license_code');
	    	$urlp = "https://api.webengage.com/v1/accounts/";
            $urlp = $urlp.$licenseCode.'/notifications';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$urlp);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Authorization: bearer 1ff12cdf-996d-49ad-98c1-33fbb711b143",
		    	"Content-Type: application/json; charset=UTF-8"
			));
			//curl_setopt($ch, CURLOPT_POSTFIELDS, $databucket2);
			 
			// 3. execute and fetch the resulting HTML output
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$output = (curl_exec($ch));
			var_dump($output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			if ($output === FALSE) { 
				////Mage::log(curl_error($ch));
				return 0;
			} else {
				return 1;
			}
			 
			// 4. free up the curl handle
			curl_close($ch);


	        
	    }
    public function getNotificationById($notificationId)
      {  $licenseCode=$this->config->get('webengage_license_code');
        $urlp = "https://api.webengage.com/v1/accounts/";
            $urlp = $urlp.$licenseCode.'/notifications/'.$notificationId;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$urlp);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: bearer 1ff12cdf-996d-49ad-98c1-33fbb711b143",
          "Content-Type: application/json; charset=UTF-8"
      ));
      //curl_setopt($ch, CURLOPT_POSTFIELDS, $databucket2);
       
      // 3. execute and fetch the resulting HTML output
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $output = (curl_exec($ch));
      //var_dump($output);
      $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

      if ($output === FALSE) { 
        ////Mage::log(curl_error($ch));
        return 0;
      } else {
        return $decodedOutput = json_decode($output,true);
      }
       
      // 4. free up the curl handle
      curl_close($ch);


          
      }
	 public function getNotificationsByTag($tag)
	    {   $tag = $tag;
	    	$licenseCode=$this->config->get('webengage_license_code');
	    	$urlp = "https://api.webengage.com/v1/accounts/";
            $urlp = $urlp.$licenseCode.'/notifications?tag='.$tag;
            //echo $url;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$urlp);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Authorization: bearer 1ff12cdf-996d-49ad-98c1-33fbb711b143",
		    	"Content-Type: application/json; charset=UTF-8"
			));
			//curl_setopt($ch, CURLOPT_POSTFIELDS, $databucket2);
			 
			// 3. execute and fetch the resulting HTML output
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$output = (curl_exec($ch));
			//var_dump($output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			if ($output === FALSE) { 
				////Mage::log(curl_error($ch));
				return 0;
			} else {
				$decodedOutput = json_decode($output,true);
			    return ($decodedOutput['response']['data']);
			}
			 
			// 4. free up the curl handle
			curl_close($ch);


	        
	    }
	  public function getNotificationsByTagByStatus()
	    {   $tag = 'magento';
	        $status = 'ACTIVE';
	    	$licenseCode=$this->config->get('webengage_license_code');
	    	$urlp = "https://api.webengage.com/v1/accounts/";
            $urlp = $urlp.$licenseCode.'/notifications?tag='.$tag.'&status='.$status;
            //echo $url;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$urlp);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Authorization: bearer 1ff12cdf-996d-49ad-98c1-33fbb711b143",
		    	"Content-Type: application/json; charset=UTF-8"
			));
			//curl_setopt($ch, CURLOPT_POSTFIELDS, $databucket2);
			 
			// 3. execute and fetch the resulting HTML output
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$output = (curl_exec($ch));
			$decodedOutput = json_decode($output,true);
			print_r($decodedOutput['response']['data']);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			if ($output === FALSE) { 
				////Mage::log(curl_error($ch));
				return 0;
			} else {
				return 1;
			}
			 
			// 4. free up the curl handle
			curl_close($ch);


	        
	    }
     public function NotificationEdit($title,$description,$link,$linkurl,$theme,$notificationId){
			//$licenseCode = '826170b8';


      $ch = curl_init();
			$urlc=$notificationId;
      $licenseCode=$this->config->get('webengage_license_code');
			$urlp = "https://api.webengage.com/v1/accounts/";
            $urlp = $urlp.$licenseCode.'/notifications/';
			$url = $urlp.$urlc.'/save';
			//echo $url;
      $varak = '{"licenseCode":"311c48b3","title":"unique55","description":"unique bhaai unique Add a small description for your notification; this can be rich<\/b> text ...","theme":"WebEngage Classic","startOn":"","endOn":"","emptyTokenCheck":false,"canMinimize":true,"canClose":true,"showTitle":false,"actionLink":"http:\/\/www.google.com","actionText":"Click Me","actionText":"Click Me","actionLink":"http:\/\/www.google.com","tokens": [{"tokenName":"couponCode", "defaultValue":"","status":"ACTIVE"},{"tokenName":"couponName", "defaultValue":"","status":"ACTIVE"},{"tokenName":"couponDesc", "defaultValue":"", "status":"ACTIVE"},{"tokenName":"pdurl", "defaultValue":"","status":"ACTIVE"}],"layoutId":"~184fc0b7","layoutConfig":{"alignment":"BOTTOM_RIGHT","width":500,"button_alignment":"RIGHT"},"themeId":"aea1de3", "actionTarget":"TOP","status":"ACTIVE"}';
			$databucket=json_decode($varak,true);
			$databucket['licenseCode']=$licenseCode;
			$databucket['title']=$title;
			$databucket['description']=$description;
			$databucket['theme']=$theme;
			$databucket['actionLink']=$linkurl;
			$databucket['actionText']=$link;
			$databucket2 = json_encode($databucket);
			// 2. set the options, including the url
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Authorization: bearer 1ff12cdf-996d-49ad-98c1-33fbb711b143",
		    	"Content-Type: application/json; charset=UTF-8"
			));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $databucket2);
			 
			// 3. execute and fetch the resulting HTML output
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$output = (curl_exec($ch));
			var_dump($output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			if ($output === FALSE) { 
				////Mage::log(curl_error($ch));
				return 0;
			} else {
				return 1;
			}
			 
			// 4. free up the curl handle
			curl_close($ch);
		
	}
	public function allCoupons(){
      $coup2 =array();
      //$this->load->model('checkout/coupon');
          //echo 'Hello World';
          $coupon_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "coupon` ");
          //var_dump($coupon_query);
          foreach($coupon_query->rows as $coup){
            //var_dump($coup['code']);
            array_push($coup2,$coup['code']);
            //var_dump($im);
            //echo "<br>";
          }
          return $coup2;
          
    }
	

	
}
?>