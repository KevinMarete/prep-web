<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//facility_distribution_map 
$config['facility_distribution_map_chartview'] = 'charts/maps_view';
$config['facility_distribution_map_title'] = 'Distribution of Facilities (By County/SubCounty)';
$config['facility_distribution_map_yaxis_title'] = 'No. of Facilities';
$config['facility_distribution_map_source'] = 'Source: www.prep.nascop.org';
$config['facility_distribution_map_has_drilldown'] = FALSE;
$config['facility_distribution_map_filters'] = array();
$config['facility_distribution_map_filters_default'] = array();

//facilities_level_distribution_chart 
$config['facilities_level_distribution_chart_chartview'] = 'charts/column_drilldown_view';
$config['facilities_level_distribution_chart_title'] = 'Distribution of Facilities (By Level)';
$config['facilities_level_distribution_chart_yaxis_title'] = 'No. of Facilities';
$config['facilities_level_distribution_chart_source'] = 'Source: www.prep.nascop.org';
$config['facilities_level_distribution_chart_has_drilldown'] = TRUE;
$config['facilities_level_distribution_chart_filters'] = array('Sub_County', 'County');
$config['facilities_level_distribution_chart_filters_default'] = array();

//prep_focal_person_chart 
$config['prep_focal_person_chart_chartview'] = 'charts/column_drilldown_view';
$config['prep_focal_person_chart_title'] = 'PrEP Focal Person in Facilities';
$config['prep_focal_person_chart_yaxis_title'] = 'No. of Facilities';
$config['prep_focal_person_chart_source'] = 'Source: www.prep.nascop.org';
$config['prep_focal_person_chart_has_drilldown'] = TRUE;
$config['prep_focal_person_chart_filters'] = array('Sub_County', 'County');
$config['prep_focal_person_chart_filters_default'] = array();

//hiv_services_offered_chart 
$config['hiv_services_offered_chart_chartview'] = 'charts/column_drilldown_view';
$config['hiv_services_offered_chart_title'] = 'Distribution of HIV Services in Facilities';
$config['hiv_services_offered_chart_yaxis_title'] = 'No. of Facilities';
$config['hiv_services_offered_chart_source'] = 'Source: www.prep.nascop.org';
$config['hiv_services_offered_chart_has_drilldown'] = TRUE;
$config['hiv_services_offered_chart_filters'] = array('Sub_County', 'County');
$config['hiv_services_offered_chart_filters_default'] = array();

//current_service_delivery_points_distribution_chart 
$config['current_service_delivery_points_distribution_chart_chartview'] = 'charts/column_drilldown_view';
$config['current_service_delivery_points_distribution_chart_title'] = 'Distribution of Current Service Delivery Points';
$config['current_service_delivery_points_distribution_chart_yaxis_title'] = 'No. of Facilities';
$config['current_service_delivery_points_distribution_chart_source'] = 'Source: www.prep.nascop.org';
$config['current_service_delivery_points_distribution_chart_has_drilldown'] = TRUE;
$config['current_service_delivery_points_distribution_chart_filters'] = array('Sub_County', 'County');
$config['current_service_delivery_points_distribution_chart_filters_default'] = array();

//population_receiving_prep_chart 
$config['population_receiving_prep_chart_chartview'] = 'charts/column_drilldown_view';
$config['population_receiving_prep_chart_title'] = 'Provision of PrEP to different population types by Facility';
$config['population_receiving_prep_chart_yaxis_title'] = 'No. of Facilities';
$config['population_receiving_prep_chart_source'] = 'Source: www.prep.nascop.org';
$config['population_receiving_prep_chart_has_drilldown'] = TRUE;
$config['population_receiving_prep_chart_filters'] = array('Sub_County', 'County');
$config['population_receiving_prep_chart_filters_default'] = array();

//partner_support_chart 
$config['partner_support_chart_chartview'] = 'charts/column_drilldown_view';
$config['partner_support_chart_title'] = 'Availability of implementing partner support';
$config['partner_support_chart_yaxis_title'] = 'No. of Facilities';
$config['partner_support_chart_source'] = 'Source: www.prep.nascop.org';
$config['partner_support_chart_has_drilldown'] = TRUE;
$config['partner_support_chart_filters'] = array('Sub_County', 'County');
$config['partner_support_chart_filters_default'] = array();

