id: 21
name: Ace
description: 'Ace code editor plugin for MODx Revolution'
plugincode: "/**\n * Ace Source Editor Plugin\n *\n * Events: OnManagerPageBeforeRender, OnRichTextEditorRegister, OnSnipFormPrerender,\n * OnTempFormPrerender, OnChunkFormPrerender, OnPluginFormPrerender,\n * OnFileCreateFormPrerender, OnFileEditFormPrerender, OnDocFormPrerender\n *\n * @author Danil Kostin <danya.postfactum(at)gmail.com>\n *\n * @package ace\n */\nif ($modx->event->name == 'OnRichTextEditorRegister') {\n    $modx->event->output('Ace');\n    return;\n}\n\nif ($modx->getOption('which_element_editor', null, 'Ace') !== 'Ace') {\n    return;\n}\n\n$ace = $modx->getService('ace', 'Ace', $modx->getOption('ace.core_path', null, $modx->getOption('core_path').'components/ace/').'model/ace/');\n\n$ace->initialize();\n\n$extensionMap = array(\n    'tpl'   => 'text/html',\n    'htm'   => 'text/html',\n    'html'  => 'text/html',\n    'css'   => 'text/css',\n    'scss'  => 'text/x-scss',\n    'less'  => 'text/x-less',\n    'svg'   => 'image/svg+xml',\n    'xml'   => 'application/xml',\n    'xsl'   => 'application/xml',\n    'js'    => 'application/javascript',\n    'json'  => 'application/json',\n    'php'   => 'application/x-php',\n    'sql'   => 'text/x-sql',\n    'txt'   => 'text/plain',\n);\n\n// Defines wether we should highlight modx tags\n$modxTags = false;\nswitch ($modx->event->name) {\n    case 'OnSnipFormPrerender':\n        $field = 'modx-snippet-snippet';\n        $mimeType = 'application/x-php';\n        break;\n    case 'OnTempFormPrerender':\n        $field = 'modx-template-content';\n        $mimeType = 'text/html';\n        $modxTags = true;\n        break;\n    case 'OnChunkFormPrerender':\n        $field = 'modx-chunk-snippet';\n        if ($modx->controller->chunk && $modx->controller->chunk->isStatic()) {\n            $extension = pathinfo($modx->controller->chunk->getSourceFile(), PATHINFO_EXTENSION);\n            $mimeType = isset($extensionMap[$extension]) ? $extensionMap[$extension] : 'text/plain';\n        } else {\n            $mimeType = 'text/html';\n        }\n        $modxTags = true;\n        break;\n    case 'OnPluginFormPrerender':\n        $field = 'modx-plugin-plugincode';\n        $mimeType = 'application/x-php';\n        break;\n    case 'OnFileCreateFormPrerender':\n        $field = 'modx-file-content';\n        $mimeType = 'text/plain';\n        break;\n    case 'OnFileEditFormPrerender':\n        $field = 'modx-file-content';\n        $extension = pathinfo($scriptProperties['file'], PATHINFO_EXTENSION);\n        $mimeType = isset($extensionMap[$extension]) ? $extensionMap[$extension] : 'text/plain';\n        $modxTags = $extension == 'tpl';\n        break;\n    case 'OnDocFormPrerender':\n        if (!$modx->controller->resourceArray) {\n            return;\n        }\n        $field = 'ta';\n        $mimeType = $modx->getObject('modContentType', $modx->controller->resourceArray['content_type'])->get('mime_type');\n        if ($modx->getOption('use_editor')){\n            $richText = $modx->controller->resourceArray['richtext'];\n            $classKey = $modx->controller->resourceArray['class_key'];\n            if ($richText || in_array($classKey, array('modStaticResource','modSymLink','modWebLink','modXMLRPCResource'))) {\n                $field = false;\n            }\n        }\n\n        $modxTags = true;\n        break;\n    default:\n        return;\n}\n\n$modxTags = json_encode($modxTags);\n$script = \"\";\nif ($field) {\n    $script .= \"MODx.ux.Ace.replaceComponent('$field', '$mimeType', $modxTags);\";\n}\n\nif ($modx->event->name == 'OnDocFormPrerender' && !$modx->getOption('use_editor')) {\n    $script .= \"MODx.ux.Ace.replaceTextAreas(Ext.query('.modx-richtext'));\";\n}\n\nif ($script) {\n    $modx->controller->addHtml('<script>Ext.onReady(function() {' . $script . '});</script>');\n    $modx->controller->addHtml('<style>.ace_editor {width: 100% !important;}</style>');\n}"
properties: null
static: 1
static_file: ace/elements/plugins/ace.plugin.php
content: "/**\n * Ace Source Editor Plugin\n *\n * Events: OnManagerPageBeforeRender, OnRichTextEditorRegister, OnSnipFormPrerender,\n * OnTempFormPrerender, OnChunkFormPrerender, OnPluginFormPrerender,\n * OnFileCreateFormPrerender, OnFileEditFormPrerender, OnDocFormPrerender\n *\n * @author Danil Kostin <danya.postfactum(at)gmail.com>\n *\n * @package ace\n */\nif ($modx->event->name == 'OnRichTextEditorRegister') {\n    $modx->event->output('Ace');\n    return;\n}\n\nif ($modx->getOption('which_element_editor', null, 'Ace') !== 'Ace') {\n    return;\n}\n\n$ace = $modx->getService('ace', 'Ace', $modx->getOption('ace.core_path', null, $modx->getOption('core_path').'components/ace/').'model/ace/');\n\n$ace->initialize();\n\n$extensionMap = array(\n    'tpl'   => 'text/html',\n    'htm'   => 'text/html',\n    'html'  => 'text/html',\n    'css'   => 'text/css',\n    'scss'  => 'text/x-scss',\n    'less'  => 'text/x-less',\n    'svg'   => 'image/svg+xml',\n    'xml'   => 'application/xml',\n    'xsl'   => 'application/xml',\n    'js'    => 'application/javascript',\n    'json'  => 'application/json',\n    'php'   => 'application/x-php',\n    'sql'   => 'text/x-sql',\n    'txt'   => 'text/plain',\n);\n\n// Defines wether we should highlight modx tags\n$modxTags = false;\nswitch ($modx->event->name) {\n    case 'OnSnipFormPrerender':\n        $field = 'modx-snippet-snippet';\n        $mimeType = 'application/x-php';\n        break;\n    case 'OnTempFormPrerender':\n        $field = 'modx-template-content';\n        $mimeType = 'text/html';\n        $modxTags = true;\n        break;\n    case 'OnChunkFormPrerender':\n        $field = 'modx-chunk-snippet';\n        if ($modx->controller->chunk && $modx->controller->chunk->isStatic()) {\n            $extension = pathinfo($modx->controller->chunk->getSourceFile(), PATHINFO_EXTENSION);\n            $mimeType = isset($extensionMap[$extension]) ? $extensionMap[$extension] : 'text/plain';\n        } else {\n            $mimeType = 'text/html';\n        }\n        $modxTags = true;\n        break;\n    case 'OnPluginFormPrerender':\n        $field = 'modx-plugin-plugincode';\n        $mimeType = 'application/x-php';\n        break;\n    case 'OnFileCreateFormPrerender':\n        $field = 'modx-file-content';\n        $mimeType = 'text/plain';\n        break;\n    case 'OnFileEditFormPrerender':\n        $field = 'modx-file-content';\n        $extension = pathinfo($scriptProperties['file'], PATHINFO_EXTENSION);\n        $mimeType = isset($extensionMap[$extension]) ? $extensionMap[$extension] : 'text/plain';\n        $modxTags = $extension == 'tpl';\n        break;\n    case 'OnDocFormPrerender':\n        if (!$modx->controller->resourceArray) {\n            return;\n        }\n        $field = 'ta';\n        $mimeType = $modx->getObject('modContentType', $modx->controller->resourceArray['content_type'])->get('mime_type');\n        if ($modx->getOption('use_editor')){\n            $richText = $modx->controller->resourceArray['richtext'];\n            $classKey = $modx->controller->resourceArray['class_key'];\n            if ($richText || in_array($classKey, array('modStaticResource','modSymLink','modWebLink','modXMLRPCResource'))) {\n                $field = false;\n            }\n        }\n\n        $modxTags = true;\n        break;\n    default:\n        return;\n}\n\n$modxTags = json_encode($modxTags);\n$script = \"\";\nif ($field) {\n    $script .= \"MODx.ux.Ace.replaceComponent('$field', '$mimeType', $modxTags);\";\n}\n\nif ($modx->event->name == 'OnDocFormPrerender' && !$modx->getOption('use_editor')) {\n    $script .= \"MODx.ux.Ace.replaceTextAreas(Ext.query('.modx-richtext'));\";\n}\n\nif ($script) {\n    $modx->controller->addHtml('<script>Ext.onReady(function() {' . $script . '});</script>');\n    $modx->controller->addHtml('<style>.ace_editor {width: 100% !important;}</style>');\n}"

