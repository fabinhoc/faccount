<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Notebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeLoggedUser(Builder $query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    public function scopeSearchable($query, Request $request)
    {
        // Todo: Implement
    }
}
