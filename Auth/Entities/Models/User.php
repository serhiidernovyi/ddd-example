<?php

namespace Auth\Entities\Models;

use App\Models\User as BaseUser;
use App\Traits\DomainMorphMap;

class User extends BaseUser
{
    use DomainMorphMap;
}