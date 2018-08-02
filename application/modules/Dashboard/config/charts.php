<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//demand_creation_activities_in_facilities_chart_level chart
$config['demand_creation_activities_in_facilities_chart_chartview'] = 'charts/column_view';
$config['demand_creation_activities_in_facilities_chart_title'] = 'Facility Level';
$config['demand_creation_activities_in_facilities_chart_yaxis_title'] = 'No. of facilities';
$config['demand_creation_activities_in_facilities_chart_source'] = 'Source: www.commodities.nascop.org';
$config['demand_creation_activities_in_facilities_chart_has_drilldown'] = FALSE;
$config['demand_creation_activities_in_facilities_chart_filters'] = array('Sub_County', 'County');
$config['demand_creation_activities_in_facilities_chart_filters_default'] = array();