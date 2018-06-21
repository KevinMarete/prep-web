<div role="tabpanel" class="tab-pane" id="communication_advocacy">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Rapid Assessment Tool(s) Availability</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#rapid_assessment_tool_availability_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="rapid_assessment_tool_availability_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="rapid_assessment_tool_availability_chart_heading heading"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>PrEP Summary Tool(s)</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#prep_summary_tool_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="prep_summary_tool_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="prep_summary_tool_chart_heading heading"></span>
                    </div>
                </div>               
            </div>
        </div><!--end row-->
        <div class="row">
            <div class="col-md-6">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Clinical Encounter Form</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#clinical_encounter_form_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="clinical_encounter_form_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="clinical_encounter_form_chart_heading heading"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>PrEP Register(s) Availability</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#prep_register_availability_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="prep_register_availability_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="prep_register_availability_chart_heading heading"></span>
                    </div>
                </div>
            </div>  
        </div><!--end row-->
    </div>
</div>
<!--modal(s)-->
<!--rapid assessment tools availability filter modal-->
<div class="modal fade" id="rapid_assessment_tool_availability_chart_filter_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><strong>Rapid Assessment Tool(s) Availability</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <select id="rapid_assessment_tool_availability_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                    </div>
                    <div class="col-sm-3">
                        <button id="rapid_assessment_tool_availability_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                        <button id="rapid_assessment_tool_availability_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--prep summary tool filter modal-->
<div class="modal fade" id="prep_summary_tool_chart_filter_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><strong>PrEP Summary Tool(s)</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <select id="prep_summary_tool_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                    </div>
                    <div class="col-sm-3">
                        <button id="prep_summary_tool_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                        <button id="prep_summary_tool_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--clinical encounter forn chart filter-->
<div class="modal fade" id="clinical_encounter_form_chart_filter_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><strong>Clinical Encounter Form</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <select id="clinical_encounter_form_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                    </div>
                    <div class="col-sm-3">
                        <button id="clinical_encounter_form_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                        <button id="clinical_encounter_form_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--prep register availablity modal-->
<div class="modal fade" id="prep_register_availability_chart_filter_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><strong>PrEP Register Availability</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <select id="prep_register_availability_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                    </div>
                    <div class="col-sm-3">
                        <button id="prep_register_availability_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                        <button id="prep_register_availability_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>