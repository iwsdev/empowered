<!-- src/Template/Motivational/edit.ctp -->
<div class="users form">
<form action="<?php echo $this->request->webroot?>motivational/edit/<?= $motiv->id;?>" method="post" enctype="multipart/form-data">    
        <div class="row">
        <div class="col-md-6">
            <h2>Edit Additional Tools</h2>
        </div>
    </div>
        <?= $this->Flash->render() ?>
        <p id="error"></p>
        
        <div class="row">
	     <div class="col-md-6">
	     <label for="type">Type<span>*</span></label>
	        <?= $this->Form->text('type',array('type'=>'text','class'=>'form-control','value'=>$motiv->type,'name'=>'type','readonly'=>'readonly'))?>
         </div>
	    </div>
        
        <div class="row">
            <div class="col-md-6">
            <label for="category">Category <span>*</span></label>
                <select class="form-control" name="cat_id" required=>"required">
                    <option value="">Select category</option>
                    <?php foreach($cat as $cats):?>
                        <option value="<?php echo $cats['id'];?>" <?php if($cats['id']==$motiv->cat_id){ echo 'selected';}?>><?php echo $cats['category_name'];?></option>
                    <?php endforeach;?>   
                </select>
            </div>
        </div>

        <div class="row">
    	    <div class="col-md-6">
            <label for="title">Title <span>*</span></label> 
    	       <?= $this->Form->text('id',array('type'=>'hidden','class'=>'control','value'=>$motiv->id))?>
               <?= $this->Form->text('title',array('type'=>'text','class'=>'form-control','value'=>$motiv->title,'required'=>'required','placeholder'=>'Title','id'=>'title','name'=>'title'))?>
            </div>
        </div>
        
     <?php if(isset($motiv->video) && !empty($motiv->video)) { ?>
     
        <div class="row">
    	    <div class="col-md-6">
            <label for="video">Video</label>
                <?= $this->Form->text('video',array('type'=>'file'))?>
                <p>Only mp4, mkv, 3gp, flv extentions allowed</p>
            </div>
        </div>
        
      <?php } ?>
      
      <?php if(isset($motiv->ppt) && !empty($motiv->ppt)) { ?>  

        <div class="row">
            <div class="col-md-6">
            <label for="ppt">PPT</label>
                <?= $this->Form->text('ppt',array('type'=>'file'))?>
                <p>Only pptx, ppt, pdf extentions allowed</p>
            </div>
        </div>

      <?php } ?>

       
        <p>Note : ( * ) Fields are mandatory</p>
        </br>

        <div class="row">
    	    <div class="col-md-6">   
              <?= $this->Form->button('Update',array('type'=>'submit','class'=>'btn-primary btn btln',onclick=>'return motivali();')); ?>
            </div>
        </div> 
        </br>     
</form>
</div>
