<?php

namespace Drupal\dummy\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Dummy routes.
 */
class HookThemeExample2 extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#theme' => 'dummy_example_second',
      '#list_type' => 'ul',
      '#items' =>[
        'Hello World!',
        'Hello Drupal!',
      ],
    ];

    return $build;
  }

}
