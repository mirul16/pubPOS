<style>.form-control{height:31px;font-size:12px !important;}</style>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="active"><i class="fa fa-edit"></i> PRODUCT</li>
		</ol>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
		
<div class="row">
	<div class="col-lg-12">
	<div id="view">
		<button id="inputProduct" class="ui-button-primary">Add Product</button>
		<div class="table-responsive"><table id="listProduct"></table></div>
		<div id="pagerProduct"></div><br />
		
		<button id="inputProductD" class="ui-button-primary">Add Product Detail</button>
		<div class="table-responsive table-responsive-custom"><table id="listProductD"></table></div>
		<div id="pagerProductD"></div>
	</div>
	
	<div id="formProduct">
	<form>
		<table width="100%">
			<input type="hidden" name="productoper" id="productoper" />
			<tr id="productlabelid">    
				<td>Product ID</td>
    			<td>:</td>
    			<td><input type="text" name="productid" id="productid" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Product</td>
    			<td>:</td>
    			<td><input type="text" name="productname" id="productname" class="form-control" style="text-transform:uppercase" /></td>
			</tr>
			<tr>    
				<td>Category</td>
    			<td>:</td>
    			<td>
				<select name="productcat" id="productcat" class="form-control">
					<?php foreach($category->result_array() as $c) { ?>
					<option value="<?php echo $c['category_id'] ?>"><?php echo $c['category_name'] ?></option>
					<?php } ?>
				</select>
				</td>
			</tr>
			<tr>    
				<td>Brand</td>
    			<td>:</td>
    			<td><input type="text" name="productbrand" id="productbrand" class="form-control" style="text-transform:uppercase" /></td>
			</tr>
			<tr>    
				<td>Status</td>
    			<td>:</td>
    			<td>
				<select name="productstat" id="productstat" class="form-control">
					<option value="1">Activate</option>
					<option value="0">DeActivate</option>
				</select>
				</td>
			</tr>
		</table>
	</form>
	</div>
	
	<div id="formProductD">
	<form>
		<table width="100%">
			<input type="hidden" name="productdoper" id="productdoper" />
			<input type="hidden" name="productdid" id="productdid" />
			<tr>    
				<td>SKU</td>
    			<td>:</td>
    			<td><input type="text" name="productdsku" id="productdsku" class="form-control" style="text-transform:uppercase" /></td>
			</tr>
			<tr>    
				<td>Barcode</td>
    			<td>:</td>
    			<td><input type="text" name="productdbcode" id="productdbcode" class="form-control" style="text-transform:uppercase" /></td>
			</tr>
			<tr>    
				<td>Variant Name</td>
    			<td>:</td>
    			<td><input type="text" name="productdvar" id="productdvar" class="form-control" style="text-transform:uppercase" /></td>
			</tr>
			<tr>    
				<td>Flavour</td>
    			<td>:</td>
    			<td><input type="text" name="productdfla" id="productdfla" class="form-control" style="text-transform:uppercase" /></td>
			</tr>
			<tr>    
				<td>Stock</td>
    			<td>:</td>
    			<td><input type="text" name="productdstock" id="productdstock" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Unit</td>
    			<td>:</td>
    			<td>
				<select name="productdunit" id="productdunit" class="form-control">
					<?php foreach($unit->result_array() as $u) { ?>
					<option value="<?php echo $u['unit_id'] ?>"><?php echo $u['unit_name'] ?></option>
					<?php } ?>
				</select>
				</td>
			</tr>
			<tr>    
				<td>Quantity On Stock</td>
    			<td>:</td>
    			<td><input type="text" name="productdqstock" id="productdqstock" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Currency</td>
    			<td>:</td>
    			<td>
					<input type="text" name="productcurrnm" id="productcurrnm" class="form-control" style="text-transform:uppercase" onClick="pCurr()" readonly="" />
					<input type="hidden" name="productcurr" id="productcurr" />
				</td>
			</tr>
			<tr>    
				<td>Buying Price</td>
    			<td>:</td>
    			<td><input type="text" name="productdbuy" id="productdbuy" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Wholesale Price</td>
    			<td>:</td>
    			<td><input type="text" name="productdwhole" id="productdwhole" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Retail Price</td>
    			<td>:</td>
    			<td><input type="text" name="productdretail" id="productdretail" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Product On Order</td>
    			<td>:</td>
    			<td><input type="text" name="productdorder" id="productdorder" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Product Re-Order</td>
    			<td>:</td>
    			<td><input type="text" name="productdrorder" id="productdrorder" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Vendor</td>
    			<td>:</td>
    			<td>
					<input type="text" name="productvendornm" id="productvendornm" class="form-control" style="text-transform:uppercase" onClick="pVendor()" readonly="" />
					<input type="hidden" name="productvendor" id="productvendor" />
				</td>
			</tr>
		</table>
	</form>
	</div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->	

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/number/numeric.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/number/jquery.number.min.js"></script>
<script type="text/javascript">
function vproduct(){
	var gridProduct = $("#listProduct");
	gridProduct.jqGrid({
		url:"<?php echo site_url() ?>/master/product/jsonProduct",
		datatype:"json",
		mtype:"post",
		colNames:["Act","ID","Product","Category","Brand","Status"],
		colModel:[
			{name:"act",sortable:false,width:40,align:"center"},
			{name:"product_id",index:"product_id",width:80},
			{name:"product_name",index:"product_name",width:250},
			{name:"category_name",index:"category_name",width:150},
			{name:"product_brand",index:"product_brand",width:100},
			{name:"product_status",index:"product_status",width:100}
		],
		rowNum:1000000000,
		rownumbers:true,
		rowList:[3,5,10,20,30],
		pager:"#pagerProduct",
		sortname:"product_id",
		viewrecords:true,
		sortorder:"desc",
		editurl:"<?php echo site_url('master/product/crudProduct') ?>",
		height:"auto",
		caption:"PRODUCTS",
		onSelectRow:function(ids) { 
			$("#listProductD").jqGrid('GridUnload');
			vproductd(ids);
			
			$("#productdid").val(ids);
		}
	}).navGrid("#pagerProduct",{view:true,add:false,edit:false,del:true,search:true});
	gridProduct.setGridParam({rowNum:3});
}

