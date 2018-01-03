<?php
namespace App\Controller\api;
require __DIR__ . '/dompdf/autoload.inc.php';
use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Dompdf\Dompdf;

class WebservicesController extends AppController
{
	
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['signup','login','introduction','reflection','quickguide','cmslist','motivational','categorylist','forgetpass','questionnaire','countrylist','contact','updateprofile','setpassword','sectorlist','add_reflection','get_reflection','adduser_ans','userans_list','empowered_achiver','report','report_download']);
        $this->loadModel('Users');
        $this->loadModel('Category');
        $this->loadModel('Cms'); 
        $this->loadModel('Motivational');
        $this->loadModel('Introduction');
        $this->loadModel('Questions');
        $this->loadModel('Importance');     
        $this->loadModel('Frequency');     
        $this->loadModel('Capability');
        $this->loadModel('Quickguide');     
        $this->loadModel('Reflection');     
        $this->loadModel('Answer');
        $this->loadModel('Apps_countries');
        $this->loadModel('Contact');
        $this->loadModel('Sector');
        $this->loadModel('User_ques_ans');
     }
    
    // ============= EMPOWERED ACHIVER =======================
    public function empowered_achiver()
    {
	     if(!empty($this->request->data['userid'] && $this->request->data['empowered_achiver']))
	     {
			 $user = $this->Users->get($this->request->data['userid']);
			
			 $user['empowered_achiver'] = $this->request->data['empowered_achiver'];
			 if($this->Users->save($user))
			 {
					$this->set([
						 'status'=>'True',
						 'message'=>'Information changed successfully.',
						 '_serialize'=>['status','message']
				   ]);
			 }
			 else
			 {
				   $this->set([
						 'status'=>'False',
						 'message'=>'Sorry! something went wrong, please try again.',
						 '_serialize'=>['status','message']
				   ]);
			 }
		 }	
		 else
		 {
			   $this->set([
			         'status'=>'False',
			         'message'=>'Please enter valid data',
			         '_serialize'=>['status','message']
			   ]);
		 }
	}
	
    
    // ============= API for ADD USER ANS List================
    public function userans_list()
    {
		if(!empty($this->request->data['userid']))
		{
			$element = $this->User_ques_ans->find('all',array('conditions'=>array('User_ques_ans.userid'=>$this->request->data['userid'])));
			$counter = $element->count();
			
			if($counter)
			{
				$this->set([
		           'status'=>'True',
		           'data'=>$element,
		           '_serialize'=> ['status','data']
		        ]);
			}
			else
			{
				$this->set([
		           'status'=>'False',
		           'message'=>'Sorry!, no record found.',
		           '_serialize'=> ['status','message']
		        ]);
			}  
		}
		else
		{
		    $this->set([
		           'status'=>'False',
		           'message'=>'Please enter valid data',
		           '_serialize'=> ['status','message']
		    ]);	
		}
	}
    
    
    // ============= API for ADD USER ANS ================
    public function adduser_ans()
    {
		if(!empty($this->request->data['userid'] && $this->request->data['question_id']  && $this->request->data['imp_ans_id']  && $this->request->data['fre_ans_id'] && $this->request->data['cap_ans_id']))
		{
			
		     $ckk = $this->User_ques_ans->find('all',array('conditions'=>array('User_ques_ans.userid'=>$this->request->data['userid'],'AND'=>array('User_ques_ans.question_id'=>$this->request->data['question_id']))))->first();
		     
		     if($ckk)
		     {
				 $this->set([
		              'status'=>'True',
		              'message'=>'You already give answer for this question',
		              '_serialize'=> ['status','message']
		         ]);
			 }
			 else
			 {
				    $element = $this->User_ques_ans->newEntity();
					$element = $this->User_ques_ans->patchEntity($element, $this->request->data);
					
					$element['userid']                 = $this->request->data['userid'];
					$element['question_id']            = $this->request->data['question_id'];
					$element['imp_ans_id']             = $this->request->data['imp_ans_id'];
					$element['frequency_and_id']       = $this->request->data['fre_ans_id'];
					$element['capability_ans_id']      = $this->request->data['cap_ans_id'];
					
					  if ($this->User_ques_ans->save($element)) 
						{
								 $this->set([
									  'status' => "True",
									  'message'=>"Record added successfully.",
									  '_serialize' => ['status','message']
								 ]);
						}
						else
						{
								$this->set([
								  'status' => "False",
								  'message'=>"Sorry, something went wrong there. Try again.",
								  '_serialize' => ['status','message']
								]);
						} 
			 }
		}
		else
		{
		    $this->set([
		           'status'=>'False',
		           'message'=>'Please enter valid data',
		           '_serialize'=> ['status','message']
		    ]);	
		}
	}
		
		   
     // ============== function for GET reflection using USER ID ================
    public function reflection()
    {
          if ($this->request->is('post')) 
           {
			 
              $userid = $this->request->data['userid'];
              $type   = $this->request->data['type'];
              $base_url = "http://".$_SERVER['SERVER_NAME'];
              if(!empty($userid && $type)) 
              {  
                 $result = $this->Reflection->find('all',['conditions'=>['Reflection.user_id' => $userid, 'AND'=>array('Reflection.type' => $type,'status'=>1)]]);
                 $number = $result->count(); 
			     if(!empty($number))
			     { 
						
					   $this->set([
						  'status' => 'Success',
						  'reflection'=>$result, 
						  'imgpath'=>$base_url."".$this->request->webroot."img/reflection/",
						  '_serialize' => ['status','imgpath','reflection']
					   ]);
				 }
				 else
				 {
					$this->set([
					'status'=>'Failed',
					'message' => 'No record found!',
					'_serialize' => ['status','message']
					]);
				 } 
			  }
			  else
			  {
					$this->set([
					'status'=>'Failed',
					'message' => 'Please enter valid data',
					'_serialize' => ['status','message']
					]);
			  }            
           }
    }

     
     
    // ============== function for Add Reflection ================
    public function add_reflection()
     {
         if(!empty($this->request->data['type'] && $this->request->data['user_id'] && $this->request->data['title'] && $this->request->data['photo'] && $this->request->data['date'] && $this->request->data['description'] && $this->request->data['status']))
         {
			   
			   $reflection = $this->Reflection->newEntity();
			   $reflection = $this->Reflection->patchEntity($reflection, $this->request->data);
			   
			   if(!empty($this->request->data['photo'])){            
				   $time = time();            
				   $filename = $time.'image.png';            
				   $directorypath  ="img/reflection/";             
				   $upload_dir = WWW_ROOT . str_replace("/", DS, $directorypath) . $filename;            
				   $img = $this->request->data['photo']; // Your data 'data:image/png;base64,AAAFBfj42Pj4';             
				   $img = str_replace('data:image/png;base64,', '', $img);            
				   $img = str_replace(' ', '+', $img);            
				   $data = base64_decode($img);            
				   file_put_contents($upload_dir, $data); 
				   $reflection['photo'] = $filename;           				   
				}   			   
			   
			   if ($this->Reflection->save($reflection)) 
				{
				  $this->set([
					  'status' => "Success",
					  'message'=>"Record added successfully.",
					  '_serialize' => ['status','message']
				 ]);
				}
				else
				{
					$this->set([
					  'status' => "False",
					  'message'=>"Sorry, something went wrong there. Try again.",
					  '_serialize' => ['status','message']
				    ]);
				}
		  }
		  else
		  {
			   $this->set([
				'status' => 'Failed',
				'message' => 'Please enter valid data',
				'_serialize' => ['status','message']
			   ]);
		  }
	}
     
     
     
       // ============== function for Sector List ================
	   public function sectorlist()
	   {
		 $sector = $this->Sector->find('all')->where(['status'=>1])->toArray();
         if(!empty($sector) )
         {		 
			$this->set([
				'status'=>'Success',
				'sector' => $sector,
				'_serialize' => ['status','sector']
			]);
		 }
		 else
		 {
			$this->set([
				'status'=>'Failed',
				'message' => 'Sector not found',
				'_serialize' => ['status','message']
			]);
		 }
	   } 
     
    // ============== function for Update password ================
    public function setpassword()
    {
	  if (!empty($this->request->data['userid'] && $this->request->data['password'] && $this->request->data['setpassword'])) 
	   {
		  $userid    =$this->request->data['userid'];
		  $password =$this->request->data['password'];

			 $set_password                = $this->Users->get($userid); 
			 $set_password['password']    = $this->request->data['password'];
			 $set_password['setpassword'] = $this->request->data['setpassword'];
			 
			 if ($this->Users->save($set_password)) 
			 {
				   $this->set([
					  'status' => 'Success',
					  'message'=>'Password updated successfully',
					  '_serialize' => ['status','message']
				   ]);
			 }
			 else
			 {
				 $this->set([
					'status' => 'Failed',
					'message' => 'User id not exist!',
					'_serialize' => ['status','message']
				   ]); 
			 }

		  }
		  else{
				$this->set([
				'status'=>'Failed',
				'message' => 'Please enter valid data',
				'_serialize' => ['status','message']
				]);
		  }            
    }


    // ============== function for register new user ================
    public function signup()
     {
         if(!empty(
         
              $this->request->data['email'] && 
              $this->request->data['name'] && 
              $this->request->data['title'] &&
              $this->request->data['company'] &&
              $this->request->data['countrycode'] &&
              $this->request->data['sector'] &&
              $this->request->data['context']
            
            ))
         {
			 $result = $this->Users->find('all',['conditions' => ['Users.email' => $this->request->data['email']]]);          
			  $number = $result->count();
			  if(empty($number))
				{
				   /*generate password*/
				   $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";	            
				   $pass = array(); //remember to declare $pass as an blank array	            
				   $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache	
				   for ($i = 0; $i < 12; $i++) 
				   {	                
					  $n = rand(0, $alphaLength);	                
					  $pass[] = $alphabet[$n];	            
				   }
			       $pass=implode($pass);
			       
			       $this->request->data['password']= $pass;
				   $this->request->data['username']= $this->request->data['email'];
				   $name     = $this->request->data['name'];
			       $username = $this->request->data['username']; 
				                 
				   $this->request->data['status']=1; 
				   $this->request->data['user_tpye']=2;
				   $user = $this->Users->newEntity();
				   $user = $this->Users->patchEntity($user, $this->request->data);
				   
				   if ($this->Users->save($user)) 
					{
						
					 // ============****************************** START EMAIL CODE **************************==============// 
					   $message='  
						<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
						<html xmlns="http://www.w3.org/1999/xhtml">
						<head>
						<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
						<title>Welcome to Empowered</title>
						<style type="text/css">
						@charset "utf-8";
						#footerDiv{
						}
						.dataDiv{
						}
						</style>
						</head>
						<body>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td style="padding:40px 0px 40px 0px;background-color:#f4f4f4;">
						  <table width="702" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#FFFFFF">
						  <tr> 
							<td width="700" bgcolor="#f4f4f4">
							  <table width="700" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#FFF">
							  <tr>
								<td width="100%" align="center" bgcolor="rgb(249,219,149)" style="padding:0 0px 0 0px;" colspan="3">
									<h2 style="color:rgb(255,255,255);">Greetings : Welcome to Empowered</h2>
								</td>
							  </tr>
							  <tr> 
										<td width="1" bgcolor="#dadada"></td> 
										<td width="697" align="center">
											<table width="696" cellspacing="0" cellpadding="1" border="0" bgcolor="#FFFFFF">
												<tr> <td> 
												<div class="dataDiv" style="color:#666666;font-family:Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif;font-size:12.5px;line-height:1.75em;padding:0 60px;">
												<br>
													Dear '.$name.',
													<br>Welcome to Empowered! Thanks so much for joining us.';
												
													$message .= '<br><br>Below is your login details: <br>
													<strong>Name :</strong>  '.$name.' <br>
													<strong>Username :</strong>  '.$username.' <br>
													<strong>Password :</strong>  '.$pass.' <br>
													<br>							
												    <br><br>
												If you have any query. Please contact us at any time.<br>
												<strong>Email ID :</strong>  info@empowered.com <br>
												<strong>Mobile No :</strong>  +91 123 456 6789,
												<br><br>
												With Best Regards, <br>
												Empowered Team <br><br>
												</div> 
												</td> </tr>
											</table>
										</td>
										<td width="1" bgcolor="#dadada"></td> 
									</tr> 
							  </table>
							</td>
						   </tr>
						   <td style="font-family:Arial,Helvetica,sans-serif;font-size:16px;color:#fff;border:1px solid #d1d1d1;text-align:center" width="100%" valign="top">
								<table style="background:#eee;border-bottom:1px solid #d1d1d1" width="100%" cellspacing="0" cellpadding="0" border="0">
							  <tbody><tr>
								<td style="width:100%;font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#2e3192;text-align:center;padding:7px 5px 7px 5px;background:rgb(255,204,0);font-weight:bold">Happy to Help</td>
							  </tr>
							</tbody></table>
								<table width="100%" cellspacing="0" cellpadding="0" border="0">
							  <tbody><tr>
								<td style="width:50%;font-family:Arial,Helvetica,sans-serif;font-size:13px;line-height:18px;color:#000;padding:5px;text-align:center;border-right:1px solid #d1d1d1" width="50%"><b>Email:</b>
								  <a href="mailto:info@empowered.com" style="color:#444" target="_blank">info@empowered.com</a><br>
								<b>Call Us:</b> <span style="color:#444"><a style="color:#444">+91 91 123 456 6789 </a></span></td>
								 </tr>
							</tbody></table>    
							</td>
						  </table>
							
						  <table width="700" border="0" cellpadding="0" cellspacing="0" bgcolor="#68686a" style="height:10px;line-height:10px;font-size:10px;" align="center">
							<tr> 	
							<td align="center" valign="top" style="height:10px;line-height:10px;font-size:10px;padding:0px 0 0px 0;">
								<div id="footerDiv" style="font-family:Lucida Grande,Arial,Helvetica,Geneva,Verdana,sans-serif;color:#FFFFFF;font-size:12px;line-height:1em;text-align:center;padding:8px 10px 12px 10px;">
									Copyright &copy; <a href="'.$site_path.'" style="text-decoration:none; color:#fff;"> Empowered</a> '.date('Y').' All rights reserved. </div>
							</td>
							</tr>
							</table>  
						  </td>
						</tr>
						</table>
						</body>
						</html>';		
										  
					  $email = new Email('default');			
					  $email->emailFormat('html')->from(['admin@empowered.com' => 'Empowered'])->to($this->request->data['email'])
					  ->subject('Congratulations ! Successfull Registration')->send($message);            
					  
                 // ============****************************** End EMAIL CODE **************************==============// 
						

					  $this->set([
						  'status' => "Success",
						  'message'=> "You are successfully register",
						  '_serialize'=> ['status','message']
					 ]);
					}
					else
					{
						 $this->set([
						   'status' => 'Failed',
						   'message'=> "Your are not register",
						   '_serialize' => ['status','message']
					 ]);
					}
				}
				else
				{
					$this->set([
						'status' => 'Failed',
						'message' => 'Your email id allready exits',
						'_serialize' => ['status','message']
					   ]);
				}           
		  }
		  else
		  {
			   $this->set([
				'status' => 'Failed',
				'message' => 'Please enter valid data',
				'_serialize' => ['status','message']
			   ]);
		  }
	}
	
	
	public function updateprofile()
	{
	    if(!empty($this->request->data['id'] && $this->request->data['name'] && $this->request->data['title'] && $this->request->data['company'] && $this->request->data['countrycode'] && $this->request->data['sector'] && $this->request->data['context']))
	    {
			$base_url = "http://".$_SERVER['SERVER_NAME'];
			$userid               = $this->request->data['id'];
			$profile              = $this->Users->get($userid); 
			$profile['name']      = $this->request->data['name'];
			$profile['age']       = $this->request->data['age'];
			$profile['title']     = $this->request->data['title'];
			$profile['company']   = $this->request->data['company'];
			$profile['countrycode']= $this->request->data['countrycode'];
			$profile['sector']    = $this->request->data['sector'];
			$profile['context']   = $this->request->data['context'];
			
			
			if(!empty($this->request->data['image'])){            
			   $time = time();            
			   $filename = $time.'image.png';            
			   $directorypath  ="img/user/";             
			   $upload_dir = WWW_ROOT . str_replace("/", DS, $directorypath) . $filename;            
			   $img = $this->request->data['image']; // Your data 'data:image/png;base64,AAAFBfj42Pj4';             
			   $img = str_replace('data:image/png;base64,', '', $img);            
			   $img = str_replace(' ', '+', $img);            
			   $data = base64_decode($img);            
			   file_put_contents($upload_dir, $data); 
			   $profile['image'] = $filename;           				   
			}
			
			   if ($this->Users->save($profile)) 
				{
					   $this->set([
						  'status' => 'Success',
						  'data'=>$profile,
						  'imgpath'=>$base_url.$this->request->webroot."img/user/",
						  '_serialize' => ['status','data','imgpath']
					  ]);
				}
				else
				{
					   $this->set([
					   'status' => 'Failed',
					   'message'=> 'Your are not register',
					   '_serialize' => ['status','message']
					 ]);
				}
		}
		else
		{
			$this->set([
			'status' => 'Failed',
			'message' => 'Please enter valid data',
			'_serialize' => ['status','message']
		    ]);
		}	
    }
	
	// API for contact us
	public function contact()
	{
		
		if(!empty($this->request->data['name'] && $this->request->data['email'] && $this->request->data['message']))
		{
					$name  = $this->request->data['name'];
					$email = $this->request->data['email'];
					$msg   = $this->request->data['message'];
					
					$contact=$this->Contact->newEntity();
					$contact = $this->Contact->patchEntity($contact, $this->request->data);
					
					$admin = $this->Users->find('all',array('conditions'=>array('Users.user_tpye'=>1)))->first();
					$toemail = $admin->email;
					
					
					if($toemail)
					 {
						 $message2='  
							<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
							<html xmlns="http://www.w3.org/1999/xhtml">
							<head>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
							<title>Welcome to Empowered</title>
							<style type="text/css">
							@charset "utf-8";
							#footerDiv{
							}
							.dataDiv{
							}
							</style>
							</head>
							<body>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td style="padding:40px 0px 40px 0px;background-color:#f4f4f4;">
							  <table width="702" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#FFFFFF">
							  <tr> 
								<td width="700" bgcolor="#f4f4f4">
								  <table width="700" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#FFF">
								  <tr>
									<td width="100%" align="center" bgcolor="rgb(249,219,149)" style="padding:0 0px 0 0px;" colspan="3">
										<h2 style="color:rgb(255,255,255);">New Message</h2>
									</td>
								  </tr>
								  <tr> 
											<td width="1" bgcolor="#dadada"></td> 
											<td width="697" align="center">
												<table width="696" cellspacing="0" cellpadding="1" border="0" bgcolor="#FFFFFF">
													<tr> <td> 
													<div class="dataDiv" style="color:#666666;font-family:Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif;font-size:12.5px;line-height:1.75em;padding:0 60px;">
													<br>
														Dear admin,';
														$message2 .= '<br><br>Below is visitor details: <br>
														<strong>Name :</strong>  '.$name.' <br>
														<strong>Email :</strong>  '.$email.' <br>
														<strong>msg :</strong>  '.$msg.' <br>
														<br>
													If you have any query. Please contact us at any time.<br>
													<strong>Email ID :</strong>  info@empowered.com <br>
													<strong>Mobile No :</strong>  +91 123 456 789,
													<br><br>
													With Best Regards, <br>
													Empowered Team <br><br>
													</div> 
													</td> </tr>
												</table>
											</td>
											<td width="1" bgcolor="#dadada"></td> 
										</tr> 
								  </table>
								</td>
							   </tr>
							   <td style="font-family:Arial,Helvetica,sans-serif;font-size:16px;color:#fff;border:1px solid #d1d1d1;text-align:center" width="100%" valign="top">
									<table style="background:#eee;border-bottom:1px solid #d1d1d1" width="100%" cellspacing="0" cellpadding="0" border="0">
								  <tbody><tr>
									<td style="width:100%;font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#2e3192;text-align:center;padding:7px 5px 7px 5px;background:rgb(255,204,0);font-weight:bold">Happy to Help</td>
								  </tr>
								</tbody></table>
									<table width="100%" cellspacing="0" cellpadding="0" border="0">
								  <tbody><tr>
									<td style="width:50%;font-family:Arial,Helvetica,sans-serif;font-size:13px;line-height:18px;color:#000;padding:5px;text-align:center;border-right:1px solid #d1d1d1" width="50%"><b>Email:</b>
									  <a href="mailto:info@empowered.com" style="color:#444" target="_blank">info@empowered.com</a><br>
									<b>Call Us:</b> <span style="color:#444"><a style="color:#444">+91 123 456 789 </a></span></td>
									 </tr>
								</tbody></table>    
								</td>
							  </table>
								
							  <table width="700" border="0" cellpadding="0" cellspacing="0" bgcolor="#68686a" style="height:10px;line-height:10px;font-size:10px;" align="center">
								<tr> 	
								<td align="center" valign="top" style="height:10px;line-height:10px;font-size:10px;padding:0px 0 0px 0;">
									<div id="footerDiv" style="font-family:Lucida Grande,Arial,Helvetica,Geneva,Verdana,sans-serif;color:#FFFFFF;font-size:12px;line-height:1em;text-align:center;padding:8px 10px 12px 10px;">
										Copyright &copy; <a href="'.$site_path.'" style="text-decoration:none; color:#fff;"> Empowered</a> '.date('Y').' All rights reserved. </div>
								</td>
								</tr>
								</table>  
							  </td>
							</tr>
							</table>
							</body>
							</html>';
					 
						  $email = new Email('default');			
				          $email->emailFormat('html')->from(['admin@empowered.com' => 'Empowered'])->to('avneesh.iwebservices@gmail.com')
						  ->subject('Contact US')->send($message2);            
					  }
					
					if($this->Contact->save($contact))
					{
						$this->set([
						
							'status'=>"Success",
							'message'=>"Thanks! your message sent successfully.",
							'_serialize' => ['status','message']
						]);
					}
					else
					{
						$this-set([
						   'status'=>'Failled',
						   'message'=>'Sorry! Not able to contact.',
						   '_serialize'=>['status','message']
						]);
					}
			}
			else
			{
				$this->set([
				'status' => 'Failed',
				'message' => 'Please enter valid data',
				'_serialize' => ['status','message']
			   ]);
			}		
	}
	
	
   // ============== function for User Login ================
   public function login()
    {
          if ($this->request->is('post')) 
           {
                 $username=$this->request->data['username'];
                 $password=$this->request->data['password'];
               
              $base_url = "http://".$_SERVER['SERVER_NAME'];  
              if(!empty($username && $password)) {  
                 
                    $user = $this->Auth->identify();
                    if (!empty($user)) 
                    {
						
						if($user['user_tpye'] == 2)
						{
						    $imagepath =
							$this->set([
							   'status'=>'Success',
							   'user' => $user,
							   'imgpath'=>$base_url.$this->request->webroot."img/user/",
							   '_serialize' => ['status','user','imgpath']
							]);
						}
						else
						{
							  $this->set([
							   'status'=>'Failed',
							   'message' => 'Sorry! You are not authrize for login',
							   '_serialize' => ['status','message']
							  ]);	
						}	
                    }
                    else
                    {
					    $this->set([
						   'status'=>'Failed',
						   'message' => 'Username and password not match',
						   '_serialize' => ['status','message']
						]);
				    }
				}
				else
				{
					$this->set([
					'status'=>'Failed',
					'message' => 'Please enter valid data',
					'_serialize' => ['status','message']
					]);
				}            
           }
    }
    
    // ============== function for forget password ================
    public function forgetpass()
    {
		if($this->request->is('post'))	    
		{	        
			 $email  = $this->request->data['email'];
			 
			 if(!empty($email)) { 
				 
					 $query  = $this->Users->find('all',['conditions'=>['And'=>['email'=>$this->request->data['email']]]]);	        
					 $number = $query->count();	        
					 $user   = $query->first();
					 
					 if($number>0)
					 {
						  $email = $this->request->data['email'];
						  $name  = $user['name'];
						  
						  /*generate password*/
						   $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";	            
						   $pass = array(); //remember to declare $pass as an blank array	            
						   $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache	
						   for ($i = 0; $i < 12; $i++) 
						   {	                
							  $n = rand(0, $alphaLength);	                
							  $pass[] = $alphabet[$n];	            
						   }
						  $pass=implode($pass);
						  $user->password =$pass;
						  if($this->Users->save($user))
						  {
							 $message='  
								<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
								<html xmlns="http://www.w3.org/1999/xhtml">
								<head>
								<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
								<title>Welcome to Empowered</title>
								<style type="text/css">
								@charset "utf-8";
								#footerDiv{
								}
								.dataDiv{
								}
								</style>
								</head>
								<body>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
								<tr>
									<td style="padding:40px 0px 40px 0px;background-color:#f4f4f4;">
								  <table width="702" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#FFFFFF">
								  <tr> 
									<td width="700" bgcolor="#f4f4f4">
									  <table width="700" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#FFF">
									  <tr>
										<td width="100%" align="center" bgcolor="rgb(249,219,149)" style="padding:0 0px 0 0px;" colspan="3">
											<h2 style="color:rgb(255,255,255);">Forgot password</h2>
										</td>
									  </tr>
									  <tr> 
												<td width="1" bgcolor="#dadada"></td> 
												<td width="697" align="center">
													<table width="696" cellspacing="0" cellpadding="1" border="0" bgcolor="#FFFFFF">
														<tr> <td> 
														<div class="dataDiv" style="color:#666666;font-family:Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif;font-size:12.5px;line-height:1.75em;padding:0 60px;">
														<br>
															Dear '.$name.',
															<br>';
															$message .= '<br><br>Below is your login details: <br>
															<strong>Name :</strong>  '.$name.' <br>
															<strong>Email :</strong>  '.$email.' <br>
															<strong>Password :</strong>  '.$pass.' <br>
															<br>							
															 You will be able to login as soon as your account is approved.
														<br><br>
														If you have any query. Please contact us at any time.<br>
														<strong>Email ID :</strong>  support@empowered.com <br>
														<strong>Mobile No :</strong>  +91 123 456 789,
														<br><br>
														With Best Regards, <br>
														Empowered Team <br><br>
														</div> 
														</td> </tr>
													</table>
												</td>
												<td width="1" bgcolor="#dadada"></td> 
											</tr> 
									  </table>
									</td>
								   </tr>
								   <td style="font-family:Arial,Helvetica,sans-serif;font-size:16px;color:#fff;border:1px solid #d1d1d1;text-align:center" width="100%" valign="top">
										<table style="background:#eee;border-bottom:1px solid #d1d1d1" width="100%" cellspacing="0" cellpadding="0" border="0">
									  <tbody><tr>
										<td style="width:100%;font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#2e3192;text-align:center;padding:7px 5px 7px 5px;background:rgb(255,204,0);font-weight:bold">Happy to Help</td>
									  </tr>
									</tbody></table>
										<table width="100%" cellspacing="0" cellpadding="0" border="0">
									  <tbody><tr>
										<td style="width:50%;font-family:Arial,Helvetica,sans-serif;font-size:13px;line-height:18px;color:#000;padding:5px;text-align:center;border-right:1px solid #d1d1d1" width="50%"><b>Email:</b>
										  <a href="mailto:support@empowered.com" style="color:#444" target="_blank">support@empowered.com</a><br>
										<b>Call Us:</b> <span style="color:#444"><a style="color:#444">+91 123 456 789 </a></span></td>
										 </tr>
									</tbody></table>    
									</td>
								  </table>
									
								  <table width="700" border="0" cellpadding="0" cellspacing="0" bgcolor="#68686a" style="height:10px;line-height:10px;font-size:10px;" align="center">
									<tr> 	
									<td align="center" valign="top" style="height:10px;line-height:10px;font-size:10px;padding:0px 0 0px 0;">
										<div id="footerDiv" style="font-family:Lucida Grande,Arial,Helvetica,Geneva,Verdana,sans-serif;color:#FFFFFF;font-size:12px;line-height:1em;text-align:center;padding:8px 10px 12px 10px;">
											Copyright &copy; <a href="'.$site_path.'" style="text-decoration:none; color:#fff;"> Empowered</a> '.date('Y').' All rights reserved. </div>
									</td>
									</tr>
									</table>  
								  </td>
								</tr>
								</table>
								</body>
								</html>';
						 
							  $email = new Email('default');			
							  $email->emailFormat('html')->from(['admin@empowered.com' => 'Empowered'])->to($this->request->data['email'])
							  ->subject('FORGOT PASSWORD')->send($message);            
							  
							  $this->set([
								'status'=>'Success',
								'message' => 'Password has been sent to your mail id',
								'_serialize' => ['status','message']
							  ]);  
						  }
						  else
						  {
							  $this->set([
								'status'=>'Failed',
								'message' => 'Some problem to sent mail',
								'_serialize' => ['status','message']
							  ]);
						  }				  
					 }else{
						  $this->set([
							'status'=>'Failed',
							'message' => 'E-mail id not registered',
							'_serialize' => ['status','message']
						  ]);
					}
				}
				else
				{
				  $this->set([
					'status'=>'Failed',
					'message' => 'Please enter email address',
					'_serialize' => ['status','message']
				  ]);
				}	
		}  	
    }

    // ============== function for Introductions ================
	public function introduction(){
		
         $base_url = "http://".$_SERVER['SERVER_NAME'];
		 $intro = $this->Introduction->find('all')->where(['status'=>1])->toArray();
         if(!empty($intro) ){		 
			 $this->set([
					'status'=>'Success',
					'introduction' => $intro,
					'imgpath'=>$base_url.$this->request->webroot."img/introduction/",
					'_serialize' => ['status','imgpath','introduction']
				]);
			}else{
				$this->set([
					'status'=>'Failed',
					'message' => 'introduction not found',
					'_serialize' => ['status','message']
				]);
			}
	   }
	 
	   // ============== function for quick guide ================
	   public function quickguide()
	   {

         $base_url="http://".$_SERVER['SERVER_NAME'];
		 $guide = $this->Quickguide->find('all')->where(['status'=>1])->toArray();
         if(!empty($guide) ){		 
			 $this->set([
					'status'=>'Success',
					'quickguide' => $guide,
					'imgpath'=>$base_url.$this->request->webroot."img/quickguide/",
					'_serialize' => ['status','imgpath','quickguide']
				]);
			}else{
				$this->set([
					'status'=>'Failed',
					'message' => 'Quick guide not found',
					'_serialize' => ['status','message']
				]);
			}
	   }
	   
	   // ============== function for CMS list ================  
	   public function cmslist(){

		 $cms = $this->Cms->find('all')->where(['status'=>1])->toArray();
         if(!empty($cms) ){		 
			 $this->set([
					'status'=>'Success',
					'cms' => $cms,
					'_serialize' => ['status','cms']
				]);
			}else{
				$this->set([
					'status'=>'Failed',
					'message' => 'CMS not found',
					'_serialize' => ['status','message']
				]);
			}
	   }
	   
	   // ============== function for Motivational ================
	    public function motivational()
	    {

         $cat_id  = $this->request->data['cat_id'];
         
         $base_url = "http://".$_SERVER['SERVER_NAME'];
		 $motiv = $this->Motivational->find('all')->where(['status'=>1,'cat_id'=>$cat_id])->toArray();
         if(!empty($motiv) ){		 
			 $this->set([
					'status'       => 'Success',
					'motivational' => $motiv,
					'videopath'    => $base_url.$this->request->webroot."video/",
					'pptpath'      => $base_url.$this->request->webroot."ppt/",
					'_serialize'   => ['status','videopath','pptpath','motivational']
				]);
			}else{
				$this->set([
					'status'=>'Failed',
					'message' => 'Additional Tools not found',
					'_serialize' => ['status','message']
				]);
			}
	   }
	   
	   // ============== function for Category List ================
	   public function categorylist(){

		 $category = $this->Category->find('all')->where(['status'=>1])->toArray();
         if(!empty($category) ){		 
			 $this->set([
					'status'=>'Success',
					'category' => $category,
					'_serialize' => ['status','category']
				]);
		 }else{
				$this->set([
					'status'=>'Failed',
					'message' => 'Category not found',
					'_serialize' => ['status','message']
				]);
		}
	   }
	   
	   // ============== function for Country list ================
	   public function countrylist(){

		 $country = $this->Apps_countries->find('all');
         if(!empty($country) ){		 
			 $this->set([
					'status'=>'Success',
					'country' => $country,
					'_serialize' => ['status','country']
				]);
		 }else{
				$this->set([
					'status'=>'Failed',
					'message' => 'Country not found',
					'_serialize' => ['status','message']
				]);
		}
	   }
	    
       
       
       public function questionnaire()
	   {   
		   $question = $this->Questions->find('all',array('conditions'=>array('Questions.status'=>1),'fields'=>array('Questions.id','Questions.question'),'order'=>array('Questions.id'=>'desc')));
		   $quest = array();
		   $i=0;
		   foreach($question as $key=>$data)
		   {
			   $q_id = $data->id;
			   // ===  DATA FOR IMPORTANCE ====
			   $imp = $this->Importance->find('all',array('fields'=>array('Importance.id','Importance.importance_name'),'conditions'=> array('Importance.q_id'=>$q_id)));  
			   
			   $importancedata = array();
			   $im = 0;
			   foreach($imp as $importance)
			   {
				   $importancedata[$im]['id'] = $importance->id;
				   $importancedata[$im]['name'] = $importance->importance_name;
			       $im++;
			   }
			   
			   // ===  DATA FOR FREQUENCY ====
			   $fr = $this->Frequency->find('all',array('fields'=>array('Frequency.id','Frequency.frequency_name'),'conditions'=> array('Frequency.q_id'=>$q_id)));  
			   
			   $freedata = array();
			   $f = 0;
			   foreach($fr as $frequency)
			   {
				   $freedata[$f]['id'] = $frequency->id;
				   $freedata[$f]['name'] = $frequency->frequency_name;
			       $f++;
			   }
			   
			   // ===  DATA FOR CAPABILITY ====
			   $capability = $this->Capability->find('all',array('fields'=>array('Capability.id','Capability.capability_name'),'conditions'=> array('Capability.q_id'=>$q_id)));  
			   
			   $capable = array();
			   $ca = 0;
			   foreach($capability as $capabilitys)
			   {
				   $capable[$ca]['id'] = $capabilitys->id;
				   $capable[$ca]['name'] = $capabilitys->capability_name;
			       $ca++;
			   }
			   
			   
			   $quest[$i]['id']         = $data->id; 
			   $quest[$i]['question']   = $data->question; 
			   $quest[$i]['importance'] = $importancedata;
			   $quest[$i]['frequency']  = $freedata;
			   $quest[$i]['capability'] = $capable;
			   $i++; 
		   }
		   
			
			if(!empty($question))
			{
				$this->set([
				    'status' => 'true',
				    'questioinnaire' => $quest,
				    '_serialize' => ['status','questioinnaire']
				]);
			}
			else
			{
				$this->set([
				    'status' => 'false',
				    'message' => 'Questioinnaire not found!',
				    '_serialize' => ['status','message']
				]);
			}
       }
       
    // API for user report to sending email
	public function report()
	{
		
		if(!empty($this->request->data['userid'] && $this->request->data['name'] && $this->request->data['email'] && $this->request->data['importance'] && $this->request->data['frequency'] && $this->request->data['capability'] ))
		{
					$userid  = $this->request->data['userid'];
					$name = $this->request->data['name'];
					$toemail = $this->request->data['email'];
					$importance = $this->request->data['importance'];
					$frequency = $this->request->data['frequency'];
					$capability = $this->request->data['capability'];
				
					if($toemail)
					{
						 $message='  
							<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
							<html xmlns="http://www.w3.org/1999/xhtml">
							<head>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
							<title>Welcome to Empowered Achiever</title>
							<style type="text/css">
							@charset "utf-8";
							#footerDiv{
							}
							.dataDiv{
							}
							</style>
							</head>
							<body>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td style="padding:40px 0px 40px 0px;background-color:#f4f4f4;">
							  <table width="702" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#FFFFFF">
							  <tr> 
								<td width="700" bgcolor="#f4f4f4">
								  <table width="700" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#FFF">
								  
								  <tr><td style="padding:0 0px 0 0px;" colspan="3" width="100%" align="center"><img src="http://cmsbox.in/app/empowered/img/logo/logo.png" alt="Empowered"></td></tr>	
								  <tr>
									<td width="100%" align="center" bgcolor="rgb(249,219,149)" style="padding:0 0px 0 0px;" colspan="3">
										<h2 style="color:rgb(255,255,255);">Your Empowered Achiever Report</h2>
									</td>
								  </tr>
								  <tr> 
											<td width="1" bgcolor="#dadada"></td> 
											<td width="697" align="center">
												<table width="696" cellspacing="0" cellpadding="1" border="0" bgcolor="#FFFFFF">
													<tr> <td> 
													<div class="dataDiv" style="color:#666666;font-family:Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif;font-size:12.5px;line-height:1.75em;padding:0 60px;">
													<br>
														Dear '.$name.',';
														$message .= '<br><br>Below is the final report: <br>
														<strong>Name :</strong>  '.$name.' <br>
														<strong>Email :</strong>  '.$toemail.' <br>
														<strong>Importance :</strong>  '.$importance.' <br>
														<strong>Frequency :</strong>  '.$frequency.' <br>
														<strong>Capability :</strong>  '.$capability.' <br>
														<br>
														<br>
													If you have any query. Please contact us at any time.<br>
													<strong>Email ID :</strong>  info@empowered.com <br>
													<strong>Mobile No :</strong>  +91 123 456 789,
													<br><br>
													With Best Regards, <br>
													Empowered Team <br><br>
													</div> 
													</td> </tr>
												</table>
											</td>
											<td width="1" bgcolor="#dadada"></td> 
										</tr> 
								  </table>
								</td>
							   </tr>
							   <td style="font-family:Arial,Helvetica,sans-serif;font-size:16px;color:#fff;border:1px solid #d1d1d1;text-align:center" width="100%" valign="top">
									<table style="background:#eee;border-bottom:1px solid #d1d1d1" width="100%" cellspacing="0" cellpadding="0" border="0">
								  <tbody><tr>
									<td style="width:100%;font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#2e3192;text-align:center;padding:7px 5px 7px 5px;background:rgb(255,204,0);font-weight:bold">Happy to Help</td>
								  </tr>
								</tbody></table>
									<table width="100%" cellspacing="0" cellpadding="0" border="0">
								  <tbody><tr>
									<td style="width:50%;font-family:Arial,Helvetica,sans-serif;font-size:13px;line-height:18px;color:#000;padding:5px;text-align:center;border-right:1px solid #d1d1d1" width="50%"><b>Email:</b>
									  <a href="mailto:info@empowered.com" style="color:#444" target="_blank">info@empowered.com</a><br>
									<b>Call Us:</b> <span style="color:#444"><a style="color:#444">+91 123 456 789 </a></span></td>
									 </tr>
								</tbody></table>    
								</td>
							  </table>
								
							  <table width="700" border="0" cellpadding="0" cellspacing="0" bgcolor="#68686a" style="height:10px;line-height:10px;font-size:10px;" align="center">
								<tr> 	
								<td align="center" valign="top" style="height:10px;line-height:10px;font-size:10px;padding:0px 0 0px 0;">
									<div id="footerDiv" style="font-family:Lucida Grande,Arial,Helvetica,Geneva,Verdana,sans-serif;color:#FFFFFF;font-size:12px;line-height:1em;text-align:center;padding:8px 10px 12px 10px;">
										Copyright &copy; <a href="'.$site_path.'" style="text-decoration:none; color:#fff;"> Empowered</a> '.date('Y').' All rights reserved. </div>
								</td>
								</tr>
								</table>  
							  </td>
							</tr>
							</table>
							</body>
							</html>';
					      
					    //create pdf
					    $dompdf = new Dompdf();
					    $dompdf = new Dompdf(array('enable_remote' => true));
                        $file = "report-" . (date('d-m-Y')) ."-". time().".pdf";
                        ob_start();
					    
					    echo $data=' 
							<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
							<html xmlns="http://www.w3.org/1999/xhtml">
							<head>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
							<title>Welcome to Empowered Achiever</title>
							<style type="text/css">
							@charset "utf-8";
							#footerDiv{
							}
							.dataDiv{
							}
							</style>
							</head>
							<body>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td style="padding:40px 0px 40px 0px;background-color:#f4f4f4;">
							  <table width="702" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#FFFFFF">
							  <tr> 
								<td width="700" bgcolor="#f4f4f4">
								  <table width="700" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#FFF">
								  <tr><td style="padding:0 0px 0 0px;" colspan="3" width="100%" align="center"><img src="http://cmsbox.in/app/empowered/img/logo/logo.png" alt="Empowered"></td></tr>	
								  <tr>
									<td width="100%" align="center" bgcolor="rgb(249,219,149)" style="padding:0 0px 0 0px;" colspan="3">
										<h2 style="color:rgb(255,255,255);">Your Empowered Achiever Report</h2>
									</td>
								  </tr>
								  <tr> 
											<td width="1" bgcolor="#dadada"></td> 
											<td width="697" align="center">
												<table width="696" cellspacing="0" cellpadding="1" border="0" bgcolor="#FFFFFF">
													<tr> <td> 
													<div class="dataDiv" style="color:#666666;font-family:Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif;font-size:12.5px;line-height:1.75em;padding:0 60px;">
													<br>
														Dear '.$name.',';
														echo $data = '<br><br>Below is the final report: <br>
														<strong>Name :</strong>  '.$name.' <br>
														<strong>Email :</strong>  '.$toemail.' <br>
														<strong>Importance :</strong>  '.$importance.' <br>
														<strong>Frequency :</strong>  '.$frequency.' <br>
														<strong>Capability :</strong>  '.$capability.' <br>
														<br>
														<br>
													If you have any query. Please contact us at any time.<br>
													<strong>Email ID :</strong>  info@empowered.com <br>
													<strong>Mobile No :</strong>  +91 123 456 789,
													<br><br>
													With Best Regards, <br>
													Empowered Team <br><br>
													</div> 
													</td> </tr>
												</table>
											</td>
										<td width="1" bgcolor="#dadada"></td> 
										</tr> 
								  </table>
								</td>
							   </tr>
							   <td style="font-family:Arial,Helvetica,sans-serif;font-size:16px;color:#fff;border:1px solid #d1d1d1;text-align:center" width="100%" valign="top">
									<table style="background:#eee;border-bottom:1px solid #d1d1d1" width="100%" cellspacing="0" cellpadding="0" border="0">
								  <tbody><tr>
									<td style="width:100%;font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#2e3192;text-align:center;padding:7px 5px 7px 5px;background:rgb(255,204,0);font-weight:bold">Happy to Help</td>
								  </tr>
								</tbody></table>
									<table width="100%" cellspacing="0" cellpadding="0" border="0">
								  <tbody><tr>
									<td style="width:50%;font-family:Arial,Helvetica,sans-serif;font-size:13px;line-height:18px;color:#000;padding:5px;text-align:center;border-right:1px solid #d1d1d1" width="50%"><b>Email:</b>
									  info@empowered.com<br>
									<b>Call Us:</b> <span style="color:#444">+91 123 456 789 </span></td>
									 </tr>
								</tbody></table>    
								</td>
							  </table>
								
							  <table width="700" border="0" cellpadding="0" cellspacing="0" bgcolor="#68686a" style="height:10px;line-height:10px;font-size:10px;" align="center">
								<tr> 	
								<td align="center" valign="top" style="height:10px;line-height:10px;font-size:10px;padding:0px 0 0px 0;">
									<div id="footerDiv" style="font-family:Lucida Grande,Arial,Helvetica,Geneva,Verdana,sans-serif;color:#FFFFFF;font-size:12px;line-height:1em;text-align:center;padding:8px 10px 12px 10px;">
										Copyright &copy; Empowered '.date('Y').' All rights reserved. </div>
								</td>
								</tr> 
								</table>  
							  </td>
							</tr>
							</table>
							</body>
							</html>';
					    
					    
					      $pdf = ob_get_contents();
                          $data = ob_get_contents();
                          ob_end_clean();
                          $dompdf->loadHtml($pdf);
                          $dompdf->setPaper('A4', 'landscape');
                          $dompdf->render();
                          $path = "report/";
                          file_put_contents("$path/$file", $dompdf->output());  

					      
    				      //send mail
    					  $email = new Email('default');
    			          $email->emailFormat('html')->from(['admin@empowered.com' => 'Empowered']);
    			          $email->to($toemail);
    					  $email->subject('Final Report');
    					  $email->attachments("$path/$file");
    					  $email->send($message);          
    					  
    					  
    					  $this->set([
    					
    						'status'=>"Success",
    						'message'=>"Thanks! your report sent successfully on your email.",
    						'_serialize' => ['status','message']
    					]);            
					  }else{
					
					
						$this-set([
						   'status'=>'Failled',
						   'message'=>'Sorry! Not able to generate report something is wrong.',
						   '_serialize'=>['status','message']
						]);
					}
			}
			else
			{
				$this->set([
				'status' => 'Failed',
				'message' => 'Please enter valid data',
				'_serialize' => ['status','message']
			   ]);
			}		
	}
	
	
	// API for user report to sending email
	public function report_download()
	{
		
		if(!empty($this->request->data['userid'] && $this->request->data['name'] && $this->request->data['importance'] && $this->request->data['frequency'] && $this->request->data['capability'] ))
		{
					$userid  = $this->request->data['userid'];
					$name = $this->request->data['name'];
					$importance = $this->request->data['importance'];
					$frequency = $this->request->data['frequency'];
					$capability = $this->request->data['capability'];
				
					if($userid)
					{
						//create pdf report
					    $dompdf = new Dompdf();
					    $dompdf = new Dompdf(array('enable_remote' => true));
                        $file = "report-" . (date('d-m-Y')) ."-". time().".pdf";
                        ob_start();
					    
					    echo $data=' 
							<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
							<html xmlns="http://www.w3.org/1999/xhtml">
							<head>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
							<title>Welcome to Empowered Achiever</title>
							<style type="text/css">
							@charset "utf-8";
							#footerDiv{
							}
							.dataDiv{
							}
							</style>
							</head>
							<body>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td style="padding:40px 0px 40px 0px;background-color:#f4f4f4;">
							  <table width="702" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#FFFFFF">
							  <tr> 
								<td width="700" bgcolor="#f4f4f4">
								  <table width="700" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#FFF">
								  <tr><td style="padding:0 0px 0 0px;" colspan="3" width="100%" align="center"><img src="http://cmsbox.in/app/empowered/img/logo/logo.png" alt="Empowered"></td></tr>	
								  <tr>
									<td width="100%" align="center" bgcolor="rgb(249,219,149)" style="padding:0 0px 0 0px;" colspan="3">
										<h2 style="color:rgb(255,255,255);">Your Empowered Achiever Report</h2>
									</td>
								  </tr>
								  <tr> 
											<td width="1" bgcolor="#dadada"></td> 
											<td width="697" align="center">
												<table width="696" cellspacing="0" cellpadding="1" border="0" bgcolor="#FFFFFF">
													<tr> <td> 
													<div class="dataDiv" style="color:#666666;font-family:Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif;font-size:12.5px;line-height:1.75em;padding:0 60px;">
													<br>
														Dear '.$name.',';
														echo $data = '<br><br>Below is the final report: <br>
														<strong>Name :</strong>  '.$name.' <br>
														<strong>Importance :</strong>  '.$importance.' <br>
														<strong>Frequency :</strong>  '.$frequency.' <br>
														<strong>Capability :</strong>  '.$capability.' <br>
														<br>
														<br>
													If you have any query. Please contact us at any time.<br>
													<strong>Email ID :</strong>  info@empowered.com <br>
													<strong>Mobile No :</strong>  +91 123 456 789,
													<br><br>
													With Best Regards, <br>
													Empowered Team <br><br>
													</div> 
													</td> </tr>
												</table>
											</td>
										<td width="1" bgcolor="#dadada"></td> 
										</tr> 
								  </table>
								</td>
							   </tr>
							   <td style="font-family:Arial,Helvetica,sans-serif;font-size:16px;color:#fff;border:1px solid #d1d1d1;text-align:center" width="100%" valign="top">
									<table style="background:#eee;border-bottom:1px solid #d1d1d1" width="100%" cellspacing="0" cellpadding="0" border="0">
								  <tbody><tr>
									<td style="width:100%;font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#2e3192;text-align:center;padding:7px 5px 7px 5px;background:rgb(255,204,0);font-weight:bold">Happy to Help</td>
								  </tr>
								</tbody></table>
									<table width="100%" cellspacing="0" cellpadding="0" border="0">
								  <tbody><tr>
									<td style="width:50%;font-family:Arial,Helvetica,sans-serif;font-size:13px;line-height:18px;color:#000;padding:5px;text-align:center;border-right:1px solid #d1d1d1" width="50%"><b>Email:</b>
									  info@empowered.com<br>
									<b>Call Us:</b> <span style="color:#444">+91 123 456 789 </span></td>
									 </tr>
								</tbody></table>    
								</td>
							  </table>
								
							  <table width="700" border="0" cellpadding="0" cellspacing="0" bgcolor="#68686a" style="height:10px;line-height:10px;font-size:10px;" align="center">
								<tr> 	
								<td align="center" valign="top" style="height:10px;line-height:10px;font-size:10px;padding:0px 0 0px 0;">
									<div id="footerDiv" style="font-family:Lucida Grande,Arial,Helvetica,Geneva,Verdana,sans-serif;color:#FFFFFF;font-size:12px;line-height:1em;text-align:center;padding:8px 10px 12px 10px;">
										Copyright &copy; Empowered '.date('Y').' All rights reserved. </div>
								</td>
								</tr> 
								</table>  
							  </td>
							</tr>
							</table>
							</body>
							</html>';
					    
					    
					      $pdf = ob_get_contents();
                          $data = ob_get_contents();
                          ob_end_clean();
                          $dompdf->loadHtml($pdf);
                          $dompdf->setPaper('A4', 'landscape');
                          $dompdf->render();
                          $path = "report/";
                          file_put_contents("$path/$file", $dompdf->output());  
                          
                          $base_url = "http://".$_SERVER['SERVER_NAME'];
                          $report =  $base_url.$this->request->webroot."report/".$file;
					      
    					  $this->set([
    					
    						'status'=>"Success",
    						'report'=>$report,
    						'_serialize' => ['status','report']
    					]);            
					  }else{
					
						$this-set([
						   'status'=>'Failled',
						   'message'=>'Sorry! Not able to generate report something is wrong.',
						   '_serialize'=>['status','message']
						]);
					}
			}
			else
			{
				$this->set([
				'status' => 'Failed',
				'message' => 'Please enter valid data',
				'_serialize' => ['status','message']
			   ]);
			}		
	}
}
?>
