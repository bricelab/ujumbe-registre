<?php

namespace App\EventSubscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\KernelEvent;

class LocaleEventSubscriber implements EventSubscriberInterface
{
    private $defaultLocale;

    public function __construct(string $defaultLocale)
    {
        $this->defaultLocale = $defaultLocale;
    }

    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            KernelEvents::REQUEST => [
                ['onKernelRequest', 110],
            ],
        ];
    }

    public function onKernelRequest(KernelEvent $event)
    {
        $request = $event->getRequest();

        if ($request->hasPreviousSession()) {
            //dd($this->defaultLocale);
            //return;
        } 
        
        if ($locale = $request->attributes->get("_locale")) {
            $request->getSession()->set("_locale", $locale);
            $request->setLocale($locale);
        } else {
            //dd($request);
            $request->getSession()->set("_locale", $this->defaultLocale);
            $request->setLocale($this->defaultLocale);
        }
        //dd($request);
        
        

        //$request->setLocale("en_US");

        //$session = $request->getSession();

        //dd($session);
    }

}