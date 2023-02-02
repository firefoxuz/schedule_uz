<?php

namespace App\Modules\Schedules\Models;

use App\Modules\Dows\Models\Dow;
use App\Modules\Groups\Models\Group;
use App\Modules\Rooms\Models\Room;
use App\Modules\Subjects\Models\Subject;
use App\Modules\Teachers\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property-read int $id
 * @property int $group_id
 * @property int $teacher_id
 * @property int $room_id
 * @property int $subject_id
 * @property Carbon $from_date
 * @property Carbon $to_date
 * @property string $from_time
 * @property string $to_time
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */
class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function group(): HasOne
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }

    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class, 'id', 'teacher_id');
    }

    public function room(): HasOne
    {
        return $this->hasOne(Room::class, 'id', 'room_id');
    }

    public function subject(): HasOne
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    public function dows(): BelongsToMany
    {
        return $this->belongsToMany(Dow::class);
    }
}
