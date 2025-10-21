<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'party_id',     // Fixed: changed from 'party' to 'party_id'
        'position_id',
        'photo',
        'description',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function party()
    {
        return $this->belongsTo(Party::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}