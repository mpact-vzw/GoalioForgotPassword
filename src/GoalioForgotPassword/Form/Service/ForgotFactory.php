<?php
namespace GoalioForgotPassword\Form\Service;

use GoalioForgotPassword\Form\Forgot;
use GoalioForgotPassword\Form\ForgotFilter;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class ForgotFactory implements FactoryInterface {
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $options = $container->get('goalioforgotpassword_module_options');
        $form = new Forgot(null, $options);
        $validator = new \LmcUser\Validator\RecordExists(array(
            'mapper' => $container->get('lmcuser_user_mapper'),
            'key'    => 'email'
        ));

        $translator = $container->get('Translator');

        $validator->setMessage($translator->translate('The email address you entered was not found.'));
        $form->setInputFilter(new ForgotFilter($validator,$options));
        return $form;
    }

}
