<?php
/**
* Assessment Document File
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
* Assessment Document File
*
* @category Assignment_Builder
* @package  Assignment_Builder
* @author   Jamie Mahoney <jmahoney@lincoln.ac.uk>
* @license  GNU Affero General Public License 3.0
* @link     coursedata.blogs.lincoln.ac.uk
*/
class Assessment_document_file extends DataMapper {

	/**
	* Name of the table that the model uses.
	*
	* @var string
	*/
	var $table = 'assessment_document_files';

	/**
	* Array containing related elements.
	*
	* @var array
	*/
	var $has_one = array(
		'assessment_documentation' => array()
	);
}

// End of file assessment_document_file.php
// Location: ./models/assessment_document_file.php
