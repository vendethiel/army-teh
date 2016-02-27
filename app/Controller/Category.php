<?php
namespace Controller;
use Minima\Controller\Base;
use Form;
use Model;

class Category extends Base
{
  public function indexAction()
  {
    $this->setType(Base::TYPE_JSON);
    if ($this->method == 'POST') {
      return $this->updateAction();
    } else {
      return $this->listAction();
    }
  }

  private function updateAction()
  {
    $post = read_angular_post();

    $form = new Form\Category($post, array('db' => $this->db));
    if ($form->isValid()) {
      $category = new Model\Category($form->getValues());
      $category->save();
      return array_deep_convert($category);
    }
    return array('error' => $form->getErrors());
  }

  private function listAction()
  {
    return array_deep_convert(array_values(Model\Category::findAll()));
  }
}
