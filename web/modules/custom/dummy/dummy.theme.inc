<?php
/**
 * @file
 */

use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * implements template_preprocess_HOOK() for dummy_example_second.
 * @param $variables
 */
function template_preprocess_dummy_example_second(&$variables){
  $list_type = &$variables['list_type'];
  $allowed_list_types = ['ul', 'ol'];

  if (!in_array($list_type, $allowed_list_types)){
    $list_type = 'ul';
  }
}

/**
 * implements template_preprocess_HOOK() for dummy_example_quote.
 * @param $variables
 */
function template_preprocess_dummy_quote(&$variables){
  $variables['source'] = NULL;
  $source = &$variables['source'];

  if ($variables['source_title'] && $variables['source_url']){
    $url = Url::fromUri($variables['source_url'], [
      'attributes' => [
        'target' => '_blank',
        'rel' => 'nofollow',
      ],
    ]);
    $source = Link::fromTextAndUrl($variables['source_title'], $url)->toString();
  }
  elseif ($variables['source_title']){
    $source = $variables['source_title'];
  }
  $footer = [];
  !$variables['author'] ?: $footer[] = $variables['author'];
  !$variables['year'] ?: $footer[] = $variables['year'];
  !$source ?: $footer[] = $source;
  $variables['footer'] = !empty($footer) ? implode(', ', $footer) : FALSE;
}

/**
 * implements template_preprocess_HOOK() for dummy_example_quote.
 * @param $variables
 */
function template_preprocess_contact_message_zakazat_obratnyy_dzvonok_form(&$variables){
  //var_dump($variables);
  $variables['dries_quote'] = [
    '#theme' => 'dummy_quote',
    '#quote' => t('It works!'),
    '#author' => 'Dri.es',
    '#source_title' => 'Homepage',
    '#source_url' => 'https://dri.es/',
    '#year' => '2018',
  ];
}
