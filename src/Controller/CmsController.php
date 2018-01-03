<?php
// src/Controller/CmsController.php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;

class CmsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->loadModel('Cms');
    }

    public function index()
    {
        $this->viewBuilder()->layout('top'); 
        $this->set('cms',$this->Cms->find('all',array('order'=>'Cms.id DESC')));
    }

    public function add()
    {
         $this->viewBuilder()->layout('top'); 
         $cms = $this->Cms->newEntity();
         if($this->request->is('post'))
         {
            $cms = $this->Cms->patchEntity($cms,$this->request->data());
            $slugname  = $this->request->data('name');
            $cms['name'] = str_replace(' ','-',strtolower($cms['name']));
            
            if($this->Cms->save($cms))
            {
               $this->Flash->success(__("Content added successfully."));
               $this->redirect(['action'=>'index']);
            }
         }
    }

    public function edit($id=null)
    {
         $this->viewBuilder()->layout('top');
         $cms = $this->Cms->get($id);
         $this->set('cms', $cms);
    }

    public function update($id=null)
    {
        $id           = $this->request->data('id');
        $cms          = $this->Cms->get($id); 
        $cms['title'] = $this->request->data['title'];
        $slugname     = $this->request->data['name'];
        $cms['name']  = str_replace(' ','-',strtolower($slugname)); 
        $cms['contents']  = $this->request->data['contents'];
        if($this->Cms->save($cms))
        {
            $this->Flash->success(__("Contents updated successfully."));
            $this->redirect(['action'=>'index']);
        }
    }

    public function delete($id=null)
    {
        $this->autoRender = false;
        $this->viewBuilder()->layout('ajax');
        $id = $this->request->data('id');
        $cms   = $this->Cms->get($id);
        if($this->Cms->delete($cms))
        {
            echo 1;
        }
    }

    public function chStatus()
    {
        $this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');   
        $id           = $this->request->data('id');
        $cms          = $this->Cms->get($id);    
        $current_status = $cms['status'];    
        
           if($current_status==1)
           {
               $cms['status']=0;
               $this->Cms->save($cms); 
               echo "<span id='status_$id'><span class='btn btn-warning btn-xs'><strong>Inactive</strong></span></span>";
           }
           else
           {
               $cms['status']=1;
               $this->Cms->save($cms);
               echo "<span id='status_$id'><span class='btn btn-success btn-xs'><strong>Active</strong></span></span>";
           }
    }
}
?>
