<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{

    public $table = 'foods';

    use SoftDeletes;

    protected $fillable = [
        'name', 'image', 'video', 'ingredient', 'instruction', 'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
