<style>.form-control{height:30px;font-size:12px !important;}</style>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="active"><i class="fa fa-edit"></i> MASTER VENDOR</li>
		</ol>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
		
<div class="row">
	<div class="col-lg-12">
	<div id="view">
		<button id="inputVen" class="ui-button-primary">Add Vendor</button>
		<div class="table-responsive table-responsive-custom"><table id="listVen"></table></div>
		<div id="pagerVen"></div>
	</div>
	
	<div id="formVen">
	<form>
		<table width="100%">
			<input type="hidden" name="oper" id="oper" />
			<tr id="venlabelid">    
				<td>Vendor ID</td>
    			<td>:</td>
    			<td><input type="text" name="venid" id="venid" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Vendor</td>
    			<td>:</td>
    			<td><input type="text" name="venname" id="venname" class="form-control" style="text-transform:uppercase" /></td>
			</tr>
			<tr>    
				<td>Address</td>
    			<td>:</td>
    			<td><input type="text" name="venaddr" id="venaddr" class="form-control" style="text-transform:uppercase" /></td>
			</tr>
			<tr>    
				<td>City</td>
    			<td>:</td>
    			<td>
					<input type="text" name="vencitynm" id="vencitynm" class="form-control" style="text-transform:uppercase" onclick='popupForm()' readonly="" />
					<input type="hidden" name="vencity" id="vencity" />
				</td>
			</tr>
			<tr>    
				<td>PIC</td>
    			<td>:</td>
    			<td><input type="text" name="venpic" id="venpic" class="form-control" style="text-transform:uppercase" /></td>
			</tr>
			<tr>    
				<td>Email</td>
    			<td>:</td>
    			<td><input type="text" name="venmail" id="venmail" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Phone</td>
    			<td>:</td>
    			<td><input type="text" name="venph" id="venph" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Fax</td>
    			<td>:</td>
    			<td><input type="text" name="venfax" id="venfax" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Notes</td>
    			<td>:</td>
    			<td><input type="text" name="vennote" id="vennote" class="form-control" style="text-transform:uppercase" /></td>
			</tr>
		</table>
	</form>
	</div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->	

<script type="text/javascript">
function vvendor(){
	var gridVen = $("#listVen");
	gridVen.jqGrid({
		url:"<?php echo site_url('master/vendor/jsonVen') ?>",
		datatype:"json",
		mtype:"post",
		colNames:["Act","ID","Vendor","Address","City","PIC","Email","Phone","Fax","Notes"],
		colModel:[
			{name:"act",sortable:false,width:30,align:"center"},
			{name:"account_id",index:"account_id",width:60},
			{name:"account_name",index:"account_name",width:250},
			{name:"address",index:"address",width:350},
			{name:"city_name",index:"city_name",width:150},
			{name:"pic",index:"pic",width:100},
			{name:"email",index:"email",width:200},
			{name:"phone",index:"phone",width:150},
			{name:"fax",index:"fax",width:150},
			{name:"notes",index:"notes",width:200}
		],
		rowNum:1000000000,
		rownumbers:true,
		rowList:[3,5,10,20,30],
		pager:"#pagerVen",
		sortname:"account_id",
		viewrecords:true,
		sortorder:"desc",
		editurl:"<?php echo site_url('master/vendor/crudVen') ?>",
		height:"auto",
		caption:"VENDOR",
		onSelectRow: function(ids) { 
			jQuery("#listVenAdd").jqGrid("setGridParam",{url:"<?php echo site_url() ?>/master/vendor/jsonVenAdd/"+ids,page:1});
			jQuery("#listVenAdd").jqGrid("setCaption","B/L Address");
			jQuery("#listVenAdd").jqGrid("clearGridData");
			jQuery("#listVenAdd").trigger("reloadGrid");
			
			$("#venidadd").val(ids);
		}
	}).navGrid("#pagerVen",{view:true,add:false,edit:false,del:true,search:true});
	gridVen.setGridParam({rowNum:3});
}

