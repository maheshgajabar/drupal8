<?php

namespace Drupal\drupal8\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class PageController.
 *
 * @package Drupal\drupal8\Controller
 */
class PageController extends ControllerBase {
  /**
   * Test_controller.
   *
   * @return string
   *   Return Hello string.
   */
  public function Test_Controller() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: Test_Controller')
    ];
  }

}
