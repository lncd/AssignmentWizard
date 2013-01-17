<div class="container">
	<div class="row">
		<section class="span12">
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae neque justo. Mauris vel laoreet risus. Mauris tortor lorem, feugiat ut auctor id, faucibus non metus. Maecenas rhoncus libero eget lectus imperdiet lobortis. Donec mollis magna sed lectus porttitor facilisis. Donec molestie erat in leo luctus sed bibendum nisi molestie. Suspendisse ut lectus nisi. Vivamus ullamcorper dolor id dolor vehicula ut pulvinar quam tempor. Etiam lacinia porta sem a lobortis. Praesent non nulla id erat egestas dictum ac eget eros. Quisque egestas dictum mi et sodales. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vivamus non felis ipsum, vel viverra libero. Suspendisse pretium justo vitae dolor vehicula tempus. Suspendisse potenti.</p>

			<strong>To get started, select a module using the dropdown boxes below.</strong>
			<?php echo form_open('module');?>
			<table>
			<tr><td>Select a School : </td><td><?php echo form_dropdown('school', $schools, '', 'style="width: 100%"');?></td></tr>
			<tr><td>Select a Module : </td><td><?php echo form_dropdown('module', $modules, '', 'style="width: 100%"');?></td></tr>
		</table>
			<?php echo form_submit(array('id' => 'submit', 'class' => 'btn btn-large'), 'View Module'); ?>
			<?php echo form_close(); ?>
		</section>

		<section class="span6">
		</section>
	</div>
</div>