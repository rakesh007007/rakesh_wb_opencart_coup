


    <title>Manage Campaign - Cart Coupons - Webengage - Magento</title>
    
    <link rel="stylesheet" href="http://uifilesplugins.webuda.com/ui3/images/fonts/dbfont/custom-font6.css">
    <link href="http://uifilesplugins.webuda.com/ui3/vendor/bootstrap/css/bootstrap.paper.min.css" rel="stylesheet">
    <link href="http://uifilesplugins.webuda.com/ui3/vendor/select2/select2.css" rel="stylesheet">
    <link href="http://uifilesplugins.webuda.com/ui3/vendor/animate/animate.css" rel="stylesheet">
    <link href="http://uifilesplugins.webuda.com/ui3/css/main.css" rel="stylesheet">

    <script type="text/javascript" src="http://uifilesplugins.webuda.com/ui3/js/components/we-webfont.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script type="text/javascript" src="/vendor/css3-mediaqueries.js"></script>
    <![endif]-->
<?php 
/*
Version 1.0.0
*/
echo $header;
echo $column_left;
if($webengage_license_code==''){
    header('Location: '.$settingurl);
}
$CamStatus = ($NotificationsByTag ['totalCount']);
if($CamStatus<2){
    //echo "hello";
    $selectedCoupons = Array();
    $leaveIntentMsg = 'Add a Message for Leave Intent';
    $itemDropMsg = 'Add a Message for Item Drop';
    $status = 'restart';
    $activeTheme='theme1';
    $IdItemDrop = 0;
    $IdLeaveIntent = 0;
    $urlsubmit = $data['urlnew'];




}
else {
    
        $IdItemDrop=$NotificationDrop['contents'][0]['id'];
        $status = $NotificationDrop['contents'][0]['status'];
        $itemDropMsg = ($DropDescription['response']['data']['description']);
        $leaveIntentMsg = ($LeaveDescription['response']['data']['description']);
        if($status=='ACTIVE'){
            $status = 'play';
        }
        else{
            $status = 'pause';
        }
        //$itemDropMsg = $NotificationDrop['contents'][0]['title'];
        //$leaveIntentMsg = $NotificationLeave['contents'][0]['title'];
    $IdLeaveIntent=$NotificationLeave['contents'][0]['id'];
    $selectedCouponsImploded=$NotificationLeave['contents'][0]['title'];
    $selectedCoupons = explode( '|', $selectedCouponsImploded);
    //var_dump($selectedCoupons);
    $activeTheme='theme2';
    $urlsubmit = $data['urledit'];


}
    $deactivateFinal=$deactivateurl."&IdLeaveIntent=".$IdLeaveIntent."&IdItemDrop=".$IdItemDrop;
    $resetFinal=$reseturl."&IdLeaveIntent=".$IdLeaveIntent."&IdItemDrop=".$IdItemDrop;
    $activateFinal=$activateurl."&IdLeaveIntent=".$IdLeaveIntent."&IdItemDrop=".$IdItemDrop;

?>

