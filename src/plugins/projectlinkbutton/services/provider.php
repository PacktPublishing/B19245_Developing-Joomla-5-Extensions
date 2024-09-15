<?php

use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Factory;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use Piedpiper\Plugin\EditorsXtd\ProjectLinkButton\Extension\ProjectLinkButton;

return new class implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container->set(
            PluginInterface::class,
            function (Container $container) {
                $dispatcher = $container->get(DispatcherInterface::class);
                $plugin     = new ProjectLinkButton(
                    $dispatcher,
                    (array) PluginHelper::getPlugin('editors-xtd', 'projectlinkbutton')
                );

                $plugin->setApplication(Factory::getApplication());

                return $plugin;
            }
        );
    }
};