//partner_distribution_map 
$config['partner_distribution_map_chartview'] = 'charts/maps_view';
$config['partner_distribution_map_title'] = 'Distribution of Partners (By County/SubCounty)';
$config['partner_distribution_map_yaxis_title'] = 'No. of Partners';
$config['partner_distribution_map_source'] = 'Source: www.prep.nascop.org';
$config['partner_distribution_map_has_drilldown'] = FALSE;
$config['partner_distribution_map_filters'] = array();
$config['partner_distribution_map_filters_default'] = array();

//partner_facility_table 
$config['partner_facility_table_chartview'] = 'charts/column_drilldown_view';
$config['partner_facility_table_title'] = 'Distribution of facilities supported by partners';
$config['partner_facility_table_yaxis_title'] = 'No. of Facilities';
$config['partner_facility_table_source'] = 'Source: www.prep.nascop.org';
$config['partner_facility_table_has_drilldown'] = TRUE;
$config['partner_facility_table_filters'] = array('Sub_County', 'County');
$config['partner_facility_table_filters_default'] = array();

//service_delivery_point_by_partner_chart 
$config['service_delivery_point_by_partner_chart_chartview'] = 'charts/stacked_column_percent_view_without_dataLabels';
$config['service_delivery_point_by_partner_chart_title'] = 'Service Delivery Points by Partners';
$config['service_delivery_point_by_partner_chart_yaxis_title'] = '';
$config['service_delivery_point_by_partner_chart_source'] = 'Source: www.prep.nascop.org';
$config['service_delivery_point_by_partner_chart_has_drilldown'] = FALSE;
$config['service_delivery_point_by_partner_chart_filters'] = array('ps.Sub_County', 'ps.County');
$config['service_delivery_point_by_partner_chart_filters_default'] = array();

//hcw_trained_by_partner_chart 
$config['hcw_trained_by_partner_chart_chartview'] = 'charts/stacked_column_percent_view_without_dataLabels';
$config['hcw_trained_by_partner_chart_title'] = 'Distribution of facilities that have trained staff by partner ';
$config['hcw_trained_by_partner_chart_yaxis_title'] = 'No. of Facilities';
$config['hcw_trained_by_partner_chart_source'] = 'Source: www.prep.nascop.org';
$config['hcw_trained_by_partner_chart_has_drilldown'] = FALSE;
$config['hcw_trained_by_partner_chart_filters'] = array('ps.Sub_County', 'ps.County');
$config['hcw_trained_by_partner_chart_filters_default'] = array();

//access_creatinine_testing_facilities_chart 
$config['access_creatinine_testing_facilities_chart_chartview'] = 'charts/column_drilldown_view';
$config['access_creatinine_testing_facilities_chart_title'] = 'Access to Creatinine Testing in Facilities';
$config['access_creatinine_testing_facilities_chart_yaxis_title'] = 'No. of Facilities';
$config['access_creatinine_testing_facilities_chart_source'] = 'Source: www.prep.nascop.org';
$config['access_creatinine_testing_facilities_chart_has_drilldown'] = TRUE;
$config['access_creatinine_testing_facilities_chart_filters'] = array('Sub_County', 'County');
$config['access_creatinine_testing_facilities_chart_filters_default'] = array();

//offsite_onsite_creatinine_testing_chart 
$config['offsite_onsite_creatinine_testing_chart_chartview'] = 'charts/column_drilldown_view';
$config['offsite_onsite_creatinine_testing_chart_title'] = 'Offsite vs Onsite Creatinine Testing';
$config['offsite_onsite_creatinine_testing_chart_yaxis_title'] = 'No. of Facilities';
$config['offsite_onsite_creatinine_testing_chart_source'] = 'Source: www.prep.nascop.org';
$config['offsite_onsite_creatinine_testing_chart_has_drilldown'] = TRUE;
$config['offsite_onsite_creatinine_testing_chart_filters'] = array('Sub_County', 'County');
$config['offsite_onsite_creatinine_testing_chart_filters_default'] = array();

