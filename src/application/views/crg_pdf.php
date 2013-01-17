<style>
	table
	{
		border-collapse: collapse;
		font-size: 8pt;
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
	ul
	{
		margin-left: 0px !important;
	}
	li
	{
		margin-left: -15px !important;
	}
</style>

<table style="text-align: center; width: 960px" class="pdf">
	<tr>
		<td style="width: 100px; background-color: #CCC"><strong>Criterion</strong></td><td style="width: 200px; background-color: #CCC"><strong>Learning Outcomes</strong></td><td style="background-color: #CCC"></td><td style="background-color: #CCC"><strong>3rd</strong></td><td style="background-color: #CCC"><strong>2:2</strong></td><td style="background-color: #CCC"><strong>2:1</strong></td><td colspan=2 style="background-color: #CCC"><strong>1st</strong></td>
	</tr>
	<?php foreach($crg->rows as $row): ?>
	<tr>
		<td style="background-color: #CCC"><strong><?php echo $row->overview->criterion_description; ?></strong></td>
		<td style="text-align: left; max-width: 100px">
				<ul>
				<?php foreach($row->los as $lo): ?>
					<li><?php echo $lo;?></li>
				<?php endforeach; ?>
				</ul>
		</td>
		<td><?php echo $row->overview->fail;?></td>
		<td><?php echo $row->overview->third;?></td>
		<td><?php echo $row->overview->lower_second;?></td>
		<td><?php echo $row->overview->upper_second;?></td>
		<td><?php echo $row->overview->lower_first;?></td>
		<td><?php echo $row->overview->upper_first;?></td>
	</tr>
	<?php endforeach; ?>
	<tr>
		<td colspan=8 style="background-color: #CCC"><strong>Note : Components are weighted as indicated.</strong></td>
	</tr>
</table>