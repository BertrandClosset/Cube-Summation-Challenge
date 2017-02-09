<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Cube Summation Challenge</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	textarea{
		display: block;
	}
	</style>
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
