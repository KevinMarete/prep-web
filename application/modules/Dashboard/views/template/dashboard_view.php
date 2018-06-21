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
        <!--filter-->
        <?php $this->load->view('template/filter_view'); ?>
        <!--tabbed-panes-->
        <div class="tab-content"><div class="tab-content">
                <!--facility_service_view-->
                <?php $this->load->view('tabs/facility_service_view'); ?>
                <!--partner_support-->
                <?php $this->load->view('tabs/partner_support_view'); ?>
            </div>
        </div>
        <!--footer-->
        <hr>
        <p class="small text-muted">NASCOP &copy; 2017-<?php echo date('Y'); ?>. All Rights Reserved</p>
        <!--scripts-->
        <?php $this->load->view('template/script_view'); ?>
    </body>
</html>