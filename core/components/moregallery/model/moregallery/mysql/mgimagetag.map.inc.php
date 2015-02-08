<?php
$xpdo_meta_map['mgImageTag']= array (
  'package' => 'moregallery',
  'version' => '1.1',
  'table' => 'moregallery_image_tag',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'resource' => NULL,
    'image' => NULL,
    'tag' => NULL,
  ),
  'fieldMeta' => 
  array (
    'resource' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'int',
      'null' => false,
    ),
    'image' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'int',
      'null' => false,
    ),
    'tag' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'int',
      'null' => false,
    ),
  ),
  'indexes' => 
  array (
    'resource' => 
    array (
      'alias' => 'resource',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'resource' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'image' => 
    array (
      'alias' => 'image',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'image' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'tag' => 
    array (
      'alias' => 'tag',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'tag' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'aggregates' => 
  array (
    'Resource' => 
    array (
      'class' => 'mgResource',
      'local' => 'resource',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'Image' => 
    array (
      'class' => 'mgImage',
      'local' => 'image',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'Tag' => 
    array (
      'class' => 'mgTag',
      'local' => 'tag',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
