<style>
	table
	{
		border-collapse: collapse;
	}
	td
	{
		border: 1px solid black;
		padding: 2px;
	}
	.one
	{
		text-align: center;
		width: 800px;
	}
	.two
	{
		width: 50%;
	}
	img
	{
		width: 150px !important;
	}
</style>

<table style="text-align: center; width: 725px" class="pdf">
<tr>
	<td colspan=2>
		<img src="<?php echo site_url();?>assets/images/crest.png">
		<p style="margin-top: -5px !important"><strong><?php echo $assessment->school->title;?></strong></p>
	</td>
</tr>
<tr>
	<td colspan=2><strong>Assessment Component Briefing Document</strong></td>
</tr>
<tr style="text-align: left">
	<td class="two">
		<p style="margin: 3px !important"><strong>Title : <?php echo $assessment->module->title;?></strong></p>
		<p style="margin: 0px 0px 0px 3px !important"><strong><?php echo $assessment->assessment_method . ' - ' . $assignment->title; ?></strong></p>
	</td>

	<td colspan=1><p><strong>Indicative Weighting : <?php echo $assessment->weighting;?>%</strong></p></td>
</tr>
<tr>
	<td colspan=2 style="text-align: left">
		<strong>Learning Outcomes : </strong>
		<p>On successful completion of this assessment package a student will have demonstrated competence in the following areas: </p>
		<ul>
			<?php foreach($assessment->learning_outcomes as $lo) : ?>
				<li><?php echo $lo->description; ?></li>
			<?php endforeach; ?>
		</ul>
	</td>
</tr>
<tr>
	<td colspan=2 style="text-align: left">
		<?php echo $assignment->brief_text; ?>
	</td>
</tr>
<tr>
	<td colspan=2 style="text-align: left">
		<p><strong>Submission Guidelines</strong></p>
		<?php echo $assignment->submission_guidelines; ?>
	</td>
</tr>
</table>