<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build('/users/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $total_users;?></h3>
              <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo $this->Url->build('/users');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $total_cms;?></h3>
              <p>CMS</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-text"></i>
            </div>
            <a href="<?php echo $this->Url->build('/cms');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $total_motivational;?></h3>
              <p>Motivational</p>
            </div>
            <div class="icon">
              <i class="fa fa-film"></i>
            </div>
            <a href="<?php echo $this->Url->build('/motivational');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $total_questions;?></h3>
              <p>Questionnaire</p>
            </div>
            <div class="icon">
              <i class="fa fa-question-circle"></i>
            </div>
            <a href="<?php echo $this->Url->build('/questionnaire');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <!-- Small boxes (Stat box) -->
      <div class="row">
      
     <?php /* ?> 
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $total_introduction;?></h3>
              <p>Introduction</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-md"></i>
            </div>
            <a href="<?php echo $this->Url->build('/introduction');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <?php */ ?>
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-black">
            <div class="inner">
              <h3><?= $total_guide;?></h3>
              <p>Quick Guide</p>
            </div>
            <div class="icon">
              <i class="fa fa-glide"></i>
            </div>
            <a href="<?php echo $this->Url->build('/quickguide');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?= $total_reflection;?></h3>
              <p>Action/Reflection</p>
            </div>
            <div class="icon">
              <i class="fa fa-retweet"></i>
            </div>
            <a href="<?php echo $this->Url->build('/reflection');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        
       </div>  
    </section>
    <!-- /.content -->
<?php
$this->Html->css([
    '/plugins/iCheck/flat/blue',
    '/plugins/morris/morris',
    '/plugins/jvectormap/jquery-jvectormap-1.2.2',
    '/plugins/datepicker/datepicker3',
    '/plugins/daterangepicker/daterangepicker',
    '/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min'
  ],
  ['block' => 'css']);

$this->Html->script([
  'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
  'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',
  '/plugins/morris/morris.min',
  '/plugins/sparkline/jquery.sparkline.min',
  '/plugins/jvectormap/jquery-jvectormap-1.2.2.min',
  '/plugins/jvectormap/jquery-jvectormap-world-mill-en',
  '/plugins/knob/jquery.knob',
  'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js',
  '/plugins/daterangepicker/daterangepicker',
  '/plugins/datepicker/bootstrap-datepicker',
  '/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min',
  '/js/pages/dashboard',
],
['block' => 'script']);
?>

<?php $this->start('scriptBottom'); ?>
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
<?php  $this->end(); ?>
