<?php

/**
 * @copyright  {{copyright}}
 * @license    {{license}}
 */

defined('_JEXEC') || die();

use Joomla\CMS\Router\Route;

/** @var $app \Joomla\CMS\Application\CMSApplication */
$app->getDocument()->getWebAssetManager()->useScript(
  'mod_{{extensionNameLowerCase}}.index',
  [],
  ['type' => 'module'],
  ['core']
)->useStyle(
  'mod_{{extensionNameLowerCase}}.index',
  [],
  ['media' => 'screen'],
  []
);

$dataUrl = Route::_('index.php?option=com_ajax&format=json&module={{extensionNameLowerCase}}&method=test&1=' . $app->getSession()->getFormToken(), false, Route::TLS_IGNORE, true);

echo '<br><hr><p><button class="btn btn-primary mod_testajax" data-url="' . $dataUrl . '">Test module {{extensionNameLowerCase}} AJAX</button></p><hr><br>';
