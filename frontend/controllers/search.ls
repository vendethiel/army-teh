module.exports = (Recipe, Category, $scope, $root-scope) !->
  $root-scope.cur-ctrl = 'Search'
  categories <-! Category.query
  $scope <<<
    ...: {categories}
    search:
      name: ''
      category_id: 0
      ingredients: []
    add-ingredient: !->
      @search.ingredients.push {name: ''}
    remove-ingredient: !->
      @search.ingredients.remove-at it
    submit: !->
      results <-! Recipe.query {@search}
      $scope.results = results.group-by (.category.name)
