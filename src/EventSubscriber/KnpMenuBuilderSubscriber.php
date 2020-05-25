<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use KevinPapst\AdminLTEBundle\Event\KnpMenuEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class KnpMenuBuilderSubscriber
 * @package App\EventSubscriber
 */
class KnpMenuBuilderSubscriber implements EventSubscriberInterface
{
    /**
     * @var array
     */
    private array $menuItems;

    /**
     * KnpMenuBuilderSubscriber constructor.
     * @param array $menuItems
     */
    public function __construct(array $menuItems)
    {
        $this->menuItems = $menuItems;
    }

    /**
     * Создаём меню из массива.
     *
     * @param KnpMenuEvent $event
     */
    public function onSetupMenu(KnpMenuEvent $event)
    {
        $menu = $event->getMenu();

        foreach ($this->getMenuItems() as $menuName => $menuItem) {
            $menu->addChild($menuName, [
                'route' => $menuItem['route'],
                'label' => $menuItem['label'],
                'childOptions' => $event->getChildOptions(),
            ])->setLabelAttribute('icon', $menuItem['icon']);
            if (array_key_exists('children', $menuItem) && $menuItem['children'] !== null) {
                foreach ($menuItem['children'] as $childName => $child) {
                    $menu->getChild($menuName)->addChild($childName, [
                        'route' => $child['route'],
                        'label' => $child['label'],
                        'childOptions' => $event->getChildOptions(),
                    ])->setLabelAttribute('icon', $child['icon']);
                }
            }
        }
    }

    /**
     * Подписываем событие на конкретный метод
     *
     * @return array|void
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KnpMenuEvent::class => ['onSetupMenu'],
        ];
    }

    /**
     * @return array
     */
    public function getMenuItems(): array
    {
        return $this->menuItems;
    }
}
