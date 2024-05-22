<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'system_id',
        'user_id',
        'priority_id',
        'supporting_documents',
        'issue_type_id',
        'status_id',
    ];
    public function system()
    {
        return $this->belongsTo(System::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function issueType()
    {
        return $this->belongsTo(Issue::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
