<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Reflection 
			<small>Management</small>
		</h1>
		<?= $this->Flash->render() ?>
		<ol class="breadcrumb">
			<li><a href=""><i class="fa fa-dashboard"></i> Reflection</a></li>
			<li class="active">Reflection</li>
		</ol>
	</section>
	
    <!-- Main content -->
    <section class="content">
		<div class="row">
            <div class="col-xs-12"> 
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Reflection List</h3><p id="abcd"></p>
						<!--div class="box-tools pull-right">
							<a href="<?php echo $this->Url->build('/quickguide/add');?>"><button class="btn btn-block btn-primary">Add New</button></a>
						</div-->
					</div>
                    <div id="deletesuccess" style="color:green;font-size:14px;text-align:center"></div>
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="5px">S.No</th>
									<th width="10px">Image</th>
									<th width="10px">Type</th>
									<th width="30px">User</th>
									<th width="10px">Title</th>
									<th width="10px">Date</th>
									<th width="20px">Description</th>
									<th width="5px">Status</th>
									<!--th width="12%">Action</th-->
								</tr>
							</thead>
							<tbody>
							    <?php
							        $i=0;
                                    foreach($ref as $reflection):
                                    $i++;
							    ?>
									<tr>
										<td><?php echo $i;?></td>
										<td><img src="<?php echo $this->request->webroot?>img/reflection/<?php echo $reflection['photo'];?>" style="height:100px !important; width:180px !important;"></td>
										<td><?php echo $reflection['type'];?></td>
										<td><?php echo $reflection['Users']['name'];?></td>
										<td><?php echo $reflection['title'];?></td>
										<td><?php echo $reflection['date'];?></td>
										<td><?php echo substr($reflection['description'],0,250);?></td>
										<td>
                                            <a href="javascript:;" onclick="ch_status('<?php echo $reflection['id'];?>');">
                                                <span id="status_<?php echo $reflection['id'];?>">
										            <?php 
										              if($reflection['status']==1)
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
										<!--td>
											<?php echo $this->Html->link('Edit',array('controller'=>'reflection','action'=>'edit',$reflection['id']),['class'=>'btn btn-success btn-xs']);?>

                                            <a href="javascript:;" onclick="ConfirmDelete('<?php echo $reflection['id'];?>');"class="btn btn-danger btn-xs">Delete
                                            </a>
										</td-->
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
          url:'<?php echo $this->request->webroot?>reflection/delete',
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
	  url:'<?php echo $this->request->webroot?>reflection/chStatus',
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
