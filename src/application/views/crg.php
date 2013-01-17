<?php
$count = 0;
?>

<div class="container">
	<div class="page-header">
		<section>
			<h1>
				Criterion Reference Grid
				<small>Overview</small>
				<p><small><?php echo $crg->assessment->weighting . '% ' . $crg->assessment->assessment_method . ' for <a href="' . site_url() . 'module/' . $crg->assessment->module->id . '">' . $crg->assessment->module->title; ?></a></small></p>

			</h1>
			<?php if($this->session->flashdata('success')): ?>
				<div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
			<?php endif;?>
		</section>
	</div>

	<div class="row">
		<section class="span12">
			<h3>Learning Outcomes</h3>
			<p>Select a group of learning outcomes to be shown one one row of the Criterion Reference Grid and add the row.</p>
			<?php echo form_open('criterion_grid/create_row', '', array('crg_id' => $crg->crg_overview->id)); ?>
			<?php echo form_multiselect('los_multi[]', $crg->los, '', 'style="width: 100%"'); ?>

			<?php echo form_submit('add_row', 'Add Row to CRG'); ?>
			<?php echo form_close(); ?>

			<h4>Learning Outcomes yet to be assigned</h4>
			<p>All learning outcomes should be present at least once on the CRG. You will not be able to produce a PDF for the CRG if some Learning Outcomes remain unselected.</p>
			<?php if(count($crg->available_los) > 0) : ?>
			<ul>
				<?php foreach($crg->available_los as $alo): ;?>
					<li><?php echo $alo; ?></li>
				<?php endforeach; ?>
			</ul>
			<?php else: ;?>
			<p>All learning outcomes have already been assigned.</p>
			<?php endif; ?>
			
			<h3>Rows in Criterion Reference Grid</h3>
			<table class="table table-striped">
			<thead>
				<th style="text-align: center">Learning Outcomes</th>
				<th style="text-align: center">Row Descriptor</th>
				<th style="text-align: center">Grade Descriptions</th>
				<th></th>
				<th></th>
			</thead>
			</thead>
			<?php foreach($crg->rows as $row): ?>
			<tr>
				<td>
					<ul>
						<?php foreach($row->los as $row_lo): ?>
							<li><?php echo $row_lo; ?></li>
						<?php endforeach; ?>
					</ul>
				</td>
				<td style="text-align: center; vertical-align: middle">
					<?php if(isset($row->overview->criterion_description)): ?>
						<i class="icon-ok"></i>
					<?php else: ?>
						<?php $count++; ?>
						<i class="icon-remove"></i>
					<?php endif; ?>
				</td>
				<td style="text-align: center; vertical-align: middle">
					<?php if(isset($row->overview->fail)): ?>
						<i class="icon-ok"></i>
					<?php else: ?>
						<?php $count++; ?>
						<i class="icon-remove"></i>
					<?php endif; ?>
					<?php if(isset($row->overview->lower_second)): ?>
						<i class="icon-ok"></i>
					<?php else: ?>
						<?php $count++; ?>
						<i class="icon-remove"></i>
					<?php endif; ?>
					<?php if(isset($row->overview->upper_second)): ?>
						<i class="icon-ok"></i>
					<?php else: ?>
						<?php $count++; ?>
						<i class="icon-remove"></i>
					<?php endif; ?>
					<?php if(isset($row->overview->lower_first)): ?>
						<i class="icon-ok"></i>
					<?php else: ?>
						<?php $count++; ?>
						<i class="icon-remove"></i>
					<?php endif; ?>
					<?php if(isset($row->overview->upper_first)): ?>
						<i class="icon-ok"></i>
					<?php else: ?>
						<?php $count++; ?>
						<i class="icon-remove"></i>
					<?php endif; ?>
				</td>
				<td style="vertical-align: middle"><a href="<?php echo site_url(); ?>criterion_grid/row/<?php echo $row->overview->id;?>" class="btn btn-small btn-success">View Row</a></td>
				<td style="vertical-align: middle"><a href="<?php echo site_url(); ?>criterion_grid/delete/row/<?php echo $row->overview->id;?>" class="btn btn-small btn-warning">Delete Row</a></td>
			</tr>
			<?php endforeach; ?>
			</table>
		</section>
		<section id="documentation">
			<section class="span6">
			<h3>Create CRG Documentation</h3>
			<?php if(($count === 0) AND (count($crg->available_los) === 0)): ?>
				<a href="<?php echo site_url();?>criterion_grid/create_pdf/<?php echo $crg->crg_overview->id;?>" class="btn btn-large btn-success" style="margin-bottom: 20px">Create PDF of CRG</a>
			<?php else: ?>
				<p>You cannot create a PDF at this time, ensure that :
					<ul>
						<li>All learning outcomes have been assigned.</li>
						<li>All fields have been completed for each of the rows.</li>
					</ul>
				</p>	
			<?php endif; ?>	
			</section>
			<section class="span6">
				<h3>Existing CRG Documentation</h3>
				<p>All completed revisions of this CRG are stored, the latest 5 versions are available below.</p>
				<ul>
				<?php foreach($pdfs as $pdf): ?>
					<li><a href="<?php echo site_url() . 'assets/crg_documents/' . $pdf->file; ?>"><?php echo $pdf->created; ?></a></li>
				<?php endforeach;?>
				</ul>
			</section>
		</section>
	</div>
</div>

<?php echo '<pre>';
print_r($crg);
echo '</pre>'; ?>