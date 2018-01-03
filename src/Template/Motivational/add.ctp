<!-- src/Template/Motivational/add.ctp -->
<div class="users form">
<?= $this->Form->create('motivational',array('id'=>'motivational','enctype' => 'multipart/form-data')) ?>
    <div class="row">
	    <div class="col-md-6">
	    	<h2>Add Additional Tools</h2>
		</div>
	</div>
    <?= $this->Flash->render() ?>
    <p id="error"></p>
    
    <div class="row">
	    <div class="col-md-6">
	     <label for="type">Type<span>*</span></label>
	        <select class="form-control" name="type" id="type">
		        <option value="">Select type</option>
	            <option value="video">Video</option>
	            <option value="ppt">PPT</option>
            </select>
        </div>
	</div>
	
	<div class="row">
	    <div class="col-md-6">
	     <label for="category">Category <span>*</span></label>
	        <select class="form-control" name="cat_id" required="required">
		        <option value="">Select category</option>
		        <?php foreach($cat as $cats):?>
	                <option value="<?php echo $cats['id'];?>"><?php echo $cats['category_name'];?></option>
	            <?php endforeach;?>   
            </select>
        </div>
	</div>

    <div class="row">
	    <div class="col-md-6">
	    <label for="title">Title <span>*</span></label>
              <?= $this->Form->text('title',array('type'=>'text','class'=>'form-control', 'id'=>'title','name'=>'title','placeholder'=>'Title','required'=>'required' ))?>
        </div>
	</div>

	<div class="row" style="display: none" id="mediavideo">
	    <div class="col-md-6">
	    <label for="video">Video</label>
              <?= $this->Form->text('video',array('type'=>'file','name'=>'video','id'=>'video'))?>
              <p>Note: Only mp4, mkv, 3gp, flv extentions allowed</p>
        </div>
	</div>

	<div class="row" style="display: none" id="mediappt">
	    <div class="col-md-6">
	    <label for="ppt">PPT</label>
              <?= $this->Form->text('ppt',array('type'=>'file','name'=>'ppt','id'=>'ppt')) ?>
              <p>Note: Only pptx, ppt, pdf extentions allowed</p>
        </div>
	</div>

	
	<p>Note : ( * ) Fields are mandatory</p>
	</br>

    <div class="row">
	    <div class="col-md-6">   
          <?= $this->Form->button('Submit',array('class'=>'btn-primary btn btln',onclick=>'return motivali();')); ?>
        </div>
    </div>   
	</br>   
<?= $this->Form->end() ?>
</div>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>

$(function () 
{
	$("#type").change(function () 
	{
		
			if ($(this).val() == "video") 
			{
				$("#mediavideo").show();
				$("#mediappt").hide();
			}
			
			if ($(this).val() == "ppt") 
			{
				$("#mediappt").show();
				$("#mediavideo").hide();
			}
			
	});
});
</script>
