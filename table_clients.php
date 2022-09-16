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
	$sql = 'SELECT * FROM clients';
$clientata = $pdo->query($sql)->fetchAll();

 echo '<script> var JsclientData='.json_encode($clientata).'; </script>'; ?>
	<div class="main-container">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">الأدلة</a></li>
									<li class="breadcrumb-item active" aria-current="page">العملاء</li>
								</ol>
							</nav>
						</div>
						
					</div>
				</div>
				<!-- basic table  Start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="clearfix mb-20">
						
						<div class="pull-right">
							<a href="#basic-table" id="btnAddNew" class="btn btn-primary btn-sm scroll-click" rel="content-y"  data-toggle="collapse" role="button"><i class="fa fa-plus"></i> جديد</a>
						</div>
					</div>
					<table class="table" id="clientTabla" data-toggle="table" >
						<thead>
							<tr>
								 <th  data-field="Id" data-width="3%"  data-sortable="true">م</th>
								 <th  data-field="Name"  data-sortable="true">الإسم</th>
								  <th  data-field="PhoneNo"  data-sortable="true">رقم الجوال </th>
								 <th  data-field="Address"  data-sortable="true">العنوان </th>
								
								 
							    <th data-formatter="EditclientFormatter" >تعديل</th>
								
							</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>
			<div class="modal fade" id="clientRegModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <form id="clientForm">
	  <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <center><h4 class="modal-title" >بيانات العميل</h4></center>
            </div>
			
            <div class="modal-body" >
			          <input type="hidden" class="form-control" id="Id" value=0  name="Id"  />
	                 <div class="form-group"> <label >الاسم <span class="rqd">*</span> :</label><input type="text" class="form-control" id="name"  name="name"  required /></div>
				      <div class="form-group"> <label >رقم الجوال <span class="rqd"></span> :</label><input type="number" class="form-control" id="phoneNo"  name="phoneNo"  /></div>
					<div class="form-group"> <label >العنوان <span class="rqd"></span> :</label><input type="text" class="form-control" id="address"  name="address"  /></div>
                      
                      
					
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
console.log(JsclientData);
	$('#clientTabla').bootstrapTable('load',JsclientData);
	$('#clientForm').on('submit',function(e){
		e.preventDefault();
		
	   let dataS=$('#clientForm').serializeArray();
	   console.log(dataS);
		if($('#Id').val()>0)
		{
			$.post('serversideCalls/Ajax/MastersCRUD/Clients/Update.php',dataS,function(r){
				if(r!='failed')
		       $('#clientTabla').bootstrapTable('load',JSON.parse(r));
			 $('#clientRegModal').modal('hide');
			});
		}
		else
		{
			$.ajax({url:'serversideCalls/Ajax/MastersCRUD/Clients/Insert.php',type:"post",data:dataS,success:function(r){
			if(r!='failed')
		       $('#clientTabla').bootstrapTable('load',JSON.parse(r));
			 $('#clientRegModal').modal('hide');
			 
			 
		    }});
		}
		
		
		
	});
	
   $('#btnAddNew').on('click',function(e){
	    $('input[type="text"],input[type="number"]').val('');
		
       
	    $('#CID').val(0);
    $('#clientRegModal').modal('show');
   });

});
   function setData4Edit(qstdt)
    {
        var clientData = JSON.parse(decodeURIComponent(qstdt));
	

        $('#Id').val(clientData.Id);$('#name').val(clientData.Name);$('#phoneNo').val(clientData.PhoneNo); 
		$('#address').val(clientData.Address); 
		
		
        $('#clientRegModal').modal('show');
		 
    }

 function EditclientFormatter(value, row, index) {
        return [
            '<a class="like btnEditDataElement"  title="Like" href="javascript:void(0)" onclick="setData4Edit(\'' + encodeURIComponent(JSON.stringify(row)) + '\');">',
            '<i class="fa fa-edit"></i> <span class="label label-primary">تعديل</span>',
            '</a>'


        ].join('');


    }
	
	function setDataFormData4Delete(qstdt)
    {
       
		r = confirm("هل انت متأكد من حذف هذا السجل؟");
        if (r == true) {

        var clientData = JSON.parse(decodeURIComponent(qstdt));
		
	   $.post('Ajax/PatientCRUD/Delete.php',clientData,function(r){
			console.log((r));
			if(r!='failed')
		       $('#clientTabla').bootstrapTable('load',JSON.parse(r));
			
			
		});
		}
		 
    }

	
</script>
</body>
</html>