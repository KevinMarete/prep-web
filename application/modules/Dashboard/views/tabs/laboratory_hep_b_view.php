<div role="tabpanel" class="tab-pane" id="laboratory_hep_b">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Access to Hep-B Testing in Facilities (By County)</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#access_hep_b_testing_facilities_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="access_hep_b_testing_facilities_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="access_hep_b_testing_facilities_chart_heading heading"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Access to Hep-B Testing in Facilities</strong>
                    </div>
                    <div class="chart-stage">
                        <div id="access_hep_b_testing_facilities_table"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="access_hep_b_testing_facilities_table_heading heading"></span>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        <div class="row">
            <div class="col-md-12">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Hep-B Testing Equipment Availability</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#hep_b_testing_equipment_availability_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="hep_b_testing_equipment_availability_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="hep_b_testing_equipment_availability_chart_heading heading"></span>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        <div class="row">
            <div class="col-md-8">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Offsite vs Onsite Hep-B Testing (By County)</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#offsite_onsite_hep_b_testing_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="offsite_onsite_hep_b_testing_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="offsite_onsite_hep_b_testing_chart_heading heading"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Offsite vs Onsite Hep-B Testing</strong>
                    </div>
                    <div class="chart-stage">
                        <div id="offsite_onsite_hep_b_testing_table"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="offsite_onsite_hep_b_testing_table_heading heading"></span>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div>
</div>
<!--modals-->
<!--access_hep_b_testing_facilities_chart filter modal-->
<div class="modal fade" id="access_hep_b_testing_facilities_chart_filter_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><strong>Access to Hep-B Testing in Facilities</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <select id="access_hep_b_testing_facilities_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                    </div>
                    <div class="col-sm-3">
                        <button id="access_hep_b_testing_facilities_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                        <button id="access_hep_b_testing_facilities_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--hep_b_testing_equipment_availability_chart filter modal-->
<div class="modal fade" id="hep_b_testing_equipment_availability_chart_filter_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><strong>Hep-B Testing Equipment Availability</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <select id="hep_b_testing_equipment_availability_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                    </div>
                    <div class="col-sm-3">
                        <button id="hep_b_testing_equipment_availability_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                        <button id="hep_b_testing_equipment_availability_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--offsite_onsite_hep_b_testing_chart filter modal-->
<div class="modal fade" id="offsite_onsite_hep_b_testing_chart_filter_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><strong>Offsite vs Onsite Hep-B Testing</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <select id="offsite_onsite_hep_b_testing_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                    </div>
                    <div class="col-sm-3">
                        <button id="offsite_onsite_hep_b_testing_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                        <button id="offsite_onsite_hep_b_testing_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>