<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CrowdFund extends Model
{
    // Define which attributes can be mass assigned
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'duration',
        'goal',
        'raised',
        'people_count',
        'image',
        'short_story',
        'story',
        'is_complete',
    ];

    // Define relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor to get formatted duration
    public function getFormattedDurationAttribute()
    {
        $endDate = Carbon::createFromTimestamp($this->duration);
        $now = Carbon::now();

        if ($now->greaterThan($endDate)) {
            return 'Time exceeded';
        }

        $diff = $endDate->diff($now);

        $formatted = [];
        if ($diff->y) $formatted[] = $diff->y . ' years';
        if ($diff->m) $formatted[] = $diff->m . ' months';

        return implode(', ', $formatted);
    }
    
    public function percentageRaised()
    {
        // Avoid division by zero
        if ($this->goal == 0) {
            return '0%';
        }

        // Calculate percentage
        $percentage = ($this->raised / $this->goal) * 100;

        // Format and return percentage as a string with 2 decimal places
        return number_format($percentage, 1);
    }

}