<div class="we-container">

    <div class="we-header">
        <div class="we-branding clearfix">
            <a href="#" class="we-logo"><span class="weicon we_ecomm"></span></a>
            <a href="http://www.webengage.com" class="we-plugin-name">Cart Coupons</a>
            <a href="<?php echo $settingurl ?>" class="we-license-code">License:<?php echo $webengage_license_code ?></a>
        </div>
        <a href="http://webengage.com" target="_blank" class="we-powered-by-in">
            <div class="we-powered-by">powered by</div>
            <div class="we-powered-by-we"><span class="weicon we_logo"></span></div>
        </a>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 col-no-padding">
                 <div class="we-menu">
                    <a class="we-menu-item active" href="<?php echo $mainurl ?>">
                        <span class="weicon we_edit"></span>
                        Manage Campaign
                    </a>
                    <a  class="we-menu-item" href="<?php echo $statsurl ?>">
                        <span class="weicon we_goalsstats"></span>
                        Stats
                    </a>
                    <a href="<?php echo $settingurl ?>" class="we-menu-item">
                        <span class="weicon we_setting"></span>
                        Settings
                    </a>
                </div>
            </div>
            <div class="col-sm-10 col-no-padding">
                <div class="we-raise clearfix">
                    <div class="col-sm-4 col-no-padding">
                        <div class="we-edit <?php echo $status?>" data-status="<?php echo $status?>">
                            <div class="we-block-heading clearfix">
                                <h4 class="status-specific show-in-play">Campaign active</h4>
                                <h4 class="status-specific show-in-pause">Campaign paused</h4>
                                <h4 class="status-specific show-in-restart">Select coupons to begin</h4>
                                <div class="we-status-changers">
                                    <a href="<?php echo $activateFinal?>" id="activate" class="btn btn-danger we-status-changer play status-specific show-in-pause"
                                            title="Resume campaign" data-action="play" >
                                        <span class="weicon we_resume"></span>
                                    </a>
                                    <a  href="<?php echo $deactivateFinal?>" id="deactivate" class="btn btn-default we-status-changer pause status-specific show-in-play"
                                            title="Pause campaign" data-action="pause">
                                        <span   class="weicon we_pause"></span>
                                    </a>
                                    <a href="<?php echo $resetFinal?>" id="restart" class="btn btn-default we-status-changer restart status-specific show-in-play"
                                            data-action="restart"
                                            title="Reset campaign. This will archive the active campaign's stats and start a new campaign.">
                                        <span  class="weicon we_revert"></span>
                                    </a>
                                </div>
                            </div>
                            <form id="notifForm" class="we-edit-form" method="post" action ="<?php echo $urlsubmit ?>">
                                <div class="form-group">
                                    <label for="selectCoupons">Select Coupons</label>
                                    <select id="selectCoupons" name="coupons[]" multiple="multiple" class="we-select form-control"
                                            data-placeholder="" style="width: 100%">
                                            <?php foreach($allCoupons as $coupon){ 
                                                if(in_array($coupon,$selectedCoupons)){
                                                    echo '<option selected value= ' .$coupon.' >'.$coupon.'</option>';

                                                }
                                                else{
                                                    echo '<option value= ' .$coupon.'  >'.$coupon.'</option>';

                                                }
                                                
                                            }
                                             ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="selectTheme">Theme</label>
                                    <select id="selectTheme" name="theme" class="we-select form-control"
                                            data-placeholder="" style="width: 100%">
                                        <option value=""></option>
                                        <?php if($activeTheme=='theme1'){ ?>
                                        <option value="theme1" selected>Theme 1</option>
                                        <option value="theme2" >Theme 2</option>
                                        <?php }
                                        else{
                                            echo '<option value="theme1" >Theme 1</option>';
                                        echo '<option value="theme2" selected >Theme 2</option>';

                                        }
                                         ?>
                                        }
                                        
                                        


                                    </select>
                                </div>
                                <div class="form-group">
                                    <input name='IdLeaveIntent' type="hidden" value="<?php echo $IdLeaveIntent?>">
                                    <label for="msgLeaveIntent">Message for Scenario 1 (Exit Intent)</label>
                                    <input type="text" id="msgLeaveIntent" name="msgLeaveIntent"
                                           class="form-control we-scenario-input scenario1"
                                           data-scenario="scenario1" value="<?php echo $leaveIntentMsg;?>"/>
                                </div>
                                <div class="form-group">
                                    <input name='IdItemDrop' type="hidden" value="<?php echo $IdItemDrop?>">
                                    <label for="msgCartDrop">Message for Scenario 2 (Cart Item Drop)</label>
                                    <input type="text" id="msgCartDrop"  name="msgCartDrop"
                                           class="form-control we-scenario-input scenario2" data-scenario="scenario2"
                                           value="<?php echo $itemDropMsg;?>"/>
                                </div>
                                <!--<div class="form-group">-->
                                <!--<div class="checkbox">-->
                                <!--<label>-->
                                <!--<input type="checkbox" checked> Active-->
                                <!--</label>-->
                                <!--</div>-->
                                <!--</div>-->
                                <div class="buttons">
                                    <button type="reset" class="btn btn-default" id="notifResetBtn">Cancel</button>
                                    <button type="submit" class="btn btn-primary status-specific show-in-play show-in-pause" >Update</button>
                                    <button type="submit" class="btn btn-primary status-specific show-in-restart">Start</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-8 col-no-padding">
                        <div class="we-preview">
                            <div class="we-preview-scenarios">
                                <button class="btn btn-default btn-sm we-scenario-btn inactive scenario1"
                                        data-scenario="scenario1">
                                    Scenario 1 (Exit Intent)
                                </button>
                                <button class="btn btn-default btn-sm we-scenario-btn inactive scenario2"
                                        data-scenario="scenario2">
                                    Scenario 2 (Cart Item Drop)
                                </button>

                                <div class="we-scenario-explanation">
                                    This notification will be shown to your visitors when they're about to close
                                    your website or navigate away from it. If you do not wish to show a notification
                                    in this scenario, simply enter a blank message.
                                </div>

                            </div>
                            <div class="we-preview-notification theme1" data-theme="theme1">
                                <div class="we-message">
                                    Why leave when you can get 10% off!
                                </div>
                                <div class="we-coupon-and-cta">
                                    <div class="we-coupon-in">
                                        <div class="we-coupon">
                                            [[COUPON_CODE]]
                                        </div>
                                    </div>
                                    <div class="we-cta">
                                        <a class="btn btn-success theme-specific show-theme1">Apply</a>
                                        <a class="btn btn-danger theme-specific show-theme2">Apply</a>
                                    </div>
                                </div>
                                <div class="we-no-thanks-in">
                                        <span class="we-no-thanks">
                                            No thanks. I hate discounts.
                                        </span>
                                </div>
                                <div class="we-preview-inactive">
                                    No notification will be shown in this scenario
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php echo $footer; ?>
<script type="text/javascript" src="http://uifilesplugins.webuda.com/ui3/vendor/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="http://uifilesplugins.webuda.com/ui3/vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://uifilesplugins.webuda.com/ui3/vendor/select2/select2.js"></script>
<script type="text/javascript" src="http://uifilesplugins.webuda.com/ui3/js/components/we-select.js"></script>
<script type="text/javascript" src="http://uifilesplugins.webuda.com/ui3/js/components/we-form.js"></script>
<script type="text/javascript" src="http://uifilesplugins.webuda.com/ui3/js/main.js"></script>