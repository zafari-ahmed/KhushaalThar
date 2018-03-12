<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo Yii::app()->baseUrl?>/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="<?php echo Yii::app()->baseUrl?>/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- NProgress -->
    <link href="<?php echo Yii::app()->baseUrl?>/assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo Yii::app()->baseUrl?>/assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->baseUrl?>/assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo Yii::app()->baseUrl?>/assets/vendors/pnotify/dist/pnotify.css" rel="stylesheet">

    <!-- JQVMap -->
    <link href="<?php echo Yii::app()->baseUrl?>/assets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo Yii::app()->baseUrl?>/assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->baseUrl?>/assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->baseUrl?>/assets/vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">


    <link href="<?php echo Yii::app()->baseUrl?>/assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->baseUrl?>/assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->baseUrl?>/assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->baseUrl?>/assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    
    

    <!-- Custom Theme Style -->
    <link href="<?php echo Yii::app()->baseUrl?>/assets/build/css/custom.min.css" rel="stylesheet">
    
    
  </head>

  <body class="nav-md" id="body">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <!-- <div class="navbar nav_title" style="border: 0;">
              
            </div> -->

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo Yii::app()->baseUrl?>/assets/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo ucfirst(@Yii::app()->session['userModel']['user']['company_name'])?> </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <!-- <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.html">Dashboard</a></li>
                    </ul>
                  </li> -->

                  <?php //if(@Yii::app()->session['userModel']['user']['userType']=='deo'){?>
                  <li class="<?php echo (Yii::app()->controller->id=='dashboard')?'active':''?>"><a href="<?php echo Yii::app()->baseUrl?>/dashboard"><i class="fa fa-home"></i> Dashboard </a></li>
                  <?php //}?>
                  <?php if(@Yii::app()->session['userModel']['user']['userType']=='deo'){?>
                  <li class="<?php echo (Yii::app()->controller->id=='registeration')?'active':''?>"><a><i class="fa  fa-user-plus"></i> Applicant Registration <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?php echo (Yii::app()->controller->id=='registeration')?'display:block':'display:none'?>">
                      <?php if(@Yii::app()->session['userModel']['user']['accesslevel']['add_labor']==1){?>
                      <li class="<?php echo (Yii::app()->controller->id=='registeration' && Yii::app()->controller->action->id=='add')?'active':''?>"><a href="<?php echo Yii::app()->baseUrl?>/registeration/add">New Registration Form</a></li>
                      <?php }?>
                      <?php if(@Yii::app()->session['userModel']['user']['accesslevel']['view_labor']==1){?>
                      <li class="<?php echo (Yii::app()->controller->id=='registeration' && Yii::app()->controller->action->id=='index')?'active':''?>"><a href="<?php echo Yii::app()->baseUrl?>/registeration">Registered Applicants</a></li>
                      <?php }?>
                      <?php //if(@Yii::app()->session['userModel']['user']['accesslevel']['report_labor']==1){?>
                      <?php if(@Yii::app()->session['userModel']['user']['userType']=='deo'){?>
                      <li class="<?php echo (Yii::app()->controller->id=='registeration' && Yii::app()->controller->action->id=='report')?'active':''?>"><a href="<?php echo Yii::app()->baseUrl?>/registeration/report">Report</a></li>
                      <?php }?>
                    </ul>
                  </li>
                  <?php }?>
                  <?php if(@Yii::app()->session['userModel']['user']['userType']=='deo'){?>
                  <li><a><i class="fa fa-briefcase"></i> Client Company <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if(@Yii::app()->session['userModel']['user']['accesslevel']['add_company']==1){?>
                      <li><a href="<?php echo Yii::app()->baseUrl?>/company/add">Register a company</a></li>
                      <?php }?>
                      <?php if(@Yii::app()->session['userModel']['user']['accesslevel']['view_company']==1){?>
                      <li><a href="<?php echo Yii::app()->baseUrl?>/company">All Companies</a></li>
                      <?php }?>
                    </ul>
                  </li>
                  <?php }?>
                  <?php if(@Yii::app()->session['userModel']['user']['userType']=='deo'){?>
                  <li class="<?php echo (Yii::app()->controller->id=='deo')?'active':''?>"><a><i class="fa fa-group"></i> DEO's <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?php echo (Yii::app()->controller->id=='deo')?'display:block':'display:none'?>">
                      <?php if(@Yii::app()->session['userModel']['user']['accesslevel']['add_user']==1){?>
                      <li class="<?php echo (Yii::app()->controller->id=='deo' && Yii::app()->controller->action->id=='add')?'active':''?>"><a href="<?php echo Yii::app()->baseUrl?>/deo/add">Add DEO</a></li>
                      <?php }?>
                      <?php if(@Yii::app()->session['userModel']['user']['accesslevel']['view_users']==1){?>
                      <li class="<?php echo (Yii::app()->controller->id=='deo' && Yii::app()->controller->action->id=='index')?'active':''?>"><a href="<?php echo Yii::app()->baseUrl?>/deo">Registered Deo's</a></li>
                      <!-- <li class="<?php //echo (Yii::app()->controller->id=='registeration')?'active':''?>"><a href="<?php //echo Yii::app()->baseUrl?>/registeration?type=2">Verified Labor</a></li> -->
                      <?php }?>
                    </ul>
                  </li>
                  <?php }?>
                  <li><a><i class="fa fa-edit"></i> Company Requisitions <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if(@Yii::app()->session['userModel']['user']['userType']=='deo'){?>
                      <?php if(@Yii::app()->session['userModel']['user']['accesslevel']['view_requisition']==1){?>
                        <li><a href="<?php echo Yii::app()->baseUrl?>/company/allrequisitions">All Requisitions</a></li>
                      <?php }?>
                      <?php } else{?>
                      <li><a href="<?php echo Yii::app()->baseUrl?>/company/allrequisitions">All Requisitions</a></li>
                      <?php }?>
                      <?php if(@Yii::app()->session['userModel']['user']['userType']=='company' || @Yii::app()->session['userModel']['user']['userType']=='person'){?>
                      <li><a href="<?php echo Yii::app()->baseUrl?>/company/onboard">On Board</a></li>
                      <li><a href="<?php echo Yii::app()->baseUrl?>/company/requisitions">New Requisition</a></li>
                      <?php }?>
                      <?php if(@Yii::app()->session['userModel']['user']['userType']=='deo'){?>
                      <li class="<?php echo (Yii::app()->controller->id=='company' && Yii::app()->controller->action->id=='report')?'active':''?>"><a href="<?php echo Yii::app()->baseUrl?>/company/report">Report</a></li>
                      <?php } ?>
                    </ul>
                  </li>
                  
                  
                  <?php /*?>
                  <li class="<?php echo (Yii::app()->controller->id=='registeration')?'active':''?>"><a><i class="fa fa-edit"></i> Company Persons <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?php echo (Yii::app()->controller->id=='registeration')?'display:block':'display:none'?>">
                      <?php if(@Yii::app()->session['userModel']['user']['userType']=='deo'){?>
                        <li class="<?php echo (Yii::app()->controller->id=='companypersons' && Yii::app()->controller->action->id=='add')?'active':''?>"><a href="<?php echo Yii::app()->baseUrl?>/companypersons/add">Add Company Person</a></li>
                      <?php }?>
                      <li class="<?php echo (Yii::app()->controller->id=='companypersons' && Yii::app()->controller->action->id=='index')?'active':''?>"><a href="<?php echo Yii::app()->baseUrl?>/companypersons">Company Persons</a></li>
                    </ul>
                  </li>
                  <?php */?>
                  
                  <?php if(@Yii::app()->session['userModel']['user']['userType']=='deo'){?>
                  <li class="<?php echo (Yii::app()->controller->id=='training')?'active':''?>"><a><i class="fa fa-black-tie"></i> Trainings <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?php echo (Yii::app()->controller->id=='training')?'display:block':'display:none'?>">
                      <?php //if(@Yii::app()->session['userModel']['user']['accesslevel']['settings']==1){?>
                      <li><a href="<?php echo Yii::app()->baseUrl?>/training">All Trainings</a></li>
                      <li><a href="<?php echo Yii::app()->baseUrl?>/training/add">Add Training</a></li>
                      <?php if(@Yii::app()->session['userModel']['user']['userType']=='deo'){?>
                      <li class="<?php echo (Yii::app()->controller->id=='training' && Yii::app()->controller->action->id=='report')?'active':''?>"><a href="<?php echo Yii::app()->baseUrl?>/training/report">Report</a></li>
                      <?php }?>
                    </ul>
                  </li>
                  <?php }?>
                  <?php if(@Yii::app()->session['userModel']['user']['userType']=='deo'){?>
                  <li class="<?php echo (Yii::app()->controller->id=='settings')?'active':''?>"><a><i class="fa fa-cog"></i> Settings <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?php echo (Yii::app()->controller->id=='settings')?'display:block':'display:none'?>">
                      <?php if(@Yii::app()->session['userModel']['user']['accesslevel']['settings']==1){?>
                      <li><a href="<?php echo Yii::app()->baseUrl?>/settings/villages">Village</a></li>
                      <li><a href="<?php echo Yii::app()->baseUrl?>/settings/tehsils">Tehsil</a></li>
                      <li><a href="<?php echo Yii::app()->baseUrl?>/settings/districts">District</a></li>
                      <li><a href="<?php echo Yii::app()->baseUrl?>/settings/vehicletypes">Vehicle Types</a></li>
                      <li><a href="<?php echo Yii::app()->baseUrl?>/settings/useraccesslevel">User Access Level</a></li>
                      <li><a href="<?php echo Yii::app()->baseUrl?>/settings/deactivate">Deactivate Status</a></li>
                      <li><a href="<?php echo Yii::app()->baseUrl?>/settings/blacklist">Blacklist Status</a></li>
                      <li><a href="<?php echo Yii::app()->baseUrl?>/settings/reject">Reject Status</a></li>
                      <li><a target="_blank" href="<?php echo Yii::app()->baseUrl?>/cron">Live Update</a></li>
                      <?php }?>
                    </ul>
                  </li>
                  <?php } ?>
                  <li ><a href="<?php echo Yii::app()->baseUrl?>/site/logout"><i class="fa fa-sign-out"></i> Logout </a></li>
                  <!--
                  <li><a><i class="fa fa-edit"></i> Client Requisition <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo Yii::app()->baseUrl?>/requisitions">All Requisition</a></li>
                      <li><a href="<?php echo Yii::app()->baseUrl?>/requisitions?type=1">Requested</a></li>
                      <li><a href="<?php echo Yii::app()->baseUrl?>/requisitions?type=2">Open</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-edit"></i> DEO Registeration <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo Yii::app()->baseUrl?>/users/add">Add DEO User</a></li>
                      <li><a href="<?php echo Yii::app()->baseUrl?>/users">DEO Users</a></li>
                    </ul>
                  </li> -->
                  <!-- <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="general_elements.html">General Elements</a></li>
                      <li><a href="media_gallery.html">Media Gallery</a></li>
                      <li><a href="typography.html">Typography</a></li>
                      <li><a href="icons.html">Icons</a></li>
                      <li><a href="glyphicons.html">Glyphicons</a></li>
                      <li><a href="widgets.html">Widgets</a></li>
                      <li><a href="invoice.html">Invoice</a></li>
                      <li><a href="inbox.html">Inbox</a></li>
                      <li><a href="calendar.html">Calendar</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables.html">Tables</a></li>
                      <li><a href="tables_dynamic.html">Table Dynamic</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="chartjs.html">Chart JS</a></li>
                      <li><a href="chartjs2.html">Chart JS2</a></li>
                      <li><a href="morisjs.html">Moris JS</a></li>
                      <li><a href="echarts.html">ECharts</a></li>
                      <li><a href="other_charts.html">Other Charts</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                      <li><a href="fixed_footer.html">Fixed Footer</a></li>
                    </ul>
                  </li>-->
                </ul>
              </div>
              <!--<div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="e_commerce.html">E-commerce</a></li>
                      <li><a href="projects.html">Projects</a></li>
                      <li><a href="project_detail.html">Project Detail</a></li>
                      <li><a href="contacts.html">Contacts</a></li>
                      <li><a href="profile.html">Profile</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="page_403.html">403 Error</a></li>
                      <li><a href="page_404.html">404 Error</a></li>
                      <li><a href="page_500.html">500 Error</a></li>
                      <li><a href="plain_page.html">Plain Page</a></li>
                      <li><a href="login.html">Login Page</a></li>
                      <li><a href="pricing_tables.html">Pricing Tables</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li>                  
                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul>
              </div>-->

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!-- <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div> -->
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->

        <?php if(Yii::app()->session['userModel']['user']['userType']=='person'){

          $comp = ClientCompanies::model()->findByPk(Yii::app()->session['userModel']['user']['company_id']);
          $companyName= ' - '.@$comp->company_name;
          } else{
           $companyName='';
          } ?>
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <!-- <div class="headerSearch"><form method="POST" action=""><input type="text" placeholder="Search CNIC"></form></div> -->
              <a href="<?php echo Yii::app()->baseUrl?>" class="logo_large"><span><img src="<?php echo Yii::app()->baseUrl?>/assets/images/KTLogo.png"> </span></a>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo Yii::app()->baseUrl?>/assets/images/img.jpg" alt=""><?php echo ucfirst(@Yii::app()->session['userModel']['user']['company_name']).@$companyName?> 
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo Yii::app()->baseUrl?>/settings/password"> Change Password</a></li>
                    <li><a href="<?php echo Yii::app()->baseUrl?>/site/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <!--< li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="<?php //echo Yii::app()->baseUrl?>/assets/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="<?php //echo Yii::app()->baseUrl?>/assets/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="<?php //echo Yii::app()->baseUrl?>/assets/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="<?php //echo Yii::app()->baseUrl?>/assets/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li> -->
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <?php echo $content?>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right no-print">
            ©2017 All Rights Reserved. KHUSHAAL THAR. Privacy and Terms
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <script type="text/javascript">
      var BASE_URL = '<?php echo Yii::app()->baseUrl?>';
      var actionID = '<?php echo Yii::app()->controller->action->id?>';
      var controllerID = '<?php echo Yii::app()->controller->id?>';
    </script>
    <!-- jQuery -->
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/jquery.mask.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/dropzone/dist/min/dropzone.min.js"></script>

    <!-- jQuery Smart Wizard -->
    <script type="text/javascript">
      function displayAlert(title,text,type){
        PNotify.removeAll();
        new PNotify({
            title: title,
            text: text,
            type: type,
            hide: true,
            styling: 'bootstrap3',
            /*addclass: 'dark'*/
        });
      }
      
    </script>
    <?php //echo date('c',strtotime('2012-12-12'));?>
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo Yii::app()->baseUrl?>/assets/build/js/custom.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/pnotify/dist/pnotify.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/webcam.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>

    <!-- Flot -->
    <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->

    <?php

    $js = array();
      $a = array();
      $date = new DateTime();
      $a['date'] = $date->format('Y-m-d');//'Mon May 01 2017 00:00:00 GMT+0500 (Pakistan Standard Time)';
      $a['value'] = 12;
      $js[0] = $a;
      $a = array();
      $date = new DateTime('2017-04-05');
      $a['date'] = $date->format('Y-m-d');
      $a['value'] = 20;
      $js[1] = $a;
      $data = array();

