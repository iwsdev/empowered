<!-- File: src/Template/Users/login.ctp -->
<div class="users form">
<?= $this->Flash->render() ?>
<?= $this->Form->create() ?>

    <div class="row">
		<div class="col-md-12"> 
			<label for="firstname">Username <span>*</span></label>
			<?= $this->Form->text('username',array('type'=>'text','class'=>'form-control', 'placeholder'=>'Username', 'required')) ?>
		</div> 
     </div> 

    <div class="row"> 
		 <div class="col-md-12"> 
			<label for="firstname">Password<span>*</span></label>  
			<?= $this->Form->text('password',array('type'=>'password','class'=>'form-control', 'placeholder'=>'Password', 'required')) ?>
		</div>
		</div>
    </br> 

    <div class="row"> 
		<div class="col-md-12">  
		   <?= $this->Form->button('Login',array('type'=>'submit','class'=>'btn-primary btn btln')); ?>
		</div>
    </div>
    
<?= $this->Form->end() ?>
</div>
