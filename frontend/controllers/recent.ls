module.exports = (Recipe, $scope, $root-scope) !->
  $root-scope.cur-ctrl = 'Recent'
  $scope.count = 5
  recipes <-! Recipe.recent {$scope.count}
  $scope <<< {recipes}

