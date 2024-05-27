<?php
/**
 * @copyright  {{copyright}}
 * @license    {{license}}
 */

namespace {{companyNamePascal}}\Library\{{extensionNamePascal}};

defined('_JEXEC') or die;

class {{extensionNamePascal}}
{
  public function test(): array
  {
    // Register the library assets
    $wa = $this->getApplication()->getDocument()->getWebAssetManager();
    $wa->getRegistry()->addExtensionRegistryFile('lib_{{extensionNameLowerCase}}');

    return ['test' => true];
  }
}
