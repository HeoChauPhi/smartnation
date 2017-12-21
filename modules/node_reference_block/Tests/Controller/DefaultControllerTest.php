<?php

/**
 * @file
 * Contains Drupal\node_reference_block\Tests\DefaultController.
 */

namespace Drupal\node_reference_block\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the node_reference_block module.
 */
class DefaultControllerTest extends WebTestBase {
  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "node_reference_block DefaultController's controller functionality",
      'description' => 'Test Unit for module node_reference_block and controller DefaultController.',
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
   * Tests node_reference_block functionality.
   */
  public function testDefaultController() {
    // Check that the basic functions of module node_reference_block.
    $this->assertEqual(TRUE, TRUE, 'Test Unit Generated via App Console.');
  }

}