if(@$_GET['viewmonth']){
    $month = $_GET['viewmonth'];
} else{
    $month = date('m');
}

$date_to = date("Y-$month-t");
$datee = strtotime("-20 day");
//$date_from = date('Y-m-t', $datee);
$date_from = date("Y-$month-01");
$begin = new DateTime($date_from);
$end = new DateTime($date_to);
$end->add(new DateInterval('P1D'));
$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
//echo $daterange;exit;
$days = array();
//$daterange = array('01','02','03');
foreach($daterange as $index=>$date){
$sd = $date->format("d");
$date = $date->format("Y-m-d");
$criteria = new CDbCriteria;
$criteria->addCondition("district_id = 1");  
$criteria->addCondition("createdOn LIKE '%$date%'");  
$data[$index]['date'] = $date;
$thrap = Labours::model()->count($criteria);
$data[$index]['thriapplicants'] = $thrap;
$criteria = new CDbCriteria;
$criteria->addCondition("district_id != 1");  
$criteria->addCondition("createdOn LIKE '%$date%'");
$nothr = Labours::model()->count($criteria);
$data[$index]['nothriapplicants'] = $nothr;
}


    ?>

    <script>
      $(document).ready(function() {


      //google.charts.load('current', {'packages':['corechart']});
      //google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Thari', 'Non Thari'],
          ['2012-12-12',  1000,      400],
          ['2012-14-14',  1170,      460],
          ['2012-15-15',  660,       1120],
          ['2016-12-12',  1030,      540]
        ]);

        var options = {
          title: 'Company Performance',
          hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }


        
        /*if((actionID =='requisitiondetail' && controllerID =="requisitions") || (actionID =='viewrequisition' && controllerID =="labor")){
          $('#body').removeClass('nav-md').addClass('nav-sm');
        } else{
          $('#body').removeClass('nav-sm').addClass('nav-md');
        }*/
        $('#body').removeClass('nav-md').addClass('nav-sm');
        $('.child_menu').attr('style','display:none!important;');
        $(".datatable").DataTable({
          "lengthMenu": [[100, 300, 500, -1], [100, 300, 500, "All"]]
        });
        $('#reqdatatable').DataTable({
            "order": [[ 0, "desc" ]],
            "lengthMenu": [[100, 300, 500, -1], [100, 300, 500, "All"]]
        });


        
        //All applicants
        var oTable  = $('#datatableee').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "<?php echo Yii::app()->baseUrl?>/registeration/fetchall",
            ordering: true,
            aoColumnDefs: [
               { aTargets: [ 0 ], bSortable: true },
               { aTargets: [ 1 ], bSortable: false },
               { aTargets: [ 2 ], bSortable: true },
               { aTargets: [ 3 ], bSortable: true },
               { aTargets: [ 4 ], bSortable: true },
               { aTargets: [ 5 ], bSortable: true },
               { aTargets: [ 6 ], bSortable: true },
               { aTargets: [ 7 ], bSortable: false },
               { aTargets: [ 8 ], bSortable: false },
               { aTargets: [ 9 ], bSortable: false },
               { aTargets: [ 10 ], bSortable: false },
            ],
            "lengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]]
            
        });
        $('.dataTables_filter input').attr("placeholder", "Search...");
        $( ".dataTables_filter input" ).addClass('bootstrap-datepicker');


        //All requisition applicants
        var oTable  = $('#datatableReq').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "<?php echo Yii::app()->baseUrl?>/requisitions/fetchall",
            ordering: true,
            aoColumnDefs: [
               { aTargets: [ 0 ], bSortable: true },
               { aTargets: [ 1 ], bSortable: true },
               { aTargets: [ 2 ], bSortable: true },
               { aTargets: [ 3 ], bSortable: true },
               { aTargets: [ 4 ], bSortable: true },
               { aTargets: [ 5 ], bSortable: true },
               { aTargets: [ 6 ], bSortable: true },
               { aTargets: [ 7 ], bSortable: true },
               { aTargets: [ 8 ], bSortable: true },
            ],
            "lengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]]
            
        });
        $('.dataTables_filter input').attr("placeholder", "Search...");
        $( ".dataTables_filter input" ).addClass('bootstrap-datepicker');
        


        /*$('#cnic').mask('00000-0000000-0');
        $('#mobile_number').mask('0000-0000000');*/

        $('.cnic').mask('00000-0000000-0');
        $('.mobile_number').mask('0000-0000000');

        $('input[name="block_2"]').change(function(){
          var villageBlock = [40,112,13,21,3779,3,23,20,3780,1984,3781,3782,3783];
          if($(this).val()==1){
            $('#district_id').val(1).trigger('change');;
            $('#district_id').attr('disabled',true);
            $('#tehsil_id').val(1).trigger('change');
            $('#tehsil_id').attr('disabled',true);
            $('#village_id').html($('#blockVillage').html());
            $(".select2_single").select2();
            
          } else{
            $('#district_id').val('').trigger('change');;
            $('#tehsil_id').val('').trigger('change');;
            $('#tehsil_id').attr('disabled',false);
            $('#district_id').attr('disabled',false);
            $('#village_id').html($('#normalVillage').html());
            $(".select2_single").select2();
          }
        });



        $('#graph_month').change(function(){
          var val = $(this).val();
          window.location = BASE_URL+'/dashboard/index?viewmonth='+val;
        })
        
        $('#take_snapshot').click(function(){
          // take snapshot and get image data

          
          Webcam.snap( function(data_uri) {
            // display results in page
            document.getElementById('results').innerHTML = 
              '<img style="margin-top: 10px;width:200px;height:150px" src="'+data_uri+'"/><input type="hidden" value="'+data_uri+'" name="avatar">';
          } );
        });
        
        $('.ddate').daterangepicker({
          autoUpdateInput: false,
          autoApply: true,
          singleDatePicker: true,
          calender_style: "picker_3",
          showDropdowns: true,
          locale: {
            format: 'YYYY-MM-DD'
          },
        }, function(start, end, label) {
            //$(this).val(end.toISOString());
        });
        $('.ddate').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.endDate.format('YYYY-MM-DD'));
        });

        $('.noti').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_4",
          showDropdowns: true,
          locale: {
            format: 'YYYY-MM-DD'
          },
        }, function(start, end, label) {
            window.location = BASE_URL+'/dashboard/index?notification_date='+end.toISOString();
        });
        

        $('.date').daterangepicker({
          autoUpdateInput: false,
          singleDatePicker: true,
          calender_style: "picker_4",
          showDropdowns: true,
          locale: {
            //format: 'YYYY-MM-DD'
            format: 'DD-MM-YYYY'
          },
          //startDate: '<?php echo date("Y-m-d", strtotime("-18 years", time()));?>',
          //maxDate: '<?php echo date("Y-m-d", strtotime("-18 years", time()));?>',
          startDate: '<?php echo date("d-m-Y", strtotime("-18 years", time()));?>',
          maxDate: '<?php echo date("d-m-Y", strtotime("-18 years", time()));?>',
        }, function(start, end, label) {
            $.ajax( {
              url: BASE_URL+'/labor/checkdob',
              type: 'POST',
              data: {dob:end.toISOString()},
              success: function(data) {
                var d = JSON.parse(data);
                if(d==0){
                  new PNotify({
                      title: 'DOB Check',
                      text: 'You are not allowed to registered.',
                      type: 'error',
                      hide: true,
                      styling: 'bootstrap3',
                  });
                  $('#dob').val('');
                } else{
                  PNotify.removeAll();
                }
              },
            });
        });
        $('.date').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.endDate.format('DD-MM-YYYY'));
        });

        $(".select2_single").select2();


        $('#wizard').smartWizard();

        $('#wizard_verticle').smartWizard({
          transitionEffect: 'slide'
        });
        //$('.stepContainer').attr('style','height:1400px');

        $('#valid_upto').change(function(){
          var rel = $(this).val();
          $.ajax( {
              url: BASE_URL+'/registeration/checklicense/date/'+rel,
              type: 'GET',
              success: function(data) {
                var d = JSON.parse(data);
                  if(d==1){
                    //displayAlert('Error','License is expired or about to expire.','error');
                    $('#valid_upto_error').removeClass('hide');
                    $('#valid_upto_error').html('License is expired or about to expire.');
                    //$('#valid_upto').val('');
                  } else{
                    $('#valid_upto_error').addClass('hide');
                    PNotify.removeAll();
                  }
              },
            });
        });

        $('.cancelReq').click(function(){
          var rel = $(this).attr('rel');
          $('.requisition_id').val(rel);
        });

        $('#addnewmobile').click(function(){
          var c = Math.floor((Math.random() * 10) + 1);
          var div = '<div class="form-group" id="mobile_'+c+'"><button type="button" class="btn btn-success btn-xs pull-right removenewmobile" rel="'+c+'">Remove</button><label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Mobile Number <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input type="text" name="mobile_number[]" required="required" class="mobile_number form-control col-md-7 col-xs-12"></div></div>';
          $('#mobileBox').append(div);
          $('.mobile_number').mask('0000-0000000');
          $('.removenewmobile').click(function(){
            var rel = $(this).attr('rel');
            $('#mobile_'+rel).remove();
          });
        });
        $('.removenewmobile').click(function(){
          var rel = $(this).attr('rel');
          $('#mobile_'+rel).remove();
        });
        $('#addnewwork').click(function(){
          var box = $('#workingBoxHtml').html();
          //$('.stepContainer').attr('style','height:'+($('.stepContainer').height()+300)+'px');
          var rand = Math.floor((Math.random() * 100) + 1);
          $('#newworkingBox').append('<div id="working_'+rand+'"><hr/><button type="button" class="btn btn-success btn-xs pull-right removework"  rel="'+rand+'">Remove</button>'+box+'</div>');
          $('.date').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4",
            showDropdowns: true,
            locale: {
              format: 'YYYY-MM-DD'
            },
          }, function(start, end, label) {
            //console.log(start.toISOString(), end.toISOString(), label);
          });
        });
        var count = 1;
        $('#addneweducation').click(function(){
          var box = $('#educationBoxHtml').html();
          //$('.stepContainer').attr('style','height:'+($('.stepContainer').height()+200)+'px');
          var rand = Math.floor((Math.random() * 100) + 1);
          $('#neweducationBox').append('<div id="education_'+rand+'"><button type="button" class="btn btn-success btn-xs pull-right removeeduc"  rel="'+rand+'">Remove</button>'+box+'<div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Certificate<span class="required">*</span></label><div class="col-md-6">Yes<input type="radio" name="degree['+rand+']" value="1" class="col-md-3" style="    float: none;">No<input type="radio" name="degree['+rand+']" value="0" class="col-md-3" style="    float: none;" checked></div></div><hr/></div>');
          count++;
        });
        
        
        $('#cnic').blur(function(){
          var rel = $(this).attr('rel');
          if(rel=='deo'){
              $.ajax( {
                url: BASE_URL+'/company/checkdeocnic',
                type: 'POST',
                data: {cnic:$('#cnic').val()},
                success: function(data) {
                  var d = JSON.parse(data);
                  if(d==1){

                    new PNotify({
                        title: 'CNIC Check',
                        text: 'CNIC already exist in database.',
                        type: 'error',
                        hide: true,
                        styling: 'bootstrap3',
                        /*addclass: 'dark'*/
                    });
                    $('#cnic').val('');
                  } else{
                    PNotify.removeAll();
                  }
                },
              });
          } else{
            $.ajax( {
              url: BASE_URL+'/labor/checkcnic',
              type: 'POST',
              data: {cnic:$('#cnic').val()},
              success: function(data) {
                var d = JSON.parse(data);
                if(typeof d.error == 'undefined'){
                    PNotify.removeAll();
                } else{
                    displayAlert('CNIC Check',d.error,'error');
                    $('#cnic').val('');
                }
                /*var d = JSON.parse(data);
                if(d==1){

                  new PNotify({
                      title: 'CNIC Check',
                      text: 'CNIC already exist in database.',
                      type: 'error',
                      hide: true,
                      styling: 'bootstrap3',
                  });
                  $('#cnic').val('');
                } else{
                  PNotify.removeAll();
                }*/
              },
          });
          }
        });

        if((actionID=='add' && controllerID=='registeration') || (actionID=='edit' && controllerID=='labor')){
          Webcam.set({
            width: 115,
            height: 150,
            image_format: 'jpeg',
            jpeg_quality: 90
          });
          Webcam.attach( '#my_camera' );  
        }
        
        
        $('.buttonNext').addClass('btn btn-success');
        $('.buttonPrevious').addClass('btn btn-primary hide');
        $('.buttonFinish').addClass('btn btn-default hide');

        $('input[name="martial_status"]').click(function(){
          if($(this).val()==0){
            $('#kidsBox').addClass('hide');
          }
          if($(this).val()==1){
           $('#kidsBox').removeClass('hide'); 
          }
        });

        $('input[name="drive"]').click(function(){
          if($(this).val()==0){
            //$('.stepContainer').attr('style','height:'+($('.stepContainer').height()-100)+'px');
            $('#driveBox').addClass('hide');
          }
          if($(this).val()==1){
            //$('.stepContainer').attr('style','height:'+($('.stepContainer').height()+100)+'px');
            $('#driveBox').removeClass('hide');
          }
        });
        $('input[name="driving_license"]').click(function(){
          if($(this).val()==0){
            //$('.stepContainer').attr('style','height:'+($('.stepContainer').height()-300)+'px');
            $('#licenseBox').addClass('hide');
          }
          if($(this).val()==1){
            //$('.stepContainer').attr('style','height:'+($('.stepContainer').height()+300)+'px');
            $('#licenseBox').removeClass('hide');
          }
        });
        $('input[name="working"]').click(function(){
          if($(this).val()==0){
            //$('.stepContainer').attr('style','height:'+($('.stepContainer').height()-300)+'px');
            $('#workingBox').addClass('hide');
            $('#workingBoxNo').removeClass('hide');
          }
          if($(this).val()==1){
            //$('.stepContainer').attr('style','height:'+($('.stepContainer').height()+300)+'px');
            $('#workingBox').removeClass('hide');
            $('#workingBoxNo').addClass('hide');
          }
        });
      });

  var nicop = $('input[name="nicop"]:checked').val();
  
  if(nicop==1){
    $('#cnic').mask('000000-000000-0');
  } else{
    $('#cnic').mask('00000-0000000-0');
  }
  $('input[name="nicop"]').change(function(){
    
    if($(this).val()==1){
      $('#cnic').mask('000000-000000-0');
    } else{
      $('#cnic').mask('00000-0000000-0');
    }
  });


  $('body').on('click', '.removework', function(){
    var rel = $(this).attr('rel');
    $('#working_'+rel).remove();
  });
  $('body').on('click', '.removeeduc', function(){
    var rel = $(this).attr('rel');
    $('#education_'+rel).remove();
  });


      

  $('#clientformBtn').click(function(){
    var cnic= [];
    var errors = [];
    if(/*$('#client_code').val()!='' && */$('#company_name').val()!=''){
      
      $($('.cnic')).each(function(i,e){
          cnic.push($(e).val());
      });
      $(cnic).each(function(i,e){
          if(e!=''){
              if(e.length < 15){
                if(errors.includes('CNIC not valid.')==false){
                    errors.push("CNIC not valid.");
                }
            }  
          }
          
      });
      if(errors.length==0){
        $.ajax( {
            url: BASE_URL+'/company/submit',
            type: 'POST',
            data: $('#clientform').serialize(),
            success: function(data) {
              var d = JSON.parse(data);
                if(typeof d.error == 'undefined'){
                    displayAlert('Success',d.success,'success');
                    window.location.reload();
                } else{
                    displayAlert('Warning',d.error,'error');
                }
            },
        });
      } else{
        var errs = errors.toString().split(',');
        var error_messages = '';
        $(errs).each(function(i,e){
          error_messages = error_messages+e+'<br/>';
        });
        displayAlert('Warning',error_messages,'error');
      }
      
    } else{
      displayAlert('Warning','Enter required fields','error');
    }
  });

  $('#att_month').change(function(){
    var id = $('#requisition_id').val();
    window.location = BASE_URL+'/requisitions/requisitiondetail/id/'+id+'?month='+$(this).val();
  })


  $('#requisition_status').change(function(){
    var r = confirm('Are you sure you want you want to change status.')
    if(r){
      var postObject = new Object;
      postObject.requisition_id = $('#requisition_id').val();
      postObject.status = $(this).val();
      $.ajax( {
          url: BASE_URL+'/requisitions/changestatus',
          type: 'POST',
          data: postObject,
          success: function(data) {
            var d = JSON.parse(data);
              if(typeof d.error == 'undefined'){
                  displayAlert('Success',d.success,'success');
                  window.location.reload();
              } else{
                  displayAlert('Warning',d.error,'error');
              }
          },
      });
    }
  })
  $('#submitDeo').click(function(){
    if($('#code').val()!='' && $('#name').val()!=''){
      $.ajax( {
            url: BASE_URL+'/deo/savedeo',
            type: 'POST',
            data: $('#deoForm').serialize(),
            success: function(data) {
              var d = JSON.parse(data);
                if(typeof d.error == 'undefined'){
                    displayAlert('Success',d.success,'success');
                    window.location.reload();
                } else{
                    displayAlert('Warning',d.error,'error');
                }
            },
        });
    } else{
      displayAlert('Warning','Enter required fields','error');
    }
  });
  $('#usertypeBtn').click(function(){
    if($('#user_type').val()!=''){
      $.ajax( {
            url: BASE_URL+'/settings/saveusertype',
            type: 'POST',
            data: $('#usertypeForm').serialize(),
            success: function(data) {
              var d = JSON.parse(data);
                if(typeof d.error == 'undefined'){
                    displayAlert('Success',d.success,'success');
                    window.location.reload();
                } else{
                    displayAlert('Warning',d.error,'error');
                }
            },
        });
    } else{
      displayAlert('Warning','Enter required fields','error');
    }
  });
  

  
  $('#clientdeoformBtn').click(function(){
    if($('#client_code').val()!='' && $('#company_email').val()!=''){
      $.ajax( {
            url: BASE_URL+'/company/deosubmit',
            type: 'POST',
            data: $('#clientdeoform').serialize(),
            success: function(data) {
              var d = JSON.parse(data);
                if(typeof d.error == 'undefined'){
                    displayAlert('Success',d.success,'success');
                    window.location.reload();
                } else{
                    displayAlert('Warning',d.error,'error');
                }
            },
        });
    } else{
      displayAlert('Warning','Enter required fields','error');
    }
  });

  $('#submitPerson').click(function(){
    if($('#name').val()!='' /*&& $('#company_email').val()!=''*/){
      $.ajax( {
            url: BASE_URL+'/companypersons/submit',
            type: 'POST',
            data: $('#personForm').serialize(),
            success: function(data) {
              var d = JSON.parse(data);
                if(typeof d.error == 'undefined'){
                    displayAlert('Success',d.success,'success');
                    window.location.reload();
                } else{
                    displayAlert('Warning',d.error,'error');
                }
            },
        });
    } else{
      displayAlert('Warning','Enter required fields','error');
    }
  });

  $('#applicantReport').click(function(){
    $.ajax( {
        url: BASE_URL+'/registeration/searchapplicant',
        type: 'POST',
        data: $('#applicantReportForm').serialize(),
        success: function(data) {
          var d = JSON.parse(data);
            if(typeof d.error == 'undefined'){
                displayAlert('Success',d.success,'success');
                window.location.reload();
            } else{
                displayAlert('Warning',d.error,'error');
            }
        },
    });
  });
  

  $('#take_thumb').click(function(){
    $.ajax( {
        url: BASE_URL+'/registeration/getthumb',
        type: 'GET',
        success: function(data) {
          var d = JSON.parse(data);
            if(typeof d.error == 'undefined'){
                $('#thumb_results').html(d.link);
                $('#thumbData').val(d.thumbs);
            } else{
                displayAlert('Warning',d.error,'error');
            }
        },
    });
  });
      
    </script>
    <script>
      $(document).ready(function() {
        var data1 = [];
        var data2 = [];
        $(<?php echo json_encode($data)?>).each(function(i,e){
          var s1 = [];
          var s2 = [];
          var d = e.date.split('-');
        
          s1[0] = gd(parseInt(d[0]), parseInt(d[1]), parseInt(d[2]));
          s1[1] = parseInt(e.thriapplicants);
          s2[0] = gd(parseInt(d[0]), parseInt(d[1]), parseInt(d[2]));
          s2[1] = parseInt(e.nothriapplicants);
          
          data1.push(s1);
          data2.push(s2);
        });
        
        $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
          data1,data2
        ], {
          series: {
            lines: {
              show: false,
              fill: true
            },
            splines: {
              show: true,
              tension: 0,
              lineWidth: 1,
              fill: 0.4
            },
            points: {
              radius: 0,
              show: false
            },
            shadowSize: 2
          },
          grid: {
            verticalLines: true,
            hoverable: true,
            clickable: true,
            tickColor: "#d5d5d5",
            borderWidth: 1,
            color: '#fff'
          },
          colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
          xaxis: {
            tickColor: "rgba(51, 51, 51, 0.06)",
            mode: "time",
            tickSize: [1, "day"],
            tickLength: 10,
            axisLabel: "Date",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 10
          },
          yaxis: {
            ticks: 8,
            tickColor: "rgba(51, 51, 51, 0.06)",
          },
          tooltip: true
        });

        function gd(year, month, day) {
          return new Date(year, month - 1, day);
        }
      });
    </script>
    <!-- /Flot -->

    <!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {

        var cb = function(start, end, label) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        };

        var optionSet1 = {
          startDate: moment().subtract(29, 'days'),
          endDate: moment(),
          minDate: '01/01/2012',
          maxDate: '12/31/2015',
          dateLimit: {
            days: 60
          },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          opens: 'left',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'MM/DD/YYYY',
          separator: ' to ',
          locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
          }
        };
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function() {
          console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function() {
          console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
          console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
          console.log("cancel event fired");
        });
        $('#options1').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function() {
          $('#reportrange').data('daterangepicker').remove();
        });
      });



  
  var rcount = 1;
  $('#addnewreq').click(function(){
    var box = $('#newreqBox').html();
    //$('.stepContainer').attr('style','height:'+($('.stepContainer').height()+200)+'px');
    $('#reqBox').append('<div class="reqBoxRemove_'+rcount+'"><hr/><div class="form-group"><button rel="'+rcount+'" type="button" class="btn btn-success btn-xs pull-right removenewreq">Remove</button><label class="control-label col-md-3 col-sm-3 col-xs-12">Type</label><div class="col-md-6 col-sm-6 col-xs-12"><div id="gender" class="btn-group" data-toggle="buttons"><label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default"><input type="radio" name="type['+rcount+']" value="1" data-parsley-multiple="gender" data-parsley-id="1"> &nbsp; Skilled &nbsp;</label><label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default"><input type="radio" name="type['+rcount+']" value="2" data-parsley-multiple="gender" data-parsley-id="2"> Un-Skilled</label></div></div></div>'+box+'</div>');
    $('.ddate').daterangepicker({
      singleDatePicker: true,
      calender_style: "picker_4",
      showDropdowns: true,
      locale: {
        format: 'YYYY-MM-DD'
      },
    }, function(start, end, label) {
      console.log(start.toISOString(), end.toISOString(), label);
    });
    rcount++;
  });

