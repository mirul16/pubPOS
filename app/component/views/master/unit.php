<style>.form-control{height:30px;font-size:12px !important;}</style>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="active"><i class="fa fa-edit"></i> MASTER UNIT</li>
		</ol>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
		
<div class="row">
	<div class="col-lg-12">
	<div id="view">
		<button id="inputUnit" class="ui-button-primary">Add Unit</button>
		<div class="table-responsive"><table id="listUnit"></table></div>
		<div id="pagerUnit"></div>
	</div>
	
	<div id="formUnit">
	<form>
		<table width="100%">
			<input type="hidden" name="oper" id="oper" />
			<tr id="unitlabelid">    
				<td>Unit ID</td>
    			<td>:</td>
    			<td><input type="text" name="unitid" id="unitid" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Unit</td>
    			<td>:</td>
    			<td><input type="text" name="unitname" id="unitname" class="form-control" style="text-transform:uppercase" /></td>
			</tr>
		</table>
	</form>
	</div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->	

<script type="text/javascript">
function vunit(){
	var gridUnit = $("#listUnit");
	gridUnit.jqGrid({
		url:"<?php echo site_url('master/unit/jsonUnit') ?>",
		datatype:"json",
		mtype:"post",
		colNames:["Act","ID","Unit"],
		colModel:[
			{name:"act",sortable:false,width:40,align:"center"},
			{name:"unit_id",index:"unit_id",width:80},
			{name:"unit_name",index:"unit_name",width:400}
		],
		rowNum:1000000000,
		rownumbers:true,
		rowList:[3,5,10,20,30],
		pager:"#pagerUnit",
		sortname:"unit_id",
		viewrecords:true,
		sortorder:"desc",
		editurl:"<?php echo site_url('master/unit/crudUnit') ?>",
		height:"auto",
		caption:"UNIT",
	}).navGrid("#pagerUnit",{view:true,add:false,edit:false,del:true,search:true});
	gridUnit.setGridParam({rowNum:3});
}

$(document).ready(function(){
	/* Begin Unit */
	vunit();

	$("#formUnit").dialog({
		autoOpen:false,
		height:200,
		width:300,
		unital:true,
		buttons:{
			Update:function(){
				var unitid=$("#unitid").val();
				var unitname=$("#unitname").val();
				var oper=$("#oper").val();
				
				if(unitname.length==0){
					alert("Unit Name can not empty!");
					$("#unitname").focus();
					return false;
				}
				
				var form_data="unitid="+unitid+"&unitname="+unitname+"&oper="+oper;
				
				$.ajax({
					url:"<?php echo site_url('master/unit/crudUnit')?>",
					type:"POST",
					data:form_data,
					success:function(data){
						$("#listUnit").jqGrid('GridUnload'),
						vunit();
                    	$("#formUnit").dialog("close")
                    }
				});
			},
			Cancel:function() {
				$("#unitname").val(""),
				$(this).dialog("close")
			}
		},
		close:function() {
			$("#unitname").val(""),
			$(this).dialog("close")
		}
	});
	
	$("#inputUnit")
		.button()
		.click(function(){
			$("#formUnit").dialog("open");
			$("#oper").val("add");
			$("#unitid").attr("disabled",true);
			$("#unitlabelid").attr("hidden",true);
			$("#unitname").focus();
		});
	
	$("body").on("click",".editUnit",function(){
		var unitid=$(this).attr("unitid");
		var unitname=$(this).attr("unitname");

		$("#oper").val("edit");
		$("#unitid").val(unitid);
        $("#unitname").val(unitname);
		
		$("#unitid").attr("disabled",true);
		$("#unitlabelid").attr("hidden",false);
		$("#unitname").focus();
        
        $("#formUnit").dialog("open");
        
        return false;
	});
	/* End Unit */
});
</script>