<?php

/**
 * @copyright  {{copyright}}
 * @license    {{license}}
 */

defined('_JEXEC') || die();

use Joomla\CMS\Layout\LayoutHelper;
use Joomla\Utilities\ArrayHelper;

extract($displayData, EXTR_OVERWRITE);

LayoutHelper::render('head', $displayData, JPATH_BASE . '/templates/{{extensionNameLowerCase}}/html/layouts/{{extensionNameLowerCase}}/partials');

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
    <jdoc:include type="message" />
    <main class="wrapper">
      <jdoc:include type="component" />
    </main>
  </body>
</html>
