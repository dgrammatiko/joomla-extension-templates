<?php

/**
 * @copyright  {{copyright}}
 * @license    {{license}}
 */

defined('_JEXEC') || die();

use Joomla\CMS\Layout\LayoutHelper;

$file = basename(__FILE__, '.php');

/**
 * The template is rendered through the LayoutHelper so a child template could
 * override this template easier.
 */
echo LayoutHelper::render($file, ['doc' => &$this, 'entry' => $file], JPATH_BASE . '/templates/{{extensionNameLowerCase}}/html/layouts/{{extensionNameLowerCase}}');
