<!-- src/Template/Users/add.ctp -->
<div class="users form">
<?= $this->Form->create($user) ?>
    <div class="row">
	    <div class="col-md-6">
	    	<h2>Add User</h2>
		</div>
	</div>
    <?= $this->Flash->render()?>
    <p id="error"></p>
    <div class="row">
	    <div class="col-md-6">
	    <label for="name">Name <span>*</span></label>
              <?= $this->Form->text('name',array('type'=>'text','class'=>'form-control','id'=>'name','name'=>'name','placeholder'=>'Name','required'=>'required')) ?>
        </div>
	</div>
	
	<div class="row">
	    <div class="col-md-6">
	    <label for="email">Email <span>*</span></label>
              <?= $this->Form->text('email',array('type'=>'email','class'=>'form-control', 'name'=>'email','id'=>'email','placeholder'=>'Email Id','onchange'=>'checkemail()' ,'required'=>'required')) ?>
              <div id="emailresult"></div>
        </div>
	</div>

	<!--div class="row">
	    <div class="col-md-6">
	    <label for="mobile">Mobile <span>*</span></label>
             <?= $this->Form->text('mobile',array('type'=>'number','class'=>'form-control', 'placeholder'=>'Mobile' ,'required'=>'required','id'=>'mobile','name'=>'mobile')) ?>
        </div>
	</div>

	<div class="row">
	    <div class="col-md-6">
	    <label for="password">Password <span>*</span></label>
             <?= $this->Form->text('password',array('type'=>'password','class'=>'form-control', 'placeholder'=>'Password' ,'required'=>'required','id'=>'password','name'=>'password')) ?>
        </div>
	</div--> 
	
	
	<div class="row">
    	    <div class="col-md-6">
            <label for="age">Age </label>
             <?= $this->Form->text('age',array('type'=>'text','class'=>'form-control',placeholder=>"Enter Age",'id'=>'age','name'=>'age'))?>
            </div>
        </div>
        
        <div class="row">
    	    <div class="col-md-6">
            <label for="title">Title <span>*</span></label>
                <?= $this->Form->text('title',array('type'=>'text','class'=>'form-control','required'=>'required', placeholder=>"Enter title",'id'=>'title','name'=>'title'))?>
            </div>
        </div>
        
        <div class="row">
    	    <div class="col-md-6">
            <label for="company">Company <span>*</span></label>
                <?= $this->Form->text('company',array('type'=>'text','class'=>'form-control','required'=>'required', placeholder=>"Enter company",'id'=>'company','name'=>'company'))?>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
            <label for="country">Country <span>*</span></label>
                <select class="form-control" name="countrycode" required=>"required">
                    <option value="">Select Country</option>
                    <?php foreach($country as $countrys):?>
                        <option value="<?php echo $countrys['country_code'];?>"><?php echo $countrys['country_name'];?></option>
                    <?php endforeach;?>   
                </select>
            </div>
        </div>
        
        <div class="row">
    	    <div class="col-md-6">
            <label for="sector">Sector <span>*</span></label>
                <select class="form-control" name="sector" required=>"required">
                    <option value="">Select Sector</option>
                    <?php foreach($sector as $sectors):?>
                        <option value="<?php echo $sectors['name'];?>"><?php echo $sectors['name'];?></option>
                    <?php endforeach;?>   
                </select>
            </div>
        </div>
        
        <div class="row">
    	    <div class="col-md-6">
            <label for="context">Context <span>*</span></label>
                <?= $this->Form->text('context',array('type'=>'text','class'=>'form-control','required'=>'required', placeholder=>"Enter context",'id'=>'context','name'=>'context'))?>
                <p>Note : ( * ) Fields are mandatory</p>
            </div>
        </div>
        
	</br> 

    <div class="row">
	    <div class="col-md-6">   
          <?= $this->Form->button('Submit',array('class'=>'btn-primary btn btln',onclick=>'return uservali();')); ?>
        </div>
    </div></br>   
	     
<?= $this->Form->end() ?>
</div>

<script type="text/javascript">

   function checkemail()
   {
	   var email = document.getElementById("email").value;
       
	   if(email)
	   {
		  $.ajax({
		  type: 'POST',
		  url:'<?php echo $this->request->webroot?>users/checkemail',
		  data:'email='+email,
			  success: function (data) 
			  {
			   
				   if(data == 0)	
				   {
				      $('#emailresult').css("color","green").html('User is available');
				      	
				   }
				   else
				   {
				      $('#emailresult').css("color","red").html('User not available!');
				   }
			  }
		  });
	 	}
	}
</script>
