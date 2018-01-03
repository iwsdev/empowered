<!-- src/Template/Users/add.ctp -->
<div class="users form">
<form action="<?php echo $this->request->webroot ?>users/profile/<?php echo $user['id']?>" method="post" enctype="multipart/form-data">

		<div class="row">
		    <div class="col-md-4">
		    	<h2>My Profile</h2>
			</div>
		</div>

        <?= $this->Flash->render() ?>
               
        <div class="row">
    	    <div class="col-md-4"> 
            <label for="name">Name<span>*</span></label>    	       
               <?= 
               $this->Form->text('name',array('type'=>'text','class'=>'form-control','value'=>$user['name'],'required'=>'required',placeholder=>"Name"))?>
            </div>
        </div>
        
        <div class="row">
    	    <div class="col-md-4">
            <label for="email">Email<span>*</span></label>
               <?= $this->Form->text('email',array('type'=>'email','class'=>'form-control','value'=>$user['email'],'required'=>'required',placeholder=>"Email"))?>
            </div>
        </div>

        <div class="row">
    	    <div class="col-md-4">
            <label for="mobile">Mobile<span>*</span></label>
             <?=$this->Form->text('mobile',array('type'=>'number','class'=>'form-control','value'=>$user['mobile'],'required'=>'required',placeholder=>"Mobile"))?>
            </div>
        </div>
        
        <div class="row">
			<div class="col-md-6">
			<label for="image">Image </label>
				  <?= $this->Form->text('image',array('type'=>'file','name'=>'image')) ?>
				  <p>Note: Only jpg, jpeg, png extentions allowed </p>
			</div>
	    </div>
	
        <br />
        <div class="row">
    	    <div class="col-md-4">   
              <?= $this->Form->button('Update',array('type'=>'submit','class'=>'btn-primary btn btln')); ?>
            </div>
        </div> 	
  </form>      
</div>
