<?php

/**
 * {{copyright}}
 * {{license}}
 */

namespace {{companyNamePascal}}\Module\{{extensionNamePascal}}\{{clientNamePascal}}\Dispatcher;

\defined('_JEXEC') || die();

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;

class Dispatcher extends AbstractModuleDispatcher implements HelperFactoryAwareInterface
{
  use HelperFactoryAwareTrait;

  protected function getLayoutData()
  {
    //$this->getHelperFactory()->getHelper('{{extensionNamePascal}}Helper')->getXxxx($data['params'], $this->getApplication());
    return parent::getLayoutData();
  }
}
