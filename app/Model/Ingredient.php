<?php
namespace Model;
use PotterORM\Base;

class Ingredient extends Base
{
  static protected $table = 'ingredients';
  static protected $pk = 'id';
  static protected $fields = array('recipe_id', 'count', 'name');

  public function toArray($embedded = false)
  {
    $values = $this->values;
    if (!$embedded) {
      $values['recipe'] = $this->getRecipe();
    }
    return $values;
  }

  public function getRecipe()
  {
    return Recipe::find($this['recipe_id']);
  }
}
