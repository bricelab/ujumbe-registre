<?php

namespace App\Events;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Contracts\EventDispatcher\Event;

class UserEvent extends Event
{
    public const SIGNED_UP = "user.signed_up";

    public const PASSWORD_RESET_REQUESTED = "user.password_reset_requested";

    public const PASSWORD_RESETED = "user.password_reseted";

    public const PASSWORD_NOT_RESETED_IN_TIME = "user.password_not_reseted_in_time";

    protected $user;
    protected $request;

    public function __construct(UserInterface $user, Request $request)
    {
        $this->user = $user;
        $this->request = $request;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get the value of request
     */ 
    public function getRequest()
    {
        return $this->request;
    }
}