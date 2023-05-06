<?php

/**
 * @copyright  {{copyright}}
 * @license    {{license}}
 */

namespace {{companyNamePascal}}\Module\{{extensionNamePascal}}\{{clientNamePascal}}\Helper;

\defined('_JEXEC') || die();

use Joomla\CMS\Factory;

class {{extensionNamePascal}}Helper
{
  public static function testAjax()
  {
    $app = Factory::getApplication();
    if (!$app->getSession()->checkToken()) {
      throw new \Exception('Not Allowed');
    }

    return ['test' => true, 'message' => 'in a bottle'];
  }
}