//creatinine_testing_equipment_availability_chart 
$config['creatinine_testing_equipment_availability_chart_chartview'] = 'charts/column_drilldown_view';
$config['creatinine_testing_equipment_availability_chart_title'] = 'Creatinine Testing Equipment';
$config['creatinine_testing_equipment_availability_chart_yaxis_title'] = 'No. of Facilities';
$config['creatinine_testing_equipment_availability_chart_source'] = 'Source: www.prep.nascop.org';
$config['creatinine_testing_equipment_availability_chart_has_drilldown'] = TRUE;
$config['creatinine_testing_equipment_availability_chart_filters'] = array('Sub_County', 'County');
$config['creatinine_testing_equipment_availability_chart_filters_default'] = array();

//creatinine_reagents_chart
$config['creatinine_reagents_chart_chartview'] = 'charts/column_drilldown_view';
$config['creatinine_reagents_chart_title'] = 'Creatinine Reagents in Facilities';
$config['creatinine_reagents_chart_yaxis_title'] = 'No. of Facilities';
$config['creatinine_reagents_chart_source'] = 'Source: www.prep.nascop.org';
$config['creatinine_reagents_chart_has_drilldown'] = TRUE;
$config['creatinine_reagents_chart_filters'] = array('Sub_County', 'County');
$config['creatinine_reagents_chart_filters_default'] = array();

//access_hep_b_testing_facilities_chart 
$config['access_hep_b_testing_facilities_chart_chartview'] = 'charts/column_drilldown_view';
$config['access_hep_b_testing_facilities_chart_title'] = 'Access to Hep-B Testing in Facilities';
$config['access_hep_b_testing_facilities_chart_yaxis_title'] = 'No. of Facilities';
$config['access_hep_b_testing_facilities_chart_source'] = 'Source: www.prep.nascop.org';
$config['access_hep_b_testing_facilities_chart_has_drilldown'] = TRUE;
$config['access_hep_b_testing_facilities_chart_filters'] = array('Sub_County', 'County');
$config['access_hep_b_testing_facilities_chart_filters_default'] = array();

//offsite_onsite_hep_b_testing_chart 
$config['offsite_onsite_hep_b_testing_chart_chartview'] = 'charts/column_drilldown_view';
$config['offsite_onsite_hep_b_testing_chart_title'] = 'Offsite vs Onsite Hep-B Testing';
$config['offsite_onsite_hep_b_testing_chart_yaxis_title'] = 'No. of Facilities';
$config['offsite_onsite_hep_b_testing_chart_source'] = 'Source: www.prep.nascop.org';
$config['offsite_onsite_hep_b_testing_chart_has_drilldown'] = TRUE;
$config['offsite_onsite_hep_b_testing_chart_filters'] = array('Sub_County', 'County');
$config['offsite_onsite_hep_b_testing_chart_filters_default'] = array();

//hep_b_testing_equipment_availability_chart 
$config['hep_b_testing_equipment_availability_chart_chartview'] = 'charts/column_drilldown_view';
$config['hep_b_testing_equipment_availability_chart_title'] = 'Hep-B Testing Equipment Availability';
$config['hep_b_testing_equipment_availability_chart_yaxis_title'] = 'No. of Facilities';
$config['hep_b_testing_equipment_availability_chart_source'] = 'Source: www.prep.nascop.org';
$config['hep_b_testing_equipment_availability_chart_has_drilldown'] = TRUE;
$config['hep_b_testing_equipment_availability_chart_filters'] = array('Sub_County', 'County');
$config['hep_b_testing_equipment_availability_chart_filters_default'] = array();

//hep_b_reagents_chart 
$config['hep_b_reagents_chart_chartview'] = 'charts/column_drilldown_view';
$config['hep_b_reagents_chart_title'] = 'Hep-B Reagents in Facilities';
$config['hep_b_reagents_chart_yaxis_title'] = 'No. of Facilities';
$config['hep_b_reagents_chart_source'] = 'Source: www.prep.nascop.org';
$config['hep_b_reagents_chart_has_drilldown'] = TRUE;
$config['hep_b_reagents_chart_filters'] = array('Sub_County', 'County');
$config['hep_b_reagents_chart_filters_default'] = array();

