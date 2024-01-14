<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscriber extends BaseModel
{
    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }
}
