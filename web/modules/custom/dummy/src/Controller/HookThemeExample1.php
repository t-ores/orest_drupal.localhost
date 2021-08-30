<?php

namespace Drupal\dummy\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Dummy routes.
 */
class HookThemeExample1 extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#title' => $this->t('Dummy Example First hook_theme()!'),
    ];

    $build['our_example'] = [
      '#theme' => 'dummy_example_first',
      '#chache'=>[
        'max-age'=>0,
      ],
    ];

    return $build;
  }

}
