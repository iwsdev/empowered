<!-- src/Template/Users/edit.ctp -->
<div class="users form">
<form action="<?php echo $this->request->webroot?>users/edit/<?php echo $user->id;?>" method="post">    

        <div class="row">
            <div class="col-md-6">
                <h2>Edit User Informations:</h2>
            </div>
        </div>
        <?= $this->Flash->render() ?>
        <p id="error"></p>
        <div class="row">
    	    <div class="col-md-6">
            <label for="name">Name <span>*</span></label> 
    	       <?= $this->Form->text('id',array('type'=>'hidden','class'=>'control','value'=>$user->id))?>
               <?= $this->Form->text('name',array('type'=>'text','class'=>'form-control','value'=>$user->name,'required'=>'required',placeholder=>"Enter name",'id'=>'name','name'=>'name'))?>
            </div>
        </div>

        <div class="row">
    	    <div class="col-md-6">
            <label for="email">Email <span>*</span></label>
               <?= $this->Form->text('email',array('type'=>'email','class'=>'form-control','value'=>$user->email,'readonly'=>'readonly','name'=>'email','id'=>'email'))?>
            </div>
        </div>

        <!--div class="row">
    	    <div class="col-md-6">
            <label for="mobile">Mobile <span>*</span></label>
             <?= $this->Form->text('mobile',array('type'=>'number','class'=>'form-control','value'=>$user->mobile,'required'=>'required',placeholder=>"Enter Mobile",'id'=>'mobile','name'=>'mobile'))?>
            </div>
        </div-->
        
        <div class="row">
    	    <div class="col-md-6">
            <label for="age">Age </label>
             <?= $this->Form->text('age',array('type'=>'number','class'=>'form-control','value'=>$user->age,placeholder=>"Enter Age",'id'=>'age','name'=>'age'))?>
            </div>
        </div>
        
        <div class="row">
    	    <div class="col-md-6">
            <label for="title">Title <span>*</span></label>
                <?= $this->Form->text('title',array('type'=>'text','class'=>'form-control','value'=>$user->title,'required'=>'required', placeholder=>"Enter title",'id'=>'title','name'=>'title'))?>
            </div>
        </div>
        
        <div class="row">
    	    <div class="col-md-6">
            <label for="company">Company <span>*</span></label>
                <?= $this->Form->text('company',array('type'=>'text','class'=>'form-control','value'=>$user->company,'required'=>'required', placeholder=>"Enter company",'id'=>'company','name'=>'company'))?>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
            <label for="country">Country <span>*</span></label>
                <select class="form-control" name="countrycode" required=>"required">
                    <option value="">Select Country</option>
                    <?php foreach($country as $countrys):?>
                        <option value="<?php echo $countrys['country_code'];?>" <?php if($countrys['country_code']==$user->countrycode){ echo 'selected';}?>><?php echo $countrys['country_name'];?></option>
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
                        <option value="<?php echo $sectors['name'];?>" <?php if($sectors['name']==$user->sector){ echo 'selected';}?>><?php echo $sectors['name'];?></option>
                    <?php endforeach;?>   
                </select>
            </div>
        </div>
        
        <div class="row">
    	    <div class="col-md-6">
            <label for="context">Context <span>*</span></label>
                <?= $this->Form->text('context',array('type'=>'text','class'=>'form-control','required'=>'required', placeholder=>"Enter context",'id'=>'context','name'=>'context','value'=>$user->context))?>
                <p>Note : ( * ) Fields are mandatory</p>
            </div>
        </div>
        
        <br>
        <div class="row">
    	    <div class="col-md-6">   
              <?= $this->Form->button('Update',array('type'=>'submit','class'=>'btn-primary btn btln',onclick=>'return uservali();')); ?>
            </div>
        </div>      
</form><br>
</div>