-----

/**
 * Ace Source Editor Plugin
 *
 * Events: OnManagerPageBeforeRender, OnRichTextEditorRegister, OnSnipFormPrerender,
 * OnTempFormPrerender, OnChunkFormPrerender, OnPluginFormPrerender,
 * OnFileCreateFormPrerender, OnFileEditFormPrerender, OnDocFormPrerender
 *
 * @author Danil Kostin <danya.postfactum(at)gmail.com>
 *
 * @package ace
 */
if ($modx->event->name == 'OnRichTextEditorRegister') {
    $modx->event->output('Ace');
    return;
}

if ($modx->getOption('which_element_editor', null, 'Ace') !== 'Ace') {
    return;
}

$ace = $modx->getService('ace', 'Ace', $modx->getOption('ace.core_path', null, $modx->getOption('core_path').'components/ace/').'model/ace/');

$ace->initialize();

$extensionMap = array(
    'tpl'   => 'text/html',
    'htm'   => 'text/html',
    'html'  => 'text/html',
    'css'   => 'text/css',
    'scss'  => 'text/x-scss',
    'less'  => 'text/x-less',
    'svg'   => 'image/svg+xml',
    'xml'   => 'application/xml',
    'xsl'   => 'application/xml',
    'js'    => 'application/javascript',
    'json'  => 'application/json',
    'php'   => 'application/x-php',
    'sql'   => 'text/x-sql',
    'txt'   => 'text/plain',
);

