<?php namespace Resizer\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Image extends Eloquent
{
    protected $connection = 'default';


    public function scopeActive($query, $finished = 0)
    {
        return $query->where('processed', $finished);
    }
}