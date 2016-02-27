<?php
namespace Model;
use PotterORM\Base;

class Category extends Base
{
  static protected $table = 'categories';
  static protected $pk = 'id';
  static protected $fields = array('name');

  public function toArray($embedded = false)
  {
    $values = $this->values;
    if (!$embedded)
      $values['recipes'] = array_values($this->getRecipes());
    return $values;
  }

  public function getRecipes()
  {
    return Recipe::findAll(array('category_id' => $this->getPk()));
  }
}