// Defines wether we should highlight modx tags
$modxTags = false;
switch ($modx->event->name) {
    case 'OnSnipFormPrerender':
        $field = 'modx-snippet-snippet';
        $mimeType = 'application/x-php';
        break;
    case 'OnTempFormPrerender':
        $field = 'modx-template-content';
        $mimeType = 'text/html';
        $modxTags = true;
        break;
    case 'OnChunkFormPrerender':
        $field = 'modx-chunk-snippet';
        if ($modx->controller->chunk && $modx->controller->chunk->isStatic()) {
            $extension = pathinfo($modx->controller->chunk->getSourceFile(), PATHINFO_EXTENSION);
            $mimeType = isset($extensionMap[$extension]) ? $extensionMap[$extension] : 'text/plain';
        } else {
            $mimeType = 'text/html';
        }
        $modxTags = true;
        break;
    case 'OnPluginFormPrerender':
        $field = 'modx-plugin-plugincode';
        $mimeType = 'application/x-php';
        break;
    case 'OnFileCreateFormPrerender':
        $field = 'modx-file-content';
        $mimeType = 'text/plain';
        break;
    case 'OnFileEditFormPrerender':
        $field = 'modx-file-content';
        $extension = pathinfo($scriptProperties['file'], PATHINFO_EXTENSION);
        $mimeType = isset($extensionMap[$extension]) ? $extensionMap[$extension] : 'text/plain';
        $modxTags = $extension == 'tpl';
        break;
    case 'OnDocFormPrerender':
        if (!$modx->controller->resourceArray) {
            return;
        }
        $field = 'ta';
        $mimeType = $modx->getObject('modContentType', $modx->controller->resourceArray['content_type'])->get('mime_type');
        if ($modx->getOption('use_editor')){
            $richText = $modx->controller->resourceArray['richtext'];
            $classKey = $modx->controller->resourceArray['class_key'];
            if ($richText || in_array($classKey, array('modStaticResource','modSymLink','modWebLink','modXMLRPCResource'))) {
                $field = false;
            }
        }

        $modxTags = true;
        break;
    default:
        return;
}

$modxTags = json_encode($modxTags);
$script = "";
if ($field) {
    $script .= "MODx.ux.Ace.replaceComponent('$field', '$mimeType', $modxTags);";
}

if ($modx->event->name == 'OnDocFormPrerender' && !$modx->getOption('use_editor')) {
    $script .= "MODx.ux.Ace.replaceTextAreas(Ext.query('.modx-richtext'));";
}

if ($script) {
    $modx->controller->addHtml('<script>Ext.onReady(function() {' . $script . '});</script>');
}