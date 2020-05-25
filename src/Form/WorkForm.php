<?php

declare(strict_types=1);

namespace App\Form;

use App\Service\PositionServiceInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class WorkForm
 * @package App\Form
 */
class WorkForm extends AbstractType
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
        $builder->add(
            'title',
            Type\TextType::class,
            [
                'label' => 'Название работы',
                'required' => true,
            ]
        )->add(
            'price',
            Type\TextType::class,
            [
                'label' => 'Стоимость за нормочас',
                'required' => true,
            ]
        )->add(
            'positions',
            Type\ChoiceType::class,
            [
                'multiple' => true,
                'choices' => $this->createChoices(),
                'label' => 'Должности для работы'
            ]
        )->add(
            'submit',
            Type\SubmitType::class,
            [
                'attr' => [
                    'class' => 'btn btn-success',
                ],
                'label' => 'Добавить',
            ]
        );
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
