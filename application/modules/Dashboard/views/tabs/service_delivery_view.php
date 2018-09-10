<div role="tabpanel" class="tab-pane active" id="service_delivery">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Distribution of Facilities by Level
                            <span class="label label-danger">Conflicting ID for Dice and Other (specify)</span>
                        </strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#facilities_level_distribution_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="facilities_level_distribution_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="facilities_level_distribution_chart_heading heading"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>PrEP Focal Person in Facilities</strong>
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
        <div class="row">
            <div class="col-md-6">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Distribution of Hiv Services in Facilities Assessed Nationally</strong>
                    </div>
                    <div class="chart-stage">
                        <div id="hiv_services_offered_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="hiv_services_offered_chart_heading heading"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Distribution of Current Service Delivery Points
                            <span class="label label-danger">Conflicting Id for PMTCT Clinic,MCH,Other and IPD</span>
                        </strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#current_service_delivery_points_distribution_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="current_service_delivery_points_distribution_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="current_service_delivery_points_distribution_chart_heading heading"></span>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        <div class="row">
            <div class="col-md-6">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>PrEP Availability by Facility Level</strong>
                    </div>
                    <div class="chart-stage">
                        <div id="facility_level_prep_availability_table"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="facility_level_prep_availability_table_heading heading"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Distribution of Current Service Delivery Points Numbers</strong>
                    </div>
                </div>
                <div class="chart-stage">
                    <div id="current_service_delivery_points_distribution_table"></div>
                </div>
                <div class="chart-notes">
                    <span class="current_service_delivery_points_distribution_table_heading heading"></span>
                </div>
            </div>
        </div><!--end row-->
        <div class="row">
            <div class="col-md-6">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Distribution of Preferred Service Delivery Points</strong>
                    </div>
                    <div class="chart-stage">
                        <div id="preferred_service_delivery_point_table"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="preferred_service_delivery_point_table_heading heading"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Populations Targeted for PrEP by Facilities 
                            <span class="label label-danger">Conflicting ID for PWID and MSM</span>
                        </strong>
                    </div>
                    <div class="chart-stage">
                        <div id="population_receiving_prep_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="population_receiving_prep_chart_heading heading"></span>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div>
</div>
<!--modal(s)-->
<!--facilities_level_distribution_chart filter modal-->
<div class="modal fade" id="facilities_level_distribution_chart_filter_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><strong>Facilties Level Distribution</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <select id="facilities_level_distribution_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                    </div>
                    <div class="col-sm-3">
                        <button id="facilities_level_distribution_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                        <button id="facilities_level_distribution_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
<!--current_service_delivery_points_distribution_chart filter modal-->
<div class="modal fade" id="current_service_delivery_points_distribution_chart_filter_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><strong>Service Delivery Points Distribution</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <select id="current_service_delivery_points_distribution_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                    </div>
                    <div class="col-sm-3">
                        <button id="current_service_delivery_points_distribution_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                        <button id="current_service_delivery_points_distribution_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>