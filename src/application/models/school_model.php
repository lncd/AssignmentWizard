<?php

class School_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    /**
    * Get a list of schools for use in dropdown menus
    *
    * @return Array of schools
    * @access Public
    */
    public function get_school_array()
    {
        $results = json_decode(file_get_contents($_SERVER['N2_URI'] . 'schools?access_token=' . $_SERVER['N2_ACCESS_TOKEN']));
        
        $schools = array();

        foreach($results->results as $result)
        {
            $schools[$result->id] = $result->title;
        }
        return $schools;
    }

}
?>