$('body').on('click', '.removenewreq', function(){
  var rel = $(this).attr('rel');
  var r = confirm('Are you sure you want to remove it?');
  if(r){
    $('.reqBoxRemove_'+rel).remove();  
  }
  
});


$('#clientreqBtn').click(function(){
  $.ajax( {
      url: BASE_URL+'/company/submitreq',
      type: 'POST',
      data: $('#clientreqform').serialize(),
      success: function(data) {
        var d = JSON.parse(data);
          if(typeof d.error == 'undefined'){
              displayAlert('Success',d.success,'success');
              window.location.reload();
          } else{
              displayAlert('Warning',d.error,'error');
          }
      },
  });
})


$("#check-all, .check-all").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});

$('#trainingBtn').click(function(){
  var postObject = new Object();
  postObject.training_id = $("#training_id").val();
  postObject.labors = $("input[name='trainingLabor[]']:checked").map(function() {return $(this).val();}).get();
  $.ajax( {
      url: BASE_URL+'/training/submittrainingdata',
      type: 'POST',
      data: postObject,
      success: function(data) {
        var d = JSON.parse(data);
          if(typeof d.error == 'undefined'){
              displayAlert('Success',d.success,'success');
              window.location.reload();
          } else{
              displayAlert('Warning',d.error,'error');
          }
      },
  });
})

