<?php
class ControllerModuleWebecoup extends Controller {
private $error = array(); // This is used to set the errors, if any.

 
public function check(){
}
public function install() {

		
$this->db->query("CREATE TABLE IF NOT EXISTS `webengage_track` (
		  `u_id` int(11) NOT NULL AUTO_INCREMENT,
		  `product_id` int(11) ,
		  `key` text,
		  `qty` text,
		  `option` text,
		  `recurring_id` int(11),
		  `url` text,
		  PRIMARY KEY (`u_id`)
		)");


	}

    
    public function index() {
        // Loading the language file of webecoup
        $this->load->language('module/webecoup'); 
     
        // Set the title of the page to the heading title in the Language file i.e., Hello World
        $this->document->setTitle($this->language->get('heading_title'));
     
        // Load the Setting Model  (All of the OpenCart Module & General Settings are saved using this Model )
        $this->load->model('setting/setting');
     
        // Start If: Validates and check if data is coming by save (POST) method
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            // Parse all the coming data to Setting Model to save it in database.
            $this->model_setting_setting->editSetting('webecoup', $this->request->post);
     
            // To display the success text on data save
            $this->session->data['success'] = $this->language->get('text_success');
     
            // Redirect to the Module Listing
            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }
     
        // Assign the language data for parsing it to view
        $this->load->model('module/webecoup');
        $NotificationsByTag = $this->model_module_webecoup->getNotificationsByTag('magento');
        $CamStatus = ($NotificationsByTag ['totalCount']);

        $data['NotificationsByTag'] = $NotificationsByTag;
        $NotificationDrop = $this->model_module_webecoup->getNotificationsByTag('magento-drop');
        $data['NotificationDrop'] = $NotificationDrop ;
        $NotificationLeave = $this->model_module_webecoup->getNotificationsByTag('magento-leave');
        $data['NotificationLeave'] = $NotificationLeave ;
        $allCoupons = $this->model_module_webecoup->allCoupons();
        $data['allCoupons'] = $allCoupons;
        if($CamStatus<2){

        }
        else {
            $IdItemDrop=$NotificationDrop['contents'][0]['id'];
            $IdItemLeave=$NotificationLeave['contents'][0]['id'];
            $DropDescription = $this->model_module_webecoup->getNotificationById($IdItemDrop);
            $LeaveDescription = $this->model_module_webecoup->getNotificationById($IdItemLeave);
            $data['DropDescription']= $DropDescription;
            $data['LeaveDescription']= $LeaveDescription;


        }

        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_edit']    = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_content_top'] = $this->language->get('text_content_top');
        $data['text_content_bottom'] = $this->language->get('text_content_bottom');      
        $data['text_column_left'] = $this->language->get('text_column_left');
        $data['text_column_right'] = $this->language->get('text_column_right');
     
        $data['entry_code'] = $this->language->get('entry_code');
        $data['entry_layout'] = $this->language->get('entry_layout');
        $data['entry_position'] = $this->language->get('entry_position');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
     
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_add_module'] = $this->language->get('button_add_module');
        $data['button_remove'] = $this->language->get('button_remove');
         
        // This Block returns the warning if any
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
     
        // This Block returns the error code if any
        if (isset($this->error['code'])) {
            $data['error_code'] = $this->error['code'];
        } else {
            $data['error_code'] = '';
        }     
     
        // Making of Breadcrumbs to be displayed on site
        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );
        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_module'),
            'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );
        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('module/webecoup', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );
          
        $data['action'] = $this->url->link('module/webecoup', 'token=' . $this->session->data['token'], 'SSL'); // URL to be directed when the save button is pressed
     
        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'); // URL to be redirected when cancel button is pressed
              
        // This block checks, if the hello world text field is set it parses it to view otherwise get the default 
        // hello world text field from the database and parse it
        if (isset($this->request->post['webecoup_text_field'])) {
            $data['webecoup_text_field'] = $this->request->post['webecoup_text_field'];
        } else {
            $data['webecoup_text_field'] = $this->config->get('webecoup_text_field');
        }   
          
        // This block parses the status (enabled / disabled)
        if (isset($this->request->post['webecoup_status'])) {
            $data['webecoup_status'] = $this->request->post['webecoup_status'];
        } else {
            $data['webecoup_status'] = $this->config->get('webecoup_status');
        }
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $redirect_url=$this->url->link('module/webecoup/mainFormSubmit', 'token=' . $this->session->data['token'], 'SSL'); 
        $data['urlnew'] = $redirect_url;
        $edit_url=$this->url->link('module/webecoup/editFormSubmit', 'token=' . $this->session->data['token'], 'SSL'); 
        $data['urledit'] = $edit_url;
        $deactivate=$this->url->link('module/webecoup/deactivate', 'token=' . $this->session->data['token'], 'SSL'); 
        $data['deactivateurl'] = $deactivate;
        $activate=$this->url->link('module/webecoup/activate', 'token=' . $this->session->data['token'], 'SSL'); 
        $data['activateurl'] = $activate;
        $reset=$this->url->link('module/webecoup/reset', 'token=' . $this->session->data['token'], 'SSL'); 
        $data['reseturl'] = $reset;
        $statsurl=$this->url->link('module/webecoup/stats', 'token=' . $this->session->data['token'], 'SSL'); 
        $data['statsurl'] = $statsurl;
        $settingurl=$this->url->link('module/webecoup/indexSetting', 'token=' . $this->session->data['token'], 'SSL'); 
        $data['settingurl'] = $settingurl;
        $mainurl=$this->url->link('module/webecoup/index', 'token=' . $this->session->data['token'], 'SSL'); 
        $data['mainurl'] = $mainurl;
        $weLicenseCode = $this->config->get('webengage_license_code');
          $weStatus = $this->config->get('webengage_status');

          if(isset($weStatus) && strlen($weStatus) > 0 && $weStatus == 'ACTIVE')
          {
            $data["webengage_license_code"] = $weLicenseCode;  
          } else {
            $data["webengage_license_code"] = '';
          }
      


        
        //$this->response->redirect($redirect_url);

        $this->response->setOutput($this->load->view('module/webengage/webecoup.tpl', $data));

    }

    /* Function that validates the data when Save Button is pressed */
    protected function validate() {
 
       
    }