//access_hep_c_testing_facilities_chart 
$config['access_hep_c_testing_facilities_chart_chartview'] = 'charts/column_drilldown_view';
$config['access_hep_c_testing_facilities_chart_title'] = 'Access to Hep-C Testing in Facilities';
$config['access_hep_c_testing_facilities_chart_yaxis_title'] = 'No. of Facilities';
$config['access_hep_c_testing_facilities_chart_source'] = 'Source: www.prep.nascop.org';
$config['access_hep_c_testing_facilities_chart_has_drilldown'] = TRUE;
$config['access_hep_c_testing_facilities_chart_filters'] = array('Sub_County', 'County');
$config['access_hep_c_testing_facilities_chart_filters_default'] = array();

//offsite_onsite_hep_c_testing_chart
$config['offsite_onsite_hep_c_testing_chart_chartview'] = 'charts/column_drilldown_view';
$config['offsite_onsite_hep_c_testing_chart_title'] = 'Offsite vs Onsite Hep-C Testing';
$config['offsite_onsite_hep_c_testing_chart_yaxis_title'] = 'No. of Facilities';
$config['offsite_onsite_hep_c_testing_chart_source'] = 'Source: www.prep.nascop.org';
$config['offsite_onsite_hep_c_testing_chart_has_drilldown'] = TRUE;
$config['offsite_onsite_hep_c_testing_chart_filters'] = array('Sub_County', 'County');
$config['offsite_onsite_hep_c_testing_chart_filters_default'] = array();
//hep_c_testing_equipment_availability_chart 
$config['hep_c_testing_equipment_availability_chart_chartview'] = 'charts/column_drilldown_view';
$config['hep_c_testing_equipment_availability_chart_title'] = 'Hep-C Testing Equipment Availability';
$config['hep_c_testing_equipment_availability_chart_yaxis_title'] = 'No. of Facilities';
$config['hep_c_testing_equipment_availability_chart_source'] = 'Source: www.prep.nascop.org';
$config['hep_c_testing_equipment_availability_chart_has_drilldown'] = TRUE;
$config['hep_c_testing_equipment_availability_chart_filters'] = array('Sub_County', 'County');
$config['hep_c_testing_equipment_availability_chart_filters_default'] = array();

//hep_c_reagents_chart 
$config['hep_c_reagents_chart_chartview'] = 'charts/column_drilldown_view';
$config['hep_c_reagents_chart_title'] = 'Hep-C Reagents in Facilities';
$config['hep_c_reagents_chart_yaxis_title'] = 'No. of Facilities';
$config['hep_c_reagents_chart_source'] = 'Source: www.prep.nascop.org';
$config['hep_c_reagents_chart_has_drilldown'] = TRUE;
$config['hep_c_reagents_chart_filters'] = array('Sub_County', 'County');
$config['hep_c_reagents_chart_filters_default'] = array();

//distibution_of_facilities_trained_personnel_chart 
$config['distibution_of_facilities_trained_personnel_chart_chartview'] = 'charts/column_drilldown_view';
$config['distibution_of_facilities_trained_personnel_chart_title'] = 'Distribution of facilities by number of staff trained';
$config['distibution_of_facilities_trained_personnel_chart_yaxis_title'] = 'No. of Faciltiies';
$config['distibution_of_facilities_trained_personnel_chart_source'] = 'Source: www.prep.nascop.org';
$config['distibution_of_facilities_trained_personnel_chart_has_drilldown'] = TRUE;
$config['distibution_of_facilities_trained_personnel_chart_filters'] = array('Sub_County', 'County');
$config['distibution_of_facilities_trained_personnel_chart_filters_default'] = array();

//cadre_trained_chart 
$config['cadre_trained_chart_chartview'] = 'charts/bar_view';
$config['cadre_trained_chart_title'] = 'Distribution of Staff Trained by Cadre';
$config['cadre_trained_chart_yaxis_title'] = 'Cadre';
$config['cadre_trained_chart_source'] = 'Source: www.prep.nascop.org';
$config['cadre_trained_chart_has_drilldown'] = FALSE;
$config['cadre_trained_chart_filters'] = array('Sub_County', 'County');
$config['cadre_trained_chart_filters_default'] = array();

