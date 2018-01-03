<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Questions 
			<small>Management</small>
		</h1>
		<?= $this->Flash->render() ?>
		<ol class="breadcrumb">
			<li><a href=""><i class="fa fa-dashboard"></i> Questions</a></li>
			<li class="active">Questions</li>
		</ol>
	</section>
	
    <!-- Main content -->
    <section class="content">
		<div class="row">
            <div class="col-xs-12"> 
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Question List</h3><p id="abcd"></p>
						<div class="box-tools pull-right">
							<a href="<?php echo $this->Url->build('/Questionnaire/add');?>"><button class="btn btn-block btn-primary">Add New</button></a>
						</div>
					</div>
                    <div id="deletesuccess" style="color:green;font-size:14px;text-align:center"></div>
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>S.No</th>
									<th>Questions</th>
									<th>Status</th>
									<th width="12%">Action</th>
								</tr>
							</thead>
							<tbody>
							    <?php
							        $i=0;
                                    foreach($question as $questions):
                                    $i++;
							    ?>
									<tr>
										<td><?php echo $i;?></td>
                                        <td><?php echo $questions['question'];?></td>
										<td>
                                            <a href="javascript:;" onclick="ch_status('<?php echo $questions['id'];?>');">
                                                <span id="status_<?php echo $questions['id'];?>">
										            <?php 
										              if($questions['status']==1)
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
											<?php echo $this->Html->link('Edit',array('controller'=>'Questionnaire','action'=>'edit',$questions['id']),['class'=>'btn btn-success btn-xs']);?>

                                            <a href="javascript:;" onclick="ConfirmDelete('<?php echo $questions['id'];?>');"class="btn btn-danger btn-xs">Delete
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
          url:'<?php echo $this->request->webroot?>Questionnaire/delete',
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
	  url:'<?php echo $this->request->webroot?>Questionnaire/chStatus',
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
