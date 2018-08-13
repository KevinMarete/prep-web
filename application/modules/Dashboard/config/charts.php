<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//facility_count_chart 
$config['facility_count_chart_chartview'] = 'charts/column_drilldown_view';
$config['facility_count_chart_title'] = 'Facility Count Distribution';
$config['facility_count_chart_yaxis_title'] = 'Facility Count';
$config['facility_count_chart_source'] = 'Source: www.prep.nascop.org';
$config['facility_count_chart_has_drilldown'] = TRUE;
$config['facility_count_chart_filters'] = array('Sub_County', 'County');
$config['facility_count_chart_filters_default'] = array();

//facilities_level_distribution_chart 
$config['facilities_level_distribution_chart_chartview'] = 'charts/stacked_column_view';
$config['facilities_level_distribution_chart_title'] = 'Facilties Level Distribution';
$config['facilities_level_distribution_chart_yaxis_title'] = 'Percent 100';
$config['facilities_level_distribution_chart_source'] = 'Source: www.prep.nascop.org';
$config['facilities_level_distribution_chart_has_drilldown'] = FALSE;
$config['facilities_level_distribution_chart_filters'] = array('Sub_County', 'County');
$config['facilities_level_distribution_chart_filters_default'] = array();

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

//hiv_services_offered_chart 
$config['hiv_services_offered_chart_chartview'] = 'charts/column_view';
$config['hiv_services_offered_chart_title'] = 'Distribution of Hiv Services in Facilities';
$config['hiv_services_offered_chart_yaxis_title'] = 'Count';
$config['hiv_services_offered_chart_source'] = 'Source: www.prep.nascop.org';
$config['hiv_services_offered_chart_has_drilldown'] = FALSE;
$config['hiv_services_offered_chart_filters'] = array('Sub_County', 'County');
$config['hiv_services_offered_chart_filters_default'] = array();

//service_delivery_points_distribution_chart 
$config['service_delivery_points_distribution_chart_chartview'] = 'charts/stacked_column_percent_view_without_dataLabels';
$config['service_delivery_points_distribution_chart_title'] = 'Service Delivery Points Distribution';
$config['service_delivery_points_distribution_chart_yaxis_title'] = 'Percent of 100';
$config['service_delivery_points_distribution_chart_source'] = 'Source: www.prep.nascop.org';
$config['service_delivery_points_distribution_chart_has_drilldown'] = FALSE;
$config['service_delivery_points_distribution_chart_filters'] = array('Sub_County', 'County');
$config['service_delivery_points_distribution_chart_filters_default'] = array();

