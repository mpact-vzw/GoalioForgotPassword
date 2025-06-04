<?php
namespace GoalioForgotPassword\Mapper\Service;

use GoalioForgotPassword\Mapper\Password;
use GoalioForgotPassword\Mapper\PasswordHydrator;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class PasswordFactory implements FactoryInterface {
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $options = $container->get('goalioforgotpassword_module_options');
        $mapper = new Password();
        $mapper->setDbAdapter($container->get('lmcuser_laminas_db_adapter'));
        $entityClass = $options->getPasswordEntityClass();
        $mapper->setEntityPrototype(new $entityClass);
        $mapper->setHydrator(new PasswordHydrator());
        return $mapper;
    }

}