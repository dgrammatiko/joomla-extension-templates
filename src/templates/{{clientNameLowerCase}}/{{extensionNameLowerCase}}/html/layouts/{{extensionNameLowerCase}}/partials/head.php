<?php

/**
 * @copyright  {{copyright}}
 * @license    {{license}}
 */

defined('_JEXEC') || die();

use Joomla\CMS\Factory;

extract($displayData, EXTR_OVERWRITE);

/** @var Joomla\CMS\Document\HtmlDocument $doc */
/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */

// Browsers support SVG favicons
$doc->addHeadLink('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>⚙️</text></svg>', 'icon', 'rel');
$doc->setMetaData('viewport', 'width=device-width, initial-scale=1');

// Register the template assets
$wa = $doc->getWebAssetManager();
$wa->usePreset('template.base')
  ->useStyle('template.user')
  ->useScript('template.user');

$mediaVersion    = $doc->getMediaVersion();
$templateBaseCss = $wa->getAsset('style', 'template.base');
$templateBaseJs  = $wa->getAsset('script', 'template.base');
$coreJs          = $wa->getAsset('script', 'core');

$doc->getPreloadManager()->preload($templateBaseCss->getUri() . '?' . $mediaVersion, ['as' => 'style', 'crossorigin' => 'anonymous', 'type' => 'text/css']);
$doc->getPreloadManager()->preload($templateBaseJs->getUri() . '?' . $mediaVersion, ['as' => 'script', 'crossorigin' => 'anonymous', 'type' => 'text/javascript']);
$doc->getPreloadManager()->preload($coreJs->getUri() . '?' . $coreJs->getVersion(), ['as' => 'script', 'crossorigin' => 'anonymous', 'type' => 'text/javascript']);
// Detecting Active Variables
$app       = Factory::getApplication();
$input     = $app->getInput();
$option    = $input->getCmd('option', '');
$view      = ' view-' . $input->getCmd('view', '');
$layout    = $input->getCmd('layout', '');
$layout    = $layout ? ' layout-' . $layout : ' layout-default';
$task      = $input->getCmd('task', '');
$task      = $task ? ' task-' . $task : ' task-index';
$itemid    = $input->getCmd('Itemid', '');
$itemid    = $itemid ? ' itemid-' . $itemid : '';
$sitename  = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$menu      = $app->getMenu()->getActive();
$pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';
$pageclass = $pageclass ? ' ' . $pageclass : '';

switch ($entry) {
  case 'index':
    $bodyClass = 'site container ' . $option . $view . $layout . $task . $itemid . $pageclass . ($doc->direction == 'rtl' ? ' rtl' : '');
    break;
  case 'error':
    $bodyClass = 'site error_site container ' . $option . $view . $layout . $task . $itemid . $pageclass . ($doc->direction == 'rtl' ? ' rtl' : '');
    break;
  case 'component':
    $bodyClass = 'container ' . ($doc->direction == 'rtl' ? ' rtl' : '');
    break;
  case 'offline';
  default:
    $bodyClass = 'site container';
    break;
}

$doc->params->set('liveParams', (object) ['htmlAttributes' => ['lang' => $doc->language, 'dir' => $doc->direction], 'bodyAttributes' => ['class' => $bodyClass]]);
