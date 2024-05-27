<?php

/**
 * @copyright  {{copyright}}
 * @license    {{license}}
 */

namespace {{companyNamePascal}}\Plugin\{{folderNamePascal}}\{{extensionNamePascal}}\Extension;

\defined('_JEXEC') || die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\SubscriberInterface;

/**
 * {{extensionNamePascal}} Plugin
 */
final class {{extensionNamePascal}} extends CMSPlugin implements SubscriberInterface
{
  /**
   * Returns an array of CMS events this plugin will listen to and the respective handlers.
   */
  public static function getSubscribedEvents(): array
  {
    return ['onContentBeforeDisplay' => 'contentBeforeDisplay'];
  }

  /**
   * @param   string   $context  The context of the content being passed to the plugin.
   * @param   mixed    &$row     An object with a "text" property
   * @param   mixed    $params   Additional parameters. See {@see PlgContentContent()}.
   * @param   integer  $page     Optional page number. Unused. Defaults to zero.
   */
  public function contentBeforeDisplay($event): void
  {
    // Always check the application client (site, administrator, api, cli)
    if (!$this->getApplication()->isClient('site')) {
      return;
    }

    // Always check the context
    if (!in_array($event['context'], ['com_content.category', 'com_content.article', 'com_content.featured'])) {
      return;
    }

    if (strpos($event['subject']->text, 'something',) !== false) {
      // Register the plugin assets
      $wa = $this->getApplication()->getDocument()->getWebAssetManager();
      $wa->getRegistry()->addExtensionRegistryFile('plg_{{folderNameLowerCase}}_{{extensionNameLowerCase}}');

      $wa->useScript(
        'plg_{{folderNameLowerCase}}_{{extensionNameLowerCase}}.index',
        [],
        ['type' => 'module'],
        ['core']
      );
    }
  }
}
