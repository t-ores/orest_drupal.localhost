<?php
/**
 * @return
 * Contains \Drupal\custom_owlcarousel\Controller\FirstPageController.
 */
namespace Drupal\custom_owlcarousel\Controller;
/**
 * Provides route responses for the DrupalBook module.
 */
class FirstPageController
{
  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function content() {
//    $html = '<h1>Hello World!</h1>';
//    return array(
//      '#markup' => $html,
//    );
    return array();
  }
  public function privateContent(){
    $element = array(
      '#title' => 'Private content',
    );
    return $element;
  }

}

