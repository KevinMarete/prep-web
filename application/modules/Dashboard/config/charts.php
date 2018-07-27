<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Support Implementing partners
$config['support_implementing_partners_chart_chartview'] = 'charts/pie_view';
$config['support_implementing_partners_chart_title'] = 'Support Implementing Partners';
$config['support_implementing_partners_chart_yaxis_title'] = 'Partners';
$config['support_implementing_partners_chart_source'] = 'Source: www.commodities.nascop.org';
$config['support_implementing_partners_chart_has_drilldown'] = FALSE;
$config['support_implementing_partners_chart_filters'] = array('subcounty_name', 'county_name');
$config['support_implementing_partners_chart_filters_default'] = array();

//facility count chart
$config['facility_count_chart_chartview'] = 'charts/column_drilldown_view';
$config['facility_count_chart_title'] = 'Facility Count Distribution';
$config['facility_count_chart_yaxis_title'] = 'No. of facilities';
$config['facility_count_chart_source'] = 'Source: www.commodities.nascop.org';
$config['facility_count_chart_has_drilldown'] = TRUE;
$config['facility_count_chart_filters'] = array('subcounty_name', 'county_name');
$config['facility_count_chart_filters_default'] = array();

//staff_dispensing_PrEP_chart
$config['staff_dispensing_PrEP_chart_chartview'] = 'charts/column_view';
$config['staff_dispensing_PrEP_chart_title'] = 'Cadre of Staff Dispensing PrEP';
$config['staff_dispensing_PrEP_chart_yaxis_title'] = 'Cadre';
$config['staff_dispensing_PrEP_chart_source'] = 'Source: www.commodities.nascop.org';
$config['staff_dispensing_PrEP_chart_has_drilldown'] = FALSE;
$config['staff_dispensing_PrEP_chart_filters'] = array('subcounty_name', 'county_name');
$config['staff_dispensing_PrEP_chart_filters_default'] = array();

//partners_percentage_support_chart
$config['partners_percentage_support_chart_chartview'] = 'charts/column_drilldown_percent_view';
$config['partners_percentage_support_chart_title'] = 'Partners Percentage Support';
$config['partners_percentage_support_chart_yaxis_title'] = '% Support';
$config['partners_percentage_support_chart_source'] = 'Source: www.commodities.nascop.org';
$config['partners_percentage_support_chart_has_drilldown'] = TRUE;
$config['partners_percentage_support_chart_filters'] = array('subcounty_name', 'county_name');
$config['partners_percentage_support_chart_filters_default'] = array();

//facility_ownership chart
$config['facility_ownership_chart_chartview'] = 'charts/pie_view';
$config['facility_ownership_chart_title'] = 'Facility Ownership';
$config['facility_ownership_chart_yaxis_title'] = '% ownership';
$config['facility_ownership_chart_source'] = 'Source: www.commodities.nascop.org';
$config['facility_ownership_chart_has_drilldown'] = FALSE;
$config['facility_ownership_chart_filters'] = array('subcounty_name', 'county_name');
$config['facility_ownership_chart_filters_default'] = array();

//facility_level chart
$config['facility_level_chart_chartview'] = 'charts/column_view';
$config['facility_level_chart_title'] = 'Facility Level';
$config['facility_level_chart_yaxis_title'] = 'number of facilities';
$config['facility_level_chart_source'] = 'Source: www.commodities.nascop.org';
$config['facility_level_chart_has_drilldown'] = FALSE;
$config['facility_level_chart_filters'] = array('subcounty_name', 'county_name');
$config['facility_level_chart_filters_default'] = array();

//partner_supported_component_chart
$config['partner_supported_component_chart_chartview'] = 'charts/column_view';
$config['partner_supported_component_chart_title'] = 'Partner Supported Components';
$config['partner_supported_component_chart_yaxis_title'] = 'number of components';
$config['partner_supported_component_chart_source'] = 'Source: www.commodities.nascop.org';
$config['partner_supported_component_chart_has_drilldown'] = FALSE;
$config['partner_supported_component_chart_filters'] = array('subcounty_name', 'county_name');
$config['partner_supported_component_chart_filters_default'] = array();

//hiv_service offered chart
$config['hiv_service_offered_chart_chartview'] = 'charts/column_percent_view';
$config['hiv_service_offered_chart_title'] = ' HIV Services Offered';
$config['hiv_service_offered_chart_yaxis_title'] = '% services';
$config['hiv_service_offered_chart_source'] = 'Source: www.commodities.nascop.org';
$config['hiv_service_offered_chart_has_drilldown'] = FALSE;
$config['hiv_service_offered_chart_filters'] = array('subcounty_name', 'county_name');
$config['hiv_service_offered_chart_filters_default'] = array();

