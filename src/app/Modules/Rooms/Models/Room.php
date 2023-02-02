<?php

namespace App\Modules\Rooms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property string $name
 */
class Room extends Model
{
    use HasFactory;

    protected $guarded = [];
}
