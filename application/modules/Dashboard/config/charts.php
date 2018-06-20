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
