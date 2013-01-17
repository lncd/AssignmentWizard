<?php

class Module_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    /**
    * Get a list of modules for use in dropdown menus
    *
    * @return Array of modules
    * @access Public
    */
    public function get_module_array()
    {
        //Temp limit
        $results = json_decode(file_get_contents($_SERVER['N2_URI'] . 'modules?limit=10&access_token=' . $_SERVER['N2_ACCESS_TOKEN']));
        
        $modules = array();

        foreach($results->results as $result)
        {
            $modules[$result->id] = $result->title;
        }
        return $modules;
    }

    /**
    * Get module information
    *
    * @param int $module_id ID of the module
    *
    * @return Array containing module information
    * @access Public
    */
    public function get_module($module_id)
    {
        $result = json_decode(file_get_contents($_SERVER['N2_URI'] . 'modules/id/' . $module_id . '?access_token=' . $_SERVER['N2_ACCESS_TOKEN']));
        return $result->result;
    }

    /**
    * Get learning outcomes for module
    *
    * @param int $module_id ID of the module
    *
    * @return Array containing learning outcomes
    * @access Public
    */
    public function get_module_learning_outcomes($module_id)
    {
        $result = json_decode(file_get_contents($_SERVER['N2_URI'] . 'learning_outcomes?module_id=' . $module_id . '&access_token=' . $_SERVER['N2_ACCESS_TOKEN']));
        return $result->results;
    }

    /**
    * Get active assignment documentation for a module.
    *
    * @param int $module_id ID of the module
    *
    * @return Array contaning assignment docs
    * @access Public
    */
    public function get_module_documented_assignments($module_id)
    {
        $result = json_decode(file_get_contents($_SERVER['N2_URI'] . 'assessments?module_id=' . $module_id . '&access_token=' . $_SERVER['N2_ACCESS_TOKEN']));

        $assignments = array();

        foreach($result->results as $a_result)
        {
            //Check if there is already documentation for this assignment.
            $assignment_doc = new Assessment_documentation();
            $assignment_doc->where('assessment_id', (int) $a_result->id);
            $assignment_doc->where('status !=', 'removed');
            $assignment_doc->where('status !=', 'superceded');
            $count = $assignment_doc->count();

            $assignment_doc = new Assessment_documentation();
            $assignment_doc->where('assessment_id', (int) $a_result->id);
            $assignment_doc->where('status !=', 'removed');
            $assignment_doc->where('status !=', 'superceded');
            $assignment_doc->get();

            if($count > 0)
            {
                $assignments[$a_result->id] = array('overview' => $a_result->assessment_method . ' : ' . $a_result->weighting . '%', 'title' => $assignment_doc->title, 'status' => ucfirst($assignment_doc->status), 'id' => $assignment_doc->id, 'file' => $this->get_assignment_pdf($assignment_doc->id)); 
            }
            unset($assignment_doc);
        }

        return $assignments;
    }

    /**
    * Get assignment details for undocumented assignments for a given module.
    *
    * @param int $module_id ID of the module
    *
    * @return Array contaning assignment info
    * @access Public
    */
    public function get_module_undocumented_assignments($module_id)
    {
        $result = json_decode(file_get_contents($_SERVER['N2_URI'] . 'assessments?module_id=' . $module_id . '&access_token=' . $_SERVER['N2_ACCESS_TOKEN']));
        
        $assignments = array();

        foreach($result->results as $result)
        {
            //Check if there is already documentation for this assignment.
            $assignment_doc = new Assessment_documentation();
            $assignment_doc->where('assessment_id', (int) $result->id);
            $assignment_doc->where('status !=', 'removed');
            
            if($assignment_doc->count() === 0)
            {
                $assignments[$result->id] = $result->assessment_method . ' : ' . $result->weighting . '%'; 
            }
        }

        return $assignments;
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
        $adf = new Assessment_document_file();
        $adf->where('assignment_id', (int) $assignment_id)->get();

        return $adf->stored;
    }
}
?>