function vproductd(ids){
	var gridProductD = $("#listProductD");
	gridProductD.jqGrid({
		url:"<?php echo site_url() ?>/master/product/jsonProductD/"+ids,
		page:1,
		datatype:"json",
		mtype:"post",
		colNames:["Act","SKU","Barcode","Variant Name","Flavour","Stock","Unit","Currency","Quantity","Buying Price","Wholesale Price",
			"Retail Price","Unit On Order","Unit Re-Order","Vendor"
		],
		colModel:[
			{name:"act",sortable:false,width:40,align:"center"},
			{name:"sku",index:"sku",width:100},
			{name:"barcode",index:"barcode",width:100},
			{name:"product_detail_name",index:"product_detail_name",width:200},
			{name:"typep",index:"typep",width:100},
			{name:"unit_stock",index:"unit_stock",width:100},
			{name:"unit_name",index:"unit_name",width:100},
			{name:"unit_qty",index:"unit_qty",width:100},
			{name:"symbol",index:"symbol",width:100},
			{name:"price_buy",index:"price_buy",width:150},
			{name:"price_wholesale",index:"price_wholesale",width:150},
			{name:"price_retail",index:"price_retail",width:150},
			{name:"unit_order",index:"unit_order",width:100},
			{name:"unit_reorder",index:"unit_reorder",width:100},
			{name:"account_name",index:"account_name",width:150}
		],
		rowNum:1000000000,
		rownumbers:true,
		rowList:[3,5,10,20,30],
		pager:"#pagerProductD",
		sortname:"sku",
		viewrecords:true,
		sortorder:"desc",
		editurl:"<?php echo site_url('master/product/crudProductD') ?>",
		height:"auto",
		caption:"PRODUCT DETAIL",
	}).navGrid("#pagerProductD",{view:true,add:false,edit:false,del:true,search:true});
	gridProductD.setGridParam({rowNum:3});
}

