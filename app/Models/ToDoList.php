<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    use HasFactory;
    protected $table = 'role_lists';
    protected $fillable = ['name', 'status', 'user_id'];

    public function item()
    {
        return $this->hasMany('App\Models\ToDoItem', 'list_id');
    }
    public function list_user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
