<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;
    protected $appends = ['target_name'];

    protected $fillable = [
        'title',
        'content',
        'priority',
        'target_type',
        'target_id',
        'created_by',
        'type'
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'target_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'announcement_user');
    }

    public function targetUser()
    {
        return $this->belongsTo(User::class, 'target_id');
    }

    public function getTargetNameAttribute()
    {
        if ($this->target_type === 'all') {
            return 'Admin';
        }

        if ($this->target_type === 'class') {
            return $this->creator?->name ?? 'Unknown Creator';
        }

        return $this->targetUser?->name ?? 'Unknown User';
    }
}
