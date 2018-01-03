<!-- src/Template/Questionnaire/edit.ctp -->
<div class="users form">
<form action="<?php echo $this->request->webroot?>Questionnaire/edit/<?php echo $question['id'];?>" method='post'>    
        <div class="row">
        <div class="col-md-6">
            <h2>Edit Question</h2>
        </div>
    </div>
        <?= $this->Flash->render() ?>
        <p id="error"></p>
         <div class="row">
    	    <div class="col-md-6">
            <label for="question">Question</label> 
               <?= $this->Form->text('question',array('type'=>'text','class'=>'form-control','value'=>$question['question'],'required'=>'required','placeholder'=>'Question','id'=>'question','name'=>'question'))?>
            </div>
         </div>
        
        <!--======== FIRST PHASE ========--->
         <div class="row">
			<div class="col-md-6">
				<?php 
				foreach($importance as $importances) { 
				?>
				<label for="importance">Importance</label>
				     <?= $this->Form->text('i_id',array('type'=>'hidden','value'=>$importances['id'],'name'=>'i_id[]')) ?>
					 <?= $this->Form->text('importance',array('type'=>'text','value'=>$importances['importance_name'],'class'=>'form-control','id'=>'importances','name'=>'importances[]','placeholder'=>'Importance','required'=>'required')) ?>			
				<?php } ?>
			</div></br>
	     </div>
	   
	     <div class="row">
			<div class="col-md-6">
				<div id="TextBoxContainer">
					<!--Textboxes will be added here -->
				</div>
			</div>
	     </div>
	     
	     <!--======== SECOND PHASE ========--->
	     <div class="row">
			<div class="col-md-6">
				<?php 
				foreach($frequency as $frequencys) { 
				?>
				<label for="frequency">Frequency ( OPPORTUNITY TO PRACTICE ) </label>
				     <?= $this->Form->text('f_id',array('type'=>'hidden','value'=>$frequencys['id'],'name'=>'f_id[]')) ?>
					 <?= $this->Form->text('frequency',array('type'=>'text','class'=>'form-control','value'=>$frequencys['frequency_name'],'id'=>'frequencys','name'=>'frequencys[]','placeholder'=>'Frequency ( OPPORTUNITY TO PRACTICE )','required'=>'required')) ?>			
				<?php } ?>
			</div></br>
	     </div>
	
		<div class="row">
			<div class="col-md-6">
				<div id="TextBoxContainer2">
					<!--Textboxes will be added here -->
				</div>
			</div>
	    </div>
	    
	    <!--======== THIRD PHASE ========--->
	    <div class="row">
			<div class="col-md-6">
				<?php 
				foreach($capability as $capabilitys) { 
				?>
				<label for="capability">CAPABILITY IN CURRENT CONTEXT</label>
				     <?= $this->Form->text('c_id',array('type'=>'hidden','value'=>$capabilitys['id'],'name'=>'c_id[]')) ?>
					 <?= $this->Form->text('capability',array('type'=>'text','class'=>'form-control','value'=>$capabilitys['capability_name'],'id'=>'capabilitys','name'=>'capabilitys[]','placeholder'=>'CAPABILITY IN CURRENT CONTEXT','required'=>'required')) ?>	
				<?php } ?>
			</div></br>
	     </div>
	     <p>Note : ( * ) Fields are mandatory</p>
		<div class="row">
			<div class="col-md-6">
				<div id="TextBoxContainer3">
					<!--Textboxes will be added here -->
				</div>
			</div>
	    </div>
	 
        </br>
        <div class="row">
    	    <div class="col-md-6">   
              <?= $this->Form->button('Update',array('type'=>'submit','class'=>'btn-primary btn btln',onclick=>'return editquevali();')); ?>
            </div>
        </div> 
        </br>     
    </form>
  </div>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
	$(function () 
	{
		$("#btnAdd").bind("click", function () 
		{
			var div = $("<div/>");
			div.html(GetDynamicTextBox(""));
			$("#TextBoxContainer").append(div);
		});
		
		$("body").on("click", ".remove", function () 
		{
			$(this).closest("div").remove();
		});
	});
	
	function GetDynamicTextBox(value) 
	{
		return '<label for="question"> </label>'+'<input name="parajumble[]" class="form-control" type="text" value="" />&nbsp;' +
		'<input type="button" value="Remove" class="remove"/>'
	}
	
	
	$(function () 
	{
		$("#btnAdd2").bind("click", function () 
		{
			var div = $("<div/>");
			div.html(GetDynamicTextBox2(""));
			$("#TextBoxContainer2").append(div);
		});
		
		$("body").on("click", ".remove", function () 
		{
			$(this).closest("div").remove();
		});
	});
	
	function GetDynamicTextBox2(value) 
	{
		return '<label for="question"> </label>'+'<input name = "option[]" class="form-control" type="text" value="" />&nbsp;' +
		'<input type="button" value="Remove" class="remove"/>'
	}
	
	
	$(function () 
	{
		$("#btnAdd2").bind("click", function () 
		{
			var div = $("<div/>");
			div.html(GetDynamicTextBox2(""));
			$("#TextBoxContainer2").append(div);
		});
		
		$("body").on("click", ".remove", function () 
		{
			$(this).closest("div").remove();
		});
	});
	
	function GetDynamicTextBox3(value) 
	{
		return '<label for="question"> </label>'+'<input name = "option1[]" class="form-control" type="text" value="" />&nbsp;' +
		'<input type="button" value="Remove" class="remove"/>'
	}
	
</script>
