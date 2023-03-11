<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public function proparty()
    {
        return $this->belongsTo(User::class, 'owner');
    }

    public function assignTo()
    {
        return $this->belongsTo(User::class, 'assigned');
    }
}
