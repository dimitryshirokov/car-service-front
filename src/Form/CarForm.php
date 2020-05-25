<?php

declare(strict_types=1);

namespace App\Form;

use App\Model\Form\Car;
use DateTime;
use Exception;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type;

/**
 * Class CarForm
 * @package App\Form
 */
class CarForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @throws Exception
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Car $model */
        $model = $options['data'];

        $builder->add(
            'id',
            Type\HiddenType::class,
            [
                'required' => false,
                'data' => $model->getId()
            ]
        )->add(
            'manufacturer',
            Type\TextType::class,
            [
                'required' => true,
                'label' => 'Производитель',
                'data' => $model->getManufacturer(),
            ]
        )->add(
            'model',
            Type\TextType::class,
            [
                'required' => true,
                'label' => 'Модель',
                'data' => $model->getModel(),
            ]
        )->add(
            'engine',
            Type\TextType::class,
            [
                'required' => true,
                'label' => 'Двигатель',
                'data' => $model->getEngine(),
            ]
        )->add(
            'year',
            Type\ChoiceType::class,
            [
                'label' => 'Год выпуска',
                'required' => true,
                'data' => $model->getYear(),
                'choices' => $this->createChoices(),
            ]
        )->add(
            'vin',
            Type\TextType::class,
            [
                'label' => 'VIN код',
                'required' => true,
                'data' => $model->getVin(),
            ]
        )->add(
            'phone',
            Type\TelType::class,
            [
                'label' => 'Телефон владельца',
                'required' => true,
                'data' => $model->getPhone(),
            ]
        )->add(
            'submit',
            Type\SubmitType::class,
            [
                'label' => 'Добавить',
            ]
        );
    }

    /**
     * @return array
     * @throws Exception
     */
    private function createChoices()
    {
        $yearStart = (int) (new DateTime())->modify('-50 years')->format('Y');
        $yearEnd = (int) (new DateTime())->format('Y');

        $years = [];

        for ($year = $yearStart; $year <= $yearEnd; $year++) {
            $years[$year] = $year;
        }

        return $years;
    }
}
