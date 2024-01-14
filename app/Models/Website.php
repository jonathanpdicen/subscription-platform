<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Website extends BaseModel
{
    public function subscribers(): HasMany
    {
        return $this->hasMany(Subscriber::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
