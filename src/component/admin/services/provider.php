<?php

use Joomla\CMS\Categories\CategoryFactoryInterface;
use Joomla\CMS\Component\Router\RouterFactoryInterface;
use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\CategoryFactory;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\Extension\Service\Provider\RouterFactory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Piedpiper\Component\Spm\Administrator\Extension\SpmComponent;

return new class implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container->registerServiceProvider(new CategoryFactory('\\Piedpiper\\Component\\Spm'));
        $container->registerServiceProvider(new MVCFactory('\\Piedpiper\\Component\\Spm'));
        $container->registerServiceProvider(new ComponentDispatcherFactory('\\Piedpiper\\Component\\Spm'));
        $container->registerServiceProvider(new RouterFactory('\\Piedpiper\\Component\\Spm'));

        $container->set(
            ComponentInterface::class,
            function (Container $container) {
                $component = new SpmComponent($container->get(ComponentDispatcherFactoryInterface::class));
                $component->setMVCFactory($container->get(MVCFactoryInterface::class));
                $component->setRouterFactory($container->get(RouterFactoryInterface::class));
                $component->setCategoryFactory($container->get(CategoryFactoryInterface::class));

                return $component;
            }
        );
    }
};
