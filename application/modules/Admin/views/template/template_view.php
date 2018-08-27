<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="NASCOP">
    <meta name="author" content=NASCOP"">
    <title><?php echo $page_title; ?></title>
    <!--Styles-->
    <?php $this->load->view('styles_view'); ?>
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php $this->load->view('navbar_view'); ?>
        <!-- Content -->
        <?php // $this->load->view($content_view); ?>
        <!--navbar-->
        <?php $this->load->view('template/menu_view'); ?>
        <!--filter-->
        <?php $this->load->view('template/filter_view'); ?>
        <!--tabbed-panes-->
        <div class="tab-content">
            <!--service_delivery_view-->
            <?php $this->load->view('tabs/service_delivery_view'); ?>
            <!--laboratory_summary_view-->
            <?php $this->load->view('tabs/laboratory_summary_view'); ?>
            <!--laboratory_creatinine_view-->
            <?php $this->load->view('tabs/laboratory_creatinine_view'); ?>
            <!--laboratory_hep_b_view-->
            <?php $this->load->view('tabs/laboratory_hep_b_view'); ?>
            <!--laboratory_hep_c_view-->
            <?php $this->load->view('tabs/laboratory_hep_c_view'); ?>
            <!--human_resource_view-->
            <?php $this->load->view('tabs/human_resource_view'); ?>
            <!--commodity_management_view-->
            <?php $this->load->view('tabs/commodity_management_view'); ?>
            <!--monitoring_evaluation_view-->
            <?php $this->load->view('tabs/monitoring_evaluation_view'); ?>
            <!--communication_advocacy_view-->
            <?php $this->load->view('tabs/communication_advocacy_view'); ?>
    </div>
    <!--Scripts-->
    <?php $this->load->view('scripts_view'); ?>
</body>
</html>