//county hepatitis b availablity chart
$config['hepatitis_b_availability_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['hepatitis_b_availability_chart_title'] = 'Hepatitis B Equipment Availability on Facilities';
$config['hepatitis_b_availability_chart_yaxis_title'] = '% of hepatitis B equipments';
$config['hepatitis_b_availability_chart_source'] = 'Source: www.commodities.nascop.org';
$config['hepatitis_b_availability_chart_has_drilldown'] = FALSE;
$config['hepatitis_b_availability_chart_filters'] = array('subcounty_name', 'county_name');
$config['hepatitis_b_availability_chart_filters_default'] = array();

//county hepatitis c availability chart
$config['hepatitis_c_availability_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['hepatitis_c_availability_chart_title'] = 'Hepatitis C Equipment Availability on Facilities';
$config['hepatitis_c_availability_chart_yaxis_title'] = '% of hepatitis C equipments';
$config['hepatitis_c_availability_chart_source'] = 'Source: www.commodities.nascop.org';
$config['hepatitis_c_availability_chart_has_drilldown'] = FALSE;
$config['hepatitis_c_availability_chart_filters'] = array('subcounty_name', 'county_name');
$config['hepatitis_c_availability_chart_filters_default'] = array();

//county creatinine availability chart
$config['creatinine_availability_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['creatinine_availability_chart_title'] = 'Creatinine Equipment Availability on Facilities';
$config['creatinine_availability_chart_yaxis_title'] = '% of creatinine equipments';
$config['creatinine_availability_chart_source'] = 'Source: www.commodities.nascop.org';
$config['creatinine_availability_chart_has_drilldown'] = FALSE;
$config['creatinine_availability_chart_filters'] = array('subcounty_name', 'county_name');
$config['creatinine_availability_chart_filters_default'] = array();

//facility population offered PrEP
$config['facility_population_offered_PrEP_chart_chartview'] = 'charts/pie_view';
$config['facility_population_offered_PrEP_chart_title'] = 'Population Offered PrEP';
$config['facility_population_offered_PrEP_chart_yaxis_title'] = 'Services';
$config['facility_population_offered_PrEP_chart_source'] = 'Source: www.commodities.nascop.org';
$config['facility_population_offered_PrEP_chart_has_drilldown'] = FALSE;
$config['facility_population_offered_PrEP_chart_filters'] = array('subcounty_name', 'county_name');
$config['facility_population_offered_PrEP_chart_filters_default'] = array();

//lab_services_availability_chart
$config['lab_services_availability_chart_chartview'] = 'charts/pie_view';
$config['lab_services_availability_chart_title'] = 'Lab Services Availability';
$config['lab_services_availability_chart_yaxis_title'] = 'Services';
$config['lab_services_availability_chart_source'] = 'Source: www.commodities.nascop.org';
$config['lab_services_availability_chart_has_drilldown'] = FALSE;
$config['lab_services_availability_chart_filters'] = array('subcounty_name', 'county_name');
$config['lab_services_availability_chart_filters_default'] = array();

//PrEP register availability chart
$config['prep_register_availability_chart_chartview'] = 'charts/column_drilldown_percent_view';
$config['prep_register_availability_chart_title'] = 'PrEP Register Availability';
$config['prep_register_availability_chart_yaxis_title'] = '% of registers';
$config['prep_register_availability_chart_source'] = 'Source: www.commodities.nascop.org';
$config['prep_register_availability_chart_has_drilldown'] = TRUE;
$config['prep_register_availability_chart_filters'] = array('subcounty_name', 'county_name');
$config['prep_register_availability_chart_filters_default'] = array();

//training_national_PrEP_M&E_tools_chart
$config['training_national_PrEP_ME_tools_chart_chartview'] = 'charts/pie_view';
$config['training_national_PrEP_ME_tools_chart_title'] = 'Training On National PrEP M&E Tool(s)';
$config['training_national_PrEP_ME_tools_chart_yaxis_title'] = 'Training';
$config['training_national_PrEP_ME_tools_chart_source'] = 'Source: www.commodities.nascop.org';
$config['training_national_PrEP_ME_tools_chart_has_drilldown'] = FALSE;
$config['training_national_PrEP_ME_tools_chart_filters'] = array('subcounty_name', 'county_name');
$config['training_national_PrEP_ME_tools_chart_filters_default'] = array();

//Rapid Assessment tool availability chart
$config['rapid_assessment_tool_availability_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['rapid_assessment_tool_availability_chart_title'] = 'Rapid Assessment Tool(s) Availability';
$config['rapid_assessment_tool_availability_chart_yaxis_title'] = '% of tools';
$config['rapid_assessment_tool_availability_chart_source'] = 'Source: www.commodities.nascop.org';
$config['rapid_assessment_tool_availability_chart_has_drilldown'] = FALSE;
$config['rapid_assessment_tool_availability_chart_filters'] = array('subcounty_name', 'county_name');
$config['rapid_assessment_tool_availability_chart_filters_default'] = array();

//PrEP summary tool chart
$config['prep_summary_tool_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['prep_summary_tool_chart_title'] = 'PrEP Summary Tool(s)';
$config['prep_summary_tool_chart_yaxis_title'] = '% of tools';
$config['prep_summary_tool_chart_source'] = 'Source: www.commodities.nascop.org';
$config['prep_summary_tool_chart_has_drilldown'] = FALSE;
$config['prep_summary_tool_chart_filters'] = array('subcounty_name', 'county_name');
$config['prep_summary_tool_chart_filters_default'] = array();

//tools_availability_chart
$config['tools_availability_chart_chartview'] = 'charts/column_view';
$config['tools_availability_chart_title'] = 'Tools Availability';
$config['tools_availability_chart_yaxis_title'] = 'Tools';
$config['tools_availability_chart_source'] = 'Source: www.commodities.nascop.org';
$config['tools_availability_chart_has_drilldown'] = FALSE;
$config['tools_availability_chart_filters'] = array('subcounty_name', 'county_name');
$config['tools_availability_chart_filters_default'] = array();

//Clinical Encounter Form chart
$config['clinical_encounter_form_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['clinical_encounter_form_chart_title'] = 'Clinical Encounter Form';
$config['clinical_encounter_form_chart_yaxis_title'] = '% of tools';
$config['clinical_encounter_form_chart_source'] = 'Source: www.commodities.nascop.org';
$config['clinical_encounter_form_chart_has_drilldown'] = FALSE;
$config['clinical_encounter_form_chart_filters'] = array('subcounty_name', 'county_name');
$config['clinical_encounter_form_chart_filters_default'] = array();

//follow_up_mathod chart
$config['follow_up_method_chart_chartview'] = 'charts/column_view';
$config['follow_up_method_chart_title'] = 'Follow-Up Methods';
$config['follow_up_method_chart_yaxis_title'] = 'Follow Up Mechanism';
$config['follow_up_method_chart_source'] = 'Source: www.commodities.nascop.org';
$config['follow_up_method_chart_has_drilldown'] = FALSE;
$config['follow_up_method_chart_filters'] = array('subcounty_name', 'county_name');
$config['follow_up_method_chart_filters_default'] = array();

//service_providers_training_chart
$config['service_providers_training_chart_chartview'] = 'charts/column_view';
$config['service_providers_training_chart_title'] = 'Service Providers Training';
$config['service_providers_training_chart_yaxis_title'] = 'training';
$config['service_providers_training_chart_source'] = 'Source: www.commodities.nascop.org';
$config['service_providers_training_chart_has_drilldown'] = FALSE;
$config['service_providers_training_chart_filters'] = array('subcounty_name', 'county_name');
$config['service_providers_training_chart_filters_default'] = array();

//PrEP_clients_both_ever_initiated_and_currently_on_care_chart
$config['PrEP_clients_both_ever_initiated_and_currently_on_care_chart_chartview'] = 'charts/stacked_column_percent_view';
$config['PrEP_clients_both_ever_initiated_and_currently_on_care_chart_title'] = 'PrEP Clients Both Ever Initiated and Currently on Care';
$config['PrEP_clients_both_ever_initiated_and_currently_on_care_chart_yaxis_title'] = 'number of clients';
$config['PrEP_clients_both_ever_initiated_and_currently_on_care_chart_source'] = 'Source: www.commodities.nascop.org';
$config['PrEP_clients_both_ever_initiated_and_currently_on_care_chart_has_drilldown'] = FALSE;
$config['PrEP_clients_both_ever_initiated_and_currently_on_care_chart_filters'] = array('subcounty_name','county_name');
$config['PrEP_clients_both_ever_initiated_and_currently_on_care_chart_filters_default'] = array();

//Software used to manage PrEP commodities chart
$config['software_managing_prep_commodities_chart_chartview'] = 'charts/column_view';
$config['software_managing_prep_commodities_chart_title'] = 'Application Used To Manage PrEP Commodities';
$config['software_managing_prep_commodities_chart_yaxis_title'] = 'No. of tools';
$config['software_managing_prep_commodities_chart_source'] = 'Source: www.commodities.nascop.org';
$config['software_managing_prep_commodities_chart_has_drilldown'] = FALSE;
$config['software_managing_prep_commodities_chart_filters'] = array('subcounty_name', 'county_name');
$config['software_managing_prep_commodities_chart_filters_default'] = array();

//facility_source_ARVs_chart
$config['facility_source_ARVs_chart_chartview'] = 'charts/pie_view';
$config['facility_source_ARVs_chart_title'] = 'Facilities Source Of ARVs';
$config['facility_source_ARVs_chart_yaxis_title'] = 'Services';
$config['facility_source_ARVs_chart_source'] = 'Source: www.commodities.nascop.org';
$config['facility_source_ARVs_chart_has_drilldown'] = FALSE;
$config['facility_source_ARVs_chart_filters'] = array('subcounty_name', 'county_name');
$config['facility_source_ARVs_chart_filters_default'] = array();

//cadre_staff_dispensing_PrEP_chart
$config['cadre_staff_dispensing_PrEP_chart_chartview'] = 'charts/column_view';
$config['cadre_staff_dispensing_PrEP_chart_title'] = 'Cadre Of Staff Dispensing PrEP';
$config['cadre_staff_dispensing_PrEP_chart_yaxis_title'] = 'Cadre';
$config['cadre_staff_dispensing_PrEP_chart_source'] = 'Source: www.commodities.nascop.org';
$config['cadre_staff_dispensing_PrEP_chart_has_drilldown'] = FALSE;
$config['cadre_staff_dispensing_PrEP_chart_filters'] = array('subcounty_name', 'county_name');
$config['cadre_staff_dispensing_PrEP_chart_filters_default'] = array();

//PrEP_drug_dispensation_chart
$config['PrEP_drug_dispensation_chart_chartview'] = 'charts/bar_view';
$config['PrEP_drug_dispensation_chart_title'] = 'PrEP Drug Dispensation';
$config['PrEP_drug_dispensation_chart_yaxis_title'] = 'dispensation';
$config['PrEP_drug_dispensation_chart_source'] = 'Source: www.commodities.nascop.org';
$config['PrEP_drug_dispensation_chart_chart_has_drilldown'] = FALSE;
$config['PrEP_drug_dispensation_chart_filters'] = array('subcounty_name', 'county_name');
$config['PrEP_drug_dispensation_chart_filters_default'] = array();

//facility_partner_service_delivery_point_table
$config['facility_partner_service_delivery_point_table_chartview'] = 'charts/table_view';
$config['facility_partner_service_delivery_point_table_title'] = 'Facilty Partner Service Delivery Points Table';
$config['facility_partner_service_delivery_point_table_yaxis_title'] = 'Delivery points';
$config['facility_partner_service_delivery_point_table_source'] = 'Source: www.commodities.nascop.org';
$config['facility_partner_service_delivery_point_table_has_drilldown'] = FALSE;
$config['facility_partner_service_delivery_point_table_filters'] = array('subcounty_name', 'county_name');
$config['facility_partner_service_delivery_point_table_filters_default'] = array();

//gaps_per_county_chart
$config['gaps_per_county_chart_chartview'] = 'charts/stacked_column_view';
$config['gaps_per_county_chart_title'] = 'Gaps Per County';
$config['gaps_per_county_chart_yaxis_title'] = 'No. of Gaps';
$config['gaps_per_county_chart_source'] = 'Source: www.commodities.nascop.org';
$config['gaps_per_county_chart_has_drilldown'] = FALSE;
$config['gaps_per_county_chart_filters'] = array('subcounty_name', 'county_name');
$config['gaps_per_county_chart_filters_default'] = array();

//gaps_per_county_table
$config['gaps_per_county_table_chartview'] = 'charts/table_view';
$config['gaps_per_county_table_title'] = 'Gaps Per County';
$config['gaps_per_county_table_yaxis_title'] = 'No. of Patients';
$config['gaps_per_county_table_source'] = 'Source: www.commodities.nascop.org';
$config['gaps_per_county_table_has_drilldown'] = FALSE;
$config['gaps_per_county_table_filters'] = array('subcounty_name', 'county_name');
$config['gaps_per_county_table_filters_default'] = array();


