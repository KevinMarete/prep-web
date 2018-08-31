<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url() . 'manager/home' ?>">PrEP</a>        
    </div>
    <!-- /.navbar-header -->
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="#">
                        <b> <?= $this->session->userdata('role'); ?></b>
                        <br>
                        <br>
                        <i class="fa fa-user fa-fw"></i> 
                        <?= $this->session->userdata('first_name'); ?>
                        <?= $this->session->userdata('last_name'); ?>
                    </a>                   
                </li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url() . 'manager/logout'; ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a class="dashboard" href="<?php echo base_url() . 'ftp'; ?>"><i class="fa fa-file-archive-o fa-fw"></i> Resources</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . 'ftp'; ?>"><i class="fa fa-users"></i> Users</a> 
                </li>
            </ul>

        </div>
        <!--/.sidebar-collapse -->
    </div>
</nav>