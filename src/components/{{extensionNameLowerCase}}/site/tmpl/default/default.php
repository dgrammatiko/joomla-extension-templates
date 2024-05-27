<?php

/**
 * @copyright  {{copyright}}
 * @license    {{license}}
 */

defined('_JEXEC') || die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

$app    = Factory::getApplication();
$params = $app->getParams();
$title  = $params->get('page_title', '');

if (empty($title)) {
  $title = $app->get('sitename');
} elseif ($app->get('sitename_pagetitles', 0) == 1) {
  $title = Text::sprintf('JPAGETITLE', $app->get('sitename'), $title);
} elseif ($app->get('sitename_pagetitles', 0) == 2) {
  $title = Text::sprintf('JPAGETITLE', $title, $app->get('sitename'));
}

$this->document->setTitle($title);

if ($params->get('menu-meta_description')) {
  $this->document->setDescription($params->get('menu-meta_description'));
} else {
  $this->document->setDescription($app->get('MetaDescription'));
}

if ($params->get('robots')) {
  $this->document->setMetaData('robots', $params->get('robots'));
}

echo '<h1>Hello world from com_{{extensionNameLowerCase}}</h1>';
