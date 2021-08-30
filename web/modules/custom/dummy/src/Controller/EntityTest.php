<?php

/**
 * @file
 * Contains \Drupal\dummy\Controller\EntityTest.
 */
namespace Drupal\dummy\Controller;

use Drupal\Core\Controller\ControllerBase;
use \Drupal\node\Entity\Node;

class EntityTest extends ControllerBase{

public function build(){
  $node = Node::create(['type' => 'page',
    'title' => 'New Node',
    'body' => [['value' => '<p>Hello World</p>',
      'summary' => '',
      'format' => 'full_html',]]]);
  $node->save();

  $build['content'] = [
//    '#title' => $node->getTitle(),
    '#title' => $this->t($node->getTitle()),
  ];

//  $build['our_example'] = [
//    '#theme' => 'dummy_example_first',
//    '#chache'=>[
//      'max-age'=>0,
//    ],
//  ];

  Node::load($node->id());
  return $build;

}

}