$('#removetrainingBtn').click(function(){
  var postObject = new Object();
  postObject.training_id = $("#training_id").val();
  postObject.labors = $("input[name='removetrainingLabor[]']:checked").map(function() {return $(this).val();}).get();
  $.ajax( {
      url: BASE_URL+'/training/removefromtraining',
      type: 'POST',
      data: postObject,
      success: function(data) {
        var d = JSON.parse(data);
          if(typeof d.error == 'undefined'){
              displayAlert('Success',d.success,'success');
              window.location.reload();
          } else{
              displayAlert('Warning',d.error,'error');
          }
      },
  });
})


$('#endtrainingBtn').click(function(){
  var r = confirm('Are you sure you want to end training session?');
  if(r){
    var postObject = new Object();
    postObject.training_id = $("#training_id").val();
    $.ajax( {
        url: BASE_URL+'/training/endtraining',
        type: 'POST',
        data: postObject,
        success: function(data) {
          var d = JSON.parse(data);
            if(typeof d.error == 'undefined'){
                displayAlert('Success',d.success,'success');
                window.location.reload();
            } else{
                displayAlert('Warning',d.error,'error');
            }
        },
    });  
  }
})
$('#reguisitionBtn').click(function(){
  var postObject = new Object();
  postObject.requisition_id = $("#requisition_id").val();
  postObject.labors = $("input[name='requisitionLabor[]']:checked").map(function() {return $(this).val();}).get();
  $.ajax( {
      url: BASE_URL+'/requisitions/submitrequisitionsdata',
      type: 'POST',
      data: postObject,
      success: function(data) {
        var d = JSON.parse(data);
          if(typeof d.error == 'undefined'){
              displayAlert('Success',d.success,'success');
              window.location.reload();
          } else{
              displayAlert('Warning',d.error,'error');
          }
      },
  });
})
//remove form temp requisition
$('#tempreguisitionremoveBtn').click(function(){
  var postObject = new Object();
  postObject.requisition_id = $("#requisition_id").val();
  postObject.labors = $("input[name='requisitionLabor[]']:checked").map(function() {return $(this).val();}).get();
  $.ajax( {
      url: BASE_URL+'/requisitions/removerequisitionsdata',
      type: 'POST',
      data: postObject,
      success: function(data) {
        var d = JSON.parse(data);
          if(typeof d.error == 'undefined'){
              displayAlert('Success',d.success,'success');
              window.location.reload();
          } else{
              displayAlert('Warning',d.error,'error');
          }
      },
  });
})
//assign temp requisition
$('#tempreguisitionassignBtn').click(function(){
  var postObject = new Object();
  postObject.requisition_id = $("#requisition_id").val();
  postObject.labors = $("input[name='requisitionLabor[]']:checked").map(function() {return $(this).val();}).get();
  $.ajax( {
      url: BASE_URL+'/requisitions/submitfinalrequisitionsdata',
      type: 'POST',
      data: postObject,
      success: function(data) {
        var d = JSON.parse(data);
          if(typeof d.error == 'undefined'){
              displayAlert('Success',d.success,'success');
              window.location.reload();
          } else{
              displayAlert('Warning',d.error,'error');
          }
      },
  });
})
$('.reqstatusBtn').click(function(){
  var rel = $(this).attr('rel');
  $('.labor_id').val(rel);
})

