<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddGame extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'add_games';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_title',
        'game_meta',
        'game_description',
        'base_image',
        'game_category',
        'game_file',
        'json',
        'status',
        'order',
        'game_type'
    ];


}
