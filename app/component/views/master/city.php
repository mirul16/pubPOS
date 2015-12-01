<style>.form-control{height:30px;font-size:12px !important;}</style>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="active"><i class="fa fa-edit"></i> MASTER CITY</li>
		</ol>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
		
<div class="row">
	<div class="col-lg-12">
	<div id="view">
		<button id="inputCity" class="ui-button-primary">Add City</button>
		<div class="table-responsive"><table id="listCity"></table></div>
		<div id="pagerCity"></div>
	</div>
	
	<div id="formCity">
	<form>
		<table width="100%">
			<input type="hidden" name="oper" id="oper" />
			<tr id="citylabelid">    
				<td>City ID</td>
    			<td>:</td>
    			<td><input type="text" name="cityid" id="cityid" class="form-control" /></td>
			</tr>
			<tr>    
				<td>City</td>
    			<td>:</td>
    			<td><input type="text" name="cityname" id="cityname" class="form-control" style="text-transform:uppercase" /></td>
			</tr>
			<tr>    
				<td>City Code</td>
    			<td>:</td>
    			<td><input type="text" name="citycode" id="citycode" class="form-control" style="text-transform:uppercase" /></td>
			</tr>
			<tr>    
				<td>Country</td>
    			<td>:</td>
    			<td>
					<input type="text" name="citycountrynm" id="citycountrynm" class="form-control" style="text-transform:uppercase" onClick="popupForm()" readonly="" />
					<input type="hidden" name="citycountry" id="citycountry" />
				</td>
			</tr>
		</table>
	</form>
	</div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->	

<script type="text/javascript">
function vcity(){
	var gridCity = $("#listCity");
	gridCity.jqGrid({
		url:"<?php echo site_url('master/city/jsonCity') ?>",
		datatype:"json",
		mtype:"post",
		colNames:["Act","ID","City","City Code","Country"],
		colModel:[
			{name:"act",sortable:false,width:40,align:"center"},
			{name:"city_id",index:"city_id",width:80},
			{name:"city_name",index:"city_name",width:200},
			{name:"city_code",index:"city_code",width:100},
			{name:"country_name",index:"country_name",width:200}
		],
		rowNum:1000000000,
		rownumbers:true,
		rowList:[3,5,10,20,30],
		pager:"#pagerCity",
		sortname:"city_id",
		viewrecords:true,
		sortorder:"desc",
		editurl:"<?php echo site_url('master/city/crudCity') ?>",
		height:"auto",
		caption:"CITY",
	}).navGrid("#pagerCity",{view:true,add:false,edit:false,del:true,search:true});
	gridCity.setGridParam({rowNum:3});
}

$(document).ready(function(){
	/* Begin City */
	vcity();

	$("#formCity").dialog({
		autoOpen:false,
		height:260,
		width:300,
		modal:true,
		buttons:{
			Update:function(){
				var cityid=$("#cityid").val();
				var cityname=$("#cityname").val();
				var citycode=$("#citycode").val();
				var citycountry=$("#citycountry").val();
				var oper=$("#oper").val();
				
				if(cityname.length==0){
					alert("City Name can not empty!");
					$("#cityname").focus();
					return false;
				}
				if(citycode.length==0){
					alert("City Code can not empty!");
					$("#citycode").focus();
					return false;
				}
				if(citycountry.length==0){
					alert("Country can not empty!");
					$("#citycountry").focus();
					return false;
				}
				
				var form_data="cityid="+cityid+"&cityname="+cityname+"&citycode="+citycode+"&citycountry="+citycountry+"&oper="+oper;
				
				$.ajax({
					url:"<?php echo site_url('master/city/crudCity')?>",
					type:"POST",
					data:form_data,
					success:function(data){
						$("#listCity").jqGrid('GridUnload'),
						vcity(),
                    	$("#formCity").dialog("close")
                    }
				});
			},
			Cancel:function() {
				$("#cityname").val(""),
				$("#citycode").val(""),
				$("#citycountry").val(""),
				$("#citycountrynm").val(""),
				$(this).dialog("close")
			}
		},
		close:function() {
			$("#cityname").val(""),
			$("#citycode").val(""),
			$("#citycountry").val(""),
			$("#citycountrynm").val(""),
			$(this).dialog("close")
		}
	});
	
	$("#inputCity")
		.button()
		.click(function(){
			$("#formCity").dialog("open");
			$("#oper").val("add");
			$("#cityid").attr("disabled",true);
			$("#citylabelid").attr("hidden",true);
			$("#citycountry").val(""),
			$("#cityname").focus();
		});
	
	$("body").on("click",".editCity",function(){
		var cityid=$(this).attr("cityid");
		var cityname=$(this).attr("cityname");
		var citycode=$(this).attr("citycode");
		var citycountry=$(this).attr("citycountry");
		var citycountrynm=$(this).attr("citycountrynm");

		$("#oper").val("edit");
		$("#cityid").val(cityid);
        $("#cityname").val(cityname);
		$("#citycode").val(citycode);
		$("#citycountry").val(citycountry);
		$("#citycountrynm").val(citycountrynm);
		
		$("#cityid").attr("disabled",true);
		$("#citylabelid").attr("hidden",false);
		$("#cityname").focus();
        
        $("#formCity").dialog("open");
        
        return false;
	});
	/* End City */
});

function popupForm(){
	var popup=window.open('<?php echo site_url('search/city_country_search')?>','popupForm','menubar=no,status=no,top=100%,left=300,width=800;');
}
</script>