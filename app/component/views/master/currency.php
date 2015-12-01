<style>.form-control{height:30px;font-size:12px !important;}</style>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="active"><i class="fa fa-edit"></i> MASTER CURRENCY</li>
		</ol>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
		
<div class="row">
	<div class="col-lg-12">
	<div id="view">
		<button id="inputCurrency" class="ui-button-primary">Add Currency</button>
		<div class="table-responsive"><table id="listCurrency"></table></div>
		<div id="pagerCurrency"></div>
	</div>
	
	<div id="formCurrency">
	<form>
		<table width="100%">
			<input type="hidden" name="oper" id="oper" />
			<tr id="currencylabelid">    
				<td>Currency ID</td>
    			<td>:</td>
    			<td><input type="text" name="currencyid" id="currencyid" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Currency</td>
    			<td>:</td>
    			<td><input type="text" name="currencycode" id="currencycode" class="form-control" style="text-transform:uppercase" /></td>
			</tr>
			<tr>    
				<td>Country</td>
    			<td>:</td>
    			<td>
					<input type="text" name="currencycountrynm" id="currencycountrynm" class="form-control" style="text-transform:uppercase" onClick="popupForm()" readonly="" />
					<input type="hidden" name="currencycountry" id="currencycountry" />
				</td>
			</tr>
			<tr>    
				<td>Rate</td>
    			<td>:</td>
    			<td><input type="text" name="currencyrate" id="currencyrate" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Symbol</td>
    			<td>:</td>
    			<td><input type="text" name="currencysymbol" id="currencysymbol" class="form-control" /></td>
			</tr>
		</table>
	</form>
	</div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->	

<script type="text/javascript" src="<?php echo base_url() ?>assets/js/number/jquery.number.min.js"></script>
<script type="text/javascript">
function vcurrency(){
	var gridCurrency = $("#listCurrency");
	gridCurrency.jqGrid({
		url:"<?php echo site_url('master/currency/jsonCurrency') ?>",
		datatype:"json",
		mtype:"post",
		colNames:["Act","ID","Currency","Country","Rate","Symbol"],
		colModel:[
			{name:"act",sortable:false,width:40,align:"center"},
			{name:"currency_id",index:"currency_id",width:80},
			{name:"currency_code",index:"currency_code",width:100},
			{name:"country_name",index:"country_name",width:200},
			{name:"rate",index:"rate",width:250},
			{name:"symbol",index:"symbol",width:100}
		],
		rowNum:1000000000,
		rownumbers:true,
		rowList:[3,5,10,20,30],
		pager:"#pagerCurrency",
		sortname:"currency_id",
		viewrecords:true,
		sortorder:"desc",
		editurl:"<?php echo site_url('master/currency/crudCurrency') ?>",
		height:"auto",
		caption:"CURRENCY",
	}).navGrid("#pagerCurrency",{view:true,add:false,edit:false,del:true,search:true});
	gridCurrency.setGridParam({rowNum:3});
} 

$(document).ready(function(){
	/* Begin Currency */
	vcurrency();

	$("#formCurrency").dialog({
		autoOpen:false,
		height:290,
		width:300,
		modal:true,
		buttons:{
			Update:function(){
				var currencyid=$("#currencyid").val();
				var currencycode=$("#currencycode").val();
				var currencycountry=$("#currencycountry").val();
				var currencyrate=$("#currencyrate").val();
				var currencysymbol=$("#currencysymbol").val();
				var oper=$("#oper").val();
				
				if(currencycode.length==0){
					alert("Currency Name can not empty!");
					$("#currencycode").focus();
					return false;
				}
				if(currencycountry.length==0){
					alert("Country can not empty!");
					$("#currencycountry").focus();
					return false;
				}
				
				var form_data="currencyid="+currencyid+"&currencycode="+currencycode+"&currencycountry="+currencycountry
							  +"&currencyrate="+currencyrate+"&currencysymbol="+currencysymbol+"&oper="+oper;
				
				$.ajax({
					url:"<?php echo site_url('master/currency/crudCurrency')?>",
					type:"POST",
					data:form_data,
					success:function(data){
						$("#listCurrency").jqGrid('GridUnload'),
						vcurrency(),
                    	$("#formCurrency").dialog("close")
                    }
				});
			},
			Cancel:function() {
				$("#currencycode").val(""),
				$("#currencycountry").val(""),
				$("#currencycountrynm").val(""),
				$("#currencyrate").val(""),
				$("#currencysymbol").val(""),
				$(this).dialog("close")
			}
		},
		close:function() {
			$("#currencycode").val(""),
			$("#currencycountry").val(""),
			$("#currencycountrynm").val(""),
			$("#currencyrate").val(""),
			$("#currencysymbol").val(""),
			$(this).dialog("close")
		}
	});
	
	$("#inputCurrency")
		.button()
		.click(function(){
			$("#formCurrency").dialog("open");
			$("#oper").val("add");
			$("#currencyid").attr("disabled",true);
			$("#currencylabelid").attr("hidden",true);
			$("#currencycountry").val(""),
			$("#currencycode").focus();
		});
	
	$("body").on("click",".editCurrency",function(){
		var currencyid=$(this).attr("currencyid");
		var currencycode=$(this).attr("currencycode");
		var currencycountry=$(this).attr("currencycountry");
		var currencycountrynm=$(this).attr("currencycountrynm");
		var currencyrate=$(this).attr("currencyrate");
		var currencysymbol=$(this).attr("currencysymbol");

		$("#oper").val("edit");
		$("#currencyid").val(currencyid);
        $("#currencycode").val(currencycode);
		$("#currencycountry").val(currencycountry);
		$("#currencycountrynm").val(currencycountrynm);
		$("#currencyrate").val(currencyrate);
		$("#currencysymbol").val(currencysymbol);
		
		$("#currencyid").attr("disabled",true);
		$("#currencylabelid").attr("hidden",false);
		$("#currencycode").focus();
        
        $("#formCurrency").dialog("open");
        
        return false;
	});
	/* End Currency */
	
	$('#currencyrate').number(true,2);
});

function popupForm(){
	var popup=window.open('<?php echo site_url('search/currency_country_search')?>','popupForm','menubar=no,status=no,top=100%,left=100;');
}
</script>