<?php
namespace Form;
use Minima\Form\Base;
use Model;

class Comment extends Base
{
  protected $fields = array('author', 'content');

  protected $validations = array(
    'mandatory' => array('author', 'content'),
  );
}
