<?php

namespace Modules\Library\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booklink extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_name', 'link_address', 'link_icon', 'book_id'
    ];

    protected static function newFactory()
    {
        return \Modules\Library\Database\factories\BooklinkFactory::new();
    }


}
