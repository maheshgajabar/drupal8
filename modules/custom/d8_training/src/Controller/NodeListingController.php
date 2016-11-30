<?php

namespace Drupal\d8_training\Controller;
use \Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Driver\mysql\Connection;

class NodeListingController extends ControllerBase {
  private $connection;
  function __construct(Connection $connection){
    $this->connection = $connection;
  }
  public function content(){
  $query = $this->connection->select('node', 'n')
    ->fields('n', array('nid', 'vid'))
    ->execute()->fetchAll();
    $rows =  array();
  foreach($query as $result){
    $rows[] = array($result->nid,$result->vid);
   }
$header = array("nid","vid");
  	/*return array(
	 '#theme' => "item_list",
	'#items' => array(1,2)
    );*/
  return [
  '#type' => 'table',
  '#header' => $header,
  '#rows' => $rows,
];
  }
 public function listing(NodeInterface $node){
	return new JsonResponse($node);
  }
 public static function create(ContainerInterface $container){
  
  return new static($container->get('database'));

 }
}
