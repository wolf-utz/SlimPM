<?php

namespace App\EventListener;

use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use App\Entity\Admin;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsEventListener(event: BeforeEntityPersistedEvent::class, method: 'onBeforeEntityPersistedEvent')]
final class AdminCrudActionMultiEventListener
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function onBeforeEntityPersistedEvent(BeforeEntityPersistedEvent $event): void
    {
        /** @var Admin|object $entity */
        $entity = $event->getEntityInstance();
        if (!($entity instanceof Admin)) {
            return;
        }

        $this->setPassword($entity);
    }

    private function setPassword(Admin $admin): void
    {
        $hashedPassword = $this->passwordHasher->hashPassword($admin, $admin->getPassword());
        $admin->setPassword($hashedPassword);
    }
}