<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="NASCOP">
        <meta name="author" content="NASCOP">
        <title>PrEP | Login</title>
        <!--style_view-->
        <?php $this->load->view('style_view'); ?>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading text-center">
                            <img src="<?php echo base_url() . 'public/login/img/user_favicon.ico'; ?>" class="img-responsive center-block" alt="prep_logo">
                            <h1>PrEP</h1>
                            <h3 class="panel-title"><b>Please Sign In</b></h3>
                        </div>
                        <?php
                        $success_msg = $this->session->flashdata('success_msg');
                        $error_msg = $this->session->flashdata('error_msg');

                        if ($success_msg) {
                            ?>
                            <div class="alert alert-success">
                                <?php echo $success_msg; ?>
                            </div>
                            <?php
                        }
                        if ($error_msg) {
                            ?>
                            <div class="alert alert-danger">
                                <?php echo $error_msg; ?>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="panel-body">
                            <form role="form" action="<?php echo base_url() . 'manager/loginme'; ?>" method="POST">
                                <fieldset>
                                    <div class="form-group has-feedback">
                                        <input class="form-control" placeholder="E-mail Address" name="email" id="email" type="email" autofocus required>
                                        <span class="help-block glyphicon glyphicon-envelope form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input class="form-control" placeholder="Password" name="password" id="password" type="password" autofocus required>
                                        <span class="help-block glyphicon glyphicon-lock form-control-feedback"></span>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                        </label>
                                    </div>
                                    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Login" name="login" id="login_button">
                                </fieldset>
                            </form>
                            <center><b>Not yet registered ?</b> 
                                <br>
                                </b>
                                <a href="<?php echo base_url('manager/register'); ?>">Register here <i class="fa fa-arrow-circle-o-right"></i></a>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--script_view-->
        <?php $this->load->view('script_view'); ?>
    </body>
</html>