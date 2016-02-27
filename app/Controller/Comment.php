<?php
namespace Controller;
use Minima\Controller\Base;
use Model;
use Form;

class Comment extends Base
{
  public function indexAction($params)
  {
    if ($this->method == 'POST') {
      return $this->updateAction($params['recipe_id']);
    } else {
      return $this->listAction($params['recipe_id']);
    }
  }

  private function updateAction($recipe_id)
  {
    $this->setType(Base::TYPE_JSON);
    $post = read_angular_post();

    $form = new Form\Comment($post);
    if ($form->isValid()) {
      $comment = new Model\Comment($form->getValues());
      $comment['recipe_id'] = $recipe_id;
      $comment->save();
      return array_deep_convert($comment);
    }
    return array('error' => $form->getErrors());
  }

  private function listAction($recipe_id)
  {
    $this->setType(Base::TYPE_JSON);
    $comments = Model\Comment::findAll(array('recipe_id' => $recipe_id));
    return array_deep_convert(array_values($comments));
  }
}
