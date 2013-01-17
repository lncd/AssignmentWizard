	<script language="javascript">
	$(document).ready(function()	{
	   $('#brief_text').markItUp(myHtmlSettings);
	   $('#lo_block').markItUp(myHtmlSettings);
	});
	</script>

<div class="container">
	<div class="page-header">
		<section>
		<h1>
			Assignment Information
			<?php if($assignment_doc->file->id): ?>
			<p><small><?php echo $assessment->weighting . "% " . $assessment->assessment_method . " for '";?><a href="<?php echo site_url();?>/module/<?php echo $assessment->module->id;?>"><?php echo $assessment->module->title ;?></a>'</small><a href="<?php echo site_url() . 'assets/assignment_documents/' . $assignment_doc->file->file ;?>" class="btn btn-large" style="float:right">Download PDF</a><p>
			<?php else: ?>
			<p><small><?php echo $assessment->weighting . "% " . $assessment->assessment_method . " for '" . $assessment->module->title . "'";?></small><p>
		<?php endif; ?>
		</h1>
		</section>
	</div>

	<div class="row">
		<section class="span12">
			<h2>Assignment Documentation</h2>
			<?php if($this->session->flashdata('message')):?>
				<div class="alert alert-success"><?php echo $this->session->flashdata('message');?></div>
			<?php endif; ?>
			<?php echo form_open('assignment/save', '', array('assessment_id' => $assessment->id)); ?>
			<table class = "table table-condensed">

				<tr><td>Assignment Title</td><td><?php echo form_input(array('id' => 'assignment_title', 'name' => 'assignment_title', 'class' => 'span10'), $assignment_doc->title);?></td></tr>
				<tr><td>Indicative Weighting</td><td><?php echo $assessment->weighting; ?>%</td></tr>
				<tr><td>Learning Outcomes</td><td><?php echo $assessment->formatted_los;?></td></tr>
				<tr><td>Assignment Text</td><td><?php echo form_textarea(array('id' => 'brief_text', 'name' => 'assignment_text'),$assignment_doc->brief_text); ?></td></tr>
				<tr><td>Submission Guidelines</td><td><?php echo $default_submission; ?></td></tr>
				<tr><td>Status : </td><td><?php echo form_dropdown(array('id' => 'status', 'name' => 'status'), array('open' => 'Open', 'complete' => 'Complete'), $assignment_doc->status);?></td></tr>
			</table>
			<?php echo form_submit(array('id' => 'submit', 'class' => 'btn btn-large btn-success'), 'Save Assignment'); ?>
			<?php echo form_close(); ?>
		</section>
	</div>
</div>