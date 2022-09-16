<!DOCTYPE html>
<html dir="rtl">
<head>

	<?php require_once('include/dbconfig.php');
	include('include/head.php'); ?>

</head>
<body >
	<?php include('include/header.php'); ?>
	<?php include('include/sidebar.php'); ?>
	<?php 
   $sql = 'SELECT * FROM  batches';
   $Batchata = $pdo->query($sql)->fetchAll();
    $sql = 'SELECT b.id,b.name,1 as type FROM  brands b union all select c.id,c.name,2 as type from clients c';
	$cmdData= $pdo->query($sql)->fetchAll();
   echo '<script> var JsBatchData='.json_encode($Batchata).';var jsCmdData='.json_encode($cmdData).'; </script>';
   
   
 
	 ?>
<style>
.modal-body{
    height :100% !important;;
    over-flow-y:auto !important;
}
</style>
	<div class="main-container">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">العمليات</a></li>
									<li class="breadcrumb-item active" aria-current="page">الدفعات</li>
								</ol>
							</nav>
						</div>
						
					</div>
				</div>
				<!-- basic table  Start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="clearfix mb-20">
						
						<div class="pull-right">
							<a href="#basic-table" id="btnAddNew" class="btn btn-primary btn-sm scroll-click" rel="content-y"  data-toggle="collapse" role="button"><i class="fa fa-plus"></i> دفعة جديدة</a>
						</div>
					</div>
					<table class="table" id="BatchTabla" data-toggle="table" >
						<thead>
							<tr>
								  <th  data-field="Id" data-filter-control="input" data-width="3%"  data-sortable="true">#</th>
								  <th  data-field="BatchName" data-filter-control="select" data-sortable="true">اسم الدفعة</th>
								   <th  data-field="ClientId" data-filter-control="select" data-sortable="true">العميل</th>
								   <th  data-field="BrandId" data-filter-control="select" data-sortable="true">المنتج</th>
								     <th  data-field="CreatedOn" data-filter-control="input"  data-sortable="true">تاريخ الدفعة</th>
									   <th  data-field="NoOfCoupons" data-filter-control="input"  data-sortable="true">عدد الكروت</th>
									 <th  data-field="CouponsGenerated" data-filter-control="input"  data-sortable="true">تم التوليد؟</th>
										 <th  data-field="Printed" data-filter-control="input"  data-sortable="true">تمت الطباعة</th>
                                 <th  data-field="Description" data-filter-control="input"  data-sortable="true">الوصف</th>
                                                           
							
									
								 	<th data-formatter="GenrateBatchCouponsFormatter" >توليد</th>
							    <th data-formatter="EditBatchFormatter" >تعديل</th>
							
								<th data-formatter="PrintBatchCouponsFormatter" >طباعة</th>
								
							</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>
			<div class="modal fade" id="BatchRegModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <form id="BatchForm">
	  <div class="modal-dialog modal-dialog-scrollable  modal-xl" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <center><h4 class="modal-title" >بيانات الدفعة</h4></center>
            </div>
			
            <div class="modal-body"  >
			          <input type="hidden" class="form-control" id="Id" value=0  name="Id"  />
					  <div class="form-group"> <label >الدفعة</label> <input type="text" class="form-control" id="BatchName" name="BatchName"   /></div>
					  	  <div class="form-group"> <label >العميل</label> <select class="form-control" id="ClientId" name="ClientId"   ></select></div>	
						   <div class="form-group"> <label >المنتج</label> <select  class="form-control" id="BrandId" name="BrandId"   ></select></div>	
						    <div class="form-group"> <label >عدد الكروت</label> <input type="text" class="form-control" id="NoOfCoupons" name="NoOfCoupons"   /></div>	
				
			         <div class="form-group"> <label >الوصف</label><textarea class="form-control coment" id="Description" name="Description" rows="2" placeholder="................"></textarea></div>
                 
                      
					
				 </div>
            <div class="modal-footer">
                <button type="submit" id="btnSubmit" class="btn btn-primary" >حفظ</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
               
                </div>     
            </div>
          </div>
        </form>
    </div>
			</div>
			<?php include('include/footer.php'); ?>
		</div>
	</div>
	<?php include('include/script.php'); ?>
	<script>


