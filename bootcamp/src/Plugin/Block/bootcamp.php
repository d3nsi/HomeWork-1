<?php

namespace Drupal\bootcamp\Plugin\Block;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Block\BlockBase;

/**
 * Displays block
 *
 * @Block(
 *   id = "bootcamp_text_box_block",
 *   admin_label = @Translation("Box Block"),
 *   category = @Translation("custom"),
 * )
 */

class bootcamp extends BlockBase
{
  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();


    $block = [
      '#type' => 'markup',
      '#markup' => 'Hello',
    ];

    return $block;
  }

  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();

    $form['image'] = [
      '#type' => 'media_library',
      '#allowed_bundles' => ['image'],
      '#title' => t('Изображение на фон'),
      '#default_value' => !empty($config['image'])
        ? $config['image']
        : [],
      '#weight' => 998,
    ];

    $form['image_over_header'] = [
      '#type' => 'media_library',
      '#allowed_bundles' => ['image'],
      '#title' => t('Изображение над заголовком'),
      '#default_value' => !empty($config['image_over_header'])
        ? $config['image_over_header']
        : [],
      '#weight' => 999,
    ];

    $form['description'] = [
      '#type' => 'textarea',
      '#title' => t('Описание'),
      '#default_value' => !empty($config['description'])
        ? $config['description']
        : [],
    ];

    return $form;
  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['image'] = $form_state->getValue('image');
    $this->configuration['image_over_header'] = $form_state->getValue('image_over_header');
    $this->configuration['description'] = $form_state->getValue('description');

  }
}
