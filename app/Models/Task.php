<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory,FilterTrait;
    protected $fillable = ['name', 'deadline','done_date', 'attachments','status','importance','project_id'];

    protected function serializeDate($date)
    {
        return $date->format('d.m.Y H:i:s');
    }
    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function assignees()
    {
        return $this->belongsToMany(User::class);
    }
}
