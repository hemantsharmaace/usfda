<!DOCTYPE html>
<html ng-app="myApp">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>USDA Food Data API</title>

  <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body  ng-controller="myController">
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="<?php echo base_url(); ?>">USDA Food Data API</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a style="font-size:28px" href="<?php echo base_url(); ?>list"><span>{{ basket.length }}</span><i class="fa fa-shopping-cart" ></i>

</a>
             <button ng-show="basket.length" class="btn btn-danger" ng-click="clearBasket();">Clear Basket</button>
          </li>
          
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
      <h1 class="display-3">Search Ingredients</h1>
      <p class="lead">Results return from the USDA’s food composition database</p>
     </header>

    <!-- Page Features -->
    <div class="row text-center">

      <div class="col-lg-12 col-md-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="form-group">
           <input type="text" placeholder="Enter Search Query" class="form-control" ng-model="searchText"> 
         </div>
         <div class="form-group">
        <button class="btn btn-primary" ng-click="getRequest()">Search</button>
         </div>
          </div>
             <table class="table">
        <tr>
          <th colspan="2" ng-show="inventory.length">Name</th>         
        </tr>
        <tr class="animate-repeat" ng-repeat="item in inventory">
          <td>
            <button class="btn btn-primary" ng-click="addItem(item)">Add to List</button></td>
          <td>{{ item.name }}</td> 

        </tr>
       
<tr ng-hide="inventory.length">
  <td colspan="2">No results available!</td> </tr>
      </table>
         </div>
      </div>

      

     
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Food Data <script type="text/javascript">var year = new Date().getFullYear();
     document.write( year);
</script></p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
   <script src="<?php echo base_url(); ?>assets/js/angular.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/js/angular-animate.min.js"></script>      
   <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/js/search.controller.js"></script>

</body>

</html>
