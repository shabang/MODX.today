<?php
$xpdo_meta_map['cbLayout']= array (
  'package' => 'contentblocks',
  'version' => '1.1',
  'table' => 'contentblocks_layout',
  'fields' => 
  array (
    'name' => NULL,
    'description' => NULL,
    'sortorder' => 0,
    'icon' => '',
    'icon_type' => 'core',
    'columns' => NULL,
    'template' => NULL,
    'availability' => NULL,
    'times_per_page' => NULL,
    'layout_only_nested' => 0,
    'settings' => NULL,
  ),
  'fieldMeta' => 
  array (
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'description' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '1024',
      'phptype' => 'string',
      'null' => true,
    ),
    'sortorder' => 
    array (
      'dbtype' => 'int',
      'precision' => '5',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'icon' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'icon_type' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => 'core',
    ),
    'columns' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
    ),
    'template' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
    ),
    'availability' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'times_per_page' => 
    array (
      'dbtype' => 'int',
      'precision' => '5',
      'phptype' => 'integer',
      'null' => true,
    ),
    'layout_only_nested' => 
    array (
      'dbtype' => 'bool',
      'phptype' => 'bool',
      'null' => true,
      'default' => 0,
    ),
    'settings' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
  ),
);
