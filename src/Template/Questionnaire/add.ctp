<!-- src/Template/Questionnaire/add.ctp -->
<div class="users form">
<?= $this->Form->create('Question') ?>
    <div class="row">
	    <div class="col-md-6">
	    	<h2>Add Question</h2>
		</div>
	</div>
    <?= $this->Flash->render()?>
    <p id="error"></p>
    <div class="row">
	    <div class="col-md-6">
	    <label for="question">Question <span>*</span></label>
              <?= $this->Form->text('question',array('type'=>'text','class'=>'form-control','id'=>'question','name'=>'question','placeholder'=>'Question','required'=>'required')) ?>
        </div>
	</div>
	
	<!--======== FIRST PHASE ========--->
	<div class="row">
	    <div class="col-md-6 fm-row">
	        <label for="importance">Importance <span>*</span></label>
            <div class="fm-group">
				<?= $this->Form->text('importance',array('type'=>'text','class'=>'form-control','id'=>'importance','name'=>'importance[]','placeholder'=>'Importance','required'=>'required')) ?>            
				<input id="btnAdd" type="button" value="Add" class="btn-primary"/>
            </div>
        </div>

	</div>
	
	<div class="row">
	    <div class="col-md-6 fm-row">
	        <div id="TextBoxContainer" class="fm-group">
				<!--Textboxes will be added here -->
			</div>
        </div>
	</div>
	
	<!--======== SECOND PHASE ========--->
	<div class="row">
	    <div class="col-md-6 fm-row">
	        <label for="frequency">Frequency ( OPPORTUNITY TO PRACTICE ) <span>*</span></label>
            <div class="fm-group">
				<?= $this->Form->text('frequency',array('type'=>'text','class'=>'form-control','id'=>'frequency','name'=>'frequency[]','placeholder'=>'Frequency ( OPPORTUNITY TO PRACTICE )','required'=>'required')) ?>            
				<input id="btnAdd2" type="button" value="Add" class="btn-primary"/>
            </div>
        </div>
	</div>
	
	<div class="row">
	    <div class="col-md-6 fm-row">
	        <div id="TextBoxContainer2" class="fm-group">
				<!--Textboxes will be added here -->
			</div>
        </div>
	</div>
	
	<!--======== THIRD PHASE ========--->
	
	<div class="row">
	    <div class="col-md-6 fm-row">
	        <label for="capability">CAPABILITY IN CURRENT CONTEXT <span>*</span></label>
            <div class="fm-group">
				<?= $this->Form->text('capability',array('type'=>'text','class'=>'form-control','id'=>'capability','name'=>'capability[]','placeholder'=>'CAPABILITY IN CURRENT CONTEXT','required'=>'required')) ?>            
				<input id="btnAdd3" type="button" value="Add" class="btn-primary"/>
            </div>
        </div>
	</div>
	
	<div class="row">
	    <div class="col-md-6 fm-row">
	        <div id="TextBoxContainer3" class="fm-group">
				<!--Textboxes will be added here -->
			</div>
        </div>
	</div>

    <p>Note : ( * ) Fields are mandatory</p>
	</br>
    <div class="row">
	    <div class="col-md-6">   
          <?= $this->Form->button('Submit',array('class'=>'btn-primary btn btln',onclick=>'return quevali();')); ?>
        </div>
    </div></br>    
<?= $this->Form->end() ?>
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
		return '</br>'+'<label for="importance"> </label>'+'<input name="importance[]" class="form-control" type="text" value="" placeholder="Importance" required=required/>'+
		'<input type="button" value="Del" class="remove btn btn-danger btn-xs"/>'
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
		return '</br>'+'<label for="frequency"> </label>'+'<input name = "frequency[]" class="form-control" type="text" value="" placeholder="Frequency" required=required/>' +
		'<input type="button" value="Del" class="remove btn btn-danger btn-xs"/>'
	}
	
	
	$(function () 
	{
		$("#btnAdd3").bind("click", function () 
		{
			var div = $("<div/>");
			div.html(GetDynamicTextBox3(""));
			$("#TextBoxContainer3").append(div);
		});
		
		$("body").on("click", ".remove", function () 
		{
			$(this).closest("div").remove();
		});
	});
	
	function GetDynamicTextBox3(value) 
	{
		return '</br>'+'<label for="capability"> </label>'+'<input name = "capability[]" class="form-control" type="text" value="" placeholder="Capability" required=required/>' +
		'<input type="button" value="Del" class="remove btn btn-danger btn-xs"/>'
	}
	
</script>



