<?php
class ControllerModuleWebecoup extends Controller {
    public function index() {
        echo 'hello';
    }
    public function indexabc()
     {
          $this->load->model('checkout/coupon');
          echo 'Hello World';
          $coupon_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "coupon` ");
         $im = $this->model_checkout_coupon->getCoupon('rakesh');
         //print_r($im);
         $this->session->data['coupon'] ='rakesh';

            $this->session->data['success'] ='Applied';

         //$this->load->controller('checkout/cart')->coupon('rakesh');
         $this->load->model('catalog/product');
         $pd = $this->model_catalog_product->getTotalProducts();
         //var_dump($pd);
         //echo "<br>";
         echo "<script type=\"text/javascript\">var p = {};</script>";
         $cart = $this->cart->getProducts();
         foreach ($cart as $item) {
            //print($item['key']);
            $key = $item['key'];
            $pp ="SELECT * FROM  "  . "webengage_track  WHERE `key`='".$key."'";
            $pp = $this->db->query($pp);
            ob_start(); 
            $u_id = (int) $pp->row['u_id'];
            $product_id = (int) $pp->row['product_id'];
            $qty = (int) $pp->row['qty'];
            $option = $pp->row['option'];
                              // start buffer capture
    

            echo "<script type=\"text/javascript\"> p['".$key."'] = {}</script>";
            echo "<script type=\"text/javascript\"> p['".$key."']['u_id'] =  '".$u_id."'</script>";
            echo "<script type=\"text/javascript\"> p['".$key."']['product_id'] =  '".$product_id."'</script>";
            echo "<script type=\"text/javascript\"> p['".$key."']['qty'] =  '".$qty."'</script>";
            echo "<script type=\"text/javascript\"> p['".$key."']['option'] =  '".($option)."'</script>";


             # code...
         }
         //print_r($cart);
         //echo "hola";
         //$this->session->data['cart'] = "YToyOntzOjEwOiJwcm9kdWN0X2lkIjtpOjQyO3M6Njoib3B0aW9uIjthOjk6e2k6MjE4O3M6MToiNSI7aToyMjM7YToxOntpOjA7czoxOiI4Ijt9aToyMDg7czo3OiJmdWNreW91IjtpOjIxNztzOjE6IjQiO2k6MjA5O3M6MzM6ImFzZGhhc2prZGFza2pkbmhhc2tqZGJuc2Fqa2Ruc2FkbSI7aToyMjI7czo0MDoiZjM4NmNiZjNmNmU3OTY0YTI2MDMzMjRjMjE4ZGJjMjA4Yjc5ZjZjYyI7aToyMTk7czoxMDoiMjAxMS0wMi0xMCI7aToyMjE7czo1OiIyMjoyNSI7aToyMjA7czoxNjoiMjAxMS0wMi0yMCAyMjoyNSI7fX0=";
         //$var = $this->session->data['cart'];
         //$_SESSION['FUCK']=$var;
         //var_dump( $_SESSION['FUCK']);
         //$this->session->data['cart'];
         //var_dump($this->session->data['cart']);
         $duck=json_encode($cart);
     	  //echo "<pre>"; var_dump($cart); echo "</pre>";
     $cart_info = $this->cart->getProducts();

