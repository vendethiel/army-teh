<?php
namespace Model;
use PotterORM\Base;

class Recipe extends Base
{
  static protected $table = 'recipes';
  static protected $pk = 'id';
  static protected $fields = array('category_id', 'name', 'description');

  public function toArray($embedded = false)
  {
    $values = $this->values;
    if (!$embedded) {
      $values += array(
        'ingredients' => array_values($this->getIngredients()),
        'category' => $this->getCategory(),
        'comments' => array_values($this->getComments()),
      );
    }
    return $values;
  }

  public function getCategory()
  {
    return Category::find($this['category_id']);
  }

  public function getIngredients()
  {
    return Ingredient::findAll(array('recipe_id' => $this->getPk()));
  }

  public function getComments()
  {
    return Comment::findAll(array('recipe_id' => $this->getPk()));
  }
}
