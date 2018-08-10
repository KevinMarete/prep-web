<div role="tabpanel" class="tab-pane" id="commodity_management">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Source of ARVs in Facilities</strong>
                    </div>
                    <div class="chart-stage">
                        <div id="facility_source_of_ARVs_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="facility_source_of_ARVs_chart_heading heading"></span>
                    </div>
                </div>
            </div>
              <div class="col-md-8">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Facility Source of ARVs by County</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#facility_source_of_arvs_by_county_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="facility_source_of_arvs_by_county_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="facility_source_of_arvs_by_county_chart_heading heading"></span>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        <div class="row">
            <div class="col-md-12">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>PrEP Dispensing Points in Facilities</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#prep_dispensing_points_in_facilities_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="prep_dispensing_points_in_facilities_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="prep_dispensing_points_in_facilities_chart_heading heading"></span>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div>
</div>
<!--modal(s)-->
<!--facility_source_of_arvs_by_county_chart filter modal-->
<div class="modal fade" id="facility_source_of_arvs_by_county_chart_filter_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><strong>Facility Source of ARVs by County</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <select id="facility_source_of_arvs_by_county_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                    </div>
                    <div class="col-sm-3">
                        <button id="facility_source_of_arvs_by_county_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                        <button id="facility_source_of_arvs_by_county_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--prep_dispensing_points_in_facilities_chart filter modal-->
<div class="modal fade" id="prep_dispensing_points_in_facilities_chart_filter_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><strong>PrEP Dispensing Points in Facilities</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <select id="prep_dispensing_points_in_facilities_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                    </div>
                    <div class="col-sm-3">
                        <button id="prep_dispensing_points_in_facilities_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                        <button id="prep_dispensing_points_in_facilities_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>