$(document).ready(function(){
	/* Begin Vendor */
	vvendor();

	$("#formVen").dialog({
		autoOpen:false,
		height:410,
		width:300,
		modal:true,
		buttons:{
			Update:function(){
				var venid=$("#venid").val();
				var venname=$("#venname").val();
				var venaddr=$("#venaddr").val();
				var vencity=$("#vencity").val();
				var venpic=$("#venpic").val();
				var venmail=$("#venmail").val();
				var venph=$("#venph").val();
				var venfax=$("#venfax").val();
				var vennote=$("#vennote").val();
				var oper=$("#oper").val();
				
				if(venname.length==0){
					alert("Vendor Name can not empty!");
					$("#venname").focus();
					return false;
				}
				if(vencity.length==0){
					alert("City can not empty!");
					$("#vencity").focus();
					return false;
				}
				
				var form_data="venid="+venid+"&venname="+venname+"&venaddr="+venaddr+"&vencity="+vencity+"&venpic="+venpic
							  +"&venmail="+venmail+"&venph="+venph+"&venfax="+venfax+"&vennote="+vennote+"&oper="+oper;
				
				$.ajax({
					url:"<?php echo site_url('master/vendor/crudVen')?>",
					type:"POST",
					data:form_data,
					success:function(data){
						$("#listVen").jqGrid('GridUnload'),
                    	vvendor(),
						$("#formVen").dialog("close")
                    }
				});
			},
			Cancel:function() {
				$("#venname").val(""),
				$("#venaddr").val(""),
				$("#vencity").val(""),
				$("#vencitynm").val(""),
				$("#venpic").val(""),
				$("#venmail").val(""),
				$("#venph").val(""),
				$("#venfax").val(""),
				$("#vennote").val(""),
				$(this).dialog("close")
			}
		},
		close:function() {
			$("#venname").val(""),
			$("#venaddr").val(""),
			$("#vencity").val(""),
			$("#vencitynm").val(""),
			$("#venpic").val(""),
			$("#venmail").val(""),
			$("#venph").val(""),
			$("#venfax").val(""),
			$("#vennote").val(""),
			$(this).dialog("close")
		}
	});
	
	$("#inputVen")
		.button()
		.click(function(){
			$("#formVen").dialog("open");
			$("#oper").val("add");
			$("#venid").attr("disabled",true);
			$("#venlabelid").attr("hidden",true);
			$("#vencity").val(""),
			$("#venname").focus();
		});
	
	$("body").on("click",".editVen",function(){
		var venid=$(this).attr("venid");
		var venname=$(this).attr("venname");
		var venaddr=$(this).attr("venaddr");
		var vencity=$(this).attr("vencity");
		var vencitynm=$(this).attr("vencitynm");
		var venpic=$(this).attr("venpic");
		var venmail=$(this).attr("venmail");
		var venph=$(this).attr("venph");
		var venfax=$(this).attr("venfax");
		var vennote=$(this).attr("vennote");

		$("#oper").val("edit");
		$("#venid").val(venid);
        $("#venname").val(venname);
		$("#venaddr").val(venaddr);
		$("#vencity").val(vencity);
		$("#vencitynm").val(vencitynm);
		$("#venpic").val(venpic);
		$("#venmail").val(venmail);
		$("#venph").val(venph);
		$("#venfax").val(venfax);
		$("#vennote").val(vennote);
		
		$("#venid").attr("disabled",true);
		$("#venlabelid").attr("hidden",false);
		$("#venname").focus();
        
        $("#formVen").dialog("open");
        
        return false;
	});
	/* End Vendor */
});

function popupForm(){
	var popup=window.open('<?php echo site_url('search/vendor_city_search')?>','popupForm','menubar=no,status=no,top=100%,left=300,width=800;');
}
</script>