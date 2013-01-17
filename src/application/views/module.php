<div class="container">
	<div class="page-header">
		<h1>
			Module Information
			<p><small><?php echo $module->title;?></small></p>
		</h1>
	</div>

	<div class="row">

		<section class="span8">
			<h2>Module Synopsis</h2>
			<?php echo $module->synopsis; ?>
			<h2>Assessment Strategy</h2>
			<?php echo $module->assessment_strategy; ?>
		</section>

		<section class="span4">
			<h2>Learning Outcomes</h2>
			<ul>
			<?php foreach($learning_outcomes as $lo): ?>
				<li><?php echo $lo->description; ?></li>
			<?php endforeach; ?>
			</ul>
		</section>
	</div>
	<hr>
	<div class="row">
		<section class="span6">
			<h2>Existing Assignment Documentation</h2>
			<?php if(count($documented_assignments) > 0): ?>
				<p>Existing assignment documents: </p>
				<?php foreach($documented_assignments as $documented): ?>
				<table>
					<tr>
					<?php if($documented['title'] !== NULL): ?>
						<td colspan=3><h4><?php echo $documented['title']; ?></h4></td>
					<?php else: ?>
						<td colspan=3><h4>Untitled Assignment</h4></td>
					<?php endif; ?>
					</tr>
					<tr><td><?php echo $documented['overview']  . '.   Status: ' . $documented['status'];?></td><td><a href="<?php echo base_url();?>assignment/<?php echo $documented['id']; ?>" class="btn btn-small" style="margin-top:-5px; margin-left: 20px">Edit Document</a></td>
					<?php if($documented['file']->file):?>
						<td><a href="<?php echo site_url();?>assets/assignment_documents/<?php echo $documented['file']->file;?>" class="btn btn-small" style="margin-top: -5px; margin-left: 20px">Download PDF</a></td>
					<?php else: ?>
						<td></td>
					<?php endif; ?>
					</tr>
					<tr>
						<td style="padding-top: 2px">Criterion Reference Grid : </td><td style="padding-top: 5px"><a href="<?php echo site_url();?>criterion_grid/create/<?php echo $documented['id'];?>" class="btn btn-small" style="margin-left: 20px; margin-top: -5px">View Document</a></td><td></td></tr>
					</tr>
				</table>
				<?php endforeach; ?>
			<?php else: ?>
				<p>There are current no assignment documents for this module.</p>
			<?php endif; ?>
		</section>

		<section class="span6">
			<h2>Create Assignment Documentation</h2>
			<?php if(count($undocumented_assignments) > 0): ?>
				<p>You can create documentation for an assignment by selecting the appropriate assignment below.</p>
				<?php echo form_open('assignment'); ?>
				<?php echo form_dropdown('assessment', $undocumented_assignments); ?>
				<?php echo form_submit(array('id' => 'submit', 'class' => 'btn', 'style' => 'margin-top: -10px'), 'Create Documentation'); ?>
				<?php echo form_close(); ?>
			<?php else: ?>
				<p>All assignments for this module have documentation associated with them.</p>
			<?php endif; ?>
		</section>
	</div>
</div>