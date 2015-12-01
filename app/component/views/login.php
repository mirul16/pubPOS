<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Form Login</title>
		
		<?php 
			echo link_tag('assets/css/login/customize.css');
			echo link_tag('assets/css/bootstrap/bootstrap.min.css');
		?>
		
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap/bootstrap.min.js"></script>
	</head>
<body>

<?php
	$vForm = array("id"=>"form","class"=>"form-horizontal");
	$vUser = array("placeholder"=>"Username", "id"=>"username", "name"=>"username", "required"=>"", "autocomplete"=>"off", "class"=>"form-control");
	$vPass = array("placeholder"=>"Password", "id"=>"password", "name"=>"password", "required"=>"", "class"=>"form-control");
	
	echo $this->session->flashdata('wlogin');
	
	echo validation_errors();
?>

<div class="container">
	<div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
		<div class="row">
			<div class="iconmelon">
				<svg viewBox="0 0 32 32">
					<g filter=""><use xlink:href="#git"></use></g>
				</svg>
			</div>
		</div>

		<div class="panel panel-default" >
			<div class="panel-heading">
				<div class="panel-title text-center">FORM LOGIN</div>
			</div>     

			<div class="panel-body" >
				<?php echo form_open('login/clog',$vForm); ?>
					 <div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><?php echo form_input($vUser); ?>
					</div>

					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span><?php echo form_password($vPass); ?>
					</div>                                                                  

					<div class="form-group">
						<div class="col-sm-12 controls">
							<button class="btn btn-primary pull-right" type="submit"><i class="glyphicon glyphicon-log-in"></i> Sign in</button>                       
						</div>
					</div>
				<?php echo form_close(); ?>    
			</div>                     
		</div>  
	</div>
</div>

</body>
</html>