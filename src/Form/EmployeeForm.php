<?php

declare(strict_types=1);

namespace App\Form;

use App\Model\Employee;
use App\Service\PositionServiceInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type;

/**
 * Class EmployeeForm
 * @package App\Form
 */
class EmployeeForm extends AbstractType
{
    /**
     * @var PositionServiceInterface
     */
    private PositionServiceInterface $positionService;

    /**
     * EmployeeForm constructor.
     * @param PositionServiceInterface $positionService
     */
    public function __construct(PositionServiceInterface $positionService)
    {
        $this->positionService = $positionService;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Employee $model */
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
                'label' => 'Фамилия',
                'required' => true,
                'data' => $model->getSurname(),
            ]
        )->add(
            'name',
            Type\TextType::class,
            [
                'label' => 'Имя',
                'required' => true,
                'data' => $model->getName(),
            ]
        )->add(
            'patronymic',
            Type\TextType::class,
            [
                'label' => 'Отчество',
                'required' => false,
                'data' => $model->getPatronymic(),
            ]
        )->add(
            'phone',
            Type\TelType::class,
            [
                'label' => 'Телефон',
                'required' => true,
                'data' => $model->getPhone(),
            ]
        )->add(
            'startDate',
            Type\DateType::class,
            [
                'label' => 'Дата начала работы',
                'required' => true,
                'format' => 'ddMMyyyy',
                'placeholder' => [
                    'year' => 'Год',
                    'month' => 'Месяц',
                    'day' => 'День',
                ],
                'data' => $model->getStartDate(),
            ]
        )->add(
            'position',
            Type\ChoiceType::class,
            [
                'choices' => $this->createChoices(),
                'label' => 'Должность',
                'required' => true,
                'data' => $model->getPosition(),
            ]
        );

        $builder->add('submit', Type\SubmitType::class, [
            'attr' => ['class' => 'btn btn-success'],
            'label' => 'Добавить'
        ]);
    }

    /**
     * @return array
     */
    private function createChoices(): array
    {
        $positions = $this->getPositionService()->getPositions();

        $choicePositions = [];
        foreach ($positions as $position) {
            $choicePositions[$position->getTitle()] = $position->getType();
        }

        return $choicePositions;
    }

    /**
     * @return PositionServiceInterface
     */
    public function getPositionService(): PositionServiceInterface
    {
        return $this->positionService;
    }
}
