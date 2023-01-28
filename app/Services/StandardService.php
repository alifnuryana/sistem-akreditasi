<?php

namespace App\Services;

use App\Models\Standard;

class StandardService
{
    public function getStandards()
    {
        return Standard::with('subs')
            ->get();
    }
}
