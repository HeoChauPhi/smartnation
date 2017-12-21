<?php

// Plugin definition
$plugin = array(
  'title'     => t('Home Layout'),
  'category'  => t('Theme Layouts'),
  'icon'      => 'homelayout.png',
  'theme'     => 'homelayout',
  'regions'   => array(
    'contenttop'    => t('Content Top'),
    'contentright'  => t('Content Right'),
    'contentleft'   => t('Content Left'),
    'contentmiddle' => t('Content Middle'),
    'colfirst'      => t('Column First'),
    'colseccond'    => t('Column Seccond'),
    'colthird'      => t('Column Third'),
    'contentbottom' => t('Content Bottom'),
  ),
);
