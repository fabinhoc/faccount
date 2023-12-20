<?php

namespace App\Models;

use App\Models\Scopes\LoggedUserScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color',
        'user_id'
    ];

    public function scopeLoggedUser(Builder $query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    public function scopeSearchable($query, Request $request)
    {
        // Todo: Implement
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new LoggedUserScope);
    }
}
