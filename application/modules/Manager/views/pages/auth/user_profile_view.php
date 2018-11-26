<!-- Add/Edit modal -->
<div class="" id="modal_form" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Person Form</h3>
                </div>
                <div class="modal-body form">
                    <form action="#" id="form" class="form-horizontal">
                        <input type="hidden" value="" name="id"/> 
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
                                        <option value="<?= $role->roleId ?>" <?php if($role->roleId == $user->roleId) {echo 'selected';}else{$scope_help = 'Please select Role.';}  ?> ><?= $role->role ?></option>
                                    <?php }?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                    <label class="control-label col-md-3">Organization</label>
                                    <div class="col-md-9">
                                        <input class="form-control" placeholder="e.g NASCOP" name="user_org" type="text" required="" value="<?= $user->organization ?>" >
                                        <span class="help-block"><?php $user->organization ?? 'Please enter your Organization.' ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Scope</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="user_scope" type="text" required="">
                                        <option value="0">Select Scope</option>
                                            <?php foreach($scopes as $scope) {?>
                                                <option value="<?php echo $scope->id ?>"  <?php if($scope->id == $user->scope) {echo ' selected'; } else { $scope_help = 'Please select Scope.';}?> ><?php echo $scope->scope; ?></option>
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
                                                <option value="<?php echo $county->id ?>" <?php if($county->id == $user->county) {echo ' selected';}?> ><?php echo ucfirst($county->name)?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="help-block"></span>
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
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-default">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->