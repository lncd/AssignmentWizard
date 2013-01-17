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
class Home extends CI_Controller {

	/**
	* Index function
	*
	* @return Nothing
	* @access Public
	*/
	public function index()
	{
		$this->load->model('school_model');
		$this->load->model('module_model');

		$data['schools'] = $this->school_model->get_school_array();
		$data['modules'] = $this->module_model->get_module_array();
		$this->load->view('includes/header.php');
		$this->load->view('home.php', $data);
		$this->load->view('includes/footer.php');
	}
}

// End of file home.php
// Location: ./controllers/home.php