//health_care_workers_trained_on_prep_table 
$config['health_care_workers_trained_on_prep_table_chartview'] = 'charts/bar_view';
$config['health_care_workers_trained_on_prep_table_title'] = 'Distribution of facilities by number of HCW trained (National)';
$config['health_care_workers_trained_on_prep_table_yaxis_title'] = 'No. of Facilities';
$config['health_care_workers_trained_on_prep_table_source'] = 'Source: www.prep.nascop.org';
$config['health_care_workers_trained_on_prep_table_has_drilldown'] = FALSE;
$config['health_care_workers_trained_on_prep_table_filters'] = array('Sub_County', 'County');
$config['health_care_workers_trained_on_prep_table_filters_default'] = array();

//health_care_workers_trained_on_prep_chart 
$config['health_care_workers_trained_on_prep_chart_chartview'] = 'charts/stacked_column_percent_view_without_dataLabels';
$config['health_care_workers_trained_on_prep_chart_title'] = 'Distribution of facilities by number of HCW trained (By County)';
$config['health_care_workers_trained_on_prep_chart_yaxis_title'] = 'Percent(100%)';
$config['health_care_workers_trained_on_prep_chart_source'] = 'Source: www.prep.nascop.org';
$config['health_care_workers_trained_on_prep_chart_has_drilldown'] = FALSE;
$config['health_care_workers_trained_on_prep_chart_filters'] = array('Sub_County', 'County');
$config['health_care_workers_trained_on_prep_chart_filters_default'] = array();

//facility_source_of_ARVs_chart 
$config['facility_source_of_ARVs_chart_chartview'] = 'charts/bar_view';
$config['facility_source_of_ARVs_chart_title'] = 'Facility Source of ARVs(National)';
$config['facility_source_of_ARVs_chart_yaxis_title'] = 'No. of Facilities';
$config['facility_source_of_ARVs_chart_source'] = 'Source: www.prep.nascop.org';
$config['facility_source_of_ARVs_chart_has_drilldown'] = FALSE;
$config['facility_source_of_ARVs_chart_filters'] = array('Sub_County', 'County');
$config['facility_source_of_ARVs_chart_filters_default'] = array();

//facility_source_of_arvs_by_county_chart 
$config['facility_source_of_arvs_by_county_chart_chartview'] = 'charts/stacked_column_percent_view_without_dataLabels';
$config['facility_source_of_arvs_by_county_chart_title'] = 'Facility Source of ARVs(By County)';
$config['facility_source_of_arvs_by_county_chart_yaxis_title'] = 'Percent(100%)';
$config['facility_source_of_arvs_by_county_chart_source'] = 'Source: www.prep.nascop.org';
$config['facility_source_of_arvs_by_county_chart_has_drilldown'] = FALSE;
$config['facility_source_of_arvs_by_county_chart_filters'] = array('Sub_County', 'County');
$config['facility_source_of_arvs_by_county_chart_filters_default'] = array();

//prep_dispensing_points_table 
$config['prep_dispensing_points_table_chartview'] = 'charts/bar_view';
$config['prep_dispensing_points_table_title'] = 'PrEP Dispensing Points in Facilities (National)';
$config['prep_dispensing_points_table_yaxis_title'] = 'No. of Facilities';
$config['prep_dispensing_points_table_source'] = 'Source: www.prep.nascop.org';
$config['prep_dispensing_points_table_has_drilldown'] = FALSE;
$config['prep_dispensing_points_table_filters'] = array('Sub_County', 'County');
$config['prep_dispensing_points_table_filters_default'] = array();

//prep_dispensing_points_chart 
$config['prep_dispensing_points_chart_chartview'] = 'charts/stacked_column_percent_view_without_dataLabels';
$config['prep_dispensing_points_chart_title'] = 'PrEP Dispensing Points in Facilities (By County)';
$config['prep_dispensing_points_chart_yaxis_title'] = 'Percent(100%)';
$config['prep_dispensing_points_chart_source'] = 'Source: www.prep.nascop.org';
$config['prep_dispensing_points_chart_has_drilldown'] = FALSE;
$config['prep_dispensing_points_chart_filters'] = array('Sub_County', 'County');
$config['prep_dispensing_points_chart_filters_default'] = array();

//prep_product_dispensed_table
$config['prep_product_dispensed_table_chartview'] = 'charts/bar_view';
$config['prep_product_dispensed_table_title'] = 'PrEP Product Dispensed in Facilities (National)';
$config['prep_product_dispensed_table_yaxis_title'] = 'Percent(100%)';
$config['prep_product_dispensed_table_source'] = 'Source: www.prep.nascop.org';
$config['prep_product_dispensed_table_has_drilldown'] = FALSE;
$config['prep_product_dispensed_table_filters'] = array('Sub_County', 'County');
$config['prep_product_dispensed_table_filters_default'] = array();

