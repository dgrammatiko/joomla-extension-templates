<?php

/**
 * @copyright  {{copyright}}
 * @license    {{license}}
 */

defined('_JEXEC') || die();

use Joomla\CMS\Document\Renderer\Html\ModulesRenderer;
use Joomla\CMS\Factory;
?>
<header class="header">
  <div class="container">
    <?= (new ModulesRenderer(Factory::getDocument()))->render('logo'); ?>
    <nav>
      <?= (new ModulesRenderer(Factory::getDocument()))->render('menu'); ?>
    </nav>
  </div>
  <?= (new ModulesRenderer(Factory::getDocument()))->render('banner'); ?>
</header>
