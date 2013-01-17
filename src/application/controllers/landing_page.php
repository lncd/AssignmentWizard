<?php
/**
* Landing Page
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
* Landing Page
*
* @category Assignment_Wizard
* @package  Assignment_Wizard
* @author   Jamie Mahoney <jmahoney@lincoln.ac.uk>
* @license  GNU Affero General Public License 3.0
* @link     coursedata.blogs.lincoln.ac.uk
*/
class Landing_page extends CI_Controller {

	/**
	* Index function
	*
	* @return Nothing
	* @access Public
	*/
	public function index()
	{
		if($this->session->userdata('user_id'))
		{
			redirect('home', 'location');
		}
		else
		{
			$this->load->view('includes/header.php');
			$this->load->view('landing_page.php');
			$this->load->view('includes/footer.php');
		}
	}

	/**
	* False login
	*
	* @return Nothing
	* @access Public
	*/
	public function fake_login()
	{
		$this->session->set_userdata('user_id', 1);
		redirect('home', 'location');
	}
}
// End of file landing_page.php
// Location: ./controllers/landing_page.php