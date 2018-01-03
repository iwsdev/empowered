<!-- src/Template/Users/add.ctp -->
<div class="users form">
<form action="<?php echo $this->request->webroot ?>users/password/<?php echo $user['id']?>" method="post" id="cngpass">

		<div class="row">
		    <div class="col-md-4">
		    	<h2>Change password</h2>
			</div>
		</div>

        <?= $this->Flash->render() ?>
               
        <div class="row">
    	    <div class="col-md-4"> 
            <label for="current">Current Password<span>*</span></label>    	       
               <?= 
               $this->Form->text('current',array('type'=>'password','class'=>'form-control',placeholder=>"Current password" ,'name'=>'current','id'=>'current','required'=>'required'))?>
               <p id="error1"></p>
            </div>
        </div>
        
        <div class="row">
    	    <div class="col-md-4"> 
            <label for="password"> New Password<span>*</span></label>    	       
               <?= 
               $this->Form->text('password',array('type'=>'password','class'=>'form-control','required'=>'required',placeholder=>"Password" ,'name'=>'password','id'=>'password'))?>
               <p id="error2"></p>
            </div>
        </div>
        
        <div class="row">
    	    <div class="col-md-4"> 
            <label for="confirmpassword">Confirm password<span>*</span></label>    	       
               <?= 
               $this->Form->text('name',array('type'=>'password','class'=>'form-control','required'=>'required',placeholder=>"Confirm password",'name'=>'confirmpass','id'=>'confirmpass'))?>
               <p id="error3"></p>
               <p>Note : ( * ) Fields are mandatory</p>
            </div>
        </div>
        
        <br />
        <div class="row">
    	    <div class="col-md-4">   
              <?= $this->Form->button('Submit',array('type'=>'submit','class'=>'btn-primary btn btln')); ?>
            </div>
        </div> 	
  </form>      
</div>
