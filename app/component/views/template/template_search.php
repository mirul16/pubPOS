<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<title><?php echo $title; ?></title>

	<!-- Bootstrap core CSS -->
	<?php echo link_tag('assets/css/bootstrap/bootstrap.min.css'); ?>
	<?php echo link_tag('assets/css/tablesorter/theme.blue.css'); ?>
	
	<!--[if lt IE 8]>
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-ie7.css" rel="stylesheet">
	<![endif]-->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap/bootstrap.min.js"></script>
	
	<!-- 2.3.2
    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.js"></script>
    -->
	
	<?php echo link_tag('assets/css/tablesorter/theme.blue.css'); ?>
	<style>table tr:hover{cursor: pointer;}</style>

	<!-- Page Specific Plugins -->
	<script src="<?php echo base_url(); ?>assets/js/tablesorter/jquery.tablesorter.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/tablesorter/jquery.tablesorter.widgets.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/tablesorter/jquery.tablesorter.pager.js"></script>
</head>

<body>

	<?php echo $contents; ?>

</body>
</html>