<!-- Add/Edit modal -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="NASCOP">
        <meta name="author" content="NASCOP">
        <title>PrEP | Register</title>
        <!--styles_view-->
        <?php $this->load->view('style_view'); ?>
</head>
<body>
<a class ="btn btn-primary" href="<?php echo base_url().'dashboard' ?>"><span class ="glyphicon glyphicon-arrow-left">&nbsp;</span>Go back to dashboard</a>
<div class="" id="reg_form" role="dialog">
        <div class="modal-dialog">
            <div :class="updateStatus">{{updateMessage}}</div>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"><?= $user->first_name.' '.$user->last_name ?></h3>
                </div>
                <form v-on:submit.prevent ="updateUser" id="userUpdateForm" class="form-horizontal" method="post">
                <div class="modal-body form">
                    
                        <input type="hidden" value="<?=$user->id?>" name="id"/> 
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">First Name</label>
                                <div class="col-md-9">
                                    <input name="first_name" placeholder="First Name" class="form-control" type="text" value="<?= $user->first_name ?>">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Last Name</label>
                                <div class="col-md-9">
                                    <input name="last_name" placeholder="Last Name" class="form-control" type="text" value="<?= $user->last_name ?>" >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Email</label>
                                <div class="col-md-9">
                                    <input name="email" placeholder="Email" class="form-control" type="text" value="<?= $user->email ?>" >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Mobile</label>
                                <div class="col-md-9">
                                    <input name="mobile" placeholder="07XXXXXXXX" class="form-control" type="text" value="<?= $user->mobile ?>" >                                    
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Role</label>
                                <div class="col-md-9">
                                    <select name="roleId" class="form-control">
                                    <?php foreach($roles as $role){ ?>
                                        <option value="<?= $role->roleId ?>" <?php if($role->roleId == $user->roleId) {echo 'selected';} ?> ><?= $role->role ?></option>
                                    <?php }?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                    <label class="control-label col-md-3">Organization</label>
                                    <div class="col-md-9">
                                        <input class="form-control" placeholder="e.g NASCOP" name="user_org" type="text" required="" value="<?= $user->organization ?>" >
                                        <span class="help-block"><?php if (empty($user->organization)) {echo 'Please enter your Organization.';}  ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Scope</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="user_scope" type="text" required="">
                                        <option value="0">Select Scope</option>
                                            <?php foreach($scopes as $scope) {?>
                                                <option value="<?php echo $scope->id ?>"  <?php if($scope->id == $user->scope) {echo ' selected'; }?> ><?php echo $scope->scope; ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="help-block error-msg"><?= $scope_help ?? '' ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">County</label>
                                    <div class="col-md-9">
                                    <select class="form-control" name="user_county" type="text" required="" v-model="county">
                                        <option value="0">Select County</option>
                                            <?php foreach($counties as $county){ ?>
                                                <option value="<?php echo $county->id ?>" <?php if($county->id == $user->county) {echo ' selected'; $county_help = $county->name;} if(empty($user->county)){$county_help = "Please select County";}?> ><?php echo ucfirst($county->name)?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="help-block"><?= $county_help ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Sub County</label>
                                    <div class="col-md-9">
                                    <select class="form-control" name="user_subcounty" type="text" required="">
                                    <option v-for="subcounty in subcounties" :value="subcounty.id">{{subcounty.name}}</option>
                                    </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class = "form-group">
                                    <label class="control-label col-md-3">Change Password</label>
                                    <div class="col-md-9">
                                    <input v-on:click="changePwd=!changePwd" type="checkbox" name="password_change_toggle">
                                    </div>
                                </div>
                            <div v-bind:class="{hidden:changePwd}" class = "">
                                <div class="modal-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Current Password</label>
                                    <div class="col-md-9">
                                        <input class="form-control" name="password" type="password">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">New Password</label>
                                    <div class="col-md-9">
                                        <input class="form-control" name="new_password" type="password">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Confirm New Password</label>
                                    <div class="col-md-9">
                                        <input class="form-control" name="new_password_confirm" type="password">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            </div>
                   
                </div>
                <div class="modal-footer">
                    <input type="submit" id="btnSave" class="btn btn-default">
                </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->
    <?php $this->load->view('script_view'); ?>
</body>
