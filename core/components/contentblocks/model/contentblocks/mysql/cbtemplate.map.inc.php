<?php
$xpdo_meta_map['cbTemplate']= array (
  'package' => 'contentblocks',
  'version' => '1.1',
  'table' => 'contentblocks_template',
  'fields' => 
  array (
    'name' => NULL,
    'description' => NULL,
    'sortorder' => 0,
    'icon' => NULL,
    'icon_type' => NULL,
    'content' => NULL,
    'availability' => NULL,
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
    ),
    'icon_type' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'content' => 
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
  ),
);
