<!DOCTYPE html>
<html ng-app="marmiton">
  <head>
  <meta charset="UTF-8">
    <base href="/" />
    <link href="<?php echo BASEPATH ?>dist/index.css" type="text/css" rel="stylesheet" />
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </head>

  <body>
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">My Marmiton</a>
    </div>
    <ul class="nav navbar-nav">
      <li ng-class="{active: curCtrl == 'Home'}"><a href="/">Accueil</a></li>
      <li ng-class="{active: curCtrl == 'Search'}"><a href="/search">Recherche</a></li>
      <li ng-class="{active: curCtrl == 'Recent'}"><a href="/recent">Récent</a></li>
    </ul>
  </div>
  </nav>
    <div id="main-body" ng-view></div>
<script>
var BASE_URL = "<?php echo BASEPATH ?>";
</script>
<script src="<?php echo BASEPATH ?>dist/bundle.js"></script>

</body>

</html>
