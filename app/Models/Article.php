<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Article extends Pivot
{
    protected $guarded = [];


    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

}
