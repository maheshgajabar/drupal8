<?php

namespace Drupal\drupal8\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the drupal8 module.
 */
class PageControllerTest extends WebTestBase {
  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "drupal8 PageController's controller functionality",
      'description' => 'Test Unit for module drupal8 and controller PageController.',
      'group' => 'Other',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests drupal8 functionality.
   */
  public function testPageController() {
    // Check that the basic functions of module drupal8.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via App Console.');
  }

}