$('#labreqacceptBtn').click(function(){
var postObject = new Object();
postObject.labor_id = $("#alabor_id").val();
postObject.requisition_id = $("#arequisition_id").val();
postObject.accept_date = $("#accept_date").val();
postObject.job_type = $("#job_type").val();
postObject.salary = $("#asalary").val();
postObject.labors = $("input[name='requisitionLabor[]']:checked").map(function() {return $(this).val();}).get();
$.ajax( {
      url: BASE_URL+'/requisitions/accept',
      type: 'POST',
      data: postObject,//$('#labreqacceptform').serialize(),
      success: function(data) {
        var d = JSON.parse(data);
          if(typeof d.error == 'undefined'){
              displayAlert('Success',d.success,'success');
              window.location.reload();
          } else{
              displayAlert('Warning',d.error,'error');
          }
      },
  });
});


//$('.deactivate').click(function(){
$('body').on('click', '.deactivate', function(){
  var rel = $(this).attr('rel');
  $('.labor_id').val(rel);
});
$('.compdeactivate').click(function(){
  var rel = $(this).attr('rel');
  $('.company_id').val(rel);
});
$('.removedRemarks').click(function(){
  var rel = $(this).attr('rel');
  $('.labor_id').val(rel);
});


$('#remarksBtn').click(function(){
  $.ajax( {
      url: BASE_URL+'/requisitions/removerequisitionlabor',
      type: 'POST',
      data: $('#remarksForm').serialize(),
      success: function(data) {
        var d = JSON.parse(data);
          if(typeof d.error == 'undefined'){
              displayAlert('Success',d.success,'success');
              window.location.reload();
          } else{
              displayAlert('Warning',d.error,'error');
          }
      },
  });
});
$('#labdecBtn').click(function(){
  $.ajax( {
      url: BASE_URL+'/labor/deactivate',
      type: 'POST',
      data: $('#labdecactivateform').serialize(),
      success: function(data) {
        var d = JSON.parse(data);
          if(typeof d.error == 'undefined'){
              displayAlert('Success',d.success,'success');
              window.location.reload();
          } else{
              displayAlert('Warning',d.error,'error');
          }
      },
  });
});



