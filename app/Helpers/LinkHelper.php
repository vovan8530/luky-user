<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\URL;

class LinkHelper
{
    /**
     * @param  User  $user
     * @return string
     */
    public static function createSignedURL(User $user): string
    {
        return URL::temporarySignedRoute('page-a', now()->addHour(), ['user' => $user->id]);
    }

}
