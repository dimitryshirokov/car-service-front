<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type;

/**
 * Class FindOrderForm
 * @package App\Form
 */
class FindOrderForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'id',
            Type\TextType::class,
            [
                'label' => 'Номер заказа',
                'required' => true,
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
