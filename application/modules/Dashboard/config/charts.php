<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//facility_count_chart 
$config['facility_count_chart_chartview'] = 'charts/column_drilldown_view';
$config['facility_count_chart_title'] = 'Facility Count';
$config['facility_count_chart_yaxis_title'] = 'Facility Count';
$config['facility_count_chart_source'] = 'Source: www.prep.nascop.org';
$config['facility_count_chart_has_drilldown'] = TRUE;
$config['facility_count_chart_filters'] = array('Sub_County', 'County');
$config['facility_count_chart_filters_default'] = array();

//prep_focal_person_chart 
$config['prep_focal_person_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['prep_focal_person_chart_title'] = 'PrEP Focal Person';
$config['prep_focal_person_chart_yaxis_title'] = 'Percent 100';
$config['prep_focal_person_chart_source'] = 'Source: www.prep.nascop.org';
$config['prep_focal_person_chart_has_drilldown'] = FALSE;
$config['prep_focal_person_chart_filters'] = array('Sub_County', 'County');
$config['prep_focal_person_chart_filters_default'] = array();

//partner_support_chart 
$config['partner_support_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['partner_support_chart_title'] = 'Partner Support';
$config['partner_support_chart_yaxis_title'] = 'Percent 100';
$config['partner_support_chart_source'] = 'Source: www.prep.nascop.org';
$config['partner_support_chart_has_drilldown'] = FALSE;
$config['partner_support_chart_filters'] = array('Sub_County', 'County');
$config['partner_support_chart_filters_default'] = array();

//lmis_tools_chart 
$config['lmis_tools_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['lmis_tools_chart_title'] = 'LMIS Tools';
$config['lmis_tools_chart_yaxis_title'] = 'Percent of 100';
$config['lmis_tools_chart_source'] = 'Source: www.prep.nascop.org';
$config['lmis_tools_chart_has_drilldown'] = FALSE;
$config['lmis_tools_chart_filters'] = array('Sub_County', 'County');
$config['lmis_tools_chart_filters_default'] = array();

//clinical_encounter_forms_chart 
$config['clinical_encounter_forms_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['clinical_encounter_forms_chart_title'] = 'Clinical Encounter Forms';
$config['clinical_encounter_forms_chart_yaxis_title'] = 'Percent of 100';
$config['clinical_encounter_forms_chart_source'] = 'Source: www.prep.nascop.org';
$config['clinical_encounter_forms_chart_has_drilldown'] = FALSE;
$config['clinical_encounter_forms_chart_filters'] = array('Sub_County', 'County');
$config['clinical_encounter_forms_chart_filters_default'] = array();

//pharmacovigilance_tools_chart 
$config['pharmacovigilance_tools_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['pharmacovigilance_tools_chart_title'] = 'Pharmacovigilance Tools';
$config['pharmacovigilance_tools_chart_yaxis_title'] = 'Percent of 100';
$config['pharmacovigilance_tools_chart_source'] = 'Source: www.prep.nascop.org';
$config['pharmacovigilance_tools_chart_has_drilldown'] = FALSE;
$config['pharmacovigilance_tools_chart_filters'] = array('Sub_County', 'County');
$config['pharmacovigilance_tools_chart_filters_default'] = array();

//prep_register_chart 
$config['prep_register_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['prep_register_chart_title'] = 'PrEP Register';
$config['prep_register_chart_yaxis_title'] = 'Percent of 100';
$config['prep_register_chart_source'] = 'Source: www.prep.nascop.org';
$config['prep_register_chart_has_drilldown'] = FALSE;
$config['prep_register_chart_filters'] = array('Sub_County', 'County');
$config['prep_register_chart_filters_default'] = array();

//rapid_assessment_screening_tool_chart 
$config['rapid_assessment_screening_tools_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['rapid_assessment_screening_tools_chart_title'] = 'Rapid Assessment Screening Tools';
$config['rapid_assessment_screening_tools_chart_yaxis_title'] = 'Percent of 100';
$config['rapid_assessment_screening_tools_chart_source'] = 'Source: www.prep.nascop.org';
$config['rapid_assessment_screening_tools_chart_has_drilldown'] = FALSE;
$config['rapid_assessment_screening_tools_chart_filters'] = array('Sub_County', 'County');
$config['rapid_assessment_screening_tools_chart_filters_default'] = array();

//rapid_assessment_screening_tool_chart 
$config['prep_summary_tools_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['prep_summary_tools_chart_title'] = 'PrEP Summary Tools';
$config['prep_summary_tools_chart_yaxis_title'] = 'Percent of 100';
$config['prep_summary_tools_chart_source'] = 'Source: www.prep.nascop.org';
$config['prep_summary_tools_chart_has_drilldown'] = FALSE;
$config['prep_summary_tools_chart_filters'] = array('Sub_County', 'County');
$config['prep_summary_tools_chart_filters_default'] = array();

//demand_creation_activities_in_facilities_chart 
$config['demand_creation_activities_in_facilities_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['demand_creation_activities_in_facilities_chart_title'] = 'Availability of Demand Creation Activities in Facilities';
$config['demand_creation_activities_in_facilities_chart_yaxis_title'] = 'Percent of 100';
$config['demand_creation_activities_in_facilities_chart_source'] = 'Source: www.prep.nascop.org';
$config['demand_creation_activities_in_facilities_chart_has_drilldown'] = FALSE;
$config['demand_creation_activities_in_facilities_chart_filters'] = array('Sub_County', 'County');
$config['demand_creation_activities_in_facilities_chart_filters_default'] = array();

//prep_education_availability_in_facilities_chart
$config['prep_education_availability_in_facilities_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['prep_education_availability_in_facilities_chart_title'] = 'Availability of Activities about PrEP Education in Facilities';
$config['prep_education_availability_in_facilities_chart_yaxis_title'] = 'Percent of 100';
$config['prep_education_availability_in_facilities_chart_source'] = 'Source: www.prep.nascop.org';
$config['prep_education_availability_in_facilities_chart_has_drilldown'] = FALSE;
$config['prep_education_availability_in_facilities_chart_filters'] = array('Sub_County', 'County');
$config['prep_education_availability_in_facilities_chart_filters_default'] = array();

//iec_materials_chart 
$config['iec_materials_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['iec_materials_chart_title'] = 'Availability of IEC Materials';
$config['iec_materials_chart_yaxis_title'] = 'Percent of 100';
$config['iec_materials_chart_source'] = 'Source: www.prep.nascop.org';
$config['iec_materials_chart_has_drilldown'] = FALSE;
$config['iec_materials_chart_filters'] = array('Sub_County', 'County');
$config['iec_materials_chart_filters_default'] = array();
