<?php

namespace Drupal\d8_training\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class MyConfigurationForm.
 *
 * @package Drupal\d8_training\Form
 */
class MyConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'd8_training.myconfiguration',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'my_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('d8_training.myconfiguration');
    $form['weather'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Weather'),
      '#description' => $this->t('Weather'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('weather'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('d8_training.myconfiguration')
      ->set('weather', $form_state->getValue('weather'))
      ->save();
  }

}
