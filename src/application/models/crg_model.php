<?php

class Crg_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    /**
    * Runs through and creates a crg record.
    *
    * @param int $assignment_id The ID of the assignment to associate with the crg records
    *
    * @return ID of CRG.
    * @access Public
    */
    public function create_crg($assignment_id)
    {
        //Create crg record
        $crg = new Criterion_reference_grid();
        $crg->where('assignment_id', (int) $assignment_id);
        $crg->order_by('id', 'desc');
        $crg->limit(1);
        $crg->get();
        
        $crg->assignment_id = $assignment_id;
        $crg->save();

        //Get crg id for use with other records
        return $crg->id;
    }

    /**
    * Returns details for a CRG
    *
    * @param int $crg_id ID of the CRG to return
    * 
    * @return Object representing the CRG
    * @access Public
    */
    public function get_crg($crg_id)
    {
        $crg = new Criterion_reference_grid();
        $crg->where('id', (int) $crg_id)->get();

        $returning = new stdClass();
        $returning->crg_overview = $crg->stored;

        //Get assessment details
        $assignment_doc = new Assessment_documentation();
        $assignment_doc->where('id', $crg->assignment_id)->get();

        $assessment_id = $assignment_doc->assessment_id;

        $result = json_decode(file_get_contents($_SERVER['N2_URI'] . 'assessments/id/' . $assessment_id . '?access_token=' . $_SERVER['N2_ACCESS_TOKEN']));
        $returning->assessment = $result->result;

        $all_los = array();
        $used_los = array();

        foreach($result->result->learning_outcomes as $lo)
        {
            $returning->los[$lo->id] = $lo->description;
            $all_los[] = $lo->id;
        }

        //Get los that have already been assigned to a row in this crg
        $crg_row_los = new Criterion_reference_grid_row_learning_outcome();
        $crg_row_los->where('criterion_grid_id', (int) $crg_id)->get();

        foreach($crg_row_los as $row_lo)
        {
            $used_los[] = $row_lo->learning_outcome_id;
        }

        if(count($used_los) > 0)
        {
            $available_los = array_diff($all_los, $used_los);
        }
        else
        {
            $available_los = $all_los;
        }

        foreach($available_los as $an_lo)
        {
            $returning->available_los[$an_lo] = $returning->los[$an_lo];
        }

        //Get rows assigned to the CRG
        $crg_rows = new Criterion_reference_grid_row();
        $crg_rows->where('criterion_reference_grid_id', (int) $crg_id)->get();

        foreach($crg_rows as $crg_row)
        {
            $temp = new stdClass();
            $temp->overview = $crg_row->stored;

            //Get all learning outcomes for this row
            $crg_row_id = $crg_row->id;

            $crg_row_outcomes = new Criterion_reference_grid_row_learning_outcome();
            $crg_row_outcomes->where('criterion_grid_row_id', (int) $crg_row_id)->get();

            foreach($crg_row_outcomes as $row_outcome)
            {
                $lo_result = json_decode(file_get_contents($_SERVER['N2_URI'] . 'learning_outcomes/id/' . $row_outcome->learning_outcome_id . '?access_token=' . $_SERVER['N2_ACCESS_TOKEN']));
                $temp->los[] = $lo_result->result->description;
            }

            $returning->rows[] = $temp;
        }

        return $returning;
    }

    /**
    * Get CRG row
    *
    * @param int $row_id ID of the row
    *
    * @access Public
    * @return Object representing crg row
    */
    public function get_crg_row($row_id)
    {
        $returning =  new stdClass();

        //Get the row overview
        $row = new Criterion_reference_grid_row();
        $row->where('id', (int) $row_id)->get();

        $returning->overview = $row->stored;

        //Get the rows learning outcomes
        $row_los = new Criterion_reference_grid_row_learning_outcome();
        $row_los->where('criterion_grid_row_id', $row_id)->get();

        foreach($row_los as $row_lo)
        {
            $lo_result = json_decode(file_get_contents($_SERVER['N2_URI'] . 'learning_outcomes/id/' . $row_lo->learning_outcome_id . '?access_token=' . $_SERVER['N2_ACCESS_TOKEN']));
            $returning->los[] = $lo_result->result->description;
        }

        return $returning;
    }

    /**
    * Get CRG PDFs
    *
    * @param int $crg_id ID of the CRG
    *
    * @return Array of objects
    * @access Public
    */
    public function get_crg_pdfs($crg_id)
    {
        $crg_pdfs = new Criterion_reference_grid_file();
        $crg_pdfs->where('criterion_grid_id', (int) $crg_id);
        $crg_pdfs->order_by('id', 'desc');
        $crg_pdfs->limit(10);
        $crg_pdfs->get();

        $returning = array();

        foreach($crg_pdfs as $crg_pdf)
        {
            $returning[] = $crg_pdf->stored;
        }

        return $returning;
    }
}
?>