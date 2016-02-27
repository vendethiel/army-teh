<?php
namespace Form;
use Minima\Form\Base;
use Model;

class Recipe extends Base
{
  protected $fields = array('name', 'description', 'category_id');

  protected $validations = array(
    'mandatory' => array('name', 'description', 'category_id'),
  );

  protected function validate()
  {
    if (!Model\Category::find($this->values['category_id']))
      $this->errors['category_id'][] = 'Categorie inconnue';
  }
}
