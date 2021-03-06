<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Role extends Model
{
    use SoftDeletes;

    /**
     * Disabled timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Mass fillable field
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Append custom attributes
     *
     * @var array
     */
    protected $appends = [
        'slug'
    ];

    /**
     * Has many relationship to `users` table
     *
     * @return HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Accessor `slug` attributes
     *
     * @return string
     */
    public function getSlugAttribute()
    {
        return Str::slug($this->name);
    }
}
