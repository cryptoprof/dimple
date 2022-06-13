<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, FilterTrait;
    protected $fillable = ['name', 'date_start','date_end', 'description'];

    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
