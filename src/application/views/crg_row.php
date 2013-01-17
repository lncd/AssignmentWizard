<div class="container">
	<div class="page-header">
		<section>
			<h1>
				Criterion Reference Grid
				<small>Row Details</small>
			</h1>
		</section>
	</div>

	<div class="row">
		<section class="span12">
			<p>This row of the criterion reference grid addresses the following learning outcomes:</p>
			<ul>
				<?php foreach($row->los as $lo): ?>
					<li><?php echo $lo; ?></li>
				<?php endforeach; ?>
			</ul>
		</section>

		<section class="span12" id="row_details">
			<h3>CRG Row Details</h3>
			<?php echo form_open('criterion_grid/edit_row', '', array('row_id' => $row->overview->id, 'crg_id' => $row->overview->criterion_reference_grid_id)); ?>
			<table class="table table-striped">
				<tr><td>Row Description</td><td><?php echo form_input(array('name' => 'row_desc','class' => 'input-xxlarge'), $row->overview->criterion_description);?></td></tr>
				<tr><td>Row Weighting</td><td class="input-append"><?php echo form_input(array('name' => 'row_weight','class' => 'input-mini'),$row->overview->row_weight);?><span class="add-on">%</span></td></tr>
				<tr><td></td><td><strong>Grade Descriptions</strong></td></tr>
				<tr><td>Fail</td><td><?php echo form_input(array('name' => 'fail', 'class' => 'input-xxlarge'),$row->overview->fail);?></td></tr>
				<tr><td>Third</td><td><?php echo form_input(array('name' => 'third','class' => 'input-xxlarge'), $row->overview->third);?></td></tr>
				<tr><td>Lower Second</td><td><?php echo form_input(array('name' => 'lower_second','class' => 'input-xxlarge'), $row->overview->lower_second);?></td></tr>
				<tr><td>Upper Second</td><td><?php echo form_input(array('name' => 'upper_second','class' => 'input-xxlarge'), $row->overview->upper_second);?></td></tr>
				<tr><td>First</td><td><?php echo form_input(array('name' => 'lower_first','class' => 'input-xxlarge'), $row->overview->lower_first);?></td></tr>
				<tr><td>Upper First</td><td><?php echo form_input(array('name' => 'upper_first','class' => 'input-xxlarge'), $row->overview->upper_first);?></td></tr>
				<tr><td></td><td><?php echo form_submit(array('name' => 'edit', 'class' => 'btn btn-success'), 'Update Row Details'); ?></td></tr>
			</table>
			<?php echo form_close(); ?>
		</section>
	</div>
</div>