     	//print_r($this->session->data['cart']);
          foreach ($cart_info as $cart_item) {
                    // Get the info for this product ID                 
                    // Uses function from the catalog/product model
                    $product_info = $this->model_catalog_product->getProduct($cart_item['product_id']);
                    
                    // Decide whether to use 'Model' or 'SKU' from product info
                    if (1==1) {
                        $product_info_sku = $product_info['sku'];
                    } else {
                        $product_info_sku = $product_info['model'];
                    }
                    
                    // Add this cart item to the piwik ecommerce cart
                    //$productoptions = $product_info['option'];
                   // var_dump($product_info);
                    $options = ($cart_item['option']);
                            //print "starts>>>><br>";
                                        //var_dump($productoptions);
                    
                    //$cart_total += ($cart_item['price'] * $cart_item['quantity']);
                }


     }
     public function indexcoup(){

        //echo "<script type=\"text/javascript\">window.p = {};alert('hola');</script>";
         //$cart = $this->cart->getProducts();
        $this->load->model('checkout/coupon');
          //echo 'Hello World';
          $coupon_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "coupon` ");
          //var_dump($coupon_query);
          foreach($coupon_query->rows as $coup){
            //var_dump($coup);
            $im = $this->model_checkout_coupon->getCoupon($coup['code']);
            $ans = array();
            if($im && !isset($this->session->data['coupon'])){
               $cop=$coup['code'];
               $ans['name'] = $coup['name'];
               $ans['code'] = $coup['code'];
               break;
               var_dump($ans);
               

            }
            //var_dump($im);
            //echo "<br>";
          }
          if (isset($cop)){
          	//var_dump($ans);
             echo json_encode($ans);
          }
          else{
            echo json_encode("{\"name\":\"\", \"code\":\"\"}");
          }
          
         


             # code...
        
     }
      public function applycoup(){
        $this->load->language('checkout/coupon');

    $json = array();

    $this->load->model('checkout/coupon');

    if (isset($this->request->get['coupon'])) {
      $coupon = $this->request->get['coupon'];
    } else {
      $coupon = '';
    }

    $coupon_info = $this->model_checkout_coupon->getCoupon($coupon);

    if (empty($this->request->get['coupon'])) {
      $json['error'] = $this->language->get('error_empty');
      
      unset($this->session->data['coupon']);
    } elseif ($coupon_info) {
      $this->session->data['coupon'] = $this->request->get['coupon'];

      $this->session->data['success'] ='Coupon applied';

      $json['redirect'] = $this->url->link('checkout/cart');
    } else {
      $json['error'] = $this->language->get('error_coupon');
    }
    $redirect_url=$this->url->link('checkout/cart');
    $this->response->redirect($redirect_url);
        

        
        
        
     }
     public function indexrajax(){

        //echo "<script type=\"text/javascript\">window.p = {};alert('hola');</script>";
         //$cart = $this->cart->getProducts();
        $key = $this->request->get['key'];
        //echo $key;
            //print($item['key']);
            $pp ="SELECT * FROM  "  . "webengage_track  WHERE `key`='".$key."'";
            $pp = $this->db->query($pp);
            //ob_start(); 
            //$u_id = (int) $pp->row['u_id'];
            //$product_id = (int) $pp->row['product_id'];
            //$qty = (int) $pp->row['qty'];
            //$option = $pp->row['option'];
                              // start buffer ca

            //echo "<script type=\"text/javascript\"> p['".$key."'] = {}</script>";
            //echo "<script type=\"text/javascript\"> p['".$key."']['u_id'] =  '".$u_id."'</script>";
            //echo "<script type=\"text/javascript\"> p['".$key."']['product_id'] =  '".$product_id."'</script>";
            //echo "<script type=\"text/javascript\"> p['".$key."']['qty'] =  '".$qty."'</script>";
            //echo "<script type=\"text/javascript\"> p['".$key."']['option'] =  '".($option)."'</script>";
            echo json_encode($pp->row,true);


             # code...
        
     }
     public function qtyfinderrak(){
        $products = $this->cart->getProducts();
        //var_dump($products);
        $arrr = array();
        foreach($products as $product){
            //var_dump($product);
            //echo "<br>";
            $arrr[$product['key']] = $product['quantity'];

        }
        echo (json_encode($arrr));
     }
     public function indexrak()
     {
        echo 'yo its working';
        $this->load->language('checkout/cart');

        $json = array();

        if (isset($this->request->get['product_id'])) {
            $product_id = (int)$this->request->get['product_id'];
        } else {
            $product_id = 0;
        }

        $this->load->model('catalog/product');

        $product_info = $this->model_catalog_product->getProduct($product_id);

        if ($product_info) {
            if (isset($this->request->get['qty']) && ((int)$this->request->get['qty'] >= $product_info['minimum'])) {
                $quantity = (int)$this->request->get['qty'];
            } else {
                $quantity = $product_info['minimum'] ? $product_info['minimum'] : 1;
            }

            if (isset($this->request->get['option'])) {
                $option = $this->request->get['option'];
                

            } else {
                $option = array();
            }

            $product_options = $this->model_catalog_product->getProductOptions($this->request->get['product_id']);

            foreach ($product_options as $product_option) {
                if ($product_option['required'] && empty($option[$product_option['product_option_id']])) {
                    $json['error']['option'][$product_option['product_option_id']] = sprintf($this->language->get('error_required'), $product_option['name']);
                }
            }

            if (isset($this->request->get['recurring_id'])) {
                $recurring_id = $this->request->get['recurring_id'];
            } else {
                $recurring_id = 0;
            }

            $recurrings = $this->model_catalog_product->getProfiles($product_info['product_id']);

            if ($recurrings) {
                $recurring_ids = array();

                foreach ($recurrings as $recurring) {
                    $recurring_ids[] = $recurring['recurring_id'];
                }

                if (!in_array($recurring_id, $recurring_ids)) {
                    $json['error']['recurring'] = $this->language->get('error_recurring_required');
                }
            }

            if (!$json) {
                $this->cart->add($this->request->get['product_id'], $quantity, $option, $recurring_id);

                $json['success'] = sprintf($this->language->get('text_success'), $this->url->link('product/product', 'product_id=' . $this->request->get['product_id']), $product_info['name'], $this->url->link('checkout/cart'));

                unset($this->session->data['shipping_method']);
                unset($this->session->data['shipping_methods']);
                unset($this->session->data['payment_method']);
                unset($this->session->data['payment_methods']);

                // Totals
                $this->load->model('extension/extension');

                $total_data = array();
                $total = 0;
                $taxes = $this->cart->getTaxes();

                // Display prices
                if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                    $sort_order = array();

                    $results = $this->model_extension_extension->getExtensions('total');

                    foreach ($results as $key => $value) {
                        $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
                    }

                    array_multisort($sort_order, SORT_ASC, $results);

                    foreach ($results as $result) {
                        if ($this->config->get($result['code'] . '_status')) {
                            $this->load->model('total/' . $result['code']);

                            $this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
                        }
                    }

                    $sort_order = array();

                    foreach ($total_data as $key => $value) {
                        $sort_order[$key] = $value['sort_order'];
                    }

                    array_multisort($sort_order, SORT_ASC, $total_data);
                }
                if (isset($this->request->get['ttcop'])) {
                    $this->session->data['coupon'] =$this->request->get['ttcop'];
            
        }
                $json['total'] = sprintf($this->language->get('text_items'), $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0), $this->currency->format($total));
            } else {
                $json['redirect'] = str_replace('&amp;', '&', $this->url->link('product/product', 'product_id=' . $this->request->get['product_id']));
            }
        }

        $redirect_url=$this->url->link('checkout/cart');
    $this->response->redirect($redirect_url);

     }
}