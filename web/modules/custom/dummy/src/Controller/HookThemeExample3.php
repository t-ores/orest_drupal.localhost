<?php

namespace Drupal\dummy\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Dummy routes.
 */
class HookThemeExample3 extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build[] = [
      '#theme' => 'dummy_quote',
      '#quote' => $this->t('It works!'),
    ];

    $build[] = [
      '#theme' => 'dummy_quote',
      '#quote' => $this->t('It works!'),
      '#author' => 'Dries Buytaert',
    ];

    $build[] = [
      '#theme' => 'dummy_quote',
      '#quote' => $this->t('It works!'),
      '#author' => 'Dries Buytaert',
      '#source_title' => 'Homepage',
      '#source_url' => 'https://dri.es/',
      '#year' => '2017',
    ];

    $build[] = [
      '#theme' => 'dummy_quote',
      '#quote' => $this->t('It works!'),
      '#author' => 'Dries Buytaert',
      '#source_title' => 'Local Magazine',
      '#year' => '2018',
    ];

    //var_dump($build);

    return $build;
  }

}
