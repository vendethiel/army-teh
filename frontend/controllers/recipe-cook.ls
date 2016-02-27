module.exports = ($scope) !->
  (event) <-! $scope.$on 'init'
  $scope <<<
    steps: $scope.recipe.description / '\n'
    current-step: 0
    next-step: !->
      @current-step++
      @current-step <?= @steps.length
    prev-step: !->
      @current-step--
      @current-step >?= 0
