<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Cube Summation Challenge</title>
	<link href="<?php echo base_url();?>/assets/favicon.ico" type="image/x-icon" rel="icon">
  <link href="<?php echo base_url();?>/assets/favicon.ico" type="image/x-icon" rel="shortcut icon">
	<link rel="stylesheet" href="<?php echo base_url();?>/assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>/assets/bootstrap/css/bootstrap-theme.css">
	<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/style.css">
</head>
<body>

	<div id="container">
		<h1>Welcome to Cube Summation Challenge</h1>
		<div id="body">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2>Introduction</h2>
						<p>On this page you will find my solution to the Cube Summation Challenge, developed with the PHP Framework CodeIgniter.</p>
						<p>I choose CI because it's a framework which is really quick to take in charge and also because the solution is not really complex</p>
						<p>Hope you will like my solution !</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
					<h2>The problem</h2>
					<p>You are given a 3-D Matrix in which each block contains 0 initially. The first block is defined by the coordinate (1,1,1) and the last block is defined by the coordinate (N,N,N). There are two types of queries.</p>
					<pre><code>UPDATE x y z W</code></pre>
					<p>updates the value of block (x,y,z) to W.</p>
					<pre><code>QUERY x1 y1 z1 x2 y2 z2</code></pre>
					<p>calculates the sum of the value of blocks whose x coordinate is between x1 and x2 (inclusive), y coordinate between y1 and y2 (inclusive) and z coordinate between z1 and z2 (inclusive). </p>
					<p><strong>Input Format</strong> <br>
						The first line contains an integer T, the number of test-cases. T testcases follow. <br>
						For each test case, the first line will contain two integers N and M separated by a single space. <br>
						N defines the N * N * N matrix. <br>
						M defines the number of operations. <br>
						The next M lines will contain either  </p>
						<pre><code> 1. UPDATE x y z W
							2. QUERY  x1 y1 z1 x2 y2 z2
						</code></pre>
						<p><strong>Output Format</strong> <br>
							Print the result for each QUERY.</p>
							<p><strong>Constrains</strong> <br>
								1 &lt;= T &lt;= 50 <br>
								1 &lt;= N &lt;= 100 <br>
								1 &lt;= M &lt;= 1000 <br>
								1 &lt;= x1 &lt;= x2 &lt;= N <br>
								1 &lt;= y1 &lt;= y2 &lt;= N <br>
								1 &lt;= z1 &lt;= z2 &lt;= N <br>
								1 &lt;= x,y,z &lt;= N <br>
								-10<sup>9</sup> &lt;= W &lt;= 10<sup>9</sup>  </p>
								<p><strong>Sample Input</strong></p>
								<pre><code>2
									4 5
									UPDATE 2 2 2 4
									QUERY 1 1 1 3 3 3
									UPDATE 1 1 1 23
									QUERY 2 2 2 4 4 4
									QUERY 1 1 1 3 3 3
									2 4
									UPDATE 2 2 2 1
									QUERY 1 1 1 1 1 1
									QUERY 1 1 1 2 2 2
									QUERY 2 2 2 2 2 2
								</code></pre>
								<p><strong>Sample Output</strong></p>
								<pre><code>4
									4
									27
									0
									1
									1
								</code></pre>
								<p><strong>Explanation</strong> <br>
									First test case, we are given a cube of 4 * 4 * 4 and 5 queries.  Initially all the cells (1,1,1) to (4,4,4) are 0. <br>
									<code>UPDATE 2 2 2 4</code> makes the cell (2,2,2) = 4 <br>
									<code>QUERY 1 1 1 3 3 3</code>. As (2,2,2) is updated to 4 and the rest are all 0. The answer to this query is 4. <br>
									<code>UPDATE 1 1 1 23</code>. updates the cell (1,1,1) to 23.
									<code>QUERY 2 2 2 4 4 4</code>. Only the cell (1,1,1) and (2,2,2) are non-zero and (1,1,1) is not between (2,2,2) and (4,4,4). So, the answer is 4. <br>
									<code>QUERY 1 1 1 3 3 3</code>. 2 cells are non-zero and their sum is 23+4 = 27. </p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>The Solution</h2>
							<div class="row">
								<div class= "col-md-6">
									<?php echo form_open("Cube_Controller/calculCube", array('id' => 'input-form')); ?>
									<div id="infoMessage"><?php echo $this->session->flashdata('message');?></div>
									<?php echo validation_errors(); ?>
									<h1>Cube Summation Challenge</h1>
									<ul>
										<li>
											<label for="nb-tests" class="form-label">Quantity of testcases</label>
											<input name="nb-tests" type="number" min="1" placeholder="Enter the number of tests to execute" required value="<?php echo set_value('nb-tests'); ?>"/><br/>
											<span>Enter the number of tests case here</span>
											<li>
												<label for="tests">Instructions</label>
												<textarea name="tests" rows="10" cols="50" required ><?php echo set_value('tests'); ?></textarea>
												<span>Enter your testscase with their own instructions here</span>
											</li>
											<li>
												<input type="submit" class="btn btn-success btn-lg" value="Submit the tests">
											</li>
										</ul>
										<?php echo form_close(); ?>
									</div>
									<div class= "col-md-6">
										<form id="output">
											<h1>Output</h1>
											<ul>
												<li>
													<label for="result">Results</label>
													<textarea name="result" readonly="readonly" rows="30" cols="100"><?php if (!empty($output) ){ for ($i=0; $i < count($output) ; $i++) { echo $output[$i]."\r\n";}}?></textarea>
													<span>You can see the result of your tests here</span>
												</li>
											</ul>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
							<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
						</div>

						<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
					</div>

				</body>
				</html>
