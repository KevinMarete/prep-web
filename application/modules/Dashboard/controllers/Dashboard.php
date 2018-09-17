<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Dashboard extends BaseController {

    public function index() {
        $this->isLoggedIn();
        $data['page_title'] = 'PrEP | Dashboard';
        $this->load->view('template/dashboard_view', $data);
    }

    public function get_chart() {
        $chartname = $this->input->post('name');
        $selectedfilters = $this->get_filter($chartname, $this->input->post('selectedfilters'));
        //Get chart configuration
        $data['chart_name'] = $chartname;
        $data['chart_title'] = $this->config->item($chartname . '_title');
        $data['chart_yaxis_title'] = $this->config->item($chartname . '_yaxis_title');
        $data['chart_xaxis_title'] = $this->config->item($chartname . '_xaxis_title');
        $data['chart_source'] = $this->config->item($chartname . '_source');
        //Get data
        $main_data = array('main' => array(), 'drilldown' => array(), 'columns' => array());
        $main_data = $this->get_data($chartname, $selectedfilters);
        if ($this->config->item($chartname . '_has_drilldown')) {
            $data['chart_drilldown_data'] = json_encode(@$main_data['drilldown'], JSON_NUMERIC_CHECK);
        } else {
            $data['chart_categories'] = json_encode(@$main_data['columns'], JSON_NUMERIC_CHECK);
        }
        $data['selectedfilters'] = htmlspecialchars(json_encode($selectedfilters), ENT_QUOTES, 'UTF-8');
        $data['chart_series_data'] = json_encode($main_data['main'], JSON_NUMERIC_CHECK);
        //Load chart
        $this->load->view($this->config->item($chartname . '_chartview'), $data);
    }

    public function get_filter($chartname, $selectedfilters) {
        $filters = $this->config->item($chartname . '_filters_default');
        $filtersColumns = $this->config->item($chartname . '_filters');

        if (!empty($selectedfilters)) {
            foreach (array_keys($selectedfilters) as $filter) {
                if (in_array($filter, $filtersColumns)) {
                    $filters[$filter] = $selectedfilters[$filter];
                }
            }
        }
        return $filters;
    }

    public function get_data($chartname, $filters) {
        if ($chartname == 'facilities_level_distribution_chart') {
            $main_data = $this->Service_delivery_model->get_facilities_level_distribution($filters);
        } else if ($chartname == 'prep_focal_person_chart') {
            $main_data = $this->Service_delivery_model->get_prep_focal_person($filters);
        } else if ($chartname == 'hiv_services_offered_chart') {
            $main_data = $this->Service_delivery_model->get_hiv_services_offered($filters);
        } else if ($chartname == 'current_service_delivery_points_distribution_table') {
            $main_data = $this->Service_delivery_model->get_current_service_delivery_points_distribution_numbers($filters);
        } else if ($chartname == 'current_service_delivery_points_distribution_chart') {
            $main_data = $this->Service_delivery_model->get_current_service_delivery_points_distribution($filters);
        } else if ($chartname == 'preferred_service_delivery_point_table') {
            $main_data = $this->Service_delivery_model->get_prep_preffered_sdp_numbers($filters);
        } else if ($chartname == 'population_receiving_prep_chart') {
            $main_data = $this->Service_delivery_model->get_population_receiving_prep_numbers($filters);
        } else if ($chartname == 'partner_support_chart') {
            $main_data = $this->Partner_model->get_partner_support($filters);
        } else if ($chartname == 'key_populations_targeted_by_prep_partner_chart') {
            $main_data = $this->Partner_model->get_key_populations_targeted_by_prep_partner($filters);
        } else if ($chartname == 'service_delivery_point_by_partner_chart') {
            $main_data = $this->Partner_model->get_partner_service_delivery_point($filters);
        } else if ($chartname == 'hcw_trained_by_partner_chart') {
            $main_data = $this->Partner_model->get_hcw_trained_by_partner($filters);
        } else if ($chartname == 'partner_facility_table') {
            $main_data = $this->Partner_model->get_partner_facility_numbers($filters);
        } else if ($chartname == 'access_creatinine_testing_facilities_chart') {
            $main_data = $this->Laboratory_service_model->get_access_creatinine_testing($filters);
        } else if ($chartname == 'creatinine_testing_equipment_availability_chart') {
            $main_data = $this->Laboratory_service_model->get_creatinine_testing_equipment($filters);
        } else if ($chartname == 'offsite_onsite_creatinine_testing_chart') {
            $main_data = $this->Laboratory_service_model->get_offsite_onsite_creatinine_testing($filters);
        } else if ($chartname == 'creatinine_reagents_chart') {
            $main_data = $this->Laboratory_service_model->get_creatinine_reagents($filters);
        } else if ($chartname == 'access_creatinine_testing_in_relation_to_equipment_availability_table') {
            $main_data = $this->Laboratory_service_model->get_access_creatinine_testing_in_relation_to_equipment_availability_numbers($filters);
        } else if ($chartname == 'creatinine_reagents_availability_in_relation_to_equipment_table') {
            $main_data = $this->Laboratory_service_model->get_creatinine_availability_reagents_in_relation_to_equipment_numbers($filters);
        } else if ($chartname == 'creatinine_reagents_unavailability_in_relation_to_equipment_table') {
            $main_data = $this->Laboratory_service_model->get_creatinine_unavailability_reagents_in_relation_to_equipment_numbers($filters);
        } else if ($chartname == 'access_hep_b_testing_facilities_chart') {
            $main_data = $this->Laboratory_service_model->get_access_hep_b_testing($filters);
        } else if ($chartname == 'hep_b_testing_equipment_availability_chart') {
            $main_data = $this->Laboratory_service_model->get_hep_b_testing_equipment($filters);
        } else if ($chartname == 'offsite_onsite_hep_b_testing_chart') {
            $main_data = $this->Laboratory_service_model->get_offsite_onsite_hep_b_testing($filters);
        } else if ($chartname == 'hep_b_reagents_chart') {
            $main_data = $this->Laboratory_service_model->get_hep_b_reagents($filters);
        } else if ($chartname == 'access_hep_b_testing_facilities_table') {
            $main_data = $this->Laboratory_service_model->get_access_hep_b_testing_numbers($filters);
        } else if ($chartname == 'access_hep_b_testing_facilities_table') {
            $main_data = $this->Laboratory_service_model->get_access_hep_b_testing_numbers($filters);
        } else if ($chartname == 'offsite_onsite_hep_b_testing_table') {
            $main_data = $this->Laboratory_service_model->get_offsite_onsite_hep_b_testing_numbers($filters);
        } else if ($chartname == 'access_hep_c_testing_facilities_table') {
            $main_data = $this->Laboratory_service_model->get_access_hep_c_testing_numbers($filters);
        } else if ($chartname == 'access_hep_c_testing_facilities_chart') {
            $main_data = $this->Laboratory_service_model->get_access_hep_c_testing($filters);
        } else if ($chartname == 'hep_c_testing_equipment_availability_chart') {
            $main_data = $this->Laboratory_service_model->get_hep_c_testing_equipment($filters);
        } else if ($chartname == 'offsite_onsite_hep_c_testing_chart') {
            $main_data = $this->Laboratory_service_model->get_offsite_onsite_hep_c_testing($filters);
        } else if ($chartname == 'hep_c_reagents_chart') {
            $main_data = $this->Laboratory_service_model->get_hep_c_reagents($filters);
        } else if ($chartname == 'offsite_onsite_hep_c_testing_table') {
            $main_data = $this->Laboratory_service_model->get_offsite_onsite_hep_c_testing_numbers($filters);
        } else if ($chartname == 'distibution_of_facilities_trained_personnel_chart') {
            $main_data = $this->Human_resource_model->get_distibution_of_facilities_trained_personnel($filters);
        } else if ($chartname == 'cadre_trained_chart') {
            $main_data = $this->Human_resource_model->get_cadre_trained($filters);
        } else if ($chartname == 'health_care_workers_trained_on_prep_chart') {
            $main_data = $this->Human_resource_model->get_health_care_workers_trained_on_prep($filters);
        } else if ($chartname == 'health_care_workers_trained_on_prep_table') {
            $main_data = $this->Human_resource_model->get_health_care_workers_trained_on_prep_numbers($filters);
        } else if ($chartname == 'facility_source_of_ARVs_chart') {
            $main_data = $this->Commodity_management_model->get_facility_source_of_ARVs($filters);
        } else if ($chartname == 'facility_source_of_arvs_by_county_chart') {
            $main_data = $this->Commodity_management_model->get_facility_source_of_arvs_by_county($filters);
        } else if ($chartname == 'prep_dispensing_points_table') {
            $main_data = $this->Commodity_management_model->get_prep_dispensing_points_numbers($filters);
        } else if ($chartname == 'prep_dispensing_points_chart') {
            $main_data = $this->Commodity_management_model->get_prep_dispensing_points($filters);
        } else if ($chartname == 'prep_dispensing_software_chart') {
            $main_data = $this->Commodity_management_model->get_prep_dispensing_software($filters);
        } else if ($chartname == 'prep_product_dispensed_table') {
            $main_data = $this->Commodity_management_model->get_prep_product_dispensed_numbers($filters);
        } else if ($chartname == 'prep_product_dispensed_chart') {
            $main_data = $this->Commodity_management_model->get_prep_product_dispensed($filters);
        } else if ($chartname == 'prep_dispensing_software_table') {
            $main_data = $this->Commodity_management_model->get_prep_dispensing_software_numbers($filters);
        } else if ($chartname == 'lmis_tools_chart') {
            $main_data = $this->Monitoring_evaluation_model->get_lmis_tools($filters);
        } else if ($chartname == 'clinical_encounter_forms_chart') {
            $main_data = $this->Monitoring_evaluation_model->get_clinical_encounter_forms($filters);
        } else if ($chartname == 'pharmacovigilance_tools_chart') {
            $main_data = $this->Monitoring_evaluation_model->get_pharmacovigilance_tools($filters);
        } else if ($chartname == 'prep_register_chart') {
            $main_data = $this->Monitoring_evaluation_model->get_prep_registers($filters);
        } else if ($chartname == 'rapid_assessment_screening_tools_chart') {
            $main_data = $this->Monitoring_evaluation_model->get_rapid_assessment_screening_tools($filters);
        } else if ($chartname == 'prep_summary_tools_chart') {
            $main_data = $this->Monitoring_evaluation_model->get_prep_summmary_tools($filters);
        } else if ($chartname == 'clients_on_prep_chart') {
            $main_data = $this->Monitoring_evaluation_model->get_clients_on_prep($filters);
        } else if ($chartname == 'demand_creation_activities_chart') {
            $main_data = $this->Communication_advocacy_model->get_demand_creation_activities($filters);
        } else if ($chartname == 'prep_education_availability_chart') {
            $main_data = $this->Communication_advocacy_model->get_prep_education_activities($filters);
        } else if ($chartname == 'iec_materials_chart') {
            $main_data = $this->Communication_advocacy_model->get_iec_materials($filters);
        }
        return $main_data;
    }

}
