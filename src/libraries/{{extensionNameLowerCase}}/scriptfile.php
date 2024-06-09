<?php

/**
 * @copyright  {{copyright}}
 * @license    {{license}}
 */

defined('_JEXEC') || die();

use Joomla\CMS\Factory;
use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Installer\InstallerScriptInterface;
use Joomla\CMS\Language\Text;

return new class() implements InstallerScriptInterface
{

  private string $minimumJoomla = '4.4.0';
  private string $minimumPhp    = '8.1.0';

  public function install(InstallerAdapter $adapter): bool
  {
    return true;
  }

  public function update(InstallerAdapter $adapter): bool
  {
    return true;
  }

  public function uninstall(InstallerAdapter $adapter): bool
  {
    return true;
  }

  public function preflight(string $type, InstallerAdapter $adapter): bool
  {
    if (version_compare(PHP_VERSION, $this->minimumPhp, '<')) {
      Factory::getApplication()->enqueueMessage(sprintf(Text::_('JLIB_INSTALLER_MINIMUM_PHP'), $this->minimumPhp), 'error');
      return false;
    }

    if (version_compare(JVERSION, $this->minimumJoomla, '<')) {
      Factory::getApplication()->enqueueMessage(sprintf(Text::_('JLIB_INSTALLER_MINIMUM_JOOMLA'), $this->minimumJoomla), 'error');
      return false;
    }

    return true;
  }

  public function postflight(string $type, InstallerAdapter $adapter): bool
  {
    return true;
  }
};
