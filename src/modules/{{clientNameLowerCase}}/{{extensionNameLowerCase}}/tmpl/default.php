<?php

/**
 * @copyright  {{copyright}}
 * @license    {{license}}
 */

defined('_JEXEC') || die();

use Joomla\CMS\Uri\Uri;

/** @var $app \Joomla\CMS\Application\CMSApplication */
$app->getDocument()->getWebAssetManager()
  ->useScript('mod_{{extensionNameLowerCase}}.index', [], ['type' => 'module'], ['core'])
  ->useStyle('mod_{{extensionNameLowerCase}}.index', [], ['media' => 'screen'], []);

/**
 * Passing variables from PHP to JavaScript can be done in two ways:
 * - Using data attributes on the HTML element
 * - Using the Joomla.options API
 *
 * Language strings can be passed to JavaScript using the Joomla.language API, ie Text::script('COM_MYCOMPONENT_MYSTRING')
 *
 * DO NOT CONSTRUCT JS INLINE IN PHP FILES! it's a major anti-pattern!
 */

$dataUrl = Uri::base() . 'index.php?option=com_ajax&format=json&module=test&method=test&1=' . $app->getSession()->getFormToken();

echo '<br><hr><p><button class="btn btn-primary mod_testajax" data-url="' . $dataUrl . '">Test module test AJAX</button></p><hr><br>';
