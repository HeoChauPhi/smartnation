<?php

/**
 * @file
 * Contains \Drupal\node_reference_block\Plugin\Block\NodeReferenceBlock.
 */

namespace Drupal\node_reference_block\Plugin\Block;

use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Entity\EntityManager;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'Node Reference' block.
 *
 * Drupal\Core\Block\BlockBase gives us a very useful set of basic functionality
 * for this configurable block. We can just fill in a few of the blanks with
 * defaultConfiguration(), blockForm(), blockSubmit(), and build().
 *
 * @Block(
 *   id = "node_reference_block",
 *   admin_label = @Translation("Node Reference"),
 *   category = @Translation("Wondrous")
 * )
 */
class NodeReferenceBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Entity\EntityManager definition.
   *
   * @var \Drupal\Core\Entity\EntityManager
   */
  protected $entity_manager;

  /**
   * @var array
   */
  private $view_modes = [];

  /**
   * @var string
   */
  private $default_view_mode = 'default';

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheContexts() {
    return [
      'user',
      'languages',
      'route',
    ];
  }

  /**
   * Construct.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\Core\Entity\EntityManager $entity_manager
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    EntityManager $entity_manager
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entity_manager = $entity_manager;
    $this->view_modes = $this->entity_manager->getViewModeOptions('node');
  }

  /**
   * {@inheritdoc}
   */
  public static function create(
    ContainerInterface $container,
    array $configuration,
    $plugin_id,
    $plugin_definition
  ) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {

    $node = $this
      ->entity_manager
      ->getStorage('node')
      ->load($this->configuration['block_node_id']);


    $form['block_node_id'] = array(
      '#type' => 'entity_autocomplete',
      '#target_type' => 'node',
      '#title' => t('Node to be rendered'),
      '#required' => TRUE,
      '#description' => t('Give the node to be rendered.'),
      '#default_value' => $node,
    );

    $form['block_node_view_mode'] = array(
      '#type' => 'select',
      '#title' => t('View Mode'),
      '#required' => TRUE,
      '#options' => $this->view_modes,
      '#default_value' => $this->configuration['block_node_view_mode'],
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {

    $this->configuration['block_node_id'] = (int) $form_state->getValue('block_node_id');

    $this->setViewMode($form_state->getValue('block_node_view_mode'));
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $node = $this
      ->entity_manager
      ->getStorage('node')
      ->load($this->configuration['block_node_id']);

    if (!$node) {
      return '';
    }

    $this->setViewMode($this->configuration['block_node_view_mode']);
    $view_builder = $this->entity_manager->getViewBuilder('node');

    return $view_builder->view(
      $node,
      $this->configuration['block_node_view_mode']
    );
  }

  /**
   * check the possible node view modes and set with the given one.
   *
   * @param string $targetViewMode
   */
  private function setViewMode($targetViewMode) {
    $view_modes = array_keys($this->entity_manager->getViewModeOptions('node'));

    if (in_array($targetViewMode, $view_modes)) {
      $this->configuration['block_node_view_mode'] = $targetViewMode;

      return;
    }

    // else update view_modes
    $this->view_modes = $this->entity_manager->getViewModeOptions('node');
    $this->configuration['block_node_view_mode'] = $this->default_view_mode;
  }


}
