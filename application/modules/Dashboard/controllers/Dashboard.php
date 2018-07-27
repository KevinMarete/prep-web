<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {

    public function index() {
        $data['page_title'] = 'prep | Dashboard';
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
        if ($chartname == 'facility_facility_ownership_chart') {
            $main_data = $this->Facility_service_model->get_facility_ownership($filters);
        } else if ($chartname == 'facility_facility_level_chart') {
            $main_data = $this->Facility_service_model->get_facility_level($filters);
        } else if ($chartname == 'hiv_service_offered_chart') {
            $main_data = $this->Facility_service_model->get_hiv_service_offered($filters);
        } else if ($chartname == 'facility_facility_count_chart') {
            $main_data = $this->Facility_service_model->get_facility_count($filters);
        } else if ($chartname == 'software_managing_prep_commodities_chart') {
            $main_data = $this->Commodity_management_model->get_software_managing_prep_commodities($filters);
        } else if ($chartname == 'facility_source_ARVs_chart') {
            $main_data = $this->Commodity_management_model->get_facility_source_ARVs($filters);
        } else if ($chartname == 'PrEP_drug_dispensation_chart') {
            $main_data = $this->Commodity_management_model->get_PrEP_drug_dispensation($filters);
        } else if ($chartname == 'training_national_PrEP_ME_tools_chart') {
            $main_data = $this->Commodity_management_model->get_training_national_PrEP_ME_tools($filters);
        } else if ($chartname == 'cadre_staff_dispensing_PrEP_chart') {
            $main_data = $this->Commodity_management_model->get_cadre_staff_dispensing_PrEP($filters);
        } else if ($chartname == 'commodity_mgmt_facility_level_chart') {
            $main_data = $this->Commodity_management_model->get_facility_level($filters);
        } else if ($chartname == 'commodity_mgmt_facility_ownership_chart') {
            $main_data = $this->Commodity_management_model->get_facility_ownership($filters);
        } else if ($chartname == 'commodity_mgmt_commodity_mgmt_facility_count_chart') {
            $main_data = $this->Commodity_management_model->get_facility_count($filters);
        } else if ($chartname == 'rapid_assessment_tool_availability_chart') {
            $main_data = $this->Communication_advocacy_model->get_rapid_assessment_tool_availability($filters);
        } else if ($chartname == 'tools_availability_chart') {
            $main_data = $this->Communication_advocacy_model->get_tools_availability($filters);
        } else if ($chartname == 'prep_summary_tool_chart') {
            $main_data = $this->Communication_advocacy_model->get_prep_summary_tool($filters);
        } else if ($chartname == 'clinical_encounter_form_chart') {
            $main_data = $this->Communication_advocacy_model->get_clinical_encounter_form($filters);
        } else if ($chartname == 'prep_register_availability_chart') {
            $main_data = $this->Communication_advocacy_model->get_prep_register_availability($filters);
        } else if ($chartname == 'hepatitis_b_availability_chart') {
            $main_data = $this->Communication_advocacy_model->get_hepatitis_b_distribution($filters);
        } else if ($chartname == 'hepatitis_c_availability_chart') {
            $main_data = $this->Communication_advocacy_model->get_hepatitis_c_distribution($filters);
        } else if ($chartname == 'creatinine_availability_chart') {
            $main_data = $this->Communication_advocacy_model->get_creatinine_distribution($filters);
        } else if ($chartname == 'PrEP_clients_both_ever_initiated_and_currently_on_care_chart') {
            $main_data = $this->Communication_advocacy_model->get_PrEP_clients_both_ever_initiated_and_currently_on_care($filters);
        } else if ($chartname == 'communication_adv_facility_level_chart') {
            $main_data = $this->Communication_advocacy_model->get_facility_level($filters);
        } else if ($chartname == 'communication_adv_facility_ownership_chart') {
            $main_data = $this->Communication_advocacy_model->get_facility_ownership($filters);
        } else if ($chartname == 'communication_adv_facility_count_chart') {
            $main_data = $this->Communication_advocacy_model->get_facility_count($filters);
        } else if ($chartname == 'support_implementing_partners_chart') {
            $main_data = $this->Partner_support_model->get_support_implementing_partners($filters);
        } else if ($chartname == 'partner_supported_component_chart') {
            $main_data = $this->Partner_support_model->get_partner_supported_component($filters);
        } else if ($chartname == 'partner_support_facility_level_chart') {
            $main_data = $this->Partner_support_model->get_facility_level($filters);
        } else if ($chartname == 'partner_support_facility_ownership_chart') {
            $main_data = $this->Partner_support_model->get_facility_ownership($filters);
        } else if ($chartname == 'partner_support_facility_count_chart') {
            $main_data = $this->Partner_support_model->get_facility_count($filters);
        }else if ($chartname == 'human_resource_support_implementing_partners_chart') {
            $main_data = $this->Human_resource_model->get_support_implementing_partners($filters);
        }else if ($chartname == 'human_resource_cadre_staff_dispensing_PrEP_chart') {
            $main_data = $this->Human_resource_model->get_cadre_staff_dispensing_PrEP($filters);
        }else if ($chartname == 'human_resource_training_national_PrEP_ME_tools_chart') {
            $main_data = $this->Human_resource_model->get_training_national_PrEP_ME_tools($filters);
        }
        return $main_data;
    }

}
