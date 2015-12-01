<style>.form-control{height:30px;font-size:12px !important;}</style>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="active"><i class="fa fa-edit"></i> MASTER COUNTRY</li>
		</ol>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
		
<div class="row">
	<div class="col-lg-12">
	<div id="view">
		<button id="inputCountry" class="ui-button-primary">Add Country</button>
		<div class="table-responsive"><table id="listCountry"></table></div>
		<div id="pagerCountry"></div>
	</div>
	
	<div id="formCountry">
	<form>
		<table width="100%">
			<input type="hidden" name="oper" id="oper" />
			<tr id="countrylabelid">    
				<td>Country ID</td>
    			<td>:</td>
    			<td><input type="text" name="countryid" id="countryid" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Country</td>
    			<td>:</td>
    			<td><input type="text" name="countryname" id="countryname" class="form-control" style="text-transform:uppercase" /></td>
			</tr>
		</table>
	</form>
	</div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->	

<script type="text/javascript">
function vcountry(){
	var gridCountry = $("#listCountry");
	gridCountry.jqGrid({
		url:"<?php echo site_url('master/country/jsonCountry') ?>",
		datatype:"json",
		mtype:"post",
		colNames:["Act","ID","Country"],
		colModel:[
			{name:"act",sortable:false,width:40,align:"center"},
			{name:"country_id",index:"country_id",width:80},
			{name:"country_name",index:"country_name",width:400}
		],
		rowNum:1000000000,
		rownumbers:true,
		rowList:[3,5,10,20,30],
		pager:"#pagerCountry",
		sortname:"country_id",
		viewrecords:true,
		sortorder:"desc",
		editurl:"<?php echo site_url('master/country/crudCountry') ?>",
		height:"auto",
		caption:"COUNTRY",
	}).navGrid("#pagerCountry",{view:true,add:false,edit:false,del:true,search:true});
	gridCountry.setGridParam({rowNum:3});
}

$(document).ready(function(){
	/* Begin Country */	
	vcountry();
	
	$("#formCountry").dialog({
		autoOpen:false,
		height:200,
		width:300,
		modal:true,
		buttons:{
			Update:function(){
				var countryid=$("#countryid").val();
				var countryname=$("#countryname").val();
				var oper=$("#oper").val();
				
				if(countryname.length==0){
					alert("Country Name can not empty!");
					$("#countryname").focus();
					return false;
				}
				
				var form_data="countryid="+countryid+"&countryname="+countryname+"&oper="+oper;
				
				$.ajax({
					url:"<?php echo site_url('master/country/crudCountry')?>",
					type:"POST",
					data:form_data,
					success:function(data){
						$("#listCountry").jqGrid('GridUnload'),
						vcountry(),
                    	$("#formCountry").dialog("close")
                    }
				});
			},
			Cancel:function() {
				$("#countryname").val(""),
				$(this).dialog("close")
			}
		},
		close:function() {
			$("#countryname").val(""),
			$(this).dialog("close")
		}
	});
	
	$("#inputCountry")
		.button()
		.click(function(){
			$("#formCountry").dialog("open");
			$("#oper").val("add");
			$("#countryid").attr("disabled",true);
			$("#countrylabelid").attr("hidden",true);
			$("#countryname").focus();
		});
	
	$("body").on("click",".editCountry",function(){
		var countryid=$(this).attr("countryid");
		var countryname=$(this).attr("countryname");

		$("#oper").val("edit");
		$("#countryid").val(countryid);
        $("#countryname").val(countryname);
		
		$("#countryid").attr("disabled",true);
		$("#countrylabelid").attr("hidden",false);
		$("#countryname").focus();
        
        $("#formCountry").dialog("open");
        
        return false;
	});
	/* End Country */
});
</script>