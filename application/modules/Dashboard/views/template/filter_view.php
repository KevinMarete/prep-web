<div class="navbar navbar-inverse bulma-nav-bg " id="filter_view">
    <div class="container">
        <div class="navbar-collapse collapse center-block" id="navbar-filter">
            <div class="navbar-form navbar-center" role="search">
                <div class="form-group">
                    <select id="filter_item" multiple="multiple" name="filter_item[]" data-filter_type="" class="form-control"></select>
                </div>
                <button id="btn_clear" class="btn btn-danger btn-md"><span class="glyphicon glyphicon-refresh"></span> RESET</button>
                <button id="btn_filter" class="btn btn-warning btn-md"><span class="glyphicon glyphicon-filter"></span> FILTER</button>
                <div class="form-group">
                    <select id="tab_items" class="form-control"></select>
                </div>
                <div class = "form-group">
                    <select class="form-control" id="assessmentPeriod">
                        <?php foreach($assessment_periods as $period) {?>
                            <option value="<?php echo $period."-01"; ?>"><?php echo $period; ?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>        