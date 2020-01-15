<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'title' => 'required',
        'genre' => 'required',
        'score' => 'required',
        'review' => 'required',
        'hard' => 'required',
    );
}
