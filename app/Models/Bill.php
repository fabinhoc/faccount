<?php

namespace App\Models;

use App\Models\Scopes\LoggedUserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'is_paid',
        'total_paid',
        'due_date',
        'tag_id',
        'notebook_id',
        'user_id'
    ];

    public function tag()
    {
        return $this->hasOne(Tag::class);
    }

    public function notebook()
    {
        return $this->belongsTo(Notebook::class);
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
