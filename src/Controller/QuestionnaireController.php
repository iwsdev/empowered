<?php
// src/Controller/QuestionnaireController.php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;

class QuestionnaireController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->loadModel('Questions');
        $this->loadModel('Importance');
        $this->loadModel('Frequency');
        $this->loadModel('Capability');
    }

    public function index()
    {
       $this->viewBuilder()->layout('top'); 
       $query = $this->Questions->find('all',array('order'=>'Questions.id DESC'));
       $this->set('question',$query);
    }

    public function add()
    {
         $this->viewBuilder()->layout('top');
         if ($this->request->is('post')) 
           {
			   $question = $this->Questions->newEntity();
			   $question = $this->Questions->patchEntity($question, $this->request->data());			   
			   $question['question']  = $this->request->data('question');
			   	//add question 		  
                if($question)
			    {
					$last_id = $this->Questions->save($question);
                    $last_question_id = $last_id->id;  
				} 
				//add importance 
				if($this->request->data('importance'))
				{
					$importancedata   = $this->request->data('importance');
					foreach($importancedata as $imp)
					{
						$importance         = $this->Importance->newEntity();
					    $importance         = $this->Importance->patchEntity($importance, $this->request->data('importance'));
						$importance['importance_name'] = $imp;
						$importance['q_id'] = $last_question_id;							
						$imp_res            = $this->Importance->save($importance);
					}	
				}
				
				//add frequency 
				if($this->request->data('frequency'))
				{
					$frequencydata   = $this->request->data('frequency');					
					foreach($frequencydata as $frequencys)
					{
						$frequency         = $this->Frequency->newEntity();
						$frequency         = $this->Frequency->patchEntity($frequency, $this->request->data('frequency'));
						$frequency['frequency_name'] = $frequencys;
						$frequency['q_id'] = $last_question_id;
					    $frequency_res = $this->Frequency->save($frequency);		
					}	
				}
				
				//add capability 
				if($this->request->data('capability'))
				{
					$capabilitydata   = $this->request->data('capability');					
					foreach($capabilitydata as $cap)
					{
						$capability         = $this->Capability->newEntity();
						$capability         = $this->Capability->patchEntity($capability, $this->request->data('capability'));
						$capability['capability_name'] = $cap;
						$capability['q_id'] = $last_question_id;
					    $capability_res = $this->Capability->save($capability);		
					}	
				}
				$this->redirect(['action'=>'index']);
                $this->Flash->success(__('Question has been added successfully'));
            }    
    }
    
    public function edit($id=null)
    {
         $this->viewBuilder()->layout('top');
         $que        = $this->Questions->get($id);
         $importance = $this->Importance->find('all', ['conditions' => ['Importance.q_id'=>$id]])->all();
         $frequency  = $this->Frequency->find('all',['conditions'=>['Frequency.q_id'=>$id]])->all();
         $capability = $this->Capability->find('all',['conditions'=>['Capability.q_id'=>$id]])->all();
         
         $this->set('question', $que);
         $this->set('importance', $importance);
         $this->set('frequency', $frequency);
         $this->set('capability', $capability);
         
         //  Update Section.
         if ($this->request->is(['post','put'])) 
         {
            $que = $this->Questions->patchEntity($que, $this->request->data);
            $que['question']  = $this->request->data('question');
            
            //Questions.
            if ($que) 
            { 
				 $this->Questions->save($que);
            }
             
            //Importance.            
            if ($this->request->data('importances')) 
            { 
				$importances       = $this->request->data('importances');
				$i_id              = $this->request->data('i_id');
				$finalimportances  = array_combine($i_id,$importances);
				
				foreach($finalimportances as $key=>$imp)
				{
					$importances   = $this->Importance->get($key);
					$importances['importance_name'] = $imp;					
					$this->Importance->save($importances);	
				}	
            }
            
            //Frequencys.            
            if ($this->request->data('frequencys')) 
            { 
				$frequencys      = $this->request->data('frequencys');
				$f_id            = $this->request->data('f_id');
				$finalfrequencys = array_combine($f_id,$frequencys);
				
				foreach($finalfrequencys as $key=>$fre)
				{
					$frequencys   = $this->Frequency->get($key);
					$frequencys['frequency_name'] = $fre;					
					$this->Frequency->save($frequencys);
				}
            }
            
            //Capabilitys.            
            if ($this->request->data('capabilitys')) 
            { 
				$capabilitys      = $this->request->data('capabilitys');
				$c_id        = $this->request->data('c_id');
				$finalcapabilitys = array_combine($c_id,$capabilitys);
				
				foreach($finalcapabilitys as $key=>$cap)
				{
					$capabilitys   = $this->Capability->get($key);
					$capabilitys['capability_name'] = $cap;					
					$this->Capability->save($capabilitys);
				}
            } 
            $this->redirect(['action'=>'index']);
            $this->Flash->success(__('Question has been changes successfully'));        
        } 
    }
    
    public function delete($id=null)
    {
        $this->autoRender = false;
        $this->viewBuilder()->layout('ajax');
        $id = $this->request->data('id');
        $que   = $this->Questions->get($id);
        if($this->Questions->delete($que))
        {
            echo 1;
        }
    }
    
    public function chStatus()
    {
        $this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');      
        $id             = $this->request->data('id'); 
        $quest          = $this->Questions->get($id); 
        $current_status = $quest['status']; 
        
           if($current_status==1)
           {
               $quest['status']=0;
               $this->Questions->save($quest); 
               echo "<span id='status_$id'><span class='btn btn-warning btn-xs'><strong>Inactive</strong></span></span>";
           }
           else
           {
               $quest['status']=1;
               $this->Questions->save($quest);
               echo "<span id='status_$id'><span class='btn btn-success btn-xs'><strong>Active</strong></span></span>";
           }
    }
}
?>
