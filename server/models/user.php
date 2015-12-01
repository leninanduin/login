<?php
namespace Entity;

use Spot\EntityInterface as Entity;
use Spot\MapperInterface as Mapper;

include_once '../../vendor/autoload.php';

class User extends \Spot\Entity
{
    protected static $table = 'users';


    public static function fields()
    {
        return [
            'id'                => ['type' => 'integer', 'autoincrement' => true, 'primary' => true],
            'full_name'         => ['type' => 'string', 'required' => true],
            'email'             => ['type' => 'string', 'required' => true, 'unique' => true],
            'password'          => ['type' => 'string', 'required' => true],
            'phone'             => ['type' => 'string'],
            'address_line_1'    => ['type' => 'string', 'required' => true],
            'city'              => ['type' => 'string', 'required' => true],
            'state_or_region'   => ['type' => 'string', 'required' => true],
            'zip'               => ['type' => 'integer', 'required' => true],
            'country'           => ['type' => 'string', 'required' => true],
            'lat'               => ['type' => float, 'required' => true],
            'lng'               => ['type' => float, 'required' => true],
            'registered_date'   => ['type' => 'datetime', 'value' => new \DateTime()]
        ];
    }

    // public static function relations(Mapper $mapper, Entity $entity)
    // {
    //     return [
    //         'tags' => $mapper->hasManyThrough($entity, 'Entity\Tag', 'Entity\PostTag', 'tag_id', 'post_id'),
    //         'comments' => $mapper->hasMany($entity, 'Entity\Post\Comment', 'post_id')->order(['date_created' => 'ASC']),
    //         'author' => $mapper->belongsTo($entity, 'Entity\Author', 'author_id')
    //     ];
    // }
}

?>