$('.deleteFile').click(function(){
  var th = $(this).attr('rel');
  var r = confirm('Are you sure you want to delete this file?');
  if(r){
    $.ajax( {
      url: BASE_URL+'/labor/deletefile/id/'+$(this).attr('rel'),
      type: 'GET',
      success: function(data) {
        var d = JSON.parse(data);
          if(typeof d.error == 'undefined'){
              displayAlert('Success',d.success,'success');
              $('#file_'+th).remove();
          } else{
              displayAlert('Warning',d.error,'error');
          }
      },
  });
  }
});

$('.deleteSkill').click(function(){
  var r = confirm('Are you sure you want to delete this skill test?');
  if(r){
    $.ajax( {
      url: BASE_URL+'/labor/deleteskill/id/'+$(this).attr('rel'),
      type: 'GET',
      success: function(data) {
        var d = JSON.parse(data);
          if(typeof d.error == 'undefined'){
              displayAlert('Success',d.success,'success');
              window.location.reload();
          } else{
              displayAlert('Warning',d.error,'error');
          }
      },
  });
  }
});


$('.deodeactivate').click(function(){
  var r = confirm('Are you sure you want to activate/deactivate this deo ?');
  if(r){
    var postObject = new Object();
    postObject.deo_id = $(this).attr('rel');
    $.ajax( {
      url: BASE_URL+'/deo/deactivate',
      type: 'POST',
      data: postObject,
      success: function(data) {
        var d = JSON.parse(data);
          if(typeof d.error == 'undefined'){
              displayAlert('Success',d.success,'success');
              window.location.reload();
          } else{
              displayAlert('Warning',d.error,'error');
          }
      },
  });
  }
  
});

