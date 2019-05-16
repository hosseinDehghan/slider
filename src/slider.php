<?php

namespace Hosein\Sliders;

use Illuminate\Database\Eloquent\Model;

class slider extends Model
{
    protected $fillable=[
        'id','title','caption','link','image','status'
    ];
}