//creatinine_testing_availability_chart 
$config['creatinine_testing_availability_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['creatinine_testing_availability_chart_title'] = 'Creatinine Testing Availability';
$config['creatinine_testing_availability_chart_yaxis_title'] = 'Percent of 100';
$config['creatinine_testing_availability_chart_source'] = 'Source: www.prep.nascop.org';
$config['creatinine_testing_availability_chart_has_drilldown'] = FALSE;
$config['creatinine_testing_availability_chart_filters'] = array('Sub_County', 'County');
$config['creatinine_testing_availability_chart_filters_default'] = array();

//facilities_trained_on_prep_chart 
$config['facilities_trained_on_prep_chart_chartview'] = 'charts/pie_view';
$config['facilities_trained_on_prep_chart_title'] = 'Proportion of Facilities Trained on PrEP';
$config['facilities_trained_on_prep_chart_yaxis_title'] = 'Percent';
$config['facilities_trained_on_prep_chart_source'] = 'Source: www.prep.nascop.org';
$config['facilities_trained_on_prep_chart_has_drilldown'] = FALSE;
$config['facilities_trained_on_prep_chart_filters'] = array('Sub_County', 'County');
$config['facilities_trained_on_prep_chart_filters_default'] = array();

//distibution_of_facilities_trained_personnel_in_facilities_chart 
$config['distibution_of_facilities_trained_personnel_in_facilities_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['distibution_of_facilities_trained_personnel_in_facilities_chart_title'] = 'Distribution of Trained Personnel in Facilities';
$config['distibution_of_facilities_trained_personnel_in_facilities_chart_yaxis_title'] = 'Percent 100';
$config['distibution_of_facilities_trained_personnel_in_facilities_chart_source'] = 'Source: www.prep.nascop.org';
$config['distibution_of_facilities_trained_personnel_in_facilities_chart_has_drilldown'] = FALSE;
$config['distibution_of_facilities_trained_personnel_in_facilities_chart_filters'] = array('Sub_County', 'County');
$config['distibution_of_facilities_trained_personnel_in_facilities_chart_filters_default'] = array();

//facility_source_of_ARVs_chart 
$config['facility_source_of_ARVs_chart_chartview'] = 'charts/pie_view';
$config['facility_source_of_ARVs_chart_title'] = 'Source of ARVs in Facilities';
$config['facility_source_of_ARVs_chart_yaxis_title'] = 'Percent';
$config['facility_source_of_ARVs_chart_source'] = 'Source: www.prep.nascop.org';
$config['facility_source_of_ARVs_chart_has_drilldown'] = FALSE;
$config['facility_source_of_ARVs_chart_filters'] = array('Sub_County', 'County');
$config['facility_source_of_ARVs_chart_filters_default'] = array();

//facility_source_of_arvs_by_county_chart 
$config['facility_source_of_arvs_by_county_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['facility_source_of_arvs_by_county_chart_title'] = 'Facility Source of ARVs By County';
$config['facility_source_of_arvs_by_county_chart_yaxis_title'] = 'Percent 100';
$config['facility_source_of_arvs_by_county_chart_source'] = 'Source: www.prep.nascop.org';
$config['facility_source_of_arvs_by_county_chart_has_drilldown'] = FALSE;
$config['facility_source_of_arvs_by_county_chart_filters'] = array('Sub_County', 'County');
$config['facility_source_of_arvs_by_county_chart_filters_default'] = array();

//prep_dispensing_points_in_facilities_chart 
$config['prep_dispensing_points_in_facilities_chart_chartview'] = 'charts/stacked_column_percent_view_without_dataLabels';
$config['prep_dispensing_points_in_facilities_chart_title'] = 'PrEP Dispensing Points in Facilities';
$config['prep_dispensing_points_in_facilities_chart_yaxis_title'] = 'Percent 100';
$config['prep_dispensing_points_in_facilities_chart_source'] = 'Source: www.prep.nascop.org';
$config['prep_dispensing_points_in_facilities_chart_has_drilldown'] = FALSE;
$config['prep_dispensing_points_in_facilities_chart_filters'] = array('Sub_County', 'County');
$config['prep_dispensing_points_in_facilities_chart_filters_default'] = array();

//prep_dispensing_software_in_facilities_chart 
$config['prep_dispensing_software_in_facilities_chart_chartview'] = 'charts/stacked_column_percent_view_without_dataLabels';
$config['prep_dispensing_software_in_facilities_chart_title'] = 'PrEP Dispensing Software in Facilities';
$config['prep_dispensing_software_in_facilities_chart_yaxis_title'] = 'Percent 100';
$config['prep_dispensing_software_in_facilities_chart_source'] = 'Source: www.prep.nascop.org';
$config['prep_dispensing_software_in_facilities_chart_has_drilldown'] = FALSE;
$config['prep_dispensing_software_in_facilities_chart_filters'] = array('Sub_County', 'County');
$config['prep_dispensing_software_in_facilities_chart_filters_default'] = array();

//prep_dispensing_software_in_facilities_table
$config['prep_dispensing_software_in_facilities_table_chartview'] = 'charts/table_view';
$config['prep_dispensing_software_in_facilities_table_title'] = 'PrEP Dispensing Software in Facilities';
$config['prep_dispensing_software_in_facilities_table_yaxis_title'] = 'Percent 100';
$config['prep_dispensing_software_in_facilities_table_source'] = 'Source: www.prep.nascop.org';
$config['prep_dispensing_software_in_facilities_table_has_drilldown'] = FALSE;
$config['prep_dispensing_software_in_facilities_table_filters'] = array('Sub_County', 'County');
$config['prep_dispensing_software_in_facilities_table_filters_default'] = array();

//prep_product_dispensed_table
$config['prep_product_dispensed_table_chartview'] = 'charts/table_view';
$config['prep_product_dispensed_table_title'] = 'PrEP Regimens Dispensed in Facilities';
$config['prep_product_dispensed_table_yaxis_title'] = 'Percent 100';
$config['prep_product_dispensed_table_source'] = 'Source: www.prep.nascop.org';
$config['prep_product_dispensed_table_has_drilldown'] = FALSE;
$config['prep_product_dispensed_table_filters'] = array('Sub_County', 'County');
$config['prep_product_dispensed_table_filters_default'] = array();

//overall_availability_of_me_tools_chart 
$config['overall_availability_of_me_tools_chart_chartview'] = 'charts/column_view';
$config['overall_availability_of_me_tools_chart_title'] = 'Overall Availability of M&E Tools';
$config['overall_availability_of_me_tools_chart_yaxis_title'] = '';
$config['overall_availability_of_me_tools_chart_source'] = 'Source: www.prep.nascop.org';
$config['overall_availability_of_me_tools_chart_has_drilldown'] = FALSE;
$config['overall_availability_of_me_tools_chart_filters'] = array('Sub_County', 'County');
$config['overall_availability_of_me_tools_chart_filters_default'] = array();

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

//prep_summary_tools_chart 
$config['prep_summary_tools_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['prep_summary_tools_chart_title'] = 'PrEP Summary Tools';
$config['prep_summary_tools_chart_yaxis_title'] = 'Percent of 100';
$config['prep_summary_tools_chart_source'] = 'Source: www.prep.nascop.org';
$config['prep_summary_tools_chart_has_drilldown'] = FALSE;
$config['prep_summary_tools_chart_filters'] = array('Sub_County', 'County');
$config['prep_summary_tools_chart_filters_default'] = array();

//clients_ever_started_on_prep_chart 
$config['clients_ever_started_on_prep_chart_chartview'] = 'charts/column_drilldown_view';
$config['clients_ever_started_on_prep_chart_title'] = 'Clients Ever Started on PrEP';
$config['clients_ever_started_on_prep_chart_yaxis_title'] = 'Clients Ever Initiated';
$config['clients_ever_started_on_prep_chart_source'] = 'Source: www.prep.nascop.org';
$config['clients_ever_started_on_prep_chart_has_drilldown'] = TRUE;
$config['clients_ever_started_on_prep_chart_filters'] = array('Sub_County', 'County');
$config['clients_ever_started_on_prep_chart_filters_default'] = array();

//clients_currently_on_prep_chart 
$config['clients_currently_on_prep_chart_chartview'] = 'charts/column_drilldown_view';
$config['clients_currently_on_prep_chart_title'] = 'Clients Currently on PrEP';
$config['clients_currently_on_prep_chart_yaxis_title'] = 'Current Clients';
$config['clients_currently_on_prep_chart_source'] = 'Source: www.prep.nascop.org';
$config['clients_currently_on_prep_chart_has_drilldown'] = TRUE;
$config['clients_currently_on_prep_chart_filters'] = array('Sub_County', 'County');
$config['clients_currently_on_prep_chart_filters_default'] = array();

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
