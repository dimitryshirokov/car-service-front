<?php

declare(strict_types=1);

namespace App\Form;

use App\Model\Form\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type;

/**
 * Class CustomerForm
 * @package App\Form
 */
class CustomerForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Customer $model */
        $model = $options['data'];

        $builder->add(
            'id',
            Type\HiddenType::class,
            [
                'required' => false,
                'data' => $model->getId(),
            ]
        )->add(
            'surname',
            Type\TextType::class,
            [
                'required' => true,
                'label' => 'Фамилия',
                'data' => $model->getSurname(),
            ]
        )->add(
            'name',
            Type\TextType::class,
            [
                'required' => true,
                'label' => 'Имя',
                'data' => $model->getName(),
            ]
        )->add(
            'patronymic',
            Type\TextType::class,
            [
                'required' => false,
                'label' => 'Отчество',
                'data' => $model->getPatronymic(),
            ]
        )->add(
            'phone',
            Type\TelType::class,
            [
                'required' => true,
                'label' => 'Телефон',
                'data' => $model->getPhone(),
            ]
        )->add(
            'discount',
            Type\TextType::class,
            [
                'required' => true,
                'label' => 'Размер скидки',
                'data' => $model->getDiscount(),
            ]
        )->add(
            'submit',
            Type\SubmitType::class,
            [
                'label' => 'Добавить'
            ]
        );
    }
}
