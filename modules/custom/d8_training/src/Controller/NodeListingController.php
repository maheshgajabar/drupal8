<?php

namespace Drupal\d8_training\Controller;
use \Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class NodeListingController extends ControllerBase {
  public function content(){
	return array(
	 '#theme' => "item_list",
	'#items' => array(1,2)
    );
  }
 public function listing(NodeInterface $node){

	return new JsonResponse($node);
  }
}
