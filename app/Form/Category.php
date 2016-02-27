<?php
namespace Form;
use Minima\Form\Base;

class Category extends Base
{
  protected $fields = array('name');

  protected $validations = array(
    'mandatory' => array('name'),
    'unique' => array('name' => 'categories'),
  );
}
