<style>.form-control{height:30px;font-size:12px !important;}</style>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="active"><i class="fa fa-edit"></i> MASTER CATEGORY</li>
		</ol>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
		
<div class="row">
	<div class="col-lg-12">
	<div id="view">
		<button id="inputCategory" class="ui-button-primary">Add Category</button>
		<div class="table-responsive"><table id="listCategory"></table></div>
		<div id="pagerCategory"></div>
	</div>
	
	<div id="formCategory">
	<form>
		<table width="100%">
			<input type="hidden" name="oper" id="oper" />
			<tr id="categorylabelid">    
				<td>Category ID</td>
    			<td>:</td>
    			<td><input type="text" name="categoryid" id="categoryid" class="form-control" /></td>
			</tr>
			<tr>    
				<td>Category</td>
    			<td>:</td>
    			<td><input type="text" name="categoryname" id="categoryname" class="form-control" style="text-transform:uppercase" /></td>
			</tr>
		</table>
	</form>
	</div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->	

<script type="text/javascript">
function vcategory(){
	var gridCategory = $("#listCategory");
	gridCategory.jqGrid({
		url:"<?php echo site_url('master/category/jsonCategory') ?>",
		datatype:"json",
		mtype:"post",
		colNames:["Act","ID","Category"],
		colModel:[
			{name:"act",sortable:false,width:40,align:"center"},
			{name:"category_id",index:"category_id",width:80},
			{name:"category_name",index:"category_name",width:400}
		],
		rowNum:1000000000,
		rownumbers:true,
		rowList:[3,5,10,20,30],
		pager:"#pagerCategory",
		sortname:"category_id",
		viewrecords:true,
		sortorder:"desc",
		editurl:"<?php echo site_url('master/category/crudCategory') ?>",
		height:"auto",
		caption:"CATEGORY",
	}).navGrid("#pagerCategory",{view:true,add:false,edit:false,del:true,search:true});
	gridCategory.setGridParam({rowNum:3});
}

$(document).ready(function(){
	/* Begin Category */
	vcategory();
	
	$("#formCategory").dialog({
		autoOpen:false,
		height:200,
		width:300,
		modal:true,
		buttons:{
			Update:function(){
				var categoryid=$("#categoryid").val();
				var categoryname=$("#categoryname").val();
				var oper=$("#oper").val();
				
				if(categoryname.length==0){
					alert("Category Name can not empty!");
					$("#categoryname").focus();
					return false;
				}
				
				var form_data="categoryid="+categoryid+"&categoryname="+categoryname+"&oper="+oper;
				
				$.ajax({
					url:"<?php echo site_url('master/category/crudCategory')?>",
					type:"POST",
					data:form_data,
					success:function(data){
						$("#listCategory").jqGrid('GridUnload'),
						vcategory(),
                    	$("#formCategory").dialog("close")
                    }
				});
			},
			Cancel:function() {
				$("#categoryname").val(""),
				$(this).dialog("close")
			}
		},
		close:function() {
			$("#categoryname").val(""),
			$(this).dialog("close")
		}
	});
	
	$("#inputCategory")
		.button()
		.click(function(){
			$("#formCategory").dialog("open");
			$("#oper").val("add");
			$("#categoryid").attr("disabled",true);
			$("#categorylabelid").attr("hidden",true);
			$("#categoryname").focus();
		});
	
	$("body").on("click",".editCategory",function(){
		var categoryid=$(this).attr("categoryid");
		var categoryname=$(this).attr("categoryname");

		$("#oper").val("edit");
		$("#categoryid").val(categoryid);
        $("#categoryname").val(categoryname);
		
		$("#categoryid").attr("disabled",true);
		$("#categorylabelid").attr("hidden",false);
		$("#categoryname").focus();
        
        $("#formCategory").dialog("open");
        
        return false;
	});
	/* End Category */
});
</script>