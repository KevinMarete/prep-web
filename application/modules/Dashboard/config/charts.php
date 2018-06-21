<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//facility_ownership chart
$config['facility_ownership_chart_chartview'] = 'charts/pie_view';
$config['facility_ownership_chart_title'] = 'Facility Ownership';
$config['facility_ownership_chart_yaxis_title'] = '% ownership';
$config['facility_ownership_chart_source'] = 'Source: www.commodities.nascop.org';
$config['facility_ownership_chart_has_drilldown'] = FALSE;
$config['facility_ownership_chart_filters'] = array('Sub_County', 'County');
$config['facility_ownership_chart_filters_default'] = array();

//facility_level chart
$config['facility_level_chart_chartview'] = 'charts/column_view';
$config['facility_level_chart_title'] = 'Facility Level';
$config['facility_level_chart_yaxis_title'] = 'number of facilities';
$config['facility_level_chart_source'] = 'Source: www.commodities.nascop.org';
$config['facility_level_chart_has_drilldown'] = FALSE;
$config['facility_level_chart_filters'] = array('Sub_County', 'County');
$config['facility_level_chart_filters_default'] = array();

//hiv_service offered chart
$config['hiv_service_offered_chart_chartview'] = 'charts/column_view';
$config['hiv_service_offered_chart_title'] = ' HIV Services Offered';
$config['hiv_service_offered_chart_yaxis_title'] = '% services';
$config['hiv_service_offered_chart_source'] = 'Source: www.commodities.nascop.org';
$config['hiv_service_offered_chart_has_drilldown'] = FALSE;
$config['hiv_service_offered_chart_filters'] = array('Subcounty', 'County');
$config['hiv_service_offered_chart_filters_default'] = array();

//facility count chart
$config['facility_count_chart_chartview'] = 'charts/column_drilldown_view';
$config['facility_count_chart_title'] = 'Facility Count Distribution';
$config['facility_count_chart_yaxis_title'] = 'No. of facilities';
$config['facility_count_chart_source'] = 'Source: www.commodities.nascop.org';
$config['facility_count_chart_has_drilldown'] = TRUE;
$config['facility_count_chart_filters'] = array('Sub_County', 'County');
$config['facility_count_chart_filters_default'] = array();