$(function(){
console.log(JsBatchData);

	var brands="<option value=0>.........لايوجد</option>";
	var clients="<option value=0>.........لايوجد</option>";
	$.each(jsCmdData,function(k,i){
		if(i.type==1)
		brands +="<option value="+i.id+">"+i.name+"</option>"
		else if(i.type==2)
		 clients +="<option value="+i.id+">"+i.name+"</option>"

    });
     $('#ClientId').html(clients);
	$('#BrandId').html(brands);
	$('#BatchTabla').bootstrapTable('load',JsBatchData);
	$('#BatchForm').on('submit',function(e){
		e.preventDefault();
		
	   let dataS=$('#BatchForm').serializeArray();
	   console.log(dataS);
		if($('#Id').val()>0)
		{
			$.post('serversideCalls/Ajax/MastersCRUD/Batches/update.php',dataS,function(r){
				if(r!='failed')
		       $('#BatchTabla').bootstrapTable('load',JSON.parse(r));
			 $('#BatchRegModal').modal('hide');
			});
		}
		else
		{
			$.ajax({url:'serversideCalls/Ajax/MastersCRUD/Batches/insert.php',type:"post",data:dataS,success:function(r){
			if(r!='failed')
		       $('#BatchTabla').bootstrapTable('load',JSON.parse(r));
			 $('#BatchRegModal').modal('hide');
			 
			 
		    }});
		}
		
		
		
	});
	
   $('#btnAddNew').on('click',function(e){
	    //$('input[type="text"],input[type="number"]').val('');
		
       
	   // $('#Id').val(0);
    $('#BatchRegModal').modal('show');
   });

});
   function setData4Edit(qstdt)
    {
        var BatchData = JSON.parse(decodeURIComponent(qstdt));

        $('#Id').val(BatchData .Id);
		$('#BatchName').val(BatchData .BatchName);
		$('#ClientId').val(BatchData .ClientId); 
	$('#BrandId').val(BatchData .BrandId); 
       
	   $('#NoOfCoupons').val(BatchData .NoOfCoupons);
	    $('#Description').val(BatchData .Description);
		
	   
	 
        $('#BatchRegModal').modal('show');
		 
    }
	 function setData4Generate(qstdt)
    {
        var BatchData = JSON.parse(decodeURIComponent(qstdt));

      	$.ajax({url:'serversideCalls/Ajax/MastersCRUD/Batches/generate.php',type:"post",data:{BatchId:BatchData.Id,NoOfCoupons:BatchData.NoOfCoupons},success:function(r){
			if(r!='failed')
		       $('#BatchTabla').bootstrapTable('load',JSON.parse(r));
			
			 
			 
		    }});
		 
    }

 function EditBatchFormatter(value, row, index) {
        return [
            '<a class="like btnEditDataElement"  title="Like" href="javascript:void(0)" onclick="setData4Edit(\'' + encodeURIComponent(JSON.stringify(row)) + '\');">',
            '<i class="fa fa-edit"></i> <span class="label label-primary">تعديل</span>',
            '</a>'


        ].join('');


    }
	
	 function GenrateBatchCouponsFormatter(value, row, index) {
		 if(row.CouponsGenerated>0)
        return [
           ''


        ].join('');
		else return [
           '<a class="like btnEditDataElement"  title="Like" href="javascript:void(0)" onclick="setData4Generate(\'' + encodeURIComponent(JSON.stringify(row)) + '\');">',
            '<i class="fa fa-cog"></i> <span class="label label-primary">توليد</span>',
            '</a>'


        ].join('');
			


    }
	 function PrintBatchCouponsFormatter(value, row, index) {
        return [
            '<a class="like btnEditDataElement" target="_blank"  title="Like" href="table_coupons.php?BatchId='+row.Id+'" >',
            '<i class="fa fa-print"></i> <span class="label label-primary">طباعة</span>',
            '</a>'


        ].join('');


    }
	
	
	function setDataFormData4Delete(qstdt)
    {
       
		r = confirm("هل انت متأكد من حذف هذا السجل؟");
        if (r == true) {

        var BatchData = JSON.parse(decodeURIComponent(qstdt));
		
	   $.post('Ajax/PatientCRUD/Delete.php',BatchData,function(r){
			console.log((r));
			if(r!='failed')
		       $('#BatchTabla').bootstrapTable('load',JSON.parse(r));
			
			
		});
		}
		 
    }
function DeleteDoctorFormatter(value, row, index) {
        return [
            '<a class="like btnEditDataElement"  title="Like" href="javascript:void(0)" onclick="setDataFormData4Delete(\'' + encodeURIComponent(JSON.stringify(row)) + '\');">',
            '<i class="fa fa-remover"></i> <span class="label label-danger">حذف</span>',
            '</a>'


        ].join('');


    }	
	
</script>
</body>
</html>