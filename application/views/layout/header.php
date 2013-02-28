<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <title>钢筋翻样应用</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width">

      <!-- ===================== TOUCH ICONS ===================== -->
      <link rel="shortcut icon" href="<?php echo base_url('favicon.ico') ?>">
      <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url() ?>">
      <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url() ?>">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url() ?>">
      <link rel="apple-touch-icon-precomposed" href="<?php echo base_url() ?>">

      <!-- ===================== MASTER CSS ===================== -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jasny-bootstrap.min.css') ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.min.css') ?>">
      
      <!-- ===================== ICONS CSS ===================== -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/icon/fugue.min.css') ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/icon/font-awesome.min.css') ?>">
    
      <!-- ===================== SITE CSS ===================== -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/default.min.css') ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/default.responsive.min.css') ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css') ?>">
      
  
      <script src="<?php echo base_url('js/vendors/modernizr-2.6.2.min.js') ?>"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">你正在使用 <strong>落伍了的</strong> 浏览器. 请 <a href="http://browsehappy.com/">更新你的浏览器</a> 或者 <a href="http://www.google.com/chromeframe/?redirect=true">使用 Google Chrome </a> 来提升你的体验.</p>
        <![endif]-->
        <div id="loading-block">加载中...</div>
        <div id="wrapper">
            <div id="wrapper-inner" class="pattern6">
                <!-- Start Main Header -->
                <div id="main-header">
                  <div class="container-fluid">
                    <div class="row-fluid">
                      <div class="span12">
                        <div class="title">
                            <h1>钢筋翻样应用</h1>
                        </div>

                        <?php if ($this->session->userdata('auth') != null) { ?>
                        <!-- Start Header Panel -->
                        <div class="header-panel">
                          <div id="dropdown-patterns" class="dropdown" rel="tooltip" data-placement="left" title="个人设置">
                            <a href="#" class="menu dropdown-toggle">
                              <i class="icon iconfa-cog"></i>
                            </a>
                          </div>

                          <div id="dropdown-patterns" class="dropdown" rel="tooltip" data-placement="left" title="退出">
                            <a href="<?php echo base_url('user/logout') ?>" class="menu dropdown-toggle">
                              <i class="cion iconfa-off"></i>
                            </a>
                          </div>
                          <a href="#" class="menu" id="menu-phone" data-menu="mobile"><i class="icon iconfa-tasks"></i></a>
                          <!-- <div id="dropdown-search" class="dropdown">
                            <a href="#" class="menu dropdown-toggle" data-toggle="dropdown">
                              <i class="icon iconfa-search"></i>
                            </a>
                            <div class="dropdown-menu pull-right" role="menu">
                              <form>
                                <input name="search" type="text" class="span12" placeholder="Enter keyword...">
                              </form>
                            </div>
                          </div> -->
                        </div>
                        <!-- End Header Panel -->
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Main Header -->
                <?php $user_session = $this->session->userdata('auth'); ?>