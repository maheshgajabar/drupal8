<?php

namespace Drupal\d8_training;
use \Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Driver\mysql\Connection;
use \Drupal\node\Entity\NodeType;
use Drupal\Core\Routing\UrlGeneratorTrait;
use Drupal\Core\StringTranslation\StringTranslationTrait;


class NodeListingPermissions extends ControllerBase {
  public function getPermissions(){
   $types =  NodeType::loadMultiple();
  $permissions = array();
   foreach ($types as $type){
    $permissions[
      "access ". $type->get('name') ."content"] = array(
        'title' => 'access training content for ' . $type->get('name'),
      );


   }
return $permissions;
  }
}
