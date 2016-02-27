module.exports = (Category, $scope, $root-scope) !->
  $root-scope.cur-ctrl = 'Home'
  $scope.load = !->
    categories <-! Category.query
    $scope <<< {categories}
  $scope.load!
  $scope.$on 'reload-categories', $scope.load
