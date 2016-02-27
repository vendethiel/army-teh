<?php
namespace Controller;
use Minima\Controller\Base;
use Form;
use Model;

class Recipe extends Base
{
  public function getAction($params)
  {
    $this->setType(Base::TYPE_JSON);
    return array_deep_convert(Model\Recipe::find($params['id']));
  }

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

    $this->assert(isset($post['ingredients']) && is_array($post['ingredients']));
    $form = new Form\Recipe($post);
    if ($form->isValid()) {
      $recipe = new Model\Recipe($form->getValues());
      $recipe->save();
      $this->saveIngredients($post['ingredients'], $recipe);
      return array_deep_convert($recipe);
    }
    return array('error' => $form->getErrors());
  }

  private function saveIngredients($ingredients, Model\Recipe $recipe)
  {
    foreach ($ingredients as $ingred) {
      if (empty($ingred['count']) || empty($ingred['name'])
        || $ingred['count'] < 1)
        continue;

      $ingredient = new Model\Ingredient($ingred);
      $ingredient['recipe_id'] = $recipe->getPk();
      $ingredient->save();
    } 
  }

  public function listAction()
  {
    $recipes = Model\Recipe::findAll(array(), $this->getListOptions());
    if (isset($_GET['search']) && ($query = json_decode($_GET['search'], true))) {
      if (!empty($query['name'])) {
        $recipes = array_filter($recipes, function ($recipe) use ($query) {
          return false !== stripos($recipe['name'], $query['name']);
        });
      }
      if (!empty($query['category_id'])) {
        $recipes = array_filter($recipes, function ($recipe) use ($query) {
          return $recipe['category_id'] == $query['category_id'];
        });
      }
      if (!empty($query['ingredients']) && is_array($query['ingredients'])) {
        $recipes = $this->filterIngredients($recipes, $query['ingredients']);
      }
    }
    return array_deep_convert(array_values($recipes));
  }

  private function filterIngredients($recipes, $ingredients)
  {
    return array_filter($recipes, function ($recipe) use ($ingredients) {
      $ing_str = implode(',', array_map(function ($ingredient) {
        return $ingredient['name'];
      }, $recipe->getIngredients()));
      if (empty($ing_str)) {
        return false;
      }
      foreach ($ingredients as $ingredient) {
        if (empty($ingredient['name'])) {
          continue;
        }
        if (false !== stripos($ing_str, $ingredient['name'])) {
          return true;
        }
      }
      return false;
    });
  }

  private function getListOptions()
  {
    $opts = array();
    if (isset($_GET['recent'])) {
      $opts['order'] = 'id DESC';
    }
    if (!empty($_GET['count']) && is_numeric($_GET['count'])) {
      $opts['limit'] = min(50, $_GET['count']);
    }
    return $opts;
  }
}
