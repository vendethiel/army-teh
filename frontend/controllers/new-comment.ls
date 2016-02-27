{format-errors} = require '../helpers.ls'

module.exports = (Comment, $scope) !->
  (event) <-! $scope.$on 'init'
  $scope <<<
    save: !->
      console.log @new-comment, @new-comment.recipe-id
      comment = new Comment @new-comment
      <~! comment.$save!then
      if it.error?
        alert format-errors that
      else
        @reset!
        @$emit 'reload-comments'
    reset: !->
      @new-comment =
        author: ''
        content: ''
        recipe-id: @recipe.id
  $scope.reset!
