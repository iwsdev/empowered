<?php
// src/Controller/QuickguideController.php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;

class QuickguideController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->loadModel('Quickguide');
    }

    public function index()
    {
        $this->viewBuilder()->layout('top'); 
        $this->set('guide',$this->Quickguide->find('all',array('order'=>'Quickguide.id DESC')));
    }

    public function add()
    {
         $this->viewBuilder()->layout('top'); 
         $guide = $this->Quickguide->newEntity();
         if($this->request->is('post'))
         {
            $guide = $this->Quickguide->patchEntity($guide,$this->request->data());
            // For Image
            $image =$this->request->data('image');
		    $name     =$image['name'];
		    $size     =$image['size'];
		    $maxsize  =2097152;
		    $ext      = substr(strtolower(strrchr($name, '.')), 1); 
		    $arr_ext  = array('jpg','jpeg','png','gif'); 
		
			if((in_array($ext, $arr_ext)) && ($maxsize>$size))
			{
				 $t=time();
				 $name=$t."_".$image['name'];
				 $path='img/quickguide/'.$name;
				 move_uploaded_file($image['tmp_name'],$path);
				 $guide['image']=$name; 
				 $guide['name'] = str_replace(' ','-',strtolower($guide['name']));
				 $this->Quickguide->save($guide);
				 $this->Flash->success(__("Information added successfully."));
                 $this->redirect(['action'=>'index']); 
			}
			else
			{
				$this->Flash->error(__('Error : Only jpg, jpeg, png extentions allowed'));
				$this->redirect(['action'=>'add']);
				
			}
         }
    }
    
    public function edit($id='null')
    {
        $this->viewBuilder()->layout('top');
        $guide=$this->Quickguide->get($id);  
        $this->set('guide', $guide);    
          
			if ($this->request->is(['put','post'])) 
			{
				$guides = $this->Quickguide->patchEntity($guide, $this->request->data);
				$image = $this->request->data('image');
				
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
						 $path='img/quickguide/'.$name;
						 move_uploaded_file($image['tmp_name'],$path);
						 $guides['image']=$name; 
						 $guides['name'] = str_replace(' ','-',strtolower($guides['name']));
						 $this->Quickguide->save($guides);
						 $this->Flash->success(__('Your Information has  been update.'));
					     return $this->redirect(['action' => 'index']);
					}
					else
			        {
				        $this->Flash->error(__('Error : Only jpg, jpeg, png extentions allowed'));
				        $this->redirect(array('action' => 'edit',$id));
			        }
				}
				else
				{
					$guidedata = $this->Quickguide->get($id);  					
					$guides['image'] = $guidedata['image'];	
				    $guides['name'] = str_replace(' ','-',strtolower($guides['name']));
				    $this->Quickguide->save($guides);
					$this->Flash->success(__('Your Information has  been update.'));
					return $this->redirect(['action' => 'index']);		
				}
				
			}
    }

   

    public function delete($id=null)
    {
        $this->autoRender = false;
        $this->viewBuilder()->layout('ajax');
        $id = $this->request->data('id');
        $guide   = $this->Quickguide->get($id);
        if($this->Quickguide->delete($guide))
        {
            echo 1;
        }
    }

    public function chStatus()
    {
        $this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');   
        $id           = $this->request->data('id');
        $guide          = $this->Quickguide->get($id);    
        $current_status = $guide['status'];    
        
           if($current_status==1)
           {
               $guide['status']=0;
               $this->Quickguide->save($guide); 
               echo "<span id='status_$id'><span class='btn btn-warning btn-xs'><strong>Inactive</strong></span></span>";
           }
           else
           {
               $guide['status']=1;
               $this->Quickguide->save($guide);
               echo "<span id='status_$id'><span class='btn btn-success btn-xs'><strong>Active</strong></span></span>";
           }
    }
}
?>
