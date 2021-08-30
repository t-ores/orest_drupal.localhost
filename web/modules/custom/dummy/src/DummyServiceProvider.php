<?php

namespace Drupal\dummy;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;

/**
 * Class DummyServiceProvider
 *
 * @package Drupal\dummy
 */
class DummyServiceProvider extends ServiceProviderBase {

  /**
   * {@inheritdoc}
   */
  /*
  public function alter(ContainerBuilder $container) {
    // Получаем обьявление сервиса.
    $definition = $container->getDefinition('dummy.random_message');
    // Устанавливаем новое значение для 'class'.
    $definition->setClass('Drupal\dummy\RandomMessageGenerator');
  }*/

}
