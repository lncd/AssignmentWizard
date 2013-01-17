<?php 
/**
* Home
*
* PHP Version 5
* 
* @category  Assignment_Wizard
* @package   Assignment_Wizard
* @author    Jamie Mahoney <jmahoney@lincoln.ac.uk>
* @copyright 2013 University of Lincoln
* @license   GNU Affero General Public License 3.0
* @link      coursedata.blogs.lincoln.ac.uk
*/

/**
* Home
*
* @category Assignment_Wizard
* @package  Assignment_Wizard
* @author   Jamie Mahoney <jmahoney@lincoln.ac.uk>
* @license  GNU Affero General Public License 3.0
* @link     coursedata.blogs.lincoln.ac.uk
*/
class Criterion_grid extends CI_Controller {

	/**
	* Index function
	*
	* @return Nothing
	* @access Public
	*/
	public function index($crg_id)
	{
		//Get current CRG details
		$this->load->model('crg_model');
		$data['crg'] = $this->crg_model->get_crg($crg_id);
		$data['pdfs'] = $this->crg_model->get_crg_pdfs($crg_id);

		$this->load->view('includes/header.php');
		$this->load->view('crg.php', $data);
		$this->load->view('includes/footer.php');
	}

	/**
	* Create CRG
	*
	* @return CRG ID
	* @access Public
	*/
	public function create_crg_for_assignment($assignment_id)
	{
		$this->load->model('crg_model');


		$crg_id = $this->crg_model->create_crg($assignment_id);

		redirect('criterion_grid/' . $crg_id, 'location');
	}

	/**
	* View a grid row
	* 
	* @param int $row_id ID of the row
	*
	* @access Public
	* @return Nothing
	*/
	public function row($row_id)
	{
		$this->load->model('crg_model');

		$data['row'] = $this->crg_model->get_crg_row($row_id);
		$this->load->view('includes/header');
		$this->load->view('crg_row', $data);
		$this->load->view('includes/footer');
	}

	/**
	* Delete a grid row
	*
	* @param int $row_id ID of the row
	*
	* @access Public
	* @return Nothing
	*/
	public function delete_row($row_id)
	{
		//Delete row
	}

	/**
	* Create a grid row
	*
	* @access Public
	* @return Nothing
	*/
	public function create_row()
	{
		//Create row first
		$row = new Criterion_reference_grid_row();
		$row->criterion_reference_grid_id = $this->input->post('crg_id');
		$row->save();

		foreach($this->input->post('los_multi') as $lo)
		{
			$row_lo = new Criterion_reference_grid_row_learning_outcome();
			$row_lo->criterion_grid_id = $this->input->post('crg_id');
			$row_lo->criterion_grid_row_id = $row->id;
			$row_lo->learning_outcome_id = $lo;
			$row_lo->save();
		}

		redirect(site_url() . 'criterion_grid/' . $this->input->post('crg_id'), 'location');
	}

	/**
	* Edit a grid row
	*
	* @access Public
	* @return Nothing
	*/
	public function edit_row()
	{
		$row = new Criterion_reference_grid_row();
		$row->where('id', (int) $this->input->post('row_id'))->get();

		$row->criterion_description = trim($this->input->post('row_desc')) != '' ? $this->input->post('row_desc') : NULL;
		$row->row_weight = $this->input->post('row_weight') != '' ? $this->input->post('row_weight') : NULL;
		$row->fail = $this->input->post('fail') != '' ? $this->input->post('fail') : NULL;
		$row->third = $this->input->post('third') != '' ? $this->input->post('third') : NULL;
		$row->lower_second = $this->input->post('lower_second') != '' ? $this->input->post('lower_second') : NULL;
		$row->upper_second = $this->input->post('upper_second') != '' ? $this->input->post('upper_second') : NULL;
		$row->lower_first = $this->input->post('lower_first') != '' ? $this->input->post('lower_first') : NULL;
		$row->upper_first = $this->input->post('upper_first') != '' ? $this->input->post('upper_first') : NULL;
		$row->save();

		redirect(site_url() . 'criterion_grid/' . $this->input->post('crg_id'), 'location');
	}

	/**
	* Create CRG pdf
	*
	* @param int $crg_id ID of the CRG to create a pdf for
	*
	* @access Public
	* @return Nothing
	*/
	public function create_pdf($crg_id)
	{
		$this->load->model('crg_model');
		$this->load->helper(array('dompdf', 'file'));

		$data['crg'] = $this->crg_model->get_crg($crg_id);
		$timestamp = time();
		
	    $html = $this->load->view('crg_pdf', $data, true);
	    $pdf_data = pdf_create($html, '', false, true);
     	write_file('assets/crg_documents/' . $crg_id . '_' . $timestamp . '.pdf', $pdf_data);

     	$this->session->set_flashdata('success', 'A PDF of the Criterion Reference Grid was created successfully.');

     	$crg_pdf = new Criterion_reference_grid_file();
     	$crg_pdf->criterion_grid_id = $crg_id;
     	$crg_pdf->file = $crg_id . '_' . $timestamp . '.pdf';
     	$crg_pdf->save();

     	redirect(site_url() . 'criterion_grid/' . $crg_id, 'location');
	}



}

// End of file home.php
// Location: ./controllers/assignment.php