<?php

namespace Drupal\dummy\Plugin\DsField;

use Drupal\ds\Plugin\DsField\DsFieldBase;
use Drupal\Component\Render\FormattableMarkup;

/**
* Поле которое выводит количество слов в содержимом.
 *
 * @DsField(
 *   id = "word_count",
 *   title = @Translation("DS: Word count"),
 *   provider = "dummy",
 *   entity_type = "node",
 *   ui_limit = {"article|full"}
 * )
 */
class WordCount extends DsFieldBase {
  /**
   * {@inheritdoc}
   *
   * Метод который должен вернуть результат для поля.
   */
  public function build() {
    // Записываем для удобства объект текущей сущности в переменную.
    $entity = $this->entity();
    // Проверяем есть ли значение в поле body. Если поле ничего не вернет
    // это воспринимается как пустое поле и оно не выводится.
    if ($body_value = $entity->body->value) {
      return [
        '#type' => 'markup',
        '#markup' => new FormattableMarkup(
          '<strong>Количество слов в тексте:</strong> @word_count',
          [
            '@word_count' => str_word_count(strip_tags($body_value))
          ]
        )
      ];
    }
  }

}