$('#labactBtn').click(function(){
  $.ajax( {
      url: BASE_URL+'/labor/deactivate',
      type: 'POST',
      data: $('#labactivateform').serialize(),
      success: function(data) {
        var d = JSON.parse(data);
          if(typeof d.error == 'undefined'){
              displayAlert('Success',d.success,'success');
              window.location.reload();
          } else{
              displayAlert('Warning',d.error,'error');
          }
      },
  });
});
$('#labblkBtn').click(function(){
  $.ajax( {
      url: BASE_URL+'/labor/blklist',
      type: 'POST',
      data: $('#labblkform').serialize(),
      success: function(data) {
        var d = JSON.parse(data);
          if(typeof d.error == 'undefined'){
              displayAlert('Success',d.success,'success');
              window.location.reload();
          } else{
              displayAlert('Warning',d.error,'error');
          }
      },
  });
});

//company buttons
$('#comdecBtn').click(function(){
  $.ajax( {
      url: BASE_URL+'/company/deactivate',
      type: 'POST',
      data: $('#comdecactivateform').serialize(),
      success: function(data) {
        var d = JSON.parse(data);
          if(typeof d.error == 'undefined'){
              displayAlert('Success',d.success,'success');
              window.location.reload();
          } else{
              displayAlert('Warning',d.error,'error');
          }
      },
  });
});
$('#comactBtn').click(function(){
  $.ajax( {
      url: BASE_URL+'/company/activate',
      type: 'POST',
      data: $('#comactivateform').serialize(),
      success: function(data) {
        var d = JSON.parse(data);
          if(typeof d.error == 'undefined'){
              displayAlert('Success',d.success,'success');
              window.location.reload();
          } else{
              displayAlert('Warning',d.error,'error');
          }
      },
  });
});
$('#labreqrejectBtn').click(function(){
  $.ajax( {
      url: BASE_URL+'/requisitions/reject',
      type: 'POST',
      data: $('#labreqrejectform').serialize(),
      success: function(data) {
        var d = JSON.parse(data);
          if(typeof d.error == 'undefined'){
              displayAlert('Success',d.success,'success');
              window.location.reload();
          } else{
              displayAlert('Warning',d.error,'error');
          }
      },
  });
});

$('#closedReqBtn').click(function(){
  $.ajax( {
      url: BASE_URL+'/requisitions/cancelreq',
      type: 'POST',
      data: $('#closedReqForm').serialize(),
      success: function(data) {
        var d = JSON.parse(data);
          if(typeof d.error == 'undefined'){
              displayAlert('Success',d.success,'success');
              window.location.reload();
          } else{
              displayAlert('Warning',d.error,'error');
          }
      },
  });
});

$('.addtrainingResult').click(function(){
  var rel = $(this).attr('rel');
  $('.labor_id').val(rel);
})

$('#trainingResult').click(function(){
  $.ajax( {
      url: BASE_URL+'/training/submitresult',
      type: 'POST',
      data: $('#trainingResultForm').serialize(),
      success: function(data) {
        var d = JSON.parse(data);
          if(typeof d.error == 'undefined'){
              displayAlert('Success',d.success,'success');
              window.location.reload();
          } else{
              displayAlert('Warning',d.error,'error');
          }
      },
  });
});




$('#allRows').click(function(){
  $('.tr_2, .tr_1, .tr_0').removeClass('hide');
});
$('#pendingRow').click(function(){
  $('.tr_2, .tr_1').addClass('hide');
  $('.tr_0').removeClass('hide');
});
$('#acceptRow').click(function(){
  $('.tr_2, .tr_0').addClass('hide');
  $('.tr_1').removeClass('hide');
});

$('#training').click(function(){
  //$('.tr_0').addClass('hide');
  //$('.tr_1').removeClass('hide');
  $('#tr_0').addClass('hide');
  $('#tr_1').removeClass('hide');
  $('#trainingBtn').addClass('hide');
  $('#endtrainingBtn').removeClass('hide');
  $('#removetrainingBtn').removeClass('hide');

  
});
$('#no_training').click(function(){
  //$('.tr_1').addClass('hide');
  //$('.tr_0').removeClass('hide');
  $('#tr_1').addClass('hide');
  $('#tr_0').removeClass('hide');
  $('#removetrainingBtn').addClass('hide');
  $('#endtrainingBtn').addClass('hide');
  $('#trainingBtn').removeClass('hide');
});

$('#reguisitionAttnBtn').click(function(){
  var postObject = new Object();
  postObject.requisition_id = $("#requisition_id").val();date
  postObject.date = $("#date").val();
  postObject.labors = $("input[name='requisitionLabor[]']:checked").map(function() {return $(this).val();}).get();
  $.ajax( {
      url: BASE_URL+'/requisitions/submitattandance',
      type: 'POST',
      data: postObject,
      success: function(data) {
        var d = JSON.parse(data);
          if(typeof d.error == 'undefined'){
              displayAlert('Success',d.success,'success');
              window.location.reload();
          } else{
              displayAlert('Warning',d.error,'error');
          }
      },
  });
})
$('#reguisitionDehireBtn').click(function(){
  var r = confirm('Are you sure you want to dehire applicants?');
  if(r){
    var postObject = new Object();
    postObject.requisition_id = $("#requisition_id").val();
    postObject.date = $("#date").val();
    postObject.labors = $("input[name='requisitionLabor[]']:checked").map(function() {return $(this).val();}).get();
    $.ajax( {
        url: BASE_URL+'/requisitions/submitdehire',
        type: 'POST',
        data: postObject,
        success: function(data) {
          var d = JSON.parse(data);
            if(typeof d.error == 'undefined'){
                displayAlert('Success',d.success,'success');
                window.location.reload();
            } else{
                displayAlert('Warning',d.error,'error');
            }
        },
    });
  }
})





