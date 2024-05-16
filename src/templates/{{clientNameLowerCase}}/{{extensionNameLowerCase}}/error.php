<?php

/**
 * @copyright  {{copyright}}
 * @license    {{license}}
 */

defined('_JEXEC') || die();

use Joomla\CMS\HTML\HTMLHelper;

/** @var Joomla\CMS\Document\HtmlDocument $this */
/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */

// Browsers support SVG favicons
$this->addHeadLink(HTMLHelper::_('image', 'favicon.svg', '', [], true, 1), 'icon', 'rel', ['type' => 'image/svg+xml']);
$this->addHeadLink(HTMLHelper::_('image', 'favicon.png', '', [], true, 1), 'icon', 'rel', ['type' => 'image/png']);
$this->setMetaData('description', 'width=device-width, initial-scale=1');

// Register the template assets
$this->getWebAssetManager()->useStyle('template.base');

// Get the output for all the template sections
$component = $this->getBuffer('component');
$header    = $this->getBuffer('modules', 'header', []);
$footer    = $this->getBuffer('modules', 'footer', []);
$debug     = $this->getBuffer('modules', 'debug', []);
$messages  = $this->getBuffer('message');
$metas     = $this->getBuffer('metas');
$styles    = $this->getBuffer('styles');
$scripts   = $this->getBuffer('scripts');

// Render the page
echo
'<!doctype html>',
  '<html lang="' . $this->language . '">',
  '<head>',
    $metas,
    $styles,
    $scripts,
  '</head>',
  '<body>',
    $header,
    '<main class="wrapper">', $messages, $component, $debug, '</main>',
    $footer,
  '</body>',
'</html>';
