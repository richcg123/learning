<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Course
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course query()
 * @mixin \Eloquent
 */
class Course extends Model
{
    const PUBLISHED = 1; // curso publicado
    const PENDING = 2; // curso pendiente
    const REJECTED = 3; // curso rechazado

}
