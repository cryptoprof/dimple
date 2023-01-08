<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, FilterTrait;

    protected $fillable = ['name', 'email', 'phone'];

    public function customer(){
        return $this->hasMany(Task::class);
    }
}
