<?php

namespace App\Modules\Groups\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property string $name
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */
class Group extends Model
{
    use HasFactory;

    protected $guarded = [];

}