//prep_product_dispensed_chart
$config['prep_product_dispensed_chart_chartview'] = 'charts/stacked_column_view';
$config['prep_product_dispensed_chart_title'] = 'PrEP Product Dispensed in Facilities (By County)';
$config['prep_product_dispensed_chart_yaxis_title'] = 'No. of Facilities';
$config['prep_product_dispensed_chart_source'] = 'Source: www.prep.nascop.org';
$config['prep_product_dispensed_chart_has_drilldown'] = FALSE;
$config['prep_product_dispensed_chart_filters'] = array('Sub_County', 'County');
$config['prep_product_dispensed_chart_filters_default'] = array();

//prep_dispensing_software_table
$config['prep_dispensing_software_table_chartview'] = 'charts/bar_view';
$config['prep_dispensing_software_table_title'] = 'PrEP Dispensing Software in Facilities (National)';
$config['prep_dispensing_software_table_yaxis_title'] = 'No. of Facilities';
$config['prep_dispensing_software_table_source'] = 'Source: www.prep.nascop.org';
$config['prep_dispensing_software_table_has_drilldown'] = FALSE;
$config['prep_dispensing_software_table_filters'] = array('Sub_County', 'County');
$config['prep_dispensing_software_table_filters_default'] = array();

//prep_dispensing_software_chart 
$config['prep_dispensing_software_chart_chartview'] = 'charts/stacked_column_percent_view_without_dataLabels';
$config['prep_dispensing_software_chart_title'] = 'PrEP Dispensing Software in Facilities (By County)';
$config['prep_dispensing_software_chart_yaxis_title'] = 'Percent(100%)';
$config['prep_dispensing_software_chart_source'] = 'Source: www.prep.nascop.org';
$config['prep_dispensing_software_chart_has_drilldown'] = FALSE;
$config['prep_dispensing_software_chart_filters'] = array('Sub_County', 'County');
$config['prep_dispensing_software_chart_filters_default'] = array();

//lmis_tools_chart 
$config['lmis_tools_chart_chartview'] = 'charts/column_drilldown_view';
$config['lmis_tools_chart_title'] = 'Availability of LMIS Tools in Facilities';
$config['lmis_tools_chart_yaxis_title'] = 'No. of Facilities';
$config['lmis_tools_chart_source'] = 'Source: www.prep.nascop.org';
$config['lmis_tools_chart_has_drilldown'] = TRUE;
$config['lmis_tools_chart_filters'] = array('Sub_County', 'County');
$config['lmis_tools_chart_filters_default'] = array();

//clinical_encounter_forms_chart 
$config['clinical_encounter_forms_chart_chartview'] = 'charts/column_drilldown_view';
$config['clinical_encounter_forms_chart_title'] = 'Availability of Clinical Encounter Forms in Facilities';
$config['clinical_encounter_forms_chart_yaxis_title'] = 'No. of Facilities';
$config['clinical_encounter_forms_chart_source'] = 'Source: www.prep.nascop.org';
$config['clinical_encounter_forms_chart_has_drilldown'] = TRUE;
$config['clinical_encounter_forms_chart_filters'] = array('Sub_County', 'County');
$config['clinical_encounter_forms_chart_filters_default'] = array();

//pharmacovigilance_tools_chart 
$config['pharmacovigilance_tools_chart_chartview'] = 'charts/column_drilldown_view';
$config['pharmacovigilance_tools_chart_title'] = 'Availability of Pharmacovigilance Tools in Facilities';
$config['pharmacovigilance_tools_chart_yaxis_title'] = 'No. of Facilities';
$config['pharmacovigilance_tools_chart_source'] = 'Source: www.prep.nascop.org';
$config['pharmacovigilance_tools_chart_has_drilldown'] = TRUE;
$config['pharmacovigilance_tools_chart_filters'] = array('Sub_County', 'County');
$config['pharmacovigilance_tools_chart_filters_default'] = array();

