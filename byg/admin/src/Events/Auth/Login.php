<?php

namespace Byg\Admin\Events\Auth;

use Illuminate\Queue\SerializesModels;

class Login
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

}
