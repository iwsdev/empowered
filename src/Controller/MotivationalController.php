<?php
// src/Controller/MotivationalController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class MotivationalController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->loadModel('Motivational');
        $this->loadModel('Category');  
    }

    public function index()
    {
       $this->viewBuilder()->layout('top'); 
       $query = $this->Motivational->find('all',array('order'=>'Motivational.id DESC','fields' => array('Category.category_name','Motivational.id','Motivational.title','Motivational.video','Motivational.ppt','Motivational.content','Motivational.status')))
        ->join([
            'Category' => [
                'table' => 'category',
                'type' => 'INNER',
                'conditions' => 'Category.id = Motivational.cat_id'
            ]      
        ]);
        $this->set('motiv',$query);
    }

    public function add()
    {
        $this->viewBuilder()->layout('top');
        // Get data for dropdown.. 
        $cat_data = $this->Category->find('all',array('conditions'=>array('Category.status'=>1)));
        $this->set('cat',$cat_data);
        
        $motiv = $this->Motivational->newEntity();
	    $motiv = $this->Motivational->patchEntity($motiv, $this->request->data());
        
        if(!empty($this->request->data('title')) && empty($this->request->data['video']['tmp_name']) && empty($this->request->data['ppt']['tmp_name']) )
		{
			
			     $this->Motivational->save($motiv);
				 $this->Flash->success(__('The element has been saved.'));
				 $this->redirect(['action'=>'index']); 	
			
		}
        
        if(!empty($this->request->data['video']['tmp_name']) ){
			
			$video1 = $this->request->data('video');
			$name     =$video1['name'];
			$size     =$video1['size'];
			$maxsize  =2097152;
			$ext      = substr(strtolower(strrchr($name, '.')), 1); 
			$arr_ext  = array('mp4','3gp','mkv','flv'); 
			
			if(in_array($ext, $arr_ext))
			{
				 $t=time();
				 $name=$t."_".$video1['name'];
				 $path='video/'.$name;
				 move_uploaded_file($video1['tmp_name'],$path);
				 $motiv['video']=$name;				
	             $this->Motivational->save($motiv);
				 $this->Flash->success(__('The element has been saved.'));
				 $this->redirect(['action'=>'index']); 		
			
			
			}else{
				
				$this->Flash->error(__('Error : Only mp4, mkv, 3gp, flv extentions allowed'));
				$this->redirect(['action'=>'add']);
				
			}
				
		}
		
		
		if(!empty($this->request->data['ppt']['tmp_name']) ){
			
			$ppt1   = $this->request->data('ppt');
			$name     =$ppt1['name'];
			$size     =$ppt1['size'];
			$maxsize  =2097152;
			$ext      = substr(strtolower(strrchr($name, '.')), 1); 
			$arr_ext  = array('pptx','ppt','pdf'); 
			
			if(in_array($ext, $arr_ext))
			{
				 $t=time();
				 $name=$t."_".$ppt1['name'];
				 $path='ppt/'.$name;
				 move_uploaded_file($ppt1['tmp_name'],$path);
				 $motiv['ppt']=$name;				
	             $this->Motivational->save($motiv);
				 $this->Flash->success(__('The element has been saved.'));
				 $this->redirect(['action'=>'index']); 		
			
			
			}else{
				
				$this->Flash->error(__('Error : Only pptx, ppt, pdf extentions allowed'));
				$this->redirect(['action'=>'add']);
				
			}
				
		}			
	       
    }

    public function edit($id=null)
    {
        $this->viewBuilder()->layout('top');
        // Get data for dropdown.. 
        $cat_data = $this->Category->find('all',array('conditions'=>array('Category.status'=>1)));
        $this->set('cat',$cat_data);

        $motiv = $this->Motivational->get($id);
        $this->set('motiv',$motiv);
          
        
        if ($this->request->is(['put','post'])) 
		{
			   $motiv = $this->Motivational->patchEntity($motiv, $this->request->data);
			   
			   if(!empty($this->request->data('title')) && empty($this->request->data['video']['tmp_name']) && empty($this->request->data['ppt']['tmp_name']) )
		       {
				   
			     $this->Motivational->save($motiv);
				 $this->Flash->success(__('The element has been saved.'));
				 $this->redirect(['action'=>'index']); 	
		       }

              
			   
               if(!empty($this->request->data['video']['tmp_name']) )
               {
			
					$video1   = $this->request->data('video');
					$name     =$video1['name'];
					$size     =$video1['size'];
					$maxsize  =2097152;
					$ext      = substr(strtolower(strrchr($name, '.')), 1); 
					$arr_ext  = array('mp4','3gp','mkv','flv'); 
					
					if(in_array($ext, $arr_ext))
					{
						 $t=time();
						 $name=$t."_".$video1['name'];
						 $path='video/'.$name;
						 move_uploaded_file($video1['tmp_name'],$path);
						 $motiv['video']=$name;				
						 $this->Motivational->save($motiv);
						 $this->Flash->success(__('The element has been saved.'));
						 $this->redirect(['action'=>'index']);
					}
					else
					{
						$this->Flash->error(__('Error : Only mp4, mkv, 3gp, flv extentions allowed'));
						$this->redirect(array('action' => 'edit',$id));
					}		
			  }
			  
			  
			  if(!empty($this->request->data['ppt']['tmp_name']) )
			  {
				$ppt1   = $this->request->data('ppt');
				$name     =$ppt1['name'];
				$size     =$ppt1['size'];
				$maxsize  =2097152;
				$ext      = substr(strtolower(strrchr($name, '.')), 1); 
				$arr_ext  = array('pptx','ppt','pdf'); 
				
				if(in_array($ext, $arr_ext))
				{
					 $t=time();
					 $name=$t."_".$ppt1['name'];
					 $path='ppt/'.$name;
					 move_uploaded_file($ppt1['tmp_name'],$path);
					 $motiv['ppt']=$name;				
					 $this->Motivational->save($motiv);
					 $this->Flash->success(__('The element has been saved.'));
					 $this->redirect(['action'=>'index']);
				}
				else
				{	
					$this->Flash->error(__('Error : Only pptx, ppt, pdf extentions allowed'));
					$this->redirect(array('action' => 'edit',$id));	
				}
					
			} 
			  
		}   
    }


    public function delete($id=null)
    {
        $this->autoRender = false;
        $this->viewBuilder()->layout('ajax');
        $id      = $this->request->data('id');
        $motiv   = $this->Motivational->get($id);
        if($this->Motivational->delete($motiv))
        {
            echo 1;
        }
    }

    public function chStatus()
    {
        $this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');       // define ajax layout.
        $id           = $this->request->data('id'); // Get id send by ajax request
        $motiv          = $this->Motivational->get($id);    // Fetch data according to id 
        $current_status = $motiv['status'];         // Fetch particular fields
        
           if($current_status==1)
           {
               $motiv['status']=0;
               $this->Motivational->save($motiv); 
               echo "<span id='status_$id'><span class='btn btn-warning btn-xs'><strong>Inactive</strong></span></span>";
           }
           else
           {
               $motiv['status']=1;
               $this->Motivational->save($motiv);
               echo "<span id='status_$id'><span class='btn btn-success btn-xs'><strong>Active</strong></span></span>";
           }
    }


}
?>
