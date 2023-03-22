<?php

namespace App\Services;

class Roles
{
    public function Admin()
    {
        return auth()->user() && auth()->user()->role_id == 2 ?? true;
    }
}
