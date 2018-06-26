<div role="tabpanel" class="tab-pane" id="commodity_management">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Application Used To Manage PrEP Commodities</strong>
                    </div>
                    <div class="chart-stage">
                        <div id="software_managing_prep_commodities_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="software_managing_prep_commodities_chart_heading heading"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Facilities Source Of ARVs</strong>
                    </div>
                    <div class="chart-stage">
                        <div id="facility_source_ARVs_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="facility_source_ARVs_chart_heading heading"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>PrEP Drug Dispensation</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#PrEP_drug_dispensation_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="PrEP_drug_dispensation_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="PrEP_drug_dispensation_chart_heading heading"></span>
                    </div>
                </div>  
            </div>
        </div><!--end row-->      
        <div class="row">
            <div class="col-md-4">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Training On National PrEP M&E Tool(s)</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#training_national_PrEP_ME_tools_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="training_national_PrEP_ME_tools_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="training_national_PrEP_ME_tools_chart_heading heading"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Cadre Of Staff Dispensing PrEP</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#cadre_staff_dispensing_PrEP_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="cadre_staff_dispensing_PrEP_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="cadre_staff_dispensing_PrEP_chart_heading heading"></span>
                    </div>
                </div>  
            </div>
        </div><!--end row-->
        <div class="row">
            <div class="col-md-8">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Facility Level</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#commodity_mgmt_facility_level_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="commodity_mgmt_facility_level_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="commodity_mgmt_facility_level_chart_heading heading"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Facility Ownership</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#commodity_mgmt_facility_ownership_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="commodity_mgmt_facility_ownership_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="commodity_mgmt_facility_ownership_chart_heading heading"></span>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        <div class="row">
            <div class="col-md-12">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Facility Count Distribution</strong><span class="label label-warning">Drilldown</span>
                    </div>
                    <div class="chart-stage">
                        <div id="commodity_mgmt_commodity_mgmt_facility_count_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="commodity_mgmt_facility_count_chart_heading heading"></span>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div>
</div>
<!--modal(s)-->
<!--PrEP_drug_dispensation_chart modal-->
<div class="modal fade" id="PrEP_drug_dispensation_chart_filter_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><strong>PrEP Drug Dispensation</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <select id="PrEP_drug_dispensation_chart_filter" size="1" data-filter_type="Sub_County"></select>
                    </div>
                    <div class="col-sm-3">
                        <button id="PrEP_drug_dispensation_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                        <button id="PrEP_drug_dispensation_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--training national PrEP M&E tools modal-->
<div class="modal fade" id="training_national_PrEP_ME_tools_chart_filter_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><strong>Training On National PrEP M&E Tool(s)</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <select id="training_national_PrEP_ME_tools_chart_filter" size="1" data-filter_type="Sub_County"></select>
                    </div>
                    <div class="col-sm-3">
                        <button id="training_national_PrEP_ME_tools_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                        <button id="training_national_PrEP_ME_tools_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--cadre staff dispensing PrEP-->
<div class="modal fade" id="cadre_staff_dispensing_PrEP_chart_filter_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><strong>Cadre Of Staff Dispensing PrEP</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <select id="cadre_staff_dispensing_PrEP_chart_filter" size="1" data-filter_type="Sub_County"></select>
                    </div>
                    <div class="col-sm-3">
                        <button id="cadre_staff_dispensing_PrEP_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                        <button id="cadre_staff_dispensing_PrEP_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--commodity_mgmt_facility level modal-->
<div class="modal fade" id="commodity_mgmt_facility_level_chart_filter_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><strong>Facility Level</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <select id="commodity_mgmt_facility_level_chart_filter" size="1" data-filter_type="Sub_County"></select>
                    </div>
                    <div class="col-sm-3">
                        <button id="commodity_mgmt_facility_level_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                        <button id="commodity_mgmt_facility_level_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--facility ownership modal-->
<div class="modal fade" id="commodity_mgmt_facility_ownership_chart_filter_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><strong>Facility Ownership</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <select id="commodity_mgmt_facility_ownership_chart_filter" size="1" data-filter_type="Sub_County"></select>
                    </div>
                    <div class="col-sm-3">
                        <button id="commodity_mgmt_facility_ownership_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                        <button id="commodity_mgmt_facility_ownership_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>