<?php

namespace Drupal\druio_migrate\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;
use Drupal\node\NodeInterface;

/**
 * @MigrateSource(
 *   id = "druio_node_question"
 * )
 */
class NodeQuestion extends SqlBase {

  /**
   * {@inheritdoc}
   *
   * IMPORTANT! This method must return single row result, we can't use joins
   * here. Don't edit!
   */
  public function query() {
    $query = $this->select('node', 'n')
      ->fields('n', [
        'nid',
        'type',
        'title',
        'uid',
        'status',
        'created',
        'changed',
      ])
      ->condition('n.status', NodeInterface::PUBLISHED)
      ->condition('n.type', 'question');
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'nid' => $this->t('The primary identifier for a node'),
      'type' => $this->t('The node_type.type of this node'),
      'title' => $this->t('The title of this node, always treated as non-markup plain text'),
      'uid' => $this->t('The users.uid that owns this node; initially, this is the user that created id'),
      'status' => $this->t('Boolean indicating whether the node is published (visible to non-administrators)'),
      'created' => $this->t('The Unix timestamp when the node was created'),
      'changed' => $this->t('The Unix timestamp when the node was most recently saved.'),
      // Custom added fields.
      'body_value' => $this->t('The value of body field'),
      'body_format' => $this->t('The format of body field'),
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'nid' => [
        'type' => 'integer',
        'alias' => 'n',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $nid = $row->getSourceProperty('nid');

    // Body field.
    $body_query = $this->select('field_data_body', 'b')
      ->fields('b', ['body_value', 'body_format'])
      ->condition('entity_type', 'node')
      ->condition('bundle', 'question')
      ->condition('entity_id', $nid)
      ->execute()
      ->fetch();
    $row->setSourceProperty('body_value', $body_query['body_value']);
    $row->setSourceProperty('body_format', $body_query['body_format']);

    // Drupal version.
    $drupal_versions = [
      38 => '8.x',
      37 => '7.x',
      36 => '6.x',
      35 => '5.x',
      33 => '4.7',
      32 => '4.6',
    ];

    $drupal_version_query = $this->select('field_data_field_drupal_version', 'dv')
      ->fields('dv', ['field_drupal_version_tid'])
      ->condition('entity_type', 'node')
      ->condition('bundle', 'question')
      ->condition('entity_id', $nid)
      ->execute()
      ->fetchCol();

    $drupal_versions_array = [];
    foreach ($drupal_version_query as $version) {
      $drupal_versions_array[] = $drupal_versions[$version];
    }
    $row->setSourceProperty('drupal_version', $drupal_versions_array);

    // Project references.
    $project_references_query = $this->select('field_data_field_project_reference', 'pr')
      ->fields('pr', ['field_project_reference_target_id'])
      ->condition('entity_type', 'node')
      ->condition('bundle', 'question')
      ->condition('entity_id', $nid)
      ->execute()
      ->fetch();
    $row->setSourceProperty('project_references', $project_references_query);

    // Question categories.
    $question_categories = $this->select('field_data_field_category', 'c')
      ->fields('c', ['field_category_tid'])
      ->condition('entity_type', 'node')
      ->condition('bundle', 'question')
      ->condition('entity_id', $nid)
      ->execute()
      ->fetch();
    $row->setSourceProperty('question_categories', $question_categories);

    return parent::prepareRow($row);
  }

}
