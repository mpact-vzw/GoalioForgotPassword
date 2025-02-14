<?php
namespace GoalioForgotPassword\Options\Service;

use GoalioForgotPassword\Options\ModuleOptions;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\ServiceManager\FactoryInterface;

class ModuleOptionsFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $config = $serviceLocator->get('Config');
        return new ModuleOptions(isset($config['goalioforgotpassword']) ? $config['goalioforgotpassword'] : array());
    }

}