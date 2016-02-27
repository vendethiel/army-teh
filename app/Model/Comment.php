<?php
namespace Model;
use PotterORM\Base;

class Comment extends Base
{
  static protected $table = 'comments';
  static protected $pk = 'id';
  static protected $fields = array('author', 'content', 'recipe_id');

  public function toArray()
  {
    return $this->values;
  }
}
