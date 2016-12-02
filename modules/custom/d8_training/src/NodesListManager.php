<?php

namespace Drupal\d8_training;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Driver\mysql\Connection;

class NodesListManager{

  private $connection;

  function __construct(Connection $connection){
    $this->connection = $connection;
  }

  public static function create(ContainerInterface $container){  
    return new static($container->get('database'));
  }

  public function fetchData(){  
    $query = \Drupal::database()->select('node_field_data', 'nfd');
$query->fields('nfd', ['nid','title']);
$query->condition('nfd.langcode', 'en');
$articles = $query->range(0,3)->execute()->fetchAll();
 foreach($articles as $result){
$output['title'][]= $result->title;
  $output['nid'][] = $result->nid;
   } 
return $output;
}

  
}
