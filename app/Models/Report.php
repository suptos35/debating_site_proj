<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reportable_type',
        'reportable_id',
        'reason',
        'details',
        'status',
        'reviewed_by',
        'reviewed_at',
        'admin_notes'
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(\App\Models\User::class, 'reviewed_by');
    }

    public function reportable()
    {
        return $this->morphTo();
    }

    public function getReasonDisplayAttribute()
    {
        $reasons = [
            'spam' => 'Spam',
            'abuse' => 'Abusive Content',
            'misinfo' => 'Misinformation',
            'irrelevant' => 'Irrelevant Content',
            'contradiction' => 'Contradiction',
            'other' => 'Other'
        ];

        return $reasons[$this->reason] ?? $this->reason;
    }

    public static function getReportSummary($reportableType, $reportableId)
    {
        return self::where('reportable_type', $reportableType)
            ->where('reportable_id', $reportableId)
            ->where('status', 'pending')
            ->selectRaw('reason, COUNT(*) as count')
            ->groupBy('reason')
            ->get();
    }

    public static function getTotalReportsCount($reportableType, $reportableId)
    {
        return self::where('reportable_type', $reportableType)
            ->where('reportable_id', $reportableId)
            ->where('status', 'pending')
            ->count();
    }
}
