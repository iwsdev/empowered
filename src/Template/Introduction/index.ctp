<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Introduction 
			<small>Management</small>
		</h1>
		<?= $this->Flash->render() ?>
		<ol class="breadcrumb">
			<li><a href=""><i class="fa fa-dashboard"></i> Introduction</a></li>
			<li class="active">Introduction</li>
		</ol>
	</section>
	
    <!-- Main content -->
    <section class="content">
		<div class="row">
            <div class="col-xs-12"> 
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Introduction List</h3><p id="abcd"></p>
						<div class="box-tools pull-right">
							<a href="<?php echo $this->Url->build('/introduction/add');?>"><button class="btn btn-block btn-primary">Add New</button></a>
						</div>
					</div>
                    <div id="deletesuccess" style="color:green;font-size:14px;text-align:center"></div>
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>S.No</th>
									<th>Image</th>
									<th>Title</th>
									<th>Name</th>
									<th>Description</th>
									<th>Status</th>
									<th width="12%">Action</th>
								</tr>
							</thead>
							<tbody>
							    <?php
							        $i=0;
                                    foreach($intro as $introduction):
                                    $i++;
							    ?>
									<tr>
										<td><?php echo $i;?></td>
										<td>
										  <?php if(isset($introduction['image']) && !empty($introduction['image'])) { ?>
										
										       <img src="<?php echo $this->request->webroot?>img/introduction/<?php echo $introduction['image'];?>" style="height:120px !important; width:140px !important;">
										       
										  <?php } else { ?>
										  
										       <img src="<?php echo $this->request->webroot?>img/logo/download.jpeg" style="height:120px !important; width:140px !important;">
										  
										 <?php } ?>
										</td>
										<td><?php echo $introduction['title'];?></td>
										<td><?php echo $introduction['name'];?></td>
										<td><?php echo substr($introduction['description'],0,250);?></td>
										<td>
                                            <a href="javascript:;" onclick="ch_status('<?php echo $introduction['id'];?>');">
                                                <span id="status_<?php echo $introduction['id'];?>">
										            <?php 
										              if($introduction['status']==1)
										              { 
										                  echo '<button class="btn btn-success btn-xs"><strong>Active</strong></button>';
										              }
										              else
										              { 
										                  echo '<button class="btn btn-warning btn-xs"><strong>Inactive</strong></button>';
										              }
										            ?>
												</span>
										    </a>
										</td>
										<td>
											<?php echo $this->Html->link('Edit',array('controller'=>'introduction','action'=>'edit',$introduction['id']),['class'=>'btn btn-success btn-xs']);?>

                                            <a href="javascript:;" onclick="ConfirmDelete('<?php echo $introduction['id'];?>');"class="btn btn-danger btn-xs">Delete
                                            </a>
										</td>
									</tr>
								<?php endforeach;?>	
							</tbody>
						</table>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->
	<!----->
</div><!-- /.content-wrapper -->


<script type="text/javascript">

  function ConfirmDelete(id)
  {
     var confirmation = confirm("Are you sure to delete record?");
     if(confirmation==true)
     {
        $.ajax({
          type:'POST',
          url:'<?php echo $this->request->webroot?>introduction/delete',
          data:'id='+id,
          success:function(responce)
          {
              if(responce==1)
              {
                  $("#deletesuccess").append("Record deleted!");
                  setTimeout(function () { location.reload(1); }, 1000);
              }
              else
              {
                  $("#deletesuccess").append("Record deleted!");
                  setTimeout(function () { location.reload(1); }, 1000);
              }
          }
        });
     }
  }

// Function for change the status Active/Inactive.
function ch_status(id)
{ 
   $.ajax({
	  type: 'POST',
	  url:'<?php echo $this->request->webroot?>introduction/chStatus',
	  data:'id='+id,
		  success: function (result) 
		  {
			  $("#status_"+id).html(result);
			  $(".q-notes").fadeIn();	
			  setTimeout(function(){ $(".q-notes").fadeOut(); },1000);
		  }
	  });
}
</script>
