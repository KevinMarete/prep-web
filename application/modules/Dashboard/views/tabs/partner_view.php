<div role="tabpanel" class="tab-pane" id="partner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Partner Support</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#partner_support_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="partner_support_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="partner_support_chart_heading heading"></span>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        <div class="row">
            <div class="col-md-5">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Key Populations Targeted by PrEP Partners</strong>
                    </div>
                    <div class="chart-stage">
                        <div id="key_populations_targeted_by_prep_partner_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="key_populations_targeted_by_prep_partner_chart_heading heading"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Service Delivery Points by Partners</strong>
                    </div>
                    <div class="chart-stage">
                        <div id="service_delivery_point_by_partner_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="service_delivery_point_by_partner_chart_heading heading"></span>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        <div class="row">
            <div class="col-md-12">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Distribution of Trained Workers by Partners</strong>
                    </div>
                    <div class="chart-stage">
                        <div id="hcw_trained_by_partner_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="hcw_trained_by_partner_chart_heading heading"></span>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        <div class="row">
            <div class="col-md-12">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Partner Facility Numbers
                            <span class="label label-danger">Revisit grouping</span>
                        </strong>
                    </div>
                    <div class="chart-stage">
                        <div id="partner_facility_table"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="partner_facility_table_heading heading"></span>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div>
</div>
<!--partner_support_chart filter modal-->
<div class="modal fade" id="partner_support_chart_filter_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><strong>Partner Support</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <select id="partner_support_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                    </div>
                    <div class="col-sm-3">
                        <button id="partner_support_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                        <button id="partner_support_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>