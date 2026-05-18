<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Todolist extends Model
{
    use HasFactory;

    protected $table = 'todolists';
    protected $fillable = ['name', 'description'];

    public function items()
    {
        return $this->hasMany(Item::class, 'list_id');
    }
}