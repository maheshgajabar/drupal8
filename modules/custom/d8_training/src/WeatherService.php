<?php

namespace Drupal\d8_training;

use Drupal\Core\Config\ConfigFactory;
use GuzzleHttp\Client;
use Drupal\Component\Serialization\Json;

class WeatherService{

	private $config_factory;
	private $http_client;
	protected $app_id;

	public function __construct(ConfigFactory $config_factory, Client $http_client){
		$this->config_factory = $config_factory;
		$this->http_client = $http_client;
	}

	public function fetchWeatherData($city){
		$this->app_id = $this->config_factory->get('d8_training.myconfiguration')->get('app-id');
		$args[] =  "http://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=".$this->app_id;
		$method = "GET";
		$data = $this->http_client->__call($method,$args);         	
		$data = $data->getBody()->getContents();
		$data = Json::decode($data);
/*		
print "Min Temp ";print_r($data['main']['temp_min']).print "<br/>";
print "Max Temp ";print_r($data['main']['temp_max']).print "<br/>";
print "Pressure ";print_r($data['main']['pressure']).print "<br/>";
print "Humidity ";print_r($data['main']['humidity']).print "<br/>";
print "Wind ";print_r($data['wind']['speed']).print "<br/>";*/

		return $data;
	}


  
}
