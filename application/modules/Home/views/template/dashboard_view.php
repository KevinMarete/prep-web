<!DOCTYPE html>
<html>
    <head>
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <!--title-->
        <title><?php echo $page_title; ?></title>
        <!--styles-->
        <?php $this->load->view('template/style_view'); ?>
    </head>
    <body class="application">
        <!--navbar-->
        <?php $this->load->view('template/menu_view'); ?>
        <!--tabbed-panes-->
        <div class="tab-content">
            <!--service_delivery_view-->
            <?php $this->load->view('tabs/service_delivery_view'); ?>            
        </div>

        <!--footer-->
        <hr>
        <p class="small text-muted">NASCOP &copy; 2017-<?php echo date('Y'); ?>. All Rights Reserved</p>
        <!--scripts-->
        <?php $this->load->view('template/script_view'); ?>
    </body>
</html>