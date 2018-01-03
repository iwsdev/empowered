<!-- src/Template/contact/add.ctp -->
<div class="users form">
<?= $this->Form->create('quickguide',array('type'=>'file')) ?>
    <div class="row">
	    <div class="col-md-6">
	    	<h2>Add Quick Guide</h2>
		</div>
	</div>
    <?= $this->Flash->render()?>
    
    <div class="row">
	    <div class="col-md-6">
	    <label for="title">Title</label>
              <?= $this->Form->text('title',array('type'=>'text','class'=>'form-control','id'=>'title','name'=>'title','placeholder'=>'Title','required'=>'required')) ?>
        </div>
	</div>
	
	<div class="row">
	    <div class="col-md-6">
	    <label for="name">Name</label>
              <?= $this->Form->text('name',array('type'=>'text','class'=>'form-control','id'=>'name','name'=>'name','placeholder'=>'Name','required'=>'required')) ?>
        </div>
	</div>
	
	<div class="row">
	    <div class="col-md-6">
	    <label for="image">Image</label>
              <?= $this->Form->text('image',array('type'=>'file','name'=>'image','required'=>'required')) ?>
        </div>
	</div>

	<div class="row">
	    <div class="col-md-6">
	    <label for="description">Description</label>
             <?= $this->form->textarea('description', array('type'=>'textarea','rows'=>5, 'cols'=> 10,'class'=>'textarea','id'=>'editor1','name'=>'description','placeholder'=>'Description',"required"=>"required")); ?>
        </div>
	</div></br>

    <div class="row">
	    <div class="col-md-6">   
          <?= $this->Form->button('Submit',array('class'=>'btn-primary btn btln')); ?>
        </div>
    </div>
    </br>   
	     
<?= $this->Form->end() ?>
</div>
