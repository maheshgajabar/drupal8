<?php

namespace Drupal\d8_training;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Routing\Access\AccessInterface;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Driver\mysql\Connection;


class FormManager {  
  private $connection;
  function __construct(Connection $connection){
    $this->connection = $connection;
  }
   public static function create(ContainerInterface $container){  
    return new static($container->get('database'));
  }
   public function fetchData(){  
    $query = $this->connection->select('mytable', 'm')
    ->fields('m', array('name'))
    ->execute()->fetchAll();
    $rows =  array();
    foreach($query as $result){
    $rows[] = array($result->name);
   }
  }
  public function addData($name){  
    $query = $this->connection->insert('mytable')
    ->fields(array('name' => $name))
    ->execute();
    
  }
}
