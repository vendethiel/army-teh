module.exports = (Recipe, Comment, $scope, {id}:$route-params) !->
  recipe <-! Recipe.get {id}
  $scope <<<
    recipe: recipe
    mode: 'description'
    reload-comments: !->
      (comments) <- Comment.query {recipe_id: id}
      $scope.recipe <<< {comments}

  $scope.$broadcast 'init'
  $scope.$on 'reload-comments', $scope~reload-comments
