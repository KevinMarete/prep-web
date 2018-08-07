<div role="tabpanel" class="tab-pane active" id="service_delivery">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Facility Count</strong> <span class="label label-warning">Drilldown</span>
                    </div>
                    <div class="chart-stage">
                        <div id="facility_count_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="facility_count_chart_heading heading"></span>
                    </div>
                </div>
            </div>
        </div><!--end row-->
           <div class="row">
            <div class="col-md-12">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>PrEP Focal Person</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#prep_focal_person_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="prep_focal_person_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="prep_focal_person_chart_heading heading"></span>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div>
</div>
<!--modal(s)-->
<!--prep_focal_person_chart filter modal-->
<div class="modal fade" id="prep_focal_person_chart_filter_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><strong>PrEP Focal Person</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <select id="prep_focal_person_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                    </div>
                    <div class="col-sm-3">
                        <button id="prep_focal_person_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                        <button id="prep_focal_person_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>