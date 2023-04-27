<?php

/**
 * (C) {{copyright}}
 * {{license}}
 */

defined('_JEXEC') || die();

/** @var $app \Joomla\CMS\Application\CMSApplication */
$app
  ->getDocument()
  ->getWebAssetManager()
  ->registerAndUseScript(
    'mod_{{extensionNameLowercase}}.default',
    'mod_{{extensionNameLowercase}}/default.js',
    [],
    ['type' => 'module'],
    ['core']
  )
  ->registerAndUseStyle(
    'mod_{{extensionNameLowercase}}.default',
    'mod_{{extensionNameLowercase}}/default.css',
    [],
    ['media' => 'screen'],
    []
  );

echo '<p class="mod_xxx_js">Hello from the module {{extensionNameLowercase}}</p>';
