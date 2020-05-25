<?php

declare(strict_types=1);

namespace App\Form;

use App\Model\Form\FindCar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class FindCarForm
 * @package App\Form
 */
class FindCarForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var FindCar $model */
        $model = $options['data'];

        $builder->add(
            'vin',
            Type\TextType::class,
            [
                'label' => 'VIN код',
                'required' => true,
                'data' => $model->getVin(),
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
