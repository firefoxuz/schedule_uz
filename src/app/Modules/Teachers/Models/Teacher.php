<?php

namespace App\Modules\Teachers\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property string $first_name
 * @property string $last_name
 * @property Carbon $birth_date
 * @property string $phone
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */
class Teacher extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
//        'birth_date' => 'date:d-m-Y'
    ];
}
