<?php
/**
* Criterion Reference Grid
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
* Criterion Reference Grid
*
* @category Assignment_Builder
* @package  Assignment_Builder
* @author   Jamie Mahoney <jmahoney@lincoln.ac.uk>
* @license  GNU Affero General Public License 3.0
* @link     coursedata.blogs.lincoln.ac.uk
*/
class Criterion_reference_grid extends DataMapper {

	/**
	* Name of the table that the model uses.
	*
	* @var string
	*/
	var $table = 'criterion_reference_grids';

	/**
	* Array containing related elements.
	*
	* @var array
	*/
	var $has_many = array(
		'criterion_reference_grid_file' => array(),
		'criterion_reference_grid_row' => array()		
	);
}

// End of file criterion_reference_grid.php
// Location: ./models/criterion_reference_grid.php
