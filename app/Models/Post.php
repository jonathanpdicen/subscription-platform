<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends BaseModel
{
    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }
}
