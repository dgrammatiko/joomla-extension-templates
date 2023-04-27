<?php

/**
 * (C) {{copyright}}
 * {{license}}
 */

\defined('_JEXEC') || die();

use Joomla\CMS\Extension\Service\Provider\HelperFactory;
use Joomla\CMS\Extension\Service\Provider\Module;
use Joomla\CMS\Extension\Service\Provider\ModuleDispatcherFactory;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

/**
 * The {{extensionNamePascal}} module service provider.
 *
 * @since  0.0.1
 */
return new class implements ServiceProviderInterface
{
  /**
   * Registers the service provider with a DI container.
   *
   * @param   Container  $container  The DI container.
   *
   * @return  void
   *
   * @since   0.0.1
   */
  public function register(Container $container)
  {
    $container->registerServiceProvider(new ModuleDispatcherFactory('\\{{companyNamePascal}}\\Module\\{{extensionNamePascal}}'))
      ->registerServiceProvider(new HelperFactory('\\{{companyNamePascal}}\\Module\\{{extensionNamePascal}}\\{{clientNamePascal}}\\Helper'))
      ->registerServiceProvider(new Module());
  }
};
