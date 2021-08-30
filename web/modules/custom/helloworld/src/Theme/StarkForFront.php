<?php

namespace Drupal\helloworld\Theme;

use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Theme\ThemeNegotiatorInterface;
use Drupal\Core\Path\PathMatcherInterface;

/**
 * Sets the Stark for frontpage.
 */
class StarkForFront implements ThemeNegotiatorInterface {

  /**
   * @var \Drupal\Core\Path\PathMatcherInterface
   */
  protected $pathMatcher;

  /**
   * StarkForFront constructor.
   * @param \Drupal\Core\Path\PathMatcherInterface $pathMatcher
   */
  public function __construct(PathMatcherInterface $pathMatcher) {
    $this->pathMatcher = $pathMatcher;
  }

  /**
   * {@inheritdoc}
   */
//  public function applies(RouteMatchInterface $routeMatch) {
//    return $this->pathMatcher->isFrontPage();
//  }
  public function applies(RouteMatchInterface $route_match) {
    if ($route_match->getRouteName() == 'entity.node.canonical') {
      $node = $route_match->getParameter('node');
      if ($node->bundle() == 'NODE_TYPE') {
        return TRUE;
      }
    }
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function determineActiveTheme(RouteMatchInterface $routeMatch) {
    # Машинное имя темы, которую необходимо активировать.
    //return 'drupalbook';
    return 'stark';
  }
}
