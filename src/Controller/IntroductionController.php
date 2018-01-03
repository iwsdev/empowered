<?php
// src/Controller/IntroductionController.php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;

class IntroductionController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->loadModel('Introduction');
    }

    public function index()
    {
        $this->viewBuilder()->layout('top'); 
        $this->set('intro',$this->Introduction->find('all',array('order'=>'Introduction.id DESC')));
    }

    public function add()
    {
         $this->viewBuilder()->layout('top'); 
         $intro = $this->Introduction->newEntity();
         if($this->request->is('post'))
         {
            $intro = $this->Introduction->patchEntity($intro,$this->request->data());
            
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
				 $path='img/introduction/'.$name;
				 move_uploaded_file($image['tmp_name'],$path);
				 $intro['image']=$name;
				 $intro['name'] = str_replace(' ','-',strtolower($intro['name'])); 
				 $this->Introduction->save($intro);
                 $this->Flash->success(__("Content added successfully."));
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
        $intro=$this->Introduction->get($id);
        if ($this->request->is(['put','post'])) 
        {
            $intro = $this->Introduction->patchEntity($intro, $this->request->data);
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
					 $path='img/introduction/'.$name;
					 move_uploaded_file($image['tmp_name'],$path);
					 $intro['image']=$name; 
					 $intro['name'] = str_replace(' ','-',strtolower($intro['name']));
					 $this->Introduction->save($intro);
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
				$intros=$this->Introduction->get($id);
				$intro['image']=$intros['image'];
				
				$intro['name'] = str_replace(' ','-',strtolower($intro['name']));
                $this->Introduction->save($intro);
                $this->Flash->success(__('Your Information has  been update.'));
                return $this->redirect(['action' => 'index']);
			}	
			
            
            
        }
        $this->set('intro', $intro);
    }

   

    public function delete($id=null)
    {
        $this->autoRender = false;
        $this->viewBuilder()->layout('ajax');
        $id = $this->request->data('id');
        $intro   = $this->Introduction->get($id);
        if($this->Introduction->delete($intro))
        {
            echo 1;
        }
    }

    public function chStatus()
    {
        $this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');   
        $id           = $this->request->data('id');
        $intro          = $this->Introduction->get($id);    
        $current_status = $intro['status'];    
        
           if($current_status==1)
           {
               $intro['status']=0;
               $this->Introduction->save($intro); 
               echo "<span id='status_$id'><span class='btn btn-warning btn-xs'><strong>Inactive</strong></span></span>";
           }
           else
           {
               $intro['status']=1;
               $this->Introduction->save($intro);
               echo "<span id='status_$id'><span class='btn btn-success btn-xs'><strong>Active</strong></span></span>";
           }
    }
}
?>
