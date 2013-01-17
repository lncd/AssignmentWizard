<?php

class Setting_model extends CI_Model
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
    public function get_setting($setting_id)
    {
        $result = $this->db->select()
                            ->where('id', (int) $setting_id)
                            ->from('settings')
                            ->get();

        return $result->row()->setting_value;
    }
}
?>