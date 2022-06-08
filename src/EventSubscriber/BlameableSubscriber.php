<?php

namespace App\EventSubscriber;

use App\Entity\Question;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class BlameableSubscriber implements EventSubscriberInterface
{
    public function __construct(private Security $security)
    {
    }

    public function onBeforeEntityUpdatedEvent(BeforeEntityUpdatedEvent $event)
    {
        $question = $event->getEntityInstance();
        if (!$question instanceof Question) {
            return;
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            // BeforeEntityUpdatedEvent::class => 'onBeforeEntityUpdatedEvent',
        ];
    }
}
