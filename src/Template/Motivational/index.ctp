<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Additional Tools 
			<small>Management</small>
		</h1>
		<?= $this->Flash->render() ?>
		<ol class="breadcrumb">
			<li><a href=""><i class="fa fa-dashboard"></i> Additional Tools</a></li>
			<li class="active">Additional Tools</li>
		</ol>
	</section>
	
    <!-- Main content -->
    <section class="content">
		<div class="row">
            <div class="col-xs-12"> 
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Additional Tools List</h3><p id="abcd"></p>
						<div class="box-tools pull-right">
							<a href="<?php echo $this->Url->build('/Motivational/add');?>"><button class="btn btn-block btn-primary">Add New</button></a>
						</div>
					</div>
                    <div id="deletesuccess" style="color:green;font-size:14px;text-align:center"></div>
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>S.No</th>
									<th>Category</th>
									<th>Title</th>
									<th>Video</th>
									<th>PPT</th>
									<th>Status</th>
									<th width="12%">Action</th>
								</tr>
							</thead>
							<tbody>
							    <?php
							        $i=0;
                                    foreach($motiv as $motivational):
                                    $i++;
							    ?>
									<tr>
										<td><?php echo $i;?></td>
										<td><?php echo $motivational['Category']['category_name'];?></td>
                                        <td><?php echo $motivational['title'];?></td>

                                        <?php if(isset($motivational['video']) && !empty($motivational['video'])){ ?>
										         <td><a href="<?php echo $this->request->webroot?>video/<?php echo $motivational['video'];?>" target="_blanl"><img src="<?php echo $this->request->webroot?>video/default/default-video.jpg" style="height:100px !important; width:100px !important;"></a></td>
                                        <?php }else{ ?>
                                                 <td><a href="javascript:;"><img src="<?php echo $this->request->webroot?>video/default/no-video.jpg" style="height:100px !important; width:100px !important;"></a></td>
                                        <?php } ?>
                                        
                                        <?php if(isset($motivational['ppt']) && !empty($motivational['ppt'])){ ?>
										         <td><a href="<?php echo $this->request->webroot?>ppt/<?php echo $motivational['ppt'];?>" target="_blanl"><img src="<?php echo $this->request->webroot?>ppt/default/ppt-default.png" style="height:100px !important; width:100px !important;"></a></td>
                                        <?php }else{ ?>
                                                 <td><a href="javascript:;"><img src="<?php echo $this->request->webroot?>ppt/default/no-ppt.png" style="height:100px !important; width:100px !important;"></a></td>
                                        <?php } ?>

										
										
										<td>
                                            <a href="javascript:;" onclick="ch_status('<?php echo $motivational['id'];?>');">
                                                <span id="status_<?php echo $motivational['id'];?>">
										            <?php 
										              if($motivational['status']==1)
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
											<?php echo $this->Html->link('Edit',array('controller'=>'Motivational','action'=>'edit',$motivational['id']),['class'=>'btn btn-success btn-xs']);?>

                                            <a href="javascript:;" onclick="ConfirmDelete('<?php echo $motivational['id'];?>');"class="btn btn-danger btn-xs">Delete
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
          url:'<?php echo $this->request->webroot?>Motivational/delete',
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
	  url:'<?php echo $this->request->webroot?>Motivational/chStatus',
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