public function NotificationCreate(){
    //$this->NotificationCreate($title,$description,$link,$linkurl,$theme);
    $this->load->model('module/webecoup');
    $this->model_module_webecoup->NotificationCreate();

    

}
public function NotificationEdit(){
    $this->load->model('module/webecoup');
    $this->model_module_webecoup->NotificationEdit();
}
public function NotificationDelete(){
    $this->load->model('module/webecoup');
    $this->model_module_webecoup->NotificationDelete();
}
public function getNotifications(){

        $this->load->model('module/webecoup');
        $this->model_module_webecoup->getNotifications();


}
public function getNotificationsByTag()
        {

        $this->load->model('module/webecoup');
        $this->model_module_webecoup->getNotificationsByTag();


}
public function getNotificationsByTagByStatus()
        {

        $this->load->model('module/webecoup');
        $this->model_module_webecoup->getNotificationsByTagByStatus();


}
public function deactivate(){
    $IdLeaveIntent = $this->request->get['IdLeaveIntent'];
    $IdItemDrop = $this->request->get['IdItemDrop'];
    $this->load->model('module/webecoup');
    $this->model_module_webecoup->NotificationDeActivate($IdLeaveIntent);
    $this->model_module_webecoup->NotificationDeActivate($IdItemDrop);
    $redirect_url=$this->url->link('module/webecoup/index', 'token=' . $this->session->data['token'], 'SSL');
    $this->response->redirect($redirect_url);


}
public function activate(){
    $IdLeaveIntent = $this->request->get['IdLeaveIntent'];
    $IdItemDrop = $this->request->get['IdItemDrop'];
    $this->load->model('module/webecoup');
    $this->model_module_webecoup->NotificationActivate($IdLeaveIntent);
    $this->model_module_webecoup->NotificationActivate($IdItemDrop);
    $redirect_url=$this->url->link('module/webecoup/index','token=' . $this->session->data['token'], 'SSL');
    $this->response->redirect($redirect_url);


}
public function stats(){
 $data['echo'] = 'yoo';
 $this->load->model('module/webecoup');
 $NotificationDrop = $this->model_module_webecoup->getNotificationsByTag('magento-drop');
    $data['NotificationDrop'] = $NotificationDrop ;
    $NotificationLeave = $this->model_module_webecoup->getNotificationsByTag('magento-leave');
    $data['NotificationLeave'] = $NotificationLeave ;
    $data['header'] = $this->load->controller('common/header');
    $data['column_left'] = $this->load->controller('common/column_left');
    $data['footer'] = $this->load->controller('common/footer');
    $statsurl=$this->url->link('module/webecoup/stats', 'token=' . $this->session->data['token'], 'SSL'); 
    $data['statsurl'] = $statsurl;
    $settingurl=$this->url->link('module/webecoup/indexSetting', 'token=' . $this->session->data['token'], 'SSL'); 
    $data['settingurl'] = $settingurl;
    $mainurl=$this->url->link('module/webecoup/index', 'token=' . $this->session->data['token'], 'SSL'); 
    $data['mainurl'] = $mainurl;
    $weLicenseCode = $this->config->get('webengage_license_code');
          $weStatus = $this->config->get('webengage_status');

          if(isset($weStatus) && strlen($weStatus) > 0 && $weStatus == 'ACTIVE')
          {
            $data["webengage_license_code"] = $weLicenseCode;  
          } else {
            $data["webengage_license_code"] = '';
          }
      
 $this->response->setOutput($this->load->view('module/webengage/stats.tpl', $data));


}
public function reset(){
    $IdLeaveIntent = $this->request->get['IdLeaveIntent'];
    $IdItemDrop = $this->request->get['IdItemDrop'];
    $this->load->model('module/webecoup');
    $this->model_module_webecoup->NotificationDelete($IdLeaveIntent);
    $this->model_module_webecoup->NotificationDelete($IdItemDrop);
    $redirect_url=$this->url->link('module/webecoup/index','token=' . $this->session->data['token'], 'SSL');
    $this->response->redirect($redirect_url);


}
public function mainFormSubmit()
        {
        //$this->load->model('module/webecoup');
        //$this->model_module_webecoup->getNotificationsByTagByStatus();
        $redirect_url=$this->url->link('module/webecoup', 'token=' . $this->session->data['token'], 'SSL'); 
        $data['urlnew'] = $redirect_url;
        $ting = $this->request->post;
        //var_dump($ting);
        $coupons = $this->request->post['coupons'];
        $theme = $this->request->post['theme'];
        $msgLeaveIntent = $this->request->post['msgLeaveIntent'];
        $msgCartDrop =  $this->request->post['msgCartDrop'];
        //echo 'yo';
        //echo $theme.'`'.$msgLeaveIntent.'`'.$msgCartDrop;
        $implodedCoupons = (implode('|',$coupons));
        $this->load->model('module/webecoup');
        $leaveId = $this->model_module_webecoup->NotificationCreate($implodedCoupons,$msgLeaveIntent,'Apply','[[pdurl]]',$theme);
        $dropId = $this->model_module_webecoup->NotificationCreate($implodedCoupons,$msgCartDrop,'Apply','[[pdurl]]',$theme);
        $this->model_module_webecoup->NotificationSetLeaveTag($leaveId);
        $this->model_module_webecoup->NotificationSetDropTag($dropId);
         $redirect_url=$this->url->link('module/webecoup/index','token=' . $this->session->data['token'], 'SSL');
         $this->response->redirect($redirect_url);


        //$this->response->redirect($redirect_url);


}
public function editFormSubmit()
        {
        //$this->load->model('module/webecoup');
        //$this->model_module_webecoup->getNotificationsByTagByStatus();
        $redirect_url=$this->url->link('module/webecoup', 'token=' . $this->session->data['token'], 'SSL'); 
        $data['urlnew'] = $redirect_url;
        $ting = $this->request->post;
        var_dump($ting);
        $coupons = $this->request->post['coupons'];
        $theme = $this->request->post['theme'];
        $msgLeaveIntent = $this->request->post['msgLeaveIntent'];
        $msgCartDrop =  $this->request->post['msgCartDrop'];
        $IdLeaveIntent = $this->request->post['IdLeaveIntent'];
        $IdItemDrop = $this->request->post['IdItemDrop'];


        //echo 'yo';
        //echo $theme.'`'.$msgLeaveIntent.'`'.$msgCartDrop;
        $implodedCoupons = (implode('|',$coupons));
        $this->load->model('module/webecoup');
        $this->model_module_webecoup->NotificationEdit( $implodedCoupons,$msgLeaveIntent,'Apply','[[pdurl]]',$theme,$IdLeaveIntent);
        $this->model_module_webecoup->NotificationEdit( $implodedCoupons,$msgCartDrop,'Apply','[[pdurl]]',$theme,$IdItemDrop);
        $redirect_url=$this->url->link('module/webecoup/index', 'token=' . $this->session->data['token'], 'SSL');
        $this->response->redirect($redirect_url);


        //$this->response->redirect($redirect_url);


}
// settings section starts from here
public function indexSetting()
    {
        $this->language->load('module/webecoup');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');

        $webengage_settings = $this->model_setting_setting->getSetting('webengage');
        if(!isset($webengage_settings['webengage_module']) || count($webengage_settings['webengage_module']) <= 0) {
            for ($i=1;$i<=11;$i++) {
                $settings['webengage_module'][] = Array (
                    'layout_id' => $i,
                    'position' => 'content_bottom',
                    'webengage_status' => 1,
                    'sort_order' => ''
                );
            }
            $this->model_setting_setting->editSetting('webengage', $settings);
        }
        if (!isset($_GET['page']) || strlen(trim($_GET['page'])) <= 0) {
            $this->handleMainPage();
        }
        else {
            switch (trim($_GET['page']))
            {
                case 'main':
                    $this->handleMainPage();
                    break;

                case 'callback':
                    $this->handleCallbackPage();
                    break;
            }
        }
    }

    private function getUrl($queryParams) 
    {
        $url = $this->url->link('module/webecoup/indexSetting', 'token=' . $this->session->data['token'] . '&' . $queryParams, 'SSL');
        return str_replace('&amp;', '&', $url);
    }

    private function handleMainPage()
    {
        $this->webengageProcessWebengageOptions();

        $webengage_settings = $this->model_setting_setting->getSetting('webengage');

        $webengage_host_name = 'webengage.com';
        $m_webengage_license_code = isset($webengage_settings['webengage_license_code']) ? $webengage_settings['webengage_license_code'] : '';

        $m_webengage_status = isset($webengage_settings['webengage_status']) ? $webengage_settings['webengage_status'] : '';

        $main_url = $this->getUrl('page=main');
        $next_url = $this->getUrl('page=callback&noheader=true');
        $activation_url = $this->getUrl('weAction=activate');

        $data['m_license_code_old'] = $m_webengage_license_code;
        $data['m_widget_webengage_status'] = $m_webengage_status;
        $weLicenseCode = $this->config->get('webengage_license_code');
          $weStatus = $this->config->get('webengage_status');

          if(isset($weStatus) && strlen($weStatus) > 0 && $weStatus == 'ACTIVE')
          {
            $data["webengage_license_code"] = $weLicenseCode;  
          } else {
            $data["webengage_license_code"] = '';
          }

        $data['message'] = urldecode(isset($_GET['message']) ? htmlspecialchars($_GET['message'], ENT_COMPAT, 'UTF-8') : '');
        $data['error_message'] = urldecode(isset($_GET['error-message']) ? htmlspecialchars($_GET['error-message'], ENT_COMPAT, 'UTF-8') : '');

        $data['email'] = '';
        $data['user_full_name'] = '';

        $data['main_url'] = $main_url;
        $data['next_url'] = $next_url;
        $data['activation_url'] = $activation_url;
        $statsurl=$this->url->link('module/webecoup/stats', 'token=' . $this->session->data['token'], 'SSL'); 
        $data['statsurl'] = $statsurl;
        $settingurl=$this->url->link('module/webecoup/indexSetting', 'token=' . $this->session->data['token'], 'SSL'); 
        $data['settingurl'] = $settingurl;
        $mainurl=$this->url->link('module/webecoup/index', 'token=' . $this->session->data['token'], 'SSL'); 
        $data['mainurl'] = $mainurl;

        $data['domain_name'] = '';
        if (isset($_SERVER['HTTP_HOST']))
            $data['domain_name'] = $_SERVER['HTTP_HOST'];
        else
            $data['domain_name'] = $_SERVER['SERVER_NAME'];

        $data['webengage_host_name'] = $webengage_host_name;
        $data['webengage_host'] = 'http://'.$webengage_host_name;
        $data['secure_webengage_host'] = 'https://'.$webengage_host_name;
        $data['resend_email_url'] = '//'.$webengage_host_name.
            '/thirdparty/signup.html?action=resendVerificationEmail&licenseCode='
            .urlencode($m_webengage_license_code).'&next='.urlencode($next_url).
            '&activation_url='.urlencode($activation_url).'&channel=opencart';

        $data['module_route'] = 'module/webecoup/indexSetting';
        $data['we_page'] = 'main';
        $data['session_token'] = $this->session->data['token'];

        $this->renderPage($this->language->get('heading_title_main'), 'module/webengage/webengage_main.tpl',$data);
    }

    private function handleCallbackPage()
    {
        error_log('your request is coming to handle pageSSS');
        //error_log($_REQUEST[]);
        $data['main_url'] = $this->getUrl('page=main');
        $data['wlc'] = urldecode(isset($_REQUEST['webengage_license_code']) ? htmlspecialchars($_REQUEST['webengage_license_code'], ENT_COMPAT, 'UTF-8') : '');
        $data['vm'] = urldecode(isset($_REQUEST['verification_message']) ? htmlspecialchars($_REQUEST['verification_message'], ENT_COMPAT, 'UTF-8') : '');
        $data['wwa'] = urldecode(isset($_REQUEST['webengage_widget_status']) ? htmlspecialchars($_REQUEST['webengage_widget_status'], ENT_COMPAT, 'UTF-8') : '');
        $data['option'] = urldecode(isset($_REQUEST['option']) ? $_REQUEST['option'] : null); 
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        }
        else {
            $data['error_warning'] = '';
        }


        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home') ,
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL') ,
            'separator' => false
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module') ,
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL') ,
            'separator' => ' :: '
        );
        $data['breadcrumbs'][] = array(
            'text' => 'Yo bitch' ,
            'href' => $this->url->link('module/webengage', 'token=' . $this->session->data['token'], 'SSL') ,
            'separator' => ' :: '
        );
        $data['modules'] = array();
        $this->load->model('design/layout');
        $data['layouts'] = $this->model_design_layout->getLayouts();
        $this->load->model('localisation/language');
        $data['languages'] = $this->model_localisation_language->getLanguages();
        //$this->template = 'module/'.$templateFile;
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');


        //$this->response->setOutput($this->load->view('module/webengage_callback.tpl', $data));
        //$this->response->setOutput($this->render());  

        $this->renderPage('','module/webengage/webengage_callback.tpl',$data);
    }

    private function webengageProcessWebengageOptions()
    {
        $redirect_url = "";

        if (isset($_REQUEST['weAction']))
        {
            if ($_REQUEST['weAction'] == 'wp-save')
            {
                $message = $this->webengageUpdateWebengageOptions();
                $redirect_url = $this->getUrl('page=main&'.$message[0].'='.urlencode($message[1]));
            }
            elseif ($_REQUEST['weAction'] == 'reset')
            {
                $message = $this->webengageResetWebengageOptions();
                $redirect_url = $this->getUrl('page=main&'.$message[0].'='.urlencode($message[1]));
            }
            elseif ($_REQUEST['weAction'] == 'activate')
            {
                $message = $this->webengageActivateWeWidget();
                $redirect_url = $this->getUrl('page=main&'.$message[0].'='.urlencode($message[1]));
            }
            elseif ($_REQUEST['weAction'] == 'discardMessage')
            {
                $this->webengageDiscardStatusMessage();
                $redirect_url = $this->getUrl('page=main');
            }

            if (strlen($redirect_url) > 0) {
                $this->response->redirect($redirect_url);
            }
        }
    }

    /**
    * Discard message processor.
    */
    private function webengageDiscardStatusMessage()
    {
        $webengage_settings = $this->model_setting_setting->getSetting('webengage');

        $data['webengage_license_code'] = isset($webengage_settings['webengage_license_code']) ? $webengage_settings['webengage_license_code'] : '';
        $data['webengage_status'] = '';
        $data['webengage_module'] = $webengage_settings['webengage_module'];
        $this->model_setting_setting->editSetting('webengage', $data);
    }

    /**
    * Resetting processor.
    */
    private function webengageResetWebengageOptions()
    {
        $webengage_settings = $this->model_setting_setting->getSetting('webengage');

        $data['webengage_license_code'] = '';
        $data['webengage_status'] = '';
        $data['webengage_module'] = $webengage_settings['webengage_module'];
        $this->model_setting_setting->editSetting('webengage', $data);
        
        return array('message', 'Your WebEngage options are deleted. You can signup for a new account.');
    }

    /**
    * Update processor.
    */
    private function webengageUpdateWebengageOptions()
    {
        $wlc = isset($_REQUEST['webengage_license_code']) ? htmlspecialchars($_REQUEST['webengage_license_code'], ENT_COMPAT, 'UTF-8') : '';
        $vm = isset($_REQUEST['verification_message']) ? htmlspecialchars($_REQUEST['verification_message'], ENT_COMPAT, 'UTF-8') : '';
        $wws = isset($_REQUEST['webengage_widget_status']) ? htmlspecialchars($_REQUEST['webengage_widget_status'], ENT_COMPAT, 'UTF-8') : 'ACTIVE';
        error_log('message coming');
        error_log($wlc);
        if (1==1)
        {
            $webengage_settings = $this->model_setting_setting->getSetting('webengage');

            $data['webengage_license_code'] = trim($wlc);
            
            $data['webengage_status'] = $wws;
            $data['webengage_module'] = $webengage_settings['webengage_module'];
            $this->model_setting_setting->editSetting('webengage', $data);


            $webengage_settings = $this->model_setting_setting->getSetting('webengage');
            error_log('hhhhh2');
error_log('sucker');
 ob_start();                    // start buffer capture
    var_dump( $data);           // dump the values
    $contents = ob_get_contents(); // put the buffer into a variable
    ob_end_clean();                // end capture
    error_log( $contents ); 
            
            $msg = !empty($vm) ? $vm : 'Your WebEngage widget license code has been updated.';
            return array('message', $msg);
        }
        else return array('error-message', 'Please add a license code.');
    }

    /**
    * Activate processor.
    */
    private function webengageActivateWeWidget()
    {
        $webengage_settings = $this->model_setting_setting->getSetting('webengage');
        $wlc = isset($_REQUEST['webengage_license_code']) ? htmlspecialchars($_REQUEST['webengage_license_code'], ENT_COMPAT, 'UTF-8') : '';
        $old_value = isset($webengage_settings['webengage_license_code']) ? $webengage_settings['webengage_license_code'] : '';
        $wws = isset($_REQUEST['webengage_widget_status']) ? htmlspecialchars($_REQUEST['webengage_widget_status'], ENT_COMPAT, 'UTF-8') : 'ACTIVE';
        if ($wlc === $old_value)
        {
            $webengage_settings = $this->model_setting_setting->getSetting('webengage');

            $data['webengage_license_code'] = $wlc;
            $data['webengage_status'] = $wws;
            $data['webengage_module'] = $webengage_settings['webengage_module'];
            $this->model_setting_setting->editSetting('webengage', $data);

            $msg = 'Your plugin installation is complete. You can do further customizations from your WebEngage dashboard.';
            return array('message', $msg);
        }
        else
        {
            $msg = 'Unauthorized plugin activation request';
            return array('error-message', $msg);
        }
    }

    private function renderPage($headingTitle, $templateFile,$data) {
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        }
        else {
            $data['error_warning'] = '';
        }


        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home') ,
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL') ,
            'separator' => false
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module') ,
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL') ,
            'separator' => ' :: '
        );
        $data['breadcrumbs'][] = array(
            'text' => $headingTitle ,
            'href' => $this->url->link('module/webengage', 'token=' . $this->session->data['token'], 'SSL') ,
            'separator' => ' :: '
        );
        $data['modules'] = array();
        $this->load->model('design/layout');
        $data['layouts'] = $this->model_design_layout->getLayouts();
        $this->load->model('localisation/language');
        $data['languages'] = $this->model_localisation_language->getLanguages();
        $this->template = 'module/'.$templateFile;
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view($templateFile, $data));
        //$this->response->setOutput($this->render());  
    }
}

