//add data table
$(function () {
	$('#example1').DataTable()
    $('#userlist').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  });

//addCKeditor
$(function () {
  CKEDITOR.replace('editor1');
  //Initialize Select2 Elements
  $(".select2").select2();
  });


 function change_password() 
  {    
	  var current     = document.getElementById("current").value;
	  var password    = document.getElementById("password").value;	
	  var confirmpass = document.getElementById("confirmpass").value;    
	     
	  current      = current.trim();	
	  name         = name.trim(); 
	  confirmpass  = confirmpass.trim();  
	  
	  if(current=="")
	  {	  
		  document.getElementById("error1").innerHTML="Current password can not empty";	  
		  document.getElementById("error1").style.color="Red";	  
		  return false;  
	  }  
	  else if(password=="")
	  {	  
		  document.getElementById("error2").innerHTML="New Password can not empty";	  
		  document.getElementById("error2").style.color="Red";	  
		  return false;  
	  }
	  else if(confirmpass=="")
	  {	  
		  document.getElementById("error3").innerHTML="Confirm password can not empty";	  
		  document.getElementById("error3").style.color="Red";	  
		  return false;  
	  }  
	  else
	  {	  
		  document.getElementById("error").innerHTML=" ";  
	  }   
  }

  
  
  function cmsvali() 
  {    
	  var title = document.getElementById("title").value;	
	  var name = document.getElementById("name").value;    
	     
	  title = title.trim();	
	  name  = name.trim();  
	  
	  if(title=="")
	  {	  
		  document.getElementById("error").innerHTML="Title can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  }  
	  else if(name=="")
	  {	  
		  document.getElementById("error").innerHTML="Name can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  }  
	  else
	  {	  
		  document.getElementById("error").innerHTML=" ";  
	  }   
  }
  
  function cmsvali() 
  {    
	  var title = document.getElementById("title").value;	
	  var name = document.getElementById("name").value;    
	     
	  title = title.trim();	
	  name  = name.trim();  
	  
	  if(title=="")
	  {	  
		  document.getElementById("error").innerHTML="Title can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  }  
	  else if(name=="")
	  {	  
		  document.getElementById("error").innerHTML="Name can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  }  
	  else
	  {	  
		  document.getElementById("error").innerHTML=" ";  
	  }   
  }

  
  function uservali() 
  {    
	  var name    = document.getElementById("name").value;	
	  var email   = document.getElementById("email").value;	
	  var title   = document.getElementById("title").value;	
	  var company = document.getElementById("company").value; 
	     
	  name      = name.trim();	
	  email     = email.trim();	
	  title     = title.trim();	
	  company   = company.trim(); 
	  
	  if(name=="")
	  {	  
		  document.getElementById("error").innerHTML="Name can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  }  
	  else if(email=="")
	  {	  
		  document.getElementById("error").innerHTML="Email can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  } 
	  else if(title=="")
	  {	  
		  document.getElementById("error").innerHTML="Title bbbb can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  } 
	  else if(company=="")
	  {	  
		  document.getElementById("error").innerHTML="Company can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  } 
	  else
	  {	  
		  document.getElementById("error").innerHTML=" ";  
	  }   
  }
  
  
  function motivali() 
  {    
	  var title = document.getElementById("title").value;	 
	  title = title.trim();	
	  if(title=="")
	  {	  
		  document.getElementById("error").innerHTML="Title can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  }  
	  else
	  {	  
		  document.getElementById("error").innerHTML=" ";  
	  }   
  }
  
  
  function quevali() 
  {    
	  var question   = document.getElementById("question").value;
	  var importance = document.getElementById("importance").value;
	  var frequency  = document.getElementById("frequency").value;
	  var capability = document.getElementById("capability").value;
	  	 
	  question   = question.trim();
	  importance = importance.trim();
	  frequency  = frequency.trim();
	  capability = capability.trim();	
	  
	  if(question=="")
	  {	  
		  document.getElementById("error").innerHTML="Question can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  } 
	  else if(importance=="")
	  {	  
		  document.getElementById("error").innerHTML="Importance can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  }
	  else if(frequency=="")
	  {	  
		  document.getElementById("error").innerHTML="Frequency can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  } 
	  else if(capability=="")
	  {	  
		  document.getElementById("error").innerHTML="Capability can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  }  
	  else
	  {	  
		  document.getElementById("error").innerHTML=" ";  
	  }   
  }
  
  
  function editquevali() 
  {    
	  var question   = document.getElementById("question").value;
	  var importances = document.getElementById("importances").value;
	  var frequencys  = document.getElementById("frequencys").value;
	  var capabilitys = document.getElementById("capabilitys").value;
	  	 
	  question   = question.trim();
	  importances = importances.trim();
	  frequencys  = frequencys.trim();
	  capabilitys = capabilitys.trim();	
	  
	  if(question=="")
	  {	  
		  document.getElementById("error").innerHTML="Question can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  } 
	  else if(importances=="")
	  {	  
		  document.getElementById("error").innerHTML="Importance can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  }
	  else if(frequencys=="")
	  {	  
		  document.getElementById("error").innerHTML="Frequency can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  } 
	  else if(capabilitys=="")
	  {	  
		  document.getElementById("error").innerHTML="Capability can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  }  
	  else
	  {	  
		  document.getElementById("error").innerHTML=" ";  
	  }   
  }
  
  
  function introvali() 
  {    
	  var title   = document.getElementById("title").value;
	  var name = document.getElementById("name").value;
	  	 
	  title   = title.trim();
	  name = name.trim();
	  	
	  
	  if(title=="")
	  {	  
		  document.getElementById("error").innerHTML="Title can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  }  
	  else if(name=="")
	  {	  
		  document.getElementById("error").innerHTML="Name can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  }
	  else
	  {	  
		  document.getElementById("error").innerHTML=" ";  
	  }    
  }
  
  
  function editintrovali() 
  {    
	  var title = document.getElementById("title").value;
	  var name  = document.getElementById("name").value;
	  	 
	  title = title.trim();
	  name  = name.trim();
	  
	  if(title=="")
	  {	  
		  document.getElementById("error").innerHTML="Title can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  }  
	  if(name=="")
	  {	  
		  document.getElementById("error").innerHTML="Name can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  }
	  else
	  {	  
		  document.getElementById("error").innerHTML=" ";  
	  }    
  }
  
  
  function quickvali() 
  {    
	  var title   = document.getElementById("title").value;
	  var name = document.getElementById("name").value;
	  	 
	  title   = title.trim();
	  name = name.trim();
	  	
	  
	  if(title=="")
	  {	  
		  document.getElementById("error").innerHTML="Title can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  }  
	  else if(name=="")
	  {	  
		  document.getElementById("error").innerHTML="Name can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  }
	  else
	  {	  
		  document.getElementById("error").innerHTML=" ";  
	  }    
  }
  
  
  function editquickvali() 
  {    
	  var title = document.getElementById("title").value;
	  var name  = document.getElementById("name").value;
	  	 
	  title = title.trim();
	  name  = name.trim();
	  
	  if(title=="")
	  {	  
		  document.getElementById("error").innerHTML="Title can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  }  
	  if(name=="")
	  {	  
		  document.getElementById("error").innerHTML="Name can not empty";	  
		  document.getElementById("error").style.color="Red";	  
		  return false;  
	  }
	  else
	  {	  
		  document.getElementById("error").innerHTML=" ";  
	  }    
  }
  

  
