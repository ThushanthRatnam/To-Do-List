<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoItem extends Model
{
    use HasFactory;
    protected $table = 'role_items';
    protected $fillable = ['title', 'due_date','list_id','status','user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function item_list()
    {
        return $this->belongsTo('App\Models\ToDoList', 'list_id');
    }
}