//delete

$('.deleteVillage').click(function(){
  var r = confirm('Are you sure you want to delete it?');
  if(r){
    var id = $(this).attr('rel');
    $.ajax( {
        url: BASE_URL+'/settings/delete/type/village/id/'+id,
        type: 'GET',
        success: function(data) {
          var d = JSON.parse(data);
            if(typeof d.error == 'undefined'){
                displayAlert('Success',d.success,'success');
                window.location.reload();
            } else{
                displayAlert('Warning',d.error,'error');
            }
        },
    });  
  }
})
$('.deleteTehsil').click(function(){
  var r = confirm('Are you sure you want to delete it?');
  if(r){
    var id = $(this).attr('rel');
    $.ajax( {
        url: BASE_URL+'/settings/delete/type/tehsil/id/'+id,
        type: 'GET',
        success: function(data) {
          var d = JSON.parse(data);
            if(typeof d.error == 'undefined'){
                displayAlert('Success',d.success,'success');
                window.location.reload();
            } else{
                displayAlert('Warning',d.error,'error');
            }
        },
    });  
  }
})
$('.deleteDistrict').click(function(){
  var r = confirm('Are you sure you want to delete it?');
  if(r){
    var id = $(this).attr('rel');
    $.ajax( {
        url: BASE_URL+'/settings/delete/type/district/id/'+id,
        type: 'GET',
        success: function(data) {
          var d = JSON.parse(data);
            if(typeof d.error == 'undefined'){
                displayAlert('Success',d.success,'success');
                window.location.reload();
            } else{
                displayAlert('Warning',d.error,'error');
            }
        },
    });  
  }
})
$('.deleteVehicle').click(function(){
  var r = confirm('Are you sure you want to delete it?');
  if(r){
    var id = $(this).attr('rel');
    $.ajax( {
        url: BASE_URL+'/settings/delete/type/vehicle/id/'+id,
        type: 'GET',
        success: function(data) {
          var d = JSON.parse(data);
            if(typeof d.error == 'undefined'){
                displayAlert('Success',d.success,'success');
                window.location.reload();
            } else{
                displayAlert('Warning',d.error,'error');
            }
        },
    });  
  }
})

$('.deleteBlacklist').click(function(){
  var r = confirm('Are you sure you want to delete it?');
  if(r){
    var id = $(this).attr('rel');
    $.ajax( {
        url: BASE_URL+'/settings/delete/type/blacklist/id/'+id,
        type: 'GET',
        success: function(data) {
          var d = JSON.parse(data);
            if(typeof d.error == 'undefined'){
                displayAlert('Success',d.success,'success');
                window.location.reload();
            } else{
                displayAlert('Warning',d.error,'error');
            }
        },
    });  
  }
})

$('.deleteDeactivate').click(function(){
  var r = confirm('Are you sure you want to delete it?');
  if(r){
    var id = $(this).attr('rel');
    $.ajax( {
        url: BASE_URL+'/settings/delete/type/deactivate/id/'+id,
        type: 'GET',
        success: function(data) {
          var d = JSON.parse(data);
            if(typeof d.error == 'undefined'){
                displayAlert('Success',d.success,'success');
                window.location.reload();
            } else{
                displayAlert('Warning',d.error,'error');
            }
        },
    });  
  }
})


$('.deletereject').click(function(){
  var r = confirm('Are you sure you want to delete it?');
  if(r){
    var id = $(this).attr('rel');
    $.ajax( {
        url: BASE_URL+'/settings/delete/type/reject/id/'+id,
        type: 'GET',
        success: function(data) {
          var d = JSON.parse(data);
            if(typeof d.error == 'undefined'){
                displayAlert('Success',d.success,'success');
                window.location.reload();
            } else{
                displayAlert('Warning',d.error,'error');
            }
        },
    });  
  }
})





$('#printTable').click(function(){
      
  var divToPrint_generator = document.getElementById('attandanceSheet');
  newWin = window.open("");
  /*newWin.document.write("<style>#attandanceSheet tr td label{display: inline-block;margin-bottom:5px;}#attandanceSheet tr td p{display:inline-block;margin-bottom:5px;margin-left:5px;}#logTable, #logTable_kesc, #logTable_eps, #logTable_alert, #attandanceSheet {border: 1px solid #ddd!important;}#logTable th,#logTable tbody tr,#logTable tbody tr td{border: 1px solid #ddd!important;}#logTable_kesc th,#logTable_kesc tbody tr,#logTable_kesc tbody tr td{border: 1px solid #ddd!important;}#logTable_eps th,#logTable_eps tbody tr,#logTable_eps tbody tr td{border: 1px solid #ddd!important;}#logTable_alert th,#logTable_alert tbody tr,#logTable_alert tbody tr td{border: 1px solid #ddd!important;}#logTable tbody tr td{text-align:center}#logTable_kesc tbody tr td{text-align:center}#logTable_eps tbody tr td{text-align:center}#attandanceSheet tbody th{border: 1px solid #ddd!important;}#attandanceSheet tbody tr td{border: 1px solid #ddd!important;}#logTable tbody tr td{text-align:center}</style>");
  newWin.document.write('<h3>'+divToHeading.outerHTML+'</h3>');*/
  var ht = $('#sheetReq').html()+'<br/>'+$('#sheetReqinfo').html();
  var date = 'Date Range: '+$('#sheetDate').html();
  newWin.document.write("<style>#attandanceSheet{width:100%} #attandanceSheet tr td label{display: inline-block;margin-bottom:5px;}#attandanceSheet tr td p{display:inline-block;margin-bottom:5px;margin-left:5px;}#logTable, #logTable_kesc, #logTable_eps, #logTable_alert, #attandanceSheet {border: 1px solid #ddd!important;}#logTable th,#logTable tbody tr,#logTable tbody tr td{border: 1px solid #ddd!important;}#logTable_kesc th,#logTable_kesc tbody tr,#logTable_kesc tbody tr td{border: 1px solid #ddd!important;}#logTable_eps th,#logTable_eps tbody tr,#logTable_eps tbody tr td{border: 1px solid #ddd!important;}#logTable_alert th,#logTable_alert tbody tr,#logTable_alert tbody tr td{border: 1px solid #ddd!important;}#logTable tbody tr td{text-align:center}#logTable_kesc tbody tr td{text-align:center}#logTable_eps tbody tr td{text-align:center}#attandanceSheet tbody th{border: 1px solid #ddd!important;}#attandanceSheet tbody tr td{border: 1px solid #ddd!important;}#logTable tbody tr td{text-align:center}.col-md-4{float:left;width:25%;}.companyCode{text-align:center;}h3{text-align:center;}</style>");
  newWin.document.write("<h5>"+ht+"</h5>");  
  newWin.document.write("<div class='col-md-4'><p style='font-weight:bold'>"+date+"</p></div>");  
  newWin.document.write(divToPrint_generator.outerHTML);
  newWin.document.write("<br/>"); 
  
  
  
  newWin.print();
  newWin.close();
});
    

    </script>
    <!-- /bootstrap-daterangepicker -->

    <!-- gauge.js -->
    
    <!-- /gauge.js -->
  </body>
</html>
