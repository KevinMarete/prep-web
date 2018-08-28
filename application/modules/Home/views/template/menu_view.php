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
            <ul class="nav navbar-nav navbar-right" id="main_tabs">
                <li class="active"><a href="#service_delivery" aria-controls="service_delivery" role="tab" data-toggle="tab">PrEP</a></li>
                <li>
                    <a href="<?php echo base_url() . 'Admin/Admin'; ?>" target="_blank">
                        <span class="glyphicon glyphicon-log-in"></span> Login
                    </a>
                </li>
            </ul>
        </div>
        <nav class="collapse navbar-collapse" id="filter-navbar">

        </nav>
    </div>
</div>
<script src = "<?php echo base_url() . 'public/admin/js/nav_dropdown.js'; ?>"></script>