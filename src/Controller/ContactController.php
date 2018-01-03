<?php
// src/Controller/ContactController.php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;

class ContactController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->loadModel('Contact');
    }

    public function index()
    {
        $this->viewBuilder()->layout('top'); 
        $this->set('contact',$this->Contact->find('all',array('order'=>'Contact.id DESC')));
    }
}
?>
