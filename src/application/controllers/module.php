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
class Module extends CI_Controller {

	/**
	* Index function
	*
	* @return Nothing
	* @access Public
	*/
	public function index($module_id = NULL)
	{
		if($this->input->post('module') OR ($module_id))
		{
			if($this->input->post('module'))
			{
				$module_id = $this->input->post('module');
			}

			$this->load->model('module_model');

			$data['module'] = $this->module_model->get_module($module_id);
			$data['learning_outcomes'] = $this->module_model->get_module_learning_outcomes($module_id);
			$data['documented_assignments'] = $this->module_model->get_module_documented_assignments($module_id);
			$data['undocumented_assignments'] = $this->module_model->get_module_undocumented_assignments($module_id);

			$this->load->view('includes/header.php');
			$this->load->view('module.php', $data);
			$this->load->view('includes/footer.php');
		}
		else
		{
			redirect('home', 'location');
		}
		
	}
}

// End of file home.php
// Location: ./controllers/module.php