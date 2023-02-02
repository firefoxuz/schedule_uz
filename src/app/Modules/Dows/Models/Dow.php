<?php

namespace App\Modules\Dows\Models;

use App\Modules\Schedules\Models\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property-read int $id
 * @property string $name
 * @property int $iso_num
 */
class Dow extends Model
{
    protected $guarded = [];

    public function schedules(): BelongsToMany
    {
        return $this->belongsToMany(Schedule::class);
    }
}
