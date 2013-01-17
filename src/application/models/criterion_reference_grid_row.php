<?php
/**
* Criterion Reference Grid Row
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
* Criterion Reference Grid Row
*
* @category Assignment_Builder
* @package  Assignment_Builder
* @author   Jamie Mahoney <jmahoney@lincoln.ac.uk>
* @license  GNU Affero General Public License 3.0
* @link     coursedata.blogs.lincoln.ac.uk
*/
class Criterion_reference_grid_row extends DataMapper {

	/**
	* Name of the table that the model uses.
	*
	* @var string
	*/
	var $table = 'criterion_grid_rows';

	/**
	* Array containing related elements.
	*
	* @var array
	*/
	var $has_one = array(
		'criterion_reference_grid' => array()
	);

	/**
	* Array containing related elements.
	*
	* @var array
	*/
	var $has_many = array(
		'criterion_grid_row_learning_outcome' => array()
	);
}

// End of file criterion_reference_grid_row.php
// Location: ./models/criterion_reference_grid_row.php
