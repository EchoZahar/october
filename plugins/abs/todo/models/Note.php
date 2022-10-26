<?php namespace Abs\ToDo\Models;

use Backend\Models\User;
use Model;
use October\Rain\Halcyon\Traits\Validation;

class Note extends Model
{
    use Validation;

    public $table = 'abs_todo_notes';

    protected $guarded = ['*'];

    protected $fillable = [];

    public $rules = [
        'title' => ['required', 'min:4']
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $belongsTo = [
        'user' => [User::class, 'key' => 'user_id'],
    ];
}
