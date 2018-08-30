<div role="tabpanel" class="tab-pane" id="manage_user">
    <div class="container" style="padding-top: 10px">    
        <button class="btn btn-primary" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add Patient</button>
        <button class="btn btn-success" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>
        <br />
        <br />
        <table id="table" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date Of Birth</th>
                    <th>Gender</th>
                    <th>Type Of Service</th>
                    <th>General Observations</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        var save_method;
        var table;

        $(document).ready(function () {
            //datatables
            table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('Dashboard/Manage_user/ajax_list') ?>",
                    "type": "POST"
                },
                "columnDefs": [
                    {
                        "targets": [-1],
                        "orderable": false,
                    },
                ],
            });

            //datepicker
            $('.datepicker').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd",
                todayHighlight: true,
                orientation: "top auto",
                todayBtn: true,
                todayHighlight: true,
            });

            $("input").change(function () {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("textarea").change(function () {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("select").change(function () {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
        });

        function add_person()
        {
            save_method = 'add';
            $('#form')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $('#modal_form').modal('show');
            $('.modal-title').text('Add Patient');
        }

        function edit_person(id)
        {
            save_method = 'update';
            $('#form')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();

            $.ajax({
                url: "<?php echo base_url('Dashboard/Manage_user/ajax_edit/') ?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data)
                {
                    $('[name="id"]').val(data.id);
                    $('[name="name"]').val(data.name);
                    $('[name="dob"]').datepicker('update', data.dob);
                    $('[name="gender"]').val(data.gender);
                    $('[name="type_of_service"]').val(data.type_of_service);
                    $('[name="general_observations"]').val(data.general_observations);

                    $('#modal_form').modal('show');
                    $('.modal-title').text('Edit Patient');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function reload_table()
        {
            table.ajax.reload(null, false);
        }

        function save()
        {
            $('#btnSave').text('saving...');
            $('#btnSave').attr('disabled', true);
            var url;

            if (save_method == 'add') {
                url = "<?php echo base_url('Dashboard/Manage_user/ajax_add') ?>";
            } else {
                url = "<?php echo base_url('Dashboard/Manage_user/ajax_update') ?>";
            }
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function (data)
                {
                    if (data.status)
                    {
                        $('#modal_form').modal('hide');
                        reload_table();
                    } else
                    {
                        for (var i = 0; i < data.inputerror.length; i++)
                        {
                            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                        }
                    }
                    $('#btnSave').text('save');
                    $('#btnSave').attr('disabled', false);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                    $('#btnSave').text('save');
                    $('#btnSave').attr('disabled', false);
                }
            });
        }

        function delete_person(id)
        {
            if (confirm('Are you sure delete this data?'))
            {
                $.ajax({
                    url: "<?php echo base_url('Dashboard/Manage_user/ajax_delete') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data)
                    {
                        $('#modal_form').modal('hide');
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    }
                });
            }
        }
    </script>

    <!-- Bootstrap modal -->
    <div class="modal fade" id="modal_form" role="dialog">
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
                                <label class="control-label col-md-3">Name</label>
                                <div class="col-md-9">
                                    <input name="name" placeholder="Name" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Date of Birth</label>
                                <div class="col-md-9">
                                    <input name="dob" placeholder="YYYY-MM-DD" class="form-control datepicker" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Gender</label>
                                <div class="col-md-9">
                                    <select name="gender" class="form-control">
                                        <option value="">--Select Gender--</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Type Of Service</label>
                                <div class="col-md-9">
                                    <select name="type_of_service" class="form-control">
                                        <option value="">--Select Type Of Service--</option>
                                        <option value="art">ART</option>
                                        <option value="prep">PREP</option>
                                        <option value="pep">PEP</option>
                                        <option value="oi">OI</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">General Observations</label>
                                <div class="col-md-9">
                                    <textarea name="general_observations" placeholder="General Observation" class="form-control"></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bootstrap modal -->
</div>