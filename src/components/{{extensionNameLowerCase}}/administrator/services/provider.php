<?php

/**
 * {{copyright}}
 * {{license}}
 */

defined('_JEXEC') || die;

use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

/**
 * The cache service provider.
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
    $container->registerServiceProvider(new MVCFactory('\\{{companyNamePascal}}\\Component\\{{extensionNamePascal}}'));
    $container->registerServiceProvider(new ComponentDispatcherFactory('\\{{companyNamePascal}}\\Component\\{{extensionNamePascal}}'));

    $container->set(
      ComponentInterface::class,
      function (Container $container)
      {
        $component = new MVCComponent($container->get(ComponentDispatcherFactoryInterface::class));

        $component->setMVCFactory($container->get(MVCFactoryInterface::class));

        return $component;
      }
    );
  }
};
