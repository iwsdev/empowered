<?php use Cake\Core\Configure; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo isset($theme['title']) ? $theme['title'] : 'Empowered | Achiever '; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <?php echo $this->Html->css('/bootstrap/css/bootstrap.min'); ?>
  <?php echo $this->Html->css('/css/datatable/jquery.dataTables.min'); ?>
  <?php echo $this->Html->css('/css/datatable/dataTables.bootstrap.min'); ?>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <?php echo $this->Html->css('AdminLTE.min'); ?>
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <?php echo $this->Html->css('skins/skin-'. Configure::read('Theme.skin') .'.min'); ?>

  <?php echo $this->fetch('css'); ?>
  
  <?php echo $this->Html->meta('icon', $this->Html->url('/favicon.ico')); ?>
 
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-<?php echo Configure::read('Theme.skin'); ?> layout-top-nav">
<div class="wrapper">
<?php
      $session_data =$this->request->session()->read('Auth.User');
      if(!empty($session_data))
      {
          $name = $session_data['name'];
      }
?>
  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo $this->Url->build('/users/dashboard'); ?>" class="navbar-brand">
            <img src="<?php echo $this->request->webroot?>img/logo/logo.png" style="margin-top:-13px;">
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="<?php if($this->request->params['controller']=='Users'){ echo "active";}?>"><a href="<?php echo $this->Url->build('/users');?>">Users<span class="sr-only">(current)</span></a></li>
            <li class="<?php if($this->request->params['controller']=='Cms'){ echo "active";}?>"><a href="<?php echo $this->Url->build('/cms')?>">CMS</a></li>
            <li class="<?php if($this->request->params['controller']=='Motivational'){ echo "active";}?>"><a href="<?php echo $this->Url->build('/motivational');?>">Additional Tools</a></li>
            <li class="<?php if($this->request->params['controller']=='Questionnaire'){ echo "active";}?>"><a href="<?php echo $this->Url->build('/questionnaire');?>">Questionnaire</a></li>
            
            <?php /*?>
            <li class="<?php if($this->request->params['controller']=='Introduction'){ echo "active";}?>"><a href="<?php echo $this->Url->build('/introduction');?>">Introduction</a></li>
            <?php */?>
            
            <li class="<?php if($this->request->params['controller']=='Quickguide'){ echo "active";}?>"><a href="<?php echo $this->Url->build('/quickguide');?>">Quick Guide</a></li>
            <li class="<?php if($this->request->params['controller']=='Reflection'){ echo "active";}?>"><a href="<?php echo $this->Url->build('/reflection');?>">Reflection/Action</a></li>
            <li class="<?php if($this->request->params['controller']=='Contact'){ echo "active";}?>"><a href="<?php echo $this->Url->build('/contact');?>">Contact Us</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?php echo $this->request->webroot?>img/logo/administration/<?php echo $session_data['image'];?>" class="user-image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo $name;?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->

                <li class="user-header">
                      <img src="<?php echo $this->request->webroot?>img/logo/administration/<?php echo $session_data['image'];?>" class="user-image">
                  <p>
                    <?php echo $name;?> - Developer
                  </p>
                </li>
         
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo $this->Url->build('/users/profile');?>" class="btn btn-default btn-flat">Profile</a>
                  </div>

                  <div class="pull-right" style="width:90px;">
                    <a href="<?php echo $this->Url->build('/users/logout');?>" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                  
                  <div class="pull-right" style="width:90px;">
                    <a href="<?php echo $this->Url->build('/users/password');?>" class="btn btn-default btn-flat">Password</a>
                  </div>
                  
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  
  <!-- Start Pnotify HTML Code -->
		<div class="q-notes">
			<div class="col-sm-2">
				<i class="fa fa-check-circle fa-3x"></i>
			</div>
			<div class="col-sm-10">
				<strong>Success!</strong><br>
				<span>Your request updated.</span>
			</div>
	   </div>
	   <!-- End Pnotify HTML Code -->
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <?php echo $this->fetch('content'); ?>
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->

  <?php echo $this->element('footer'); ?>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.2-->
<?php echo $this->Html->script('/plugins/jQuery/jquery-2.2.3.min'); ?>
<!-- Bootstrap 3.3.5 -->
<?php echo $this->Html->script('/bootstrap/js/bootstrap.min'); ?>
<?php echo $this->Html->script('/js/datatable/jquery.dataTables.min'); ?>
<?php echo $this->Html->script('/js/datatable/dataTables.bootstrap.min'); ?>
<!-- SlimScroll -->
<?php echo $this->Html->script('/plugins/slimScroll/jquery.slimscroll.min'); ?>
<!-- FastClick -->
<?php echo $this->Html->script('/plugins/fastclick/fastclick'); ?>
<!-- AdminLTE App -->
<?php echo $this->Html->script('/js/app.min'); ?>
<?php echo $this->Html->script('/js/custom'); ?>
<!-- AdminLTE for demo purposes -->
<?php echo $this->fetch('script'); ?>
<?php echo $this->fetch('scriptBottom'); ?>
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js"></script>
</body>
</html>
