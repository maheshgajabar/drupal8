<?php

namespace Drupal\d8_training\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\d8_training\WeatherService;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

/**
 * Provides a 'weather' block.
 *
 * @Block(
 *   id = "weather_block",
 *   admin_label = @Translation("Weather block"),
 * )
 */
class WeatherBlock extends BlockBase implements ContainerFactoryPluginInterface{
  private $owf;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, WeatherService $owf){
  	parent::__construct($configuration, $plugin_id, $plugin_definition);	
  	$this->owf = $owf;
  }

   public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
		return new static(
			$configuration,
			$plugin_id,
			$plugin_definition,
			$container->get('d8_training.weather_service')
		);
	}
  public function blockform($form, FormStateInterface $form_state){
    $form['city-name'] = array(
     '#type' => 'textfield',
     '#title' => 'City Name', 
     '#required' => true,
     '#default_value' => $this->configuration['city-name'],			  
   );
   
   return $form;
  }
  
 public function blockSubmit($form, FormStateInterface $form_state) {
  $this->configuration['city-name'] = $form_state->getValue('city-name');
 }

  public function build(){
  $data = $this->owf->fetchWeatherData($this->configuration['city-name']);
  $header = array("Min Temp","Max Temp","Pressure","Humidity","Wind speed");
  $rows =  array();
  $rows[] = array($data['main']['temp_min'],$data['main']['temp_max'],$data['main']['pressure'],$data['main']['humidity'],$data['wind']['speed']);
   return [
  '#type' => 'table',
  '#header' => $header,
  '#rows' => $rows,
];
   }
}
