<?php

namespace Drupal\d8_training\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Driver\mysql\Connection;
use Drupal\d8_training\NodesListManager;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;



/**
 * Provides a 'NodeArticlesList' block.
 *
 * @Block(
 *  id = "node_articles_list",
 *  admin_label = @Translation("Node articles list"),
 * )
 */
class NodeArticlesList extends BlockBase implements ContainerFactoryPluginInterface{
  private $nodes_list_manager;
  
  public function __construct(array $configuration, $plugin_id, $plugin_definition, NodesListManager $nodes_list_manager){
  	parent::__construct($configuration, $plugin_id, $plugin_definition);	
  	$this->nodes_list_manager = $nodes_list_manager;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
		return new static(
			$configuration,
			$plugin_id,
			$plugin_definition,
			$container->get('d8_training.nodes_list_manager')
		);
	}

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $data = $this->nodes_list_manager->fetchData();
 $output = "";
    foreach($data['title'] as $result){
     $output .= " ". $result;
   } 

   foreach($data['nid'] as $nodes){
     $nids[] = "node:". $nodes;
   } 
    $user = \Drupal::currentUser()->getEmail();
    $output .= "<br/>Current user email: ".$user;
    $build['node_articles_list']['#markup'] = $output;  
    $build['node_articles_list']['#cache']['contexts'] = array('user');  
    $build['node_articles_list']['#cache']['tags']= array('node_list');
    return $build;
  }

}
