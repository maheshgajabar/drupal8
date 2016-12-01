<?php

namespace Drupal\d8_training\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class EventManager implements EventSubscriberInterface{

 function __construct(){}

 public static function getSubscribedEvents(){
  $events[KernelEvents::RESPONSE][] = array('addCrossHeaders');
  return $events;
 }

 public function addCrossHeaders(FilterResponseEvent $event){
  $response = $event->getResponse();
  $response->headers->add(['Access-Control-Allow-Origin' => '*']);
 }	
  
}
