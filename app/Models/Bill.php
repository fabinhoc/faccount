<?php

namespace App\Models;

use App\Models\Scopes\LoggedUserScope;
use Illuminate\Database\Eloquent\Builder;
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
        return $this->hasOne(Tag::class, 'id', 'tag_id');
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

    public function scopeFindByYear(Builder $query, string $year): void
    {
        $query->whereYear('due_date', '=', $year);
    }

    public function scopeFindByMonth(Builder $query, string $month): void
    {
        $query->whereMonth('due_date', '=', $month);
    }
}
