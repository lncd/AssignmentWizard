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
class Assignment extends CI_Controller {

	/**
	* Index function
	*
	* @return Nothing
	* @access Public
	*/
	public function index($assignment_id)
	{
		if($this->input->post('assignment') OR ($assignment_id))
		{
			if($this->input->post('assignment'))
			{
				$assignment_id = $this->input->post('assignment');
			}

			$this->load->model('assignment_model');
			$this->load->model('setting_model');
			
			$data['assessment'] = $this->assignment_model->get_assessment_by_assignment_id($assignment_id);
			$data['assignment_doc'] = $this->assignment_model->get_assignment_documentation($assignment_id);
			$data['default_submission'] = $this->setting_model->get_setting(1);
			$data['assignment_id'] = $assignment_id;

			$this->load->view('includes/header.php');
			$this->load->view('assignment.php', $data);
			$this->load->view('includes/footer.php');
		}
		elseif($this->input->post('assessment'))
		{
			$this->load->model('assignment_model');
			$this->load->model('setting_model');
			
			$data['assessment'] = $this->assignment_model->get_assessment($this->input->post('assessment'));
			$data['default_submission'] = $this->setting_model->get_setting(1);
			$data['assessment_id'] = $this->input->post('assessment');

			$this->load->view('includes/header.php');
			$this->load->view('assignment.php', $data);
			$this->load->view('includes/footer.php');
		}
	}

	/**
	* Save function
	*
	* @return Nothing
	* @access Public
	*/
	public function save()
	{
		$this->load->model('assignment_model');
		$assignment_id = $this->assignment_model->create_assignment($this->input->post());

		$this->session->set_flashdata('message', 'Documentation saved successfully.');

		if($this->input->post('Array') === 'complete')
		{
			$this->create_documentation($assignment_id);
		}

		redirect('assignment/' . $assignment_id, 'location');
	}

	/**
	* Create documentation pdf
	*
	* @param int $assignment_id ID of the assignment to create
	*
	* @return Nothing
	* @access Private
	*/
	private function create_documentation($assignment_id)
	{
		$this->load->helper(array('dompdf', 'file'));

		$this->load->model('assignment_model');
		$data['assignment'] = $this->assignment_model->get_assignment_documentation($assignment_id);
		$data['assessment'] = $this->assignment_model->get_assessment_by_assignment_id($assignment_id);

	    // page info here, db calls, etc.   

	    $timestamp = time();  
	    $html = $this->load->view('documentation_pdf', $data, true);
	    $pdf_data = pdf_create($html, '', false, false);
     	write_file('assets/assignment_documents/' . $assignment_id . '_' . $timestamp . '.pdf', $pdf_data);

     	$this->assignment_model->save_assignment_document($assignment_id, $timestamp);
     }
}

// End of file home.php
// Location: ./controllers/assignment.php