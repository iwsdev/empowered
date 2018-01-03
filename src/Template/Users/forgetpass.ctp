<!-- File: src/Template/Users/forgetPass.ctp -->

<div class="Users form">

<?= $this->Flash->render() ?>
<?= $this->Form->create() ?>
    
    <legend><?= __('Please enter your email') ?></legend>
          <div class="row">
    	    <div class="col-md-12"> 
    	    <label for="email">Email <span>*</span></label>
	        	<?= $this->Form->text('email',array('type'=>'text','class'=>'form-control','required'=>'true','placeholder'=>'Enter username/email')) ?>
	    	</div>
	      </div></br>

          <div class="row">
		    <div class="col-md-12"> 
		        <?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary']); ?>
		    </div>     
         </div>
<?= $this->Form->end() ?>
</div>
