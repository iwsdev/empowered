<?php
// src/Controller/ReflectionController.php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;

class ReflectionController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->loadModel('Reflection');
        $this->loadModel('Users');
    }

    public function index()
    {
        $this->viewBuilder()->layout('top'); 
        $ref = $this->Reflection->find('all',array('order'=>'Reflection.id DESC','fields' => array('Users.name','Reflection.photo','Reflection.type','Reflection.title','Reflection.date','Reflection.id','Reflection.description',
        'Reflection.status','Reflection.user_id')))
        ->join([
			'Users' => [
			'table' => 'users',
			'type' => 'INNER',
			'conditions' => 'Users.id = Reflection.user_id'
			 ]
        ]);
        $this->set('ref',$ref);
    }
    
    public function chStatus()
    {
        $this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');   
        $id             = $this->request->data('id');
        $intro          = $this->Reflection->get($id);    
        $current_status = $intro['status'];    
        
           if($current_status==1)
           {
               $intro['status']=0;
               $this->Reflection->save($intro); 
               echo "<span id='status_$id'><span class='btn btn-warning btn-xs'><strong>Inactive</strong></span></span>";
           }
           else
           {
               $intro['status']=1;
               $this->Reflection->save($intro);
               echo "<span id='status_$id'><span class='btn btn-success btn-xs'><strong>Active</strong></span></span>";
           }
    }
}
?>
