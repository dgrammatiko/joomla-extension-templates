<?php

/**
 * @copyright  {{copyright}}
 * @license    {{license}}
 */

defined('_JEXEC') || die();

use Joomla\CMS\Document\Renderer\Html\ModulesRenderer;
use Joomla\CMS\Factory;

echo '<footer class="footer container">' . (new ModulesRenderer(Factory::getDocument()))->render('footer') . '</footer>';
