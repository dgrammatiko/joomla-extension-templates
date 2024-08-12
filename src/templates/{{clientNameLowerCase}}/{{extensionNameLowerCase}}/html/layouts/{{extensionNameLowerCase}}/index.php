<?php

/**
 * @copyright  {{copyright}}
 * @license    {{license}}
 */

defined('_JEXEC') || die();

use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Language\Text;
use Joomla\Utilities\ArrayHelper;

extract($displayData, EXTR_OVERWRITE);

$liveParams = $doc->params->get('liveParams');
?>
<!doctype html>
<html <?= ArrayHelper::toString($liveParams->htmlAttributes); ?>>

<head>
  <jdoc:include type="metas" />
  <jdoc:include type="styles" />
  <jdoc:include type="scripts" />
</head>

<body <?= ArrayHelper::toString($liveParams->bodyAttributes); ?>>
  <?= LayoutHelper::render('header', $displayData, JPATH_BASE . '/templates/{{extensionNameLowerCase}}/html/layouts/{{extensionNameLowerCase}}/partials'); ?>
  <jdoc:include type="message" />
  <main class="wrapper">
    <jdoc:include type="component" />
  </main>
  <?= LayoutHelper::render('footer', $displayData, JPATH_BASE . '/templates/{{extensionNameLowerCase}}/html/layouts/{{extensionNameLowerCase}}/partials'); ?>
  <jdoc:include type="modules" name="debug" />
  <a href="#" class="scroll-to-top"><?= Text::_('TPL_{{extensionNameUpperCase}}_BACK_TO_TOP'); ?> &#8593;</a>
</body>

</html>
