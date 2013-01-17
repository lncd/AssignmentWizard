<?php
/**
* User Module
*
* PHP Version 5
* 
* @category  Assignment_Builder
* @package   Assignment_Builder
* @author    Jamie Mahoney <jmahoney@lincoln.ac.uk>
* @copyright 2012 University of Lincoln
* @license   GNU Affero General Public License 3.0
* @link      coursedata.blogs.lincoln.ac.uk
*/

/**
* User
*
* @category Assignment_Builder
* @package  Assignment_Builder
* @author   Jamie Mahoney <jmahoney@lincoln.ac.uk>
* @license  GNU Affero General Public License 3.0
* @link     coursedata.blogs.lincoln.ac.uk
*/
class User_module extends DataMapper {

	/**
	* Name of the table that the model uses.
	*
	* @var string
	*/
	var $table = 'users_modules';

	/**
	* Array containing related elements.
	*
	* @var array
	*/
	var $has_one = array(
		'user' => array()
	);
}

// End of file user_module.php
// Location: ./models/user_module.php
