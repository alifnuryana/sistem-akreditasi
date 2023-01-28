<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'sub_id',
        'user_id',
        'major_id',
        'status',
        'name',
        'file',
    ];

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function scopeByMajorId($query, string $majorId)
    {
        return $query->where('major_id', '=', $majorId);
    }

    public function scopeBySubId($query, string $subId)
    {
        return $query->where('sub_id', '=', $subId);
    }

    public function scopeByStandardId($query, string $standardId)
    {
        return $query->whereHas('sub', fn($sub) => $sub->where('standard_id', '=', $standardId));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sub()
    {
        return $this->belongsTo(Sub::class);
    }
}
