<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>SYSTEM</title>   
	<?php 
		echo link_tag('assets/css/bootstrap/bootstrap.min.css');
		echo link_tag('assets/css/jqueryui/jquery-ui-1.10.3.custom.css');
		echo link_tag('assets/css/jqgrid/ui.jqgrid.css');
		echo link_tag('assets/css/jqgrid/jqGrid.overrides.css');
		echo link_tag('assets/css/sb-admin.css');
		echo link_tag('assets/css/font-awesome/css/font-awesome.min.css');
	?>
		
	<style>
	  .bootstrap-select:not([class*="span"]):not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn){width:100%;}
	  .bootstrap-select {/*width: 220px\9; IE8 and below*/
	    width:100%\0; /*IE9 and below*/
	  }
	  .bootstrap-select.btn-group:not(.input-group-btn) {margin-bottom:0px;}
	  .ui-jqgrid .ui-jqgrid-view,.ui-jqgrid .ui-paging-info, .ui-jqgrid .ui-pg-table,
	  .ui-jqgrid .ui-pg-selbox{font-size:12px;}
	  .ui-jqgrid .ui-jqgrid-resize-ltr {float: right;margin: 15px -2px -2px 0;}
	  .side-nav{background-color:#666666;}
	  .side-nav>li.dropdown>ul.dropdown-menu>li>a:hover,
  	  .side-nav>li.dropdown>ul.dropdown-menu>li>a.active,
  	  .side-nav>li.dropdown>ul.dropdown-menu>li>a:focus{background-color:#999966;}
	  .side-nav>li.dropdown>ul.dropdown-menu>li>a {
		color:#000066;
		padding: 15px 15px 15px 40px;
		background-color:#0099FF;
  	  }
	  /*.dropdown:hover .dropdown-menu{display: block;}*/ /*for hover menu dropdown*/
	  
	   @media screen and (max-width:1024px){
		.table-responsive-custom-mini {
		  width:100%;
		  margin-bottom:15px;
		  overflow-y:hidden;
		  -ms-overflow-style:-ms-autohiding-scrollbar;
		  border:1px solid #ddd;
		}
		.table-responsive-custom > .table{margin-bottom:0;}
		.table-responsive-custom > .table > thead > tr > th,
		.table-responsive-custom > .table > tbody > tr > th,
		.table-responsive-custom > .table > tfoot > tr > th,
		.table-responsive-custom > .table > thead > tr > td,
		.table-responsive-custom > .table > tbody > tr > td,
		.table-responsive-custom > .table > tfoot > tr > td{white-space:nowrap;}
		.table-responsive-custom > .table-bordered{border:0;}
		.table-responsive-custom > .table-bordered > thead > tr > th:first-child,
		.table-responsive-custom > .table-bordered > tbody > tr > th:first-child,
		.table-responsive-custom > .table-bordered > tfoot > tr > th:first-child,
		.table-responsive-custom > .table-bordered > thead > tr > td:first-child,
		.table-responsive-custom > .table-bordered > tbody > tr > td:first-child,
		.table-responsive-custom > .table-bordered > tfoot > tr > td:first-child{border-left:0;}
		.table-responsive-custom > .table-bordered > thead > tr > th:last-child,
		.table-responsive-custom > .table-bordered > tbody > tr > th:last-child,
		.table-responsive-custom > .table-bordered > tfoot > tr > th:last-child,
		.table-responsive-custom > .table-bordered > thead > tr > td:last-child,
		.table-responsive-custom > .table-bordered > tbody > tr > td:last-child,
		.table-responsive-custom > .table-bordered > tfoot > tr > td:last-child{border-right:0;}
		.table-responsive-custom > .table-bordered > tbody > tr:last-child > th,
		.table-responsive-custom > .table-bordered > tfoot > tr:last-child > th,
		.table-responsive-custom > .table-bordered > tbody > tr:last-child > td,
		.table-responsive-custom > .table-bordered > tfoot > tr:last-child > td{border-bottom:0;}
	  }
	  
	  @media screen and (max-width:1366px){
		.table-responsive-custom {
		  width:100%;
		  margin-bottom:15px;
		  overflow-y:hidden;
		  -ms-overflow-style:-ms-autohiding-scrollbar;
		  border:1px solid #ddd;
		}
		.table-responsive-custom > .table{margin-bottom:0;}
		.table-responsive-custom > .table > thead > tr > th,
		.table-responsive-custom > .table > tbody > tr > th,
		.table-responsive-custom > .table > tfoot > tr > th,
		.table-responsive-custom > .table > thead > tr > td,
		.table-responsive-custom > .table > tbody > tr > td,
		.table-responsive-custom > .table > tfoot > tr > td{white-space:nowrap;}
		.table-responsive-custom > .table-bordered{border:0;}
		.table-responsive-custom > .table-bordered > thead > tr > th:first-child,
		.table-responsive-custom > .table-bordered > tbody > tr > th:first-child,
		.table-responsive-custom > .table-bordered > tfoot > tr > th:first-child,
		.table-responsive-custom > .table-bordered > thead > tr > td:first-child,
		.table-responsive-custom > .table-bordered > tbody > tr > td:first-child,
		.table-responsive-custom > .table-bordered > tfoot > tr > td:first-child{border-left:0;}
		.table-responsive-custom > .table-bordered > thead > tr > th:last-child,
		.table-responsive-custom > .table-bordered > tbody > tr > th:last-child,
		.table-responsive-custom > .table-bordered > tfoot > tr > th:last-child,
		.table-responsive-custom > .table-bordered > thead > tr > td:last-child,
		.table-responsive-custom > .table-bordered > tbody > tr > td:last-child,
		.table-responsive-custom > .table-bordered > tfoot > tr > td:last-child{border-right:0;}
		.table-responsive-custom > .table-bordered > tbody > tr:last-child > th,
		.table-responsive-custom > .table-bordered > tfoot > tr:last-child > th,
		.table-responsive-custom > .table-bordered > tbody > tr:last-child > td,
		.table-responsive-custom > .table-bordered > tfoot > tr:last-child > td{border-bottom:0;}
	  }
	  
	  .pTitleTop{margin-bottom:10px;}
	</style>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
</head>

<body>

<div id="wrapper">
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand">pubPOS</a>
		</div><!-- /.navbar-header -->

		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav side-nav">
				<li><a href="<?php echo site_url() ?>"><i class="fa fa-bullseye"></i> Dashboard</a></li>
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-folder-open"></i> Master Data <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url() ?>/master/country"><i class="fa fa-tag"></i> Country</a></li>
						<li><a href="<?php echo site_url() ?>/master/city"><i class="fa fa-tag"></i> City</a></li>
						<li><a href="<?php echo site_url() ?>/master/customer"><i class="fa fa-tag"></i> Customer</a></li>
						<li><a href="<?php echo site_url() ?>/master/vendor"><i class="fa fa-tag"></i> Vendor</a></li>
						<li><a href="<?php echo site_url() ?>/master/unit"><i class="fa fa-tag"></i> Unit</a></li>
						<li><a href="<?php echo site_url() ?>/master/category"><i class="fa fa-tag"></i> Category</a></li>
						<li><a href="<?php echo site_url() ?>/master/currency"><i class="fa fa-tag"></i> Currency</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-folder-open"></i> Inventory <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url() ?>/master/product"><i class="fa fa-tag"></i> Product</a></li>
					</ul>
				</li>
			</ul>
			
			<ul class="nav navbar-nav navbar-right navbar-user">
				<li class="dropdown user-dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->session->userdata('iSysUser') ?><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url() ?>/login/logout"><i class="fa fa-power-off"></i> Log Out</a></li>
					</ul>
				</li>
			</ul><!-- /.nav -->
		</div><!-- /.collapse -->
	</nav><!-- /.navbar -->
	
	<div id="page-wrapper">
		
		<?php echo $contents; ?>
	
	</div><!-- /.page-wrapper -->
</div><!-- /.wrapper -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jqueryui/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jqueryui/jquery-ui-1.11.4.custom.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jqgrid/i18n/grid.locale-en.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jqgrid/jquery.jqGrid.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/mask/jquery.maskedinput.min.js"></script>

</body>
</html>