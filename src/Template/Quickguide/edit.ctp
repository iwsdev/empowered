<!-- src/Template/Quickguide/edit.ctp -->
<div class="users form">
<form action="<?php echo $this->request->webroot?>quickguide/edit/<?= $guide->id?>" method="post" enctype="multipart/form-data">    

        <div class="row">
        <div class="col-md-6">
            <h2>Edit Information</h2>
        </div>
    </div>
        <?= $this->Flash->render() ?>
        <p id="error"></p>
        <div class="row">
    	    <div class="col-md-6">
            <label for="title">Title <span>*</span></label> 
    	       <?= $this->Form->text('id',array('type'=>'hidden','class'=>'control','value'=>$guide->id))?>
               <?= $this->Form->text('title',array('type'=>'text','class'=>'form-control','name'=>'title','id'=>'title','value'=>$guide->title,'required'=>'required','placeholder'=>'Title',))?>
            </div>
        </div>
        
        <div class="row">
    	    <div class="col-md-6">
            <label for="name">Name <span>*</span></label> 
               <?= $this->Form->text('name',array('type'=>'text','class'=>'form-control','name'=>'name','id'=>'name','value'=>$guide->name,'required'=>'required','placeholder'=>'Name',))?>
            </div>
        </div>
        
        <div class="row">
			<div class="col-md-6">
			<label for="image">Image <span>*</span></label>
				  <?= $this->Form->text('image',array('type'=>'file','name'=>'image')) ?>
				  <p>Note: Only jpg, jpeg, png extentions allowed </p>
			</div>
	    </div>

      
        <div class="row">
            <div class="col-md-6">
            <label for="description">Description</label>
                 <?= $this->form->text('Description',array('type'=>'textarea','rows'=>5,'cols'=>10,'class'=>'form-control','value'=>$guide->description,'name'=>'description','id'=>'editor1','placeholder'=>'Description','required'=>'required')); ?>
                 <p>Note : ( * ) Fields are mandatory</p>
            </div>
        </div></br>

        <div class="row">
    	    <div class="col-md-6">   
              <?= $this->Form->button('Update',array('type'=>'submit','class'=>'btn-primary btn btln',onclick=>'return editquickvali();'));?>
            </div>
        </div></br>      
</form>
</div>
