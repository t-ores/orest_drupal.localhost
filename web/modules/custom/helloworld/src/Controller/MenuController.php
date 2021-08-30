<?php
/**
 * @file
 * Contains \Drupal\helloworld\Controller\MenuController.
 */

namespace Drupal\helloworld\Controller;

use Drupal\Component\Utility\Html;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Console\Bootstrap\Drupal;
use Drupal\Core\Menu\MenuTreeParameters;

class MenuController extends MenuTreeParameters{

  function drupal_render(&$elements, $is_recursive_call = FALSE) {
    return \Drupal::service('renderer')
      ->render($elements, $is_recursive_call);
  }

  public function MyMenu(){

    $menu_tree_parameters = new MenuTreeParameters();
    $tree = \Drupal::menuTree()->load('main', $menu_tree_parameters);
    $tree_array = \Drupal::menuTree()->build($tree);
    // Меняем тему на нашу.
    $tree_array['#theme'] = 'my_custom_menu_template';
    $menu = self::drupal_render($tree_array);


    //var_dump($menu);
    //echo $menu; // вывод.

    return Response::create($menu);
    // return; // вывод.
  }
}
