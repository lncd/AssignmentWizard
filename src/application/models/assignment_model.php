<?php

class Assignment_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    

    /**
    * Get details for a specific assignment
    *
    * @param int $assignment_id The ID of the assignment
    *
    * @return Object representing the assignment 
    * @access Public
    */
    public function get_assessment($assessment_id)
    {
        $result = json_decode(file_get_contents($_SERVER['N2_URI'] . 'assessments/id/' . $assessment_id . '?access_token=' . $_SERVER['N2_ACCESS_TOKEN']));
        $returning = $result->result;

        $formatted_los = '<p>On successful completion of this assessment package a student will have demonstrated competence in the following areas:</p><ul>';

        foreach ($result->result->learning_outcomes as $lo)
        {
            $formatted_los.= '<li>' . $lo->description . '</li>';
        }

        $formatted_los.= '</ul>';
        $returning->formatted_los = $formatted_los;
        return $returning;
    }

    /**
    * Create an assignment
    *
    * @param array $data_array Array containinig assignment data
    *
    * @return Success / error notification
    * @access Public
    */
    public function create_assignment($data_array)
    {
        $old_doc = new Assessment_documentation();
        $old_doc->where('assessment_id', $data_array['assessment_id']);
        $old_doc->where('status !=', 'removed');
        $old_doc->update('status', 'superceded');

        $this->load->model('setting_model');

        $new_doc = new Assessment_documentation();
        $new_doc->assessment_id = $data_array['assessment_id'];
        if($data_array['assignment_title'])
        {
            $new_doc->title = $data_array['assignment_title'];
        }

        if($data_array['assignment_text'])
        {
            $new_doc->brief_text = $data_array['assignment_text'];
        }
        $new_doc->status = $data_array['Array'];
        $new_doc->submission_guidelines = $this->setting_model->get_setting(1);

        $new_doc->save();

        return $new_doc->id;
    }

    /**
    * Check if assignment has a pdf associated with it
    *
    * @param int $assignment_id The ID of the assignment
    *
    * @return Object representing the pdf doc
    * @access Public
    */
    public function get_assignment_pdf($assignment_id)
    {
        $adf = new assignment_doc_file();
        $adf->where('assignment_id', (int) $assignment_id)->get();

        echo '<pre>';
        print_r($adf);
        echo '</pre>';
        die();
    }


    /**
    * Get details for a specific assignment doc
    *
    * @param int $assignment_id The ID of the assignment
    *
    * @return Object representing the assignment doc
    * @access Public
    */
    public function get_assignment_documentation($assignment_id)
    {
        $assignment_doc = new Assessment_documentation();
        $assignment_doc->where('id', (int) $assignment_id);
        $assignment_doc->where('status !=', 'removed');
        $assignment_doc->order_by('id', 'desc');
        $assignment_doc->limit(1);
        $assignment_doc->get();

        $returning = new stdClass();
        $returning = $assignment_doc->stored;

        $assignment_doc_file = new Assessment_document_file();
        $assignment_doc_file->where('assignment_id', $assignment_id)->get();

        $returning->file = $assignment_doc_file->stored;

        return $returning;
    }

    /**
    * Get assessment information from N2 from an assignment (local) ID 
    *
    * @param int $assignment_id The ID of the assignment document
    *
    * @return Object representing the assessment
    * @access Public
    */
    public function get_assessment_by_assignment_id($assignment_id)
    {
        $assignment_doc = new Assessment_documentation();
        $assignment_doc->where('id', $assignment_id);
        $assignment_doc->get();

        $assessment_id = $assignment_doc->assessment_id;

        $result = json_decode(file_get_contents($_SERVER['N2_URI'] . 'assessments/id/' . $assessment_id . '?access_token=' . $_SERVER['N2_ACCESS_TOKEN']));
        
        $returning = new stdClass();
        $returning= $result->result;

        $module_result = json_decode(file_get_contents($_SERVER['N2_URI'] . 'modules/id/' . $result->result->module->id . '?access_token=' . $_SERVER['N2_ACCESS_TOKEN']));
        $returning->school = $module_result->result->schools[0];

        $formatted_los = '<p>On successful completion of this assessment package a student will have demonstrated competence in the following areas:</p><ul>';

        foreach ($result->result->learning_outcomes as $lo)
        {
            $formatted_los.= '<li>' . $lo->description . '</li>';
        }

        $formatted_los.= '</ul>';
        $returning->formatted_los = $formatted_los;
        return $returning;
    }

    /**
    * Save assignment document
    */
    public function save_assignment_document($assignment_id, $timestamp)
    {
        $adf = new Assessment_document_file();
        $adf->assignment_id = $assignment_id;
        $adf->file = $assignment_id . '_' . $timestamp . '.pdf';
        $adf->save();
    }
}
?>