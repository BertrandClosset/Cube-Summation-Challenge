<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Cube Summation Challenge</title>
	<link rel="stylesheet" href="<?php echo base_url();?>/assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>/assets/bootstrap/css/bootstrap-theme.css">
	<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/style.css">
</head>
<body>

<div id="container">
	<h1>Welcome to Cube Summation Challenge</h1>

	<div id="body">
		<p>On this page you will find my solution to the Cube Summation Challenge, developed with the PHP Framework CodeIgniter</p>
		<div id="infoMessage"><?php echo $this->session->flashdata('message');?></div>
		<?php echo validation_errors(); ?>
		<?php echo form_open("Cube_Controller/calculCube"); ?>
			<label for="nb-tests">Quantity of testcases</label>
			<input name="nb-tests" type="number" min="1" placeholder="Enter the number of tests to execute" required value="<?php echo set_value('nb-tests'); ?>"/><br/>
			<label for="tests">Instructions</label>
			<textarea name="tests" rows="10" cols="50" required ><?php echo set_value('tests'); ?></textarea>
			<input type="submit" class="btn btn-primary" value="Submit the tests">
		<?php echo form_close(); ?>

		<div id="output">
			<textarea readonly="readonly" rows="30" cols="100"><?php if (!empty($output) ){ for ($i=0; $i < count($output) ; $i++) { echo $output[$i]."\r\n";}}?></textarea>
		</div>
		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>
