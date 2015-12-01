<style>.form-control{height:30px;font-size:12px !important;}</style>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="active"><i class="fa fa-edit"></i> MASTER CUSTOMER</li>
		</ol>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
		
<div class="row">
	<div class="col-lg-12">
	<div id="view">
		<button id="inputCust" class="ui-button-primary">Add Customer</button>
		<div class="table-responsive table-responsive-custom"><table id="listCust"></table></div>
		<div id="pagerCust"></div>
	</div>
	
	<div id="formCust">
	<form>
		<table width="100%">
			<input type="hidden" name="oper" id="oper" />
			<tr id="custlabelid">    
				<td>Customer ID</td>
    			<td>:</td>
    			<td><input type="text" name="custid" id="custid" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Customer</td>
    			<td>:</td>
    			<td><input type="text" name="custname" id="custname" class="form-control" style="text-transform:uppercase" /></td>
			</tr>
			<tr>    
				<td>Address</td>
    			<td>:</td>
    			<td><input type="text" name="custaddr" id="custaddr" class="form-control" style="text-transform:uppercase" /></td>
			</tr>
			<tr>    
				<td>City</td>
    			<td>:</td>
    			<td>
					<input type="text" name="custcitynm" id="custcitynm" class="form-control" style="text-transform:uppercase" onclick='popupForm()' readonly="" />
					<input type="hidden" name="custcity" id="custcity" />
				</td>
			</tr>
			<tr>    
				<td>PIC</td>
    			<td>:</td>
    			<td><input type="text" name="custpic" id="custpic" class="form-control" style="text-transform:uppercase" /></td>
			</tr>
			<tr>    
				<td>Email</td>
    			<td>:</td>
    			<td><input type="text" name="custmail" id="custmail" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Phone</td>
    			<td>:</td>
    			<td><input type="text" name="custph" id="custph" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Fax</td>
    			<td>:</td>
    			<td><input type="text" name="custfax" id="custfax" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Notes</td>
    			<td>:</td>
    			<td><input type="text" name="custnote" id="custnote" class="form-control" style="text-transform:uppercase" /></td>
			</tr>
		</table>
	</form>
	</div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<script type="text/javascript">
function vcustomer(){
	var gridCust = $("#listCust");
	gridCust.jqGrid({
		url:"<?php echo site_url('master/customer/jsonCust') ?>",
		datatype:"json",
		mtype:"post",
		colNames:["Act","ID","Customer","Address","City","PIC","Email","Phone","Fax","Notes"],
		colModel:[
			{name:"act",sortable:false,width:40,align:"center"},
			{name:"account_id",index:"account_id",width:80},
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
		pager:"#pagerCust",
		sortname:"account_id",
		viewrecords:true,
		sortorder:"desc",
		editurl:"<?php echo site_url('master/customer/crudCust') ?>",
		height:"auto",
		caption:"CUSTOMER",
		onSelectRow: function(ids) { 
			jQuery("#listCustAdd").jqGrid("setGridParam",{url:"<?php echo site_url() ?>/master/customer/jsonCustAdd/"+ids,page:1});
			jQuery("#listCustAdd").jqGrid("setCaption","B/L Address");
			jQuery("#listCustAdd").jqGrid("clearGridData");
			jQuery("#listCustAdd").trigger("reloadGrid");
			
			$("#custidadd").val(ids);
		}
	}).navGrid("#pagerCust",{view:true,add:false,edit:false,del:true,search:true});
	gridCust.setGridParam({rowNum:3});
}

$(document).ready(function(){
	/* Begin Customer */
	vcustomer();

	$("#formCust").dialog({
		autoOpen:false,
		height:410,
		width:300,
		modal:true,
		buttons:{
			Update:function(){
				var custid=$("#custid").val();
				var custname=$("#custname").val();
				var custaddr=$("#custaddr").val();
				var custcity=$("#custcity").val();
				var custpic=$("#custpic").val();
				var custmail=$("#custmail").val();
				var custph=$("#custph").val();
				var custfax=$("#custfax").val();
				var custnote=$("#custnote").val();
				var oper=$("#oper").val();
				
				if(custname.length==0){
					alert("Customer Name can not empty!");
					$("#custname").focus();
					return false;
				}
				if(custcity.length==0){
					alert("City can not empty!");
					$("#custcity").focus();
					return false;
				}
				
				var form_data="custid="+custid+"&custname="+custname+"&custaddr="+custaddr+"&custcity="+custcity+"&custpic="+custpic
							  +"&custmail="+custmail+"&custph="+custph+"&custfax="+custfax+"&custnote="+custnote+"&oper="+oper;
				
				$.ajax({
					url:"<?php echo site_url('master/customer/crudCust')?>",
					type:"POST",
					data:form_data,
					success:function(data){
						$("#listCust").jqGrid('GridUnload'),
						vcustomer(),
                    	$("#formCust").dialog("close")
                    }
				});
			},
			Cancel:function() {
				$("#custname").val(""),
				$("#custaddr").val(""),
				$("#custcity").val(""),
				$("#custcitynm").val(""),
				$("#custpic").val(""),
				$("#custmail").val(""),
				$("#custph").val(""),
				$("#custfax").val(""),
				$("#custnote").val(""),
				$(this).dialog("close")
			}
		},
		close:function() {
			$("#custname").val(""),
			$("#custaddr").val(""),
			$("#custcity").val(""),
			$("#custcitynm").val(""),
			$("#custpic").val(""),
			$("#custmail").val(""),
			$("#custph").val(""),
			$("#custfax").val(""),
			$("#custnote").val(""),
			$(this).dialog("close")
		}
	});
	
	$("#inputCust")
		.button()
		.click(function(){
			$("#formCust").dialog("open");
			$("#oper").val("add");
			$("#custid").attr("disabled",true);
			$("#custlabelid").attr("hidden",true);
			$("#custcity").val(""),
			$("#custname").focus();
		});
	
	$("body").on("click",".editCust",function(){
		var custid=$(this).attr("custid");
		var custname=$(this).attr("custname");
		var custaddr=$(this).attr("custaddr");
		var custcity=$(this).attr("custcity");
		var custcitynm=$(this).attr("custcitynm");
		var custpic=$(this).attr("custpic");
		var custmail=$(this).attr("custmail");
		var custph=$(this).attr("custph");
		var custfax=$(this).attr("custfax");
		var custnote=$(this).attr("custnote");

		$("#oper").val("edit");
		$("#custid").val(custid);
        $("#custname").val(custname);
		$("#custaddr").val(custaddr);
		$("#custcity").val(custcity);
		$("#custcitynm").val(custcitynm);
		$("#custpic").val(custpic);
		$("#custmail").val(custmail);
		$("#custph").val(custph);
		$("#custfax").val(custfax);
		$("#custnote").val(custnote);
		
		$("#custid").attr("disabled",true);
		$("#custlabelid").attr("hidden",false);
		$("#custname").focus();
        
        $("#formCust").dialog("open");
        
        return false;
	});
	/* End Customer */
});

function popupForm(){
	var popup=window.open('<?php echo site_url('search/customer_city_search')?>','popupForm','menubar=no,status=no,top=100%,left=300,width=800;');
}
</script>