//prep_register_chart 
$config['prep_register_chart_chartview'] = 'charts/column_drilldown_view';
$config['prep_register_chart_title'] = 'Availability of PrEP Register in Facilities';
$config['prep_register_chart_yaxis_title'] = 'No. of Facilities';
$config['prep_register_chart_source'] = 'Source: www.prep.nascop.org';
$config['prep_register_chart_has_drilldown'] = TRUE;
$config['prep_register_chart_filters'] = array('Sub_County', 'County');
$config['prep_register_chart_filters_default'] = array();

//rapid_assessment_screening_tool_chart 
$config['rapid_assessment_screening_tools_chart_chartview'] = 'charts/column_drilldown_view';
$config['rapid_assessment_screening_tools_chart_title'] = 'Availability of  Rapid Assessment Screening Tools in Facilities';
$config['rapid_assessment_screening_tools_chart_yaxis_title'] = 'No. of Facilities';
$config['rapid_assessment_screening_tools_chart_source'] = 'Source: www.prep.nascop.org';
$config['rapid_assessment_screening_tools_chart_has_drilldown'] = TRUE;
$config['rapid_assessment_screening_tools_chart_filters'] = array('Sub_County', 'County');
$config['rapid_assessment_screening_tools_chart_filters_default'] = array();

//prep_summary_tools_chart 
$config['prep_summary_tools_chart_chartview'] = 'charts/column_drilldown_view';
$config['prep_summary_tools_chart_title'] = 'Availability of PrEP Summary Tools in Facilities';
$config['prep_summary_tools_chart_yaxis_title'] = 'No. of Facilities';
$config['prep_summary_tools_chart_source'] = 'Source: www.prep.nascop.org';
$config['prep_summary_tools_chart_has_drilldown'] = TRUE;
$config['prep_summary_tools_chart_filters'] = array('Sub_County', 'County');
$config['prep_summary_tools_chart_filters_default'] = array();

//clients_on_prep_chart 
$config['clients_on_prep_chart_chartview'] = 'charts/combined_column_view';
$config['clients_on_prep_chart_title'] = 'Clients ever on PrEP as at  February 2018 ';
$config['clients_on_prep_chart_yaxis_title'] = 'No. of Clients';
$config['clients_on_prep_chart_source'] = 'Source: www.prep.nascop.org';
$config['clients_on_prep_chart_has_drilldown'] = FALSE;
$config['clients_on_prep_chart_filters'] = array('Sub_County', 'County');
$config['clients_on_prep_chart_filters_default'] = array();

//demand_creation_activities_chart 
$config['demand_creation_activities_chart_chartview'] = 'charts/stacked_column_percent_view_without_dataLabels';
$config['demand_creation_activities_chart_title'] = 'Availability of Demand Creation Activities in Facilities';
$config['demand_creation_activities_chart_yaxis_title'] = 'Percentage(100%)';
$config['demand_creation_activities_chart_source'] = 'Source: www.prep.nascop.org';
$config['demand_creation_activities_chart_has_drilldown'] = FALSE;
$config['demand_creation_activities_chart_filters'] = array('Sub_County', 'County');
$config['demand_creation_activities_chart_filters_default'] = array();

//prep_education_availability_chart
$config['prep_education_availability_chart_chartview'] = 'charts/stacked_column_percent_view_without_dataLabels';
$config['prep_education_availability_chart_title'] = 'Availability of Demand Creation Activities in the Community';
$config['prep_education_availability_chart_yaxis_title'] = 'Percentage(100%)';
$config['prep_education_availability_chart_source'] = 'Source: www.prep.nascop.org';
$config['prep_education_availability_chart_has_drilldown'] = FALSE;
$config['prep_education_availability_chart_filters'] = array('Sub_County', 'County');
$config['prep_education_availability_chart_filters_default'] = array();

//iec_materials_chart 
$config['iec_materials_chart_chartview'] = 'charts/stacked_column_percent_view_without_dataLabels';
$config['iec_materials_chart_title'] = 'Availability of IEC Materials in Facilities';
$config['iec_materials_chart_yaxis_title'] = 'Percentage(100%)';
$config['iec_materials_chart_source'] = 'Source: www.prep.nascop.org';
$config['iec_materials_chart_has_drilldown'] = FALSE;
$config['iec_materials_chart_filters'] = array('Sub_County', 'County');
$config['iec_materials_chart_filters_default'] = array();