$(document).ready(function(){
	/* Begin Product */
	vproduct();

	$("#formProduct").dialog({
		autoOpen:false,
		height:300,
		width:400,
		modal:true,
		buttons:{
			Update:function(){
				var productid=$("#productid").val();
				var productname=$("#productname").val();
				var productcat=$("#productcat").val();
				var productbrand=$("#productbrand").val();
				var productstat=$("#productstat").val();
				var oper=$("#productoper").val();
				
				if(productname.length==0){
					alert("Product Name can not empty!");
					$("#productname").focus();
					return false;
				}
				if(productcat==null){
					alert("Category can not empty!");
					$("#productcat").focus();
					return false;
				}
				if(productstat==null){
					alert("Status can not empty!");
					$("#productstat").focus();
					return false;
				}
				
				var form_data="productid="+productid+"&productname="+productname+"&productcat="+productcat+"&productbrand="+productbrand
							 +"&productstat="+productstat+"&oper="+oper;
				
				$.ajax({
					url:"<?php echo site_url('master/product/crudProduct')?>",
					type:"POST",
					data:form_data,
					success:function(data){
						$("#listProduct").jqGrid('GridUnload'),
						vproduct(),
                    	$("#formProduct").dialog("close")
                    }
				});
			},
			Cancel:function() {
				$("#productname").val(""),
				$("#productcat").val(""),
				$("#productbrand").val(""),
				$("#productstat").val(""),
				$(this).dialog("close")
			}
		},
		close:function() {
			$("#productname").val(""),
			$("#productcat").val(""),
			$("#productbrand").val(""),
			$("#productstat").val(""),
			$(this).dialog("close")
		}
	});
	
	$("#inputProduct")
		.button()
		.click(function(){
			$("#formProduct").dialog("open");
			$("#productoper").val("add");
			$("#productid").attr("disabled",true);
			$("#productlabelid").attr("hidden",true);
			$("#productcat").val(""),
			$("#productname").focus();
		});
	
	$("body").on("click",".editProduct",function(){
		var productid=$(this).attr("productid");
		var productname=$(this).attr("productname");
		var productcat=$(this).attr("productcat");
		var productbrand=$(this).attr("productbrand");
		var productstat=$(this).attr("productstat");

		$("#productoper").val("edit");
		$("#productid").val(productid);
        $("#productname").val(productname);
		$("#productcat").val(productcat);
		$("#productbrand").val(productbrand);
		$("#productstat").val(productstat);
		
		$("#productid").attr("disabled",true);
		$("#productlabelid").attr("hidden",false);
		$("#productname").focus();
        
        $("#formProduct").dialog("open");
        
        return false;
	});
	/* End Product */
	
	/* Begin Product Detail */
	vproductd();
	
	$("#formProductD").dialog({
		autoOpen:false,
		height:570,
		width:500,
		modal:true,
		buttons:{
			Update:function(){
				var productdsku=$("#productdsku").val();
				var productdid=$("#productdid").val();
				var productdbcode=$("#productdbcode").val();
				var productdvar=$("#productdvar").val();
				var productdfla=$("#productdfla").val();
				var productdstock=$("#productdstock").val();
				var productdunit=$("#productdunit").val();
				var productdqstock=$("#productdqstock").val();
				var productcurr=$("#productcurr").val();
				var productdbuy=$("#productdbuy").val();
				var productdwhole=$("#productdwhole").val();
				var productdretail=$("#productdretail").val();
				var productdorder=$("#productdorder").val();
				var productdrorder=$("#productdrorder").val();
				var productvendor=$("#productvendor").val();
				var oper=$("#productdoper").val();
				
				if(productdsku.length==0){
					alert("SKU can not empty!");
					$("#productdsku").focus();
					return false;
				}
				if(productdid.length==0){
					alert("Please select Product!");
					$("#productdid").focus();
					return false;
				}
				if(productdvar.length==0){
					alert("Variant can not empty!");
					$("#productdvar").focus();
					return false;
				}
				if(productdunit==null){
					alert("Unit can not empty!");
					$("#productdunit").focus();
					return false;
				}
				if(productcurr==null){
					alert("Currency can not empty!");
					$("#productcurr").focus();
					return false;
				}
				
				var form_data="productdsku="+productdsku+"&productdid="+productdid+"&productdbcode="+productdbcode+"&productdvar="+productdvar+"&productdfla="+productdfla
							 +"&productdstock="+productdstock+"&productdunit="+productdunit+"&productdqstock="+productdqstock+"&productcurr="+productcurr
							 +"&productdbuy="+productdbuy+"&productdwhole="+productdwhole+"&productdretail="+productdretail+"&productdorder="+productdorder
							 +"&productdrorder="+productdrorder+"&productvendor="+productvendor+"&oper="+oper;
				
				$.ajax({
					url:"<?php echo site_url('master/product/crudProductD')?>",
					type:"POST",
					data:form_data,
					success:function(data){
						$("#listProductD").jqGrid('GridUnload'),
						vproductd(productdid),
                    	$("#formProductD").dialog("close")
                    }
				});
			},
			Cancel:function() {
				$("#productdsku").val(""),
				$("#productdid").val(""),
				$("#productdbcode").val(""),
				$("#productdvar").val(""),
				$("#productdfla").val(""),
				$("#productdstock").val(""),
				$("#productdunit").val(""),
				$("#productdqstock").val(""),
				$("#productcurrnm").val(""),
				$("#productcurr").val(""),
				$("#productdbuy").val(""),
				$("#productdwhole").val(""),
				$("#productdretail").val(""),
				$("#productdorder").val(""),
				$("#productdrorder").val(""),
				$("#productvendornm").val(""),
				$("#productvendor").val(""),
				$(this).dialog("close")
			}
		},
		close:function() {
			$("#productdsku").val(""),
			$("#productdid").val(""),
			$("#productdbcode").val(""),
			$("#productdvar").val(""),
			$("#productdfla").val(""),
			$("#productdstock").val(""),
			$("#productdunit").val(""),
			$("#productdqstock").val(""),
			$("#productcurrnm").val(""),
			$("#productcurr").val(""),
			$("#productdbuy").val(""),
			$("#productdwhole").val(""),
			$("#productdretail").val(""),
			$("#productdorder").val(""),
			$("#productdrorder").val(""),
			$("#productvendornm").val(""),
			$("#productvendor").val(""),
			$(this).dialog("close")
		}
	});
	
	$("#inputProductD")
		.button()
		.click(function(){
			$("#formProductD").dialog("open");
			$("#productdoper").val("add");
			$("#productdsku").attr("disabled",false);
			$("#productdunit").val(""),
			$("#productdsku").focus();
		});
	
	$("body").on("click",".editProductD",function(){
		var productdsku=$(this).attr("productdsku");
		var productdid=$(this).attr("productdid");
		var productdbcode=$(this).attr("productdbcode");
		var productdvar=$(this).attr("productdvar");
		var productdfla=$(this).attr("productdfla");
		var productdstock=$(this).attr("productdstock");
		var productdunit=$(this).attr("productdunit");
		var productdqstock=$(this).attr("productdqstock");
		var productcurrnm=$(this).attr("productcurrnm");
		var productcurr=$(this).attr("productcurr");
		var productdbuy=$(this).attr("productdbuy");
		var productdwhole=$(this).attr("productdwhole");
		var productdretail=$(this).attr("productdretail");
		var productdorder=$(this).attr("productdorder");
		var productdrorder=$(this).attr("productdrorder");
		var productvendornm=$(this).attr("productvendornm");
		var productvendor=$(this).attr("productvendor");

		$("#productdoper").val("edit");
		$("#productdsku").val(productdsku);
        $("#productdid").val(productdid);
		$("#productdbcode").val(productdbcode);
		$("#productdvar").val(productdvar);
		$("#productdfla").val(productdfla);
		$("#productdstock").val(productdstock);
		$("#productdunit").val(productdunit);
		$("#productdqstock").val(productdqstock);
		$("#productcurrnm").val(productcurrnm);
		$("#productcurr").val(productcurr);
		$("#productdbuy").val(productdbuy);
		$("#productdwhole").val(productdwhole);
		$("#productdretail").val(productdretail);
		$("#productdorder").val(productdorder);
		$("#productdrorder").val(productdrorder);
		$("#productvendornm").val(productvendornm);
		$("#productvendor").val(productvendor);
		
		$("#productdsku").attr("disabled",true);
		$("#productdvar").focus();
        
        $("#formProductD").dialog("open");
        
        return false;
	});
	/* End Product Detail */
	
	$("#productdstock").forceNumeric();
	$("#productdorder").forceNumeric();
	$("#productdrorder").forceNumeric();
	$('#productdbuy').number(true,2);
	$('#productdwhole').number(true,2);
	$('#productdretail').number(true,2);
});

function pVendor(){
	var popup=window.open('<?php echo site_url('search/product_vendor_search')?>','pVendor','menubar=no,status=no,top=100%,left=300,width=800;');
}

function pCurr(){
	var popup=window.open('<?php echo site_url('search/product_currency_search')?>','pCurr','menubar=no,status=no,top=100%,left=300,width=800;');
}
</script>