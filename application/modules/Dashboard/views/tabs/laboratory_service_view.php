<div role="tabpanel" class="tab-pane" id="laboratory_service">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Creatinine Testing Availability</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#creatinine_testing_availability_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="creatinine_testing_availability_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="creatinine_testing_availability_chart_heading heading"></span>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div>
</div>
<!--modal(s)-->
<!--creatinine_testing_availability_chart filter modal-->
<div class="modal fade" id="creatinine_testing_availability_chart_filter_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><strong>Creatinine Testing Availability</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <select id="creatinine_testing_availability_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                    </div>
                    <div class="col-sm-3">
                        <button id="creatinine_testing_availability_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                        <button id="creatinine_testing_availability_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>