require('bulk-require') __dirname, ['./_dist/templates/*.html']

const API_PREFIX = "#{BASE_URL}index.php/api"

require! <[sugar angular angular-route angular-resource]>
app = angular.module 'marmiton', ['templates', angular-route, angular-resource]

app.factory 'Recipe', ($resource) ->
  $resource "#{API_PREFIX}/recipes/:id", {},
    recent: {+is-array, params: {+recent}}
app.factory 'Category', ($resource) ->
  $resource "#{API_PREFIX}/categories/:id"
app.factory 'Comment', ($resource) ->
  $resource "#{API_PREFIX}/recipes/:recipe_id/comments/:id", {recipe_id: '@recipeId'}

app.controller 'HomeController', require './controllers/home.ls'
app.controller 'RecipeController', require './controllers/recipe.ls'
app.controller 'RecipeCookController', require './controllers/recipe-cook.ls'
app.controller 'NewRecipeController', require './controllers/new-recipe.ls'
app.controller 'NewCommentController', require './controllers/new-comment.ls'
app.controller 'SearchController', require './controllers/search.ls'
app.controller 'RecentController', require './controllers/recent.ls'

app.config ($route-provider, $location-provider, $resource-provider) !->
  $route-provider
    ..when '/', do
      template-url: './templates/home.html'
      controller: 'HomeController'
    ..when '/recipe/:id', do
      template-url: './templates/recipe.html'
      controller: 'RecipeController'
    ..when '/search', do
      template-url: './templates/search.html'
      controller: 'SearchController'
    ..when '/recent', do
      template-url: './templates/recent.html'
      controller: 'RecentController'
    ..otherwise redirect-to: '/'

  $location-provider.html5Mode true
