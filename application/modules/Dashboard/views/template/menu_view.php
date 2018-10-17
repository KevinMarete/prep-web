<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <span class="glyphicon glyphicon-dashboard"></span>
            </a>
            <a class="navbar-brand" href="#">PrEP DASHBOARD</a>
        </div>
        <nav class="collapse navbar-collapse" id="filter-navbar">
            <input type="hidden" name="filter_tab" id="filter_tab" value="" />
            <ul class="nav navbar-nav navbar-right" id="main_tabs">
                <li class="active"><a href="#service_delivery" aria-controls="service_delivery" role="tab" data-toggle="tab">Service Delivery</a></li>
                <li><a href="#partner" aria-controls="partner" role="tab" data-toggle="tab">Partner Service</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Laboratory Service
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#laboratory_creatinine" aria-controls="laboratory_creatinine" role="tab" data-toggle="tab">Creatinine</a></li>
                        <li><a href="#laboratory_hep_b" aria-controls="laboratory_hep_b" role="tab" data-toggle="tab">Hep B</a></li>
                        <li><a href="#laboratory_hep_c" aria-controls="laboratory_hep_c" role="tab" data-toggle="tab">Hep C</a></li>
                    </ul>
                </li>
                <li><a href="#human_resource" aria-controls="human_resource" role="tab" data-toggle="tab">Human Resource</a></li>
                <li><a href="#commodity_management" aria-controls="commodity_management" role="tab" data-toggle="tab">Commodity Management</a></li>
                <li><a href="#monitoring_evaluation" aria-controls="monitoring_evaluation" role="tab" data-toggle="tab">Monitoring &amp; Evaluation</a></li>
                <li><a href="#communication_advocacy" aria-controls="communication_advocacy" role="tab" data-toggle="tab">Communication &amp; Advocacy</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i> <?= ucwords($this->session->userdata('first_name').' '.$this->session->userdata('last_name')); ?> <i class="caret"></i>                      
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="#">
                                <b><?= $this->session->userdata('role'); ?></b>
                            </a> 
                        </li>
                        <li><a href="<?php echo base_url('manager/file_upload'); ?>" onclick="window.location.reload(true);"> <span class="glyphicon glyphicon-wrench"></span> My Settings</a>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url() . 'manager/logout'; ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>