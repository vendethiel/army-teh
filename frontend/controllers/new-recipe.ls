{format-errors} = require '../helpers.ls'

module.exports = (Recipe, Category, $scope, $location) !->
  $scope <<<
    save: !->
      @new-recipe.ingredients.=exclude (.count < 1)
      recipe = new Recipe @new-recipe
      <~! recipe.$save!then
      if it.error?
        alert format-errors that
      else
        @reset!
        $location.path "/recipe/#{it.id}"
    add-category: !->
      category = new Category name: prompt 'Nom de la categorie ?'
      <~! category.$save!then
      if it.error?
        alert format-errors that
      else
        @categories.push it
        @new-recipe.category_id = it.id
    reset: !->
      @new-recipe =
        name: ''
        description: ''
        category_id: 0
        ingredients: []
    add-ingredient: !->
      @new-recipe.ingredients.push {name: '', count: 0}
    remove-ingredient: !->
      @new-recipe.ingredients.remove-at it
  $scope.reset!
