<!-- src/Template/Cms/edit.ctp -->
<div class="users form">
<form action="<?php echo $this->request->webroot?>cms/update" method="post">    

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
    	       <?= $this->Form->text('id',array('type'=>'hidden','class'=>'control','value'=>$cms->id))?>
               <?= $this->Form->text('title',array('type'=>'text','class'=>'form-control','value'=>$cms->title,'required'=>'required','placeholder'=>'Title','id'=>'name','name'=>'name','id'=>'title','name'=>'title'))?>
            </div>
        </div>

        <div class="row">
    	    <div class="col-md-6">
            <label for="name">Name<span>*</span></label>
                <?= $this->Form->text('name',array('type'=>'text','class'=>'form-control','value'=>$cms->name,'required'=>'required','placeholder'=>'Name','id'=>'name','name'=>'name'))?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
            <label for="contents">Content</label>
                 <?= $this->form->text('contents', array('type'=>'textarea','rows'=>5, 'cols'=> 10,'class'=>'form-control','value'=>$cms->contents,'name'=>'contents','id'=>'editor1','placeholder'=>'Contents','required'=>'required')); ?>
                 <p>Note : ( * ) Fields are mandatory</p>
            </div>
        </div></br>

        <div class="row">
    	    <div class="col-md-6">   
              <?= $this->Form->button('Update',array('type'=>'submit','class'=>'btn-primary btn btln',onclick=>'return cmsvali();')); ?>
            </div>
        </div></br>      
</form>
</div>
