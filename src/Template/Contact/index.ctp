<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Contact Us 
			<small>Management</small>
		</h1>
		<?= $this->Flash->render() ?>
		<ol class="breadcrumb">
			<li><a href=""><i class="fa fa-dashboard"></i> Contact Us</a></li>
			<li class="active">Contact Us</li>
		</ol>
	</section>

    <!-- Main content -->
    <section class="content">
		<div class="row">
            <div class="col-xs-12"> 
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Contact List</h3><p id="abcd"></p>
					</div>
                    <div id="deletesuccess" style="color:green;font-size:14px;text-align:center"></div>
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>S.No</th>
									<th>Name</th>
									<th>Email</th>
									<th>Message</th>
								</tr>
							</thead>
							<tbody>
							    <?php
							        $i=0;
                                    foreach($contact as $contacts):
                                    $i++;
							    ?>
									<tr>
										<td><?php echo $i;?></td>
										<td><?php echo $contacts['name'];?></td>
										<td><?php echo $contacts['email'];?></td>
										<td><?php echo $contacts['message'];?></td>
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
