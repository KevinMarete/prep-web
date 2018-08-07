<div role="tabpanel" class="tab-pane" id="human_resource">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Proportion of Facilities Trained on PrEP</strong>
                    </div>
                    <div class="chart-stage">
                        <div id="facilities_trained_on_prep_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="facilities_trained_on_prep_chart_heading heading"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="chart-wrapper">
                    <div class="chart-title">
                        <strong>Distribution of Trained Personnel in Facilities</strong>
                        <div class="nav navbar-right">
                            <button data-toggle="modal" data-target="#distibution_of_facilities_trained_personnel_in_facilities_chart_filter_modal" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-filter"></span>
                            </button>
                        </div>
                    </div>
                    <div class="chart-stage">
                        <div id="distibution_of_facilities_trained_personnel_in_facilities_chart"></div>
                    </div>
                    <div class="chart-notes">
                        <span class="distibution_of_facilities_trained_personnel_in_facilities_chart_heading heading"></span>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div>
</div>
<!--modal(s)-->
<!--distibution_of_facilities_trained_personnel_in_facilities_chart filter modal-->
<div class="modal fade" id="distibution_of_facilities_trained_personnel_in_facilities_chart_filter_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><strong>Distribution of Trained Personnel in Facilities</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <select id="distibution_of_facilities_trained_personnel_in_facilities_chart_filter" size="1" data-filter_type="subcounty_name"></select>
                    </div>
                    <div class="col-sm-3">
                        <button id="distibution_of_facilities_trained_personnel_in_facilities_chart_filter_clear_btn" class="btn btn-danger btn-sm clear_btn"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                        <button id="distibution_of_facilities_trained_personnel_in_facilities_chart_filter_btn" class="btn btn-warning btn-sm filter_btn"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>