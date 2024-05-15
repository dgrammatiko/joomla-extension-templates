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
  public static function testAjax(): array
  {
    // Consider checking the token!
    // $app = Factory::getApplication();
    // if (!Session::checkToken('request')) throw new \Exception('Not Allowed');

    return ['test' => true, 'message' => 'Message in a bottle'];
  }
}
