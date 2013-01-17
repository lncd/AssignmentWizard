<?php
/**
* Assessment Instance Documentation
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
* Assessment Instance Documentation
*
* @category Assignment_Builder
* @package  Assignment_Builder
* @author   Jamie Mahoney <jmahoney@lincoln.ac.uk>
* @license  GNU Affero General Public License 3.0
* @link     coursedata.blogs.lincoln.ac.uk
*/
class Assessment_documentation extends DataMapper {

	/**
	* Name of the table that the model uses.
	*
	* @var string
	*/
	var $table = 'assessment_documentation';

	/**
	* Array containing related elements.
	*
	* @var array
	*/
	var $has_many = array(
		'assessment_document_file' => array()
	);
}

// End of file assessment_instance_documentation.php
// Location: ./models/assessment_instance_documentation.php
