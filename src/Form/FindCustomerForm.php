<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type;

/**
 * Class FindCustomerForm
 * @package App\Form
 */
class FindCustomerForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'phone',
            Type\TelType::class,
            [
                'required' => true,
                'label' => 'Телефон:',
            ]
        )->add(
            'submit',
            Type\SubmitType::class,
            [
                'label' => 'Найти',
            ]
        );
    }
}
