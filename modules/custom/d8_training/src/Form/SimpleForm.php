<?php

namespace Drupal\d8_training\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Driver\mysql\Connection;
use Drupal\d8_training\FormManager;

class SimpleForm extends FormBase{
  private $form_manager;
  function __construct(FormManager $form_manager){
    $this->form_manager = $form_manager;
  }
   public static function create(ContainerInterface $container){  
    return new static($container->get('d8_training.form_manager'));
  }

  public function getFormId(){
   return 'simpleform';
  }
  public function buildform(array $form, FormStateInterface $form_state){
	 $form['first-name'] = array('#type' => 'textfield','#title' => 'First Name', '#required' => true);
         $form['save'] = array('#type' => 'submit','#value' => 'Save', );
         return $form;
  }
  public function validateForm(array &$form, FormStateInterface $form_state){
    if (strlen($form_state->getValue('first-name') ) < 5){
     $form_state->setErrorByName('first-name','Name should be atleast 5 charecters');
    }
  }
  public function submitForm(array &$form, FormStateInterface $form_state){
$this->form_manager->addData($form_state->getValue('first-name'));
    
  }

}
