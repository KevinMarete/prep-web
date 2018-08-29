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
                        <?= $this->session->userdata('role'); ?>
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
                    <a href="<?php echo base_url() . 'manager/home' ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <?php
                $roleId = $this->session->userdata('roleId');
                if ($roleId == ROLE_ADMIN) {
                    ?>
                    <li>
                        <a href = "<?php echo base_url('anager/Backup'); ?>"><i class = "fa fa-files-o fa-fw"></i> Backups</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i> Settings<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level" id="list">
                            <li>
                                <a href="<?php echo base_url('Manager/Settings/Category'); ?>">Category</a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                <?php }
                ?>
                <li>
                    <a href = "#"><i class = "fa fa-bar-chart-o fa-fw"></i> Reports</a>
                </li>
            </ul>
        </div>
        <!--/.sidebar-collapse -->
    </div>
    <!--/.navbar-static-side -->
</nav>

<!---script to sort settings nav links alphabetically--->
<script src = "<?php echo base_url() . 'public/admin/js/settings_sort_nav_links.js'; ?>"></script>
<script src = "<?php echo base_url() . 'public/admin/js/nav_dropdown.js'; ?>"></script>