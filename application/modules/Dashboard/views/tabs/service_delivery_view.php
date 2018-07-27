<div role="tabpanel" class="tab-pane" id="service_delivery">
    <div class="container-fluid">
        <div class="row"><!--row-->
            <div class="col-md-8">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>HIV Services Offered</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#hiv_service_offered_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="hiv_service_offered_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="hiv_service_offered_chart_heading heading"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Population Offered PrEP</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#facility_population_offered_PrEP_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="facility_population_offered_PrEP_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="facility_population_offered_PrEP_chart_heading heading"></span>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        <div class="row"><!--row-->
            <div class="col-md-6">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Hepatitis B Availability</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#hepatitis_b_availability_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="hepatitis_b_availability_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="hepatitis_b_availability_chart_heading heading"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Hepatitis C Availability</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#hepatitis_c_availability_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="hepatitis_c_availability_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="hepatitis_c_availability_chart_heading heading"></span>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        <div class="row"><!--row-->
            <div class="col-md-8">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Creatinine Availability</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#creatinine_availability_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="creatinine_availability_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="creatinine_availability_chart_heading heading"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Lab Services Availability</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#lab_services_availability_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="lab_services_availability_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="lab_services_availability_chart_heading heading"></span>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        <!--modal(s)-->
        <!--hiv services offered modal-->
        <div class="modal fade" id="hiv_service_offered_chart_filter_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title"><strong>HIV Services Offered</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-9">
                                <select id="hiv_service_offered_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                            </div>
                            <div class="col-sm-3">
                                <button id="hiv_service_offered_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                                <button id="hiv_service_offered_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--population offered prep modal-->
        <div class="modal fade" id="facility_population_offered_PrEP_chart_filter_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title"><strong>Population Offered PrEP</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-9">
                                <select id="facility_population_offered_PrEP_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                            </div>
                            <div class="col-sm-3">
                                <button id="facility_population_offered_PrEP_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                                <button id="facility_population_offered_PrEP_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--lab services availability modal-->
        <div class="modal fade" id="lab_services_availability_chart_filter_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title"><strong>Availability Of Lab Services</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-9">
                                <select id="lab_services_availability_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                            </div>
                            <div class="col-sm-3">
                                <button id="lab_services_availability_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                                <button id="lab_services_availability_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--county_hepatitis_b_availability modal-->
        <div class="modal fade" id="hepatitis_b_availability_chart_filter_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title"><strong>Hepatitis B Availability</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-9">
                                <select id="hepatitis_b_availability_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                            </div>
                            <div class="col-sm-3">
                                <button id="hepatitis_b_availability_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                                <button id="hepatitis_b_availability_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--county_hepatitis_c_availability modal-->
        <div class="modal fade" id="hepatitis_c_availability_chart_filter_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title"><strong>Hepatitis C Availability</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-9">
                                <select id="hepatitis_c_availability_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                            </div>
                            <div class="col-sm-3">
                                <button id="hepatitis_c_availability_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                                <button id="hepatitis_c_availability_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Creatinine Availability-->
        <div class="modal fade" id="creatinine_availability_chart_filter_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title"><strong>Creatinine Availability</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-9">
                                <select id="creatinine_availability_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                            </div>
                            <div class="col-sm-3">
                                <button id=creatinine_availability_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                                <button id="creatinine_availability_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
