<?php
namespace GoalioForgotPassword\Mapper\Service;

use GoalioForgotPassword\Mapper\Password;
use GoalioForgotPassword\Mapper\PasswordHydrator;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\ServiceManager\FactoryInterface;

class PasswordFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $options = $serviceLocator->get('goalioforgotpassword_module_options');
        $mapper = new Password();
        $mapper->setDbAdapter($serviceLocator->get('lmcuser_laminas_db_adapter'));
        $entityClass = $options->getPasswordEntityClass();
        $mapper->setEntityPrototype(new $entityClass);
        $mapper->setHydrator(new PasswordHydrator());
        return $mapper;
    }

}