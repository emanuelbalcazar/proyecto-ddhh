<!DOCTYPE html>
<html lang="en-ES" ng-app="app">
  <head>
    <title>DDHH</title>
    <meta name="description" content="DDHH - Gestión y búsqueda de Personas" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="icon" type="image/png" href="img/favicon.png"/>
    <link href="assets/app.min.css" rel="stylesheet">
  </head>
  <body>
    <header>
      <div data-ng-include src="'partials/head/header.html'"></div>
    </header>
    <div id="content" class="row">
      <div data-ng-hide="isUserLogedIn()">
        <div data-ng-include src="'partials/content/home/home.html'"></div>
      </div>
      <div data-ng-show="isUserLogedIn()">
        <div class="col-lg-3 col-md-3 col-sm-4" role="complementary">
          <div data-ng-include src="'partials/navigation/navigation.html'"></div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-8 main-content" role="main">
          <div data-ng-view=""></div>
        </div>
      </div>
    </div>
    <footer class="footer">
      <div data-ng-include src="'partials/footer/footer.html'"></div>
    </footer>
    <span class="totop">
      <a href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
    </span>
    <script src="assets/app.min.js"></script>
  </body>
</html>
