<?php

namespace App\EventSubscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;

class UserLocaleEventSubscriber implements EventSubscriberInterface
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            SecurityEvents::INTERACTIVE_LOGIN => [
                ['onLogin', 15],
            ],
        ];
    }

    public function onLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        $request = $event->getRequest();

        if (!is_null($user) && !is_null($user->getLocale())) {
            $request->setLocale($user->getLocale());
            $this->session->set("_locale", $user->getLocale());
        }
        //dd($this->session);
    }
}