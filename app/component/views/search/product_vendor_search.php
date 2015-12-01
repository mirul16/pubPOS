<script type="text/javascript">
$(function() {

	// call the tablesorter plugin and apply the uitheme widget
	$("table").tablesorter({
		// this will apply the bootstrap theme if "uitheme" widget is included
		// the widgetOptions.uitheme is no longer required to be set
		theme : "blue",

		widthFixed: true,

		headerTemplate : '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!

		// widget code contained in the jquery.tablesorter.widgets.js file
		// use the zebra stripe widget if you plan on hiding any rows (filter widget)
		widgets : [ "uitheme", "filter", "zebra" ],

		widgetOptions : {
			// using the default zebra striping class name, so it actually isn't included in the theme variable above
			// this is ONLY needed for bootstrap theming if you are using the filter widget, because rows are hidden
			zebra : ["even", "odd"],

			// reset filters button
			filter_reset : ".reset"

			// set the uitheme widget to use the bootstrap theme class names
			// this is no longer required, if theme is set
			// ,uitheme : "bootstrap"

		}
	})
	.tablesorterPager({

		// target the pager markup - see the HTML block below
		container: $(".ts-pager"),

		// target the pager page select dropdown - choose a page
		cssGoto  : ".pagenum",

		// remove rows from the table to speed up the sort of large tables.
		// setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
		removeRows: false,

		// output string - default is '{page}/{totalPages}';
		// possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
		output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'

	});

});
</script>



<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<ol class="breadcrumb">
            	<li class="active"><i class="fa fa-edit"></i> Data Vendor</li>
            </ol>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-6">
			<table class="table table-bordered table-hover tablesorter">
			<thead>
				<tr>
					<th>No</th>
					<th>Vendor ID</th>
					<th>Vendor</th>
				</tr>
			</thead>
			
			<tfoot>
				<tr>
					<th colspan="4" class="ts-pager form-horizontal">
						<button type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i></button>
						<button type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i></button>
						<span class="pagedisplay"></span> <!-- this can be any element, including an input -->
						<button type="button" class="btn next"><i class="icon-arrow-right glyphicon glyphicon-forward"></i></button>
						<button type="button" class="btn last"><i class="icon-step-forward glyphicon glyphicon-step-forward"></i></button>
						<select class="pagesize input-mini" title="Select page size">
							<option value="8" selected>8</option>
							<option value="10">10</option>
							<option value="50">50</option>
							<option value="100">100</option>
						</select>
						<select class="pagenum input-mini" title="Select page number"></select>
					</th>
				</tr>
			</tfoot>
			
			<tbody>
			<?php 
				$no = 1;
				foreach($data->result() as $db){ 
			?>
				<tr onclick="javascript:choose(this);">
					<td><?php echo $no; ?></td>
					<td><?php echo $db->account_id ?></td>
					<td><?php echo $db->account_name ?></td>
				</tr>
			<?php 
				$no++;
				} 
			?>
			</tbody>
			</table>
		</div>
	</div>
</div><!-- /.page-wrapper -->

<script>
function choose(row){
	var venid=row.cells[1].innerHTML;
	var ven=row.cells[2].innerHTML;
	
	//window.opener.parent.document.getElementById("custcity").value = city;
	opener.productvendornm.value = ven;
	opener.productvendor.value = venid;
	self.close();
}
</script>