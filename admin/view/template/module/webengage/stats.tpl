    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Campaign Stats - Cart Coupons - Webengage - Magento</title>
    
    <link rel="stylesheet" href="http://uifilesplugins.webuda.com/ui3/images/fonts/dbfont/custom-font6.css">
    <link href="http://uifilesplugins.webuda.com/ui3/vendor/bootstrap/css/bootstrap.paper.min.css" rel="stylesheet">
    <link href="http://uifilesplugins.webuda.com/ui3/vendor/select2/select2.css" rel="stylesheet">
    <link href="http://uifilesplugins.webuda.com/ui3/vendor/animate/animate.css" rel="stylesheet">
    <link href="http://uifilesplugins.webuda.com/ui3/css/stats.css" rel="stylesheet">

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
if($webengage_license_code==''){
    header('Location: '.$settingurl);
}
echo $header; 
echo $column_left; 

?>
<?php
$statsData1 = ($data['NotificationDrop']['contents'][0]);
$viewsDrop =$statsData1['views'];
$clicksDrop =$statsData1['clicks'];
$uniqueDrop =$statsData1["uniqueViews"];
$ClickThruDrop ='200';
$statsData2 = ($data['NotificationLeave']['contents'][0]);
$viewsLeave =$statsData2['views'];
$clicksLeave =$statsData2['clicks'];
$uniqueLeave =$statsData2["uniqueViews"];
$ClickThruLeave ='200';
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
                    <a class="we-menu-item" href="<?php echo $mainurl ?>">
                        <span class="weicon we_edit"></span>
                        Manage Campaign
                    </a>
                    <a  class="we-menu-item active" href="<?php echo $statsurl ?>">
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
                    <h4 class="we-block-heading">Active Campaign Stats</h4>

                    <div class="we-stats-in">
                        <div class="we-stats">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title we-stats-title">Scenario 1 (Exit Intent)</h3>
                                    <a href="http://dashboard.webengage.com/publisher/notifications/82617417/stats/~251445845"
                                       target="_blank" class="we-stats-detailed">Click here for detailed stats</a>
                                </div>
                                <div class="panel-body">
                                    <div class="col-sm-3 col-no-padding">
                                        <div class="we-stat">
                                            <div class="weicon we_view we-stat-icon"></div>
                                            <div class="we-stat-label">Total Views</div>
                                            <div class="we-stat-number"><?php echo $viewsLeave?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-no-padding">
                                        <div class="we-stat">
                                            <div class="weicon we_newview we-stat-icon"></div>
                                            <div class="we-stat-label">Unique Views</div>
                                            <div class="we-stat-number"><?php echo $uniqueLeave ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-no-padding">
                                        <div class="we-stat">
                                            <div class="weicon we_click we-stat-icon"></div>
                                            <div class="we-stat-label">Total Clicks</div>
                                            <div class="we-stat-number"><?php echo $clicksLeave ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-no-padding">
                                        <div class="we-stat">
                                            <div class="weicon we_clickrate we-stat-icon"></div>
                                            <div class="we-stat-label">Click-through Rate</div>
                                            <div class="we-stat-number">200%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="we-stats">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title we-stats-title">Scenario 2 (Cart Item Drop)</h3>
                                    <a href="http://dashboard.webengage.com/publisher/notifications/82617417/stats/22a340a47"
                                       target="_blank" class="we-stats-detailed">Click here for detailed stats</a>
                                </div>
                                <div class="panel-body">
                                    <div class="col-sm-3 col-no-padding">
                                        <div class="we-stat">
                                            <div class="weicon we_view we-stat-icon"></div>
                                            <div class="we-stat-label">Total Views</div>
                                            <div class="we-stat-number"><?php echo $viewsDrop?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-no-padding">
                                        <div class="we-stat">
                                            <div class="weicon we_newview we-stat-icon"></div>
                                            <div class="we-stat-label">Unique Views</div>
                                            <div class="we-stat-number"><?php echo $uniqueDrop ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-no-padding">
                                        <div class="we-stat">
                                            <div class="weicon we_click we-stat-icon"></div>
                                            <div class="we-stat-label">Total Clicks</div>
                                            <div class="we-stat-number"><?php echo $clicksDrop?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-no-padding">
                                        <div class="we-stat">
                                            <div class="weicon we_clickrate we-stat-icon"></div>
                                            <div class="we-stat-label">Click-through Rate</div>
                                            <div class="we-stat-number">210% </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="we-all-stats">
                            <div class="well">
                                <a target="_blank" href="http://dashboard.webengage.com/publisher/notifications/82617417/all?tag=magento">
                                    Click here</a> to view detailed stats of all campaigns, including archived ones.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php 
 echo $footer;
 ?>

<script type="text/javascript" src="http://uifilesplugins.webuda.com/ui3/vendor/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="http://uifilesplugins.webuda.com/ui3/vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
    jQuery.noConflict();    
</script>
