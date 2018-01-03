<?php
// src/Controller/UsersController.php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['login','logout','forgetpass']);
        $this->loadModel('Users');
        $this->loadModel('Cms');
        $this->loadModel('Motivational');
        $this->loadModel('Questions');
        $this->loadModel('Introduction');
        $this->loadModel('Quickguide');
        $this->loadModel('Reflection');
        $this->loadModel('Apps_countries');
        $this->loadModel('Sector');
    }

    public function index()
    {
        $this->viewBuilder()->layout('top'); 
        $this->set('users', $this->Users->find('all',array('order'=>'Users.id DESC'))->where(['Users.user_tpye '=>2])); 
    }
   
    public function password()
	{
	    $this->viewBuilder()->layout('top');
	    $user =$this->Users->get($this->Auth->user('id'));
	   
	    
	    if(!empty($this->request->data))
	    {
	        $current     = $this->request->data('current');
	        $password    = $this->request->data('password');
	        $confirmpass = $this->request->data('confirmpass');
	        
	        $data        = $this->Users->get($user['id']);
	        $hasher      = new DefaultPasswordHasher();
	        if(!$hasher->check($current,$data->password))
	        {
	            $this->Flash->success(__('Your current password does not matched...'));
	            return $this->redirect(['action' => 'password']);
	        }
	        else
	        {
	            
	            if($this->request->data('password') == $this->request->data('confirmpass'))
	            {
	                
	                $data->password = $confirmpass;
	                if($this->Users->save($data))
	                {
	                    $this->Flash->success('Your password has been successfully changed.');
	                    return $this->redirect($this->Auth->logout());
	                 }
	                else
	                {
	                    $this->Flash->success(__('Error in updation.'));
	                    return $this->redirect(['action' => 'password']); 
	                }
	            }
	            else
	            {
	                $this->Flash->success(__('Your current password and new password should not be the same.'));
	                return $this->redirect(['action' => 'password']);
	            }  
	        }     
	    }   
	    $this->set('user',$user);
	}
    
    
    public function dashboard()
    {
        $this->viewBuilder()->layout('top'); 
        $this->set('total_users', $this->Users->find('all')->where(['Users.user_tpye '=>2])->count());
        $this->set('total_cms', $this->Cms->find('all')->count());
        $this->set('total_motivational', $this->Motivational->find('all')->count());
        $this->set('total_questions',$this->Questions->find('all')->count());
        $this->set('total_introduction',$this->Introduction->find('all')->count());
        $this->set('total_guide',$this->Quickguide->find('all')->count());
        $this->set('total_reflection',$this->Reflection->find('all')->count());
    }

    public function profile()
    {
        $this->viewBuilder()->layout('top'); 
        $usr = $this->Auth->user();
        $user=$this->Users->get($usr['id']);
        
        if($this->request->is(['post','put'])) 
        {
				$user = $this->Users->patchEntity($user, $this->request->data);
				$image =$this->request->data('image');
				
				// For Image
				if(!empty($image['name']))
				{
					$name     =$image['name'];
					$size     =$image['size'];
					$maxsize  =2097152;
					$ext      = substr(strtolower(strrchr($name, '.')), 1); 
					$arr_ext  = array('jpg','jpeg','png','gif'); 
			
					// For Image
					if((in_array($ext, $arr_ext)) && ($maxsize>$size))
					{
						 $t=time();
						 $name=$t."_".$image['name'];
						 $path='img/logo/administration/'.$name;
						 move_uploaded_file($image['tmp_name'],$path);
						 $user['image']=$name; 
						 $this->Users->save($user);
						 $this->Flash->success(__('Your Information has  been update.'));
						 return $this->redirect(['action' => 'profile']);
					}
					else
					{
					   $this->Flash->success(__('Error: Only jpg, jpeg, png extentions allowed'));
                       return $this->redirect(['action' => 'profile']); 
					}
				}
				else
				{
				     $intros=$this->Users->get($usr['id']);
				     $user['image']=$intros['image'];
				
                     $this->Users->save($user);
                     $this->Flash->success(__('Your Information has  been update.'));
                     return $this->redirect(['action' => 'profile']);	
				}
				
				if($this->Users->save($user)) 
				{
					 $this->Flash->success(__('Your profile has been successfully update '));
					 return $this->redirect(['action' => 'profile']);
				}
        }
        $this->set('user',$user);
    }


   //Function for edit User Informations..//
    public function edit($id)
    {
        $this->viewBuilder()->layout('top');
        $user = $this->Users->get($id); 
        $country = $this->Apps_countries->find("all");
        $sector = $this->Sector->find("all",array('fields'=>'Sector.name'));
       
        if ($this->request->is('post','put')) {
			
			$data = $this->request->data;
            $user = $this->Users->patchEntity($user, $data);
            
			if ($this->Users->save($user))
			{
				$this->Flash->success(__('Information updated successfully.'));
				$this->redirect(['action' => 'index']);
			}
        }
        $this->set('user', $user);
        $this->set('country', $country);
        $this->set('sector', $sector);
    }

    
    public function add()
    {
        $this->viewBuilder()->layout('top');
         
        $country = $this->Apps_countries->find("all");
        $this->set('country', $country);
        
        $sector = $this->Sector->find("all",array('fields'=>'Sector.name'));
       
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data());
            $user['username']  = $this->request->data('email');
            $user['status']    = 1;
            $user['user_tpye'] = 2;
            if ($this->Users->save($user)) {
                $this->Flash->Success(__('The user has been saved.'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user', $user);
        $this->set('sector', $sector);
    }

    public function delete($id=null)
    {   
        $this->autoRender = false;
        $this->viewBuilder()->layout('ajax');
        $id       = $this->request->Data('id');
        $del_item = $this->Users->get($id);
        if($this->Users->delete($del_item))
        {
            echo 1;
        }
    }

    public function chStatus()
    {
        $this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');       // define ajax layout.
        $id             = $this->request->data('id'); // Get id send by ajax request
        $users          = $this->Users->get($id);    // Fetch data according to id 
        $current_status = $users['status'];         // Fetch particular fields
        
           if($current_status==1)
           {
               $users['status']=0;
               $this->Users->save($users); 
               echo "<span id='status_$id'><span class='btn btn-warning btn-xs'><strong>Inactive</strong></span></span>";
           }
           else
           {
               $users['status']=1;
               $this->Users->save($users);
               echo "<span id='status_$id'><span class='btn btn-success btn-xs'><strong>Active</strong></span></span>";
           }
    }

    public function checkemail()
    {
        $this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');         
        
			if ($this->request->is(['post'])) {
				$email = $this->request->getData('email');
				$responce = $this->Users->find()->where(['email'=>$email])->count();
				
				 if($responce == 0)
				 {
					 echo 0;
				 }
				 else
				 {
					 echo 1;
				 }
		 }
    }

    public function login()
    {
        $this->viewBuilder()->layout("login");
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                if ($this->Auth->user('user_tpye') == 1 && $this->Auth->user('status') == 1) {
                    $this->redirect('/users/dashboard');
                }                
            }else{
				$this->Flash->error(__('Invalid username or password, try again'));
			}
            
        }
	}
    

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
    
    
	public function emailCheck()
	{
		$this->autoRender = false;
		$this->viewBuilder()->layout('false');
		if ($this->request->is(['post'])) {
			$email =$this->request->data('email');                                                 
			$query = $this->Users->find()->where(['Users.email '=>$email])->count();
			if($query) {
				 echo 1;
			}else{
				echo 0;
			}
		}
	}
	
	public function usernameCheck()
	{
		$this->autoRender = false;
		//$this->response->disableCache();
		$this->viewBuilder()->layout('false');
		if ($this->request->is(['post'])) {
			 $search =$this->request->data('username');                                                  
			 $query = $this->Users->find('list', [
								  'conditions' => ['Users.username LIKE '=>'%' .$search. '%'],
								  'limit' => 1
								  ])->all();
			 foreach ($query as $key) {
				 if($key!=null){
					//echo "This email has been taken!!";
					echo 1;
				 }else
				 //echo "Email avilable.";
				 echo 0;
			 }
		} 
	}
	
	public function forgetpass()	
    {	    
		$this->viewBuilder()->layout('forgetpass');   	    
		if($this->request->is('post') || $this->request->is('put'))	    
		{	        
			 $email = $this->request->data['email'];
			       
			 $query = $this->Users->find('all',['conditions'=>['And'=>['email'=>$this->request->data['email'],'status'=>1]]]);	        
			 $number = $query->count();	        
			 $user = $query->first();
			 							
			 if($number>0)	        
			 {	            
				 $user = $this->Users->get($user['id']);
				 	           	            
				 /*generate password*/
				 $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";	            
				 $pass = array(); //remember to declare $pass as an array	            
				 $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache	
							 
				 for ($i = 0; $i < 12; $i++) 
				 {	                
					$n = rand(0, $alphaLength);	                
					$pass[] = $alphabet[$n];	            
				 }
				 			   
			     $pass=implode($pass);	            	           
			     $user->password =$pass;	            
			     /*End generate password*/
						   
						if( $this->Users->save($user))	           
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
															Dear '.$user['name'].',
															<br>';
														
															$message .= '<br><br>Below is your login details: <br>
															<strong>Name :</strong>  '.$user['name'].' <br>
															<strong>Email :</strong>  '.$user['email'].' <br>
															<strong>Password :</strong>  '.$pass.' <br>
															<br>							
															 You will be able to login as soon as your account is approved.
														<br><br>
														If you have any query. Please contact us at any time.<br>
														<strong>Email ID :</strong>  xxxxxxxxx@gmail.com <br>
														<strong>Mobile No :</strong>  +91 00 0000 00000,
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
										  <a href="mailto:xxxxxxxx@gmail.com" style="color:#444" target="_blank">xxxxxxxx@gmail.com</a><br>
										<b>Call Us:</b> <span style="color:#444"><a style="color:#444">+91 00-0000-0000 </a></span></td>
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
							  // pr( $email);exit;                        
							  $email->emailFormat('html')->from(['admin@empowered.com' => 'Empowered'])->to($this->request->data['email'])
							  ->subject('FORGOT PASSWORD')->send($message);            
							  $this->Flash->success(__('Password has been sent to your mail'));	           
						 }	            
						 else	            
						 {	               
							  $this->Flash->error(__('Some problem Password updated'));	           
						 }	        
			 }	        
			 else	       
			 {	            
				$this->Flash->error(__('E-mail id is not registered'));	        
			 }	    
		}  	
	}
}
?>
