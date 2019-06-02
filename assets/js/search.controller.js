angular.module('myApp', ['ngAnimate']);

angular.module('myApp').controller('myController', function ($scope,$http) {
  
  $scope.inventory = [];
  
  $scope.basket = [];

    
   $scope.getRequest = function() {    
      
     var req = {
     method: 'GET',
     url: 'search',
     params: { q: $scope.searchText}
    }

      
    $http(req).then(
      function successCallback(response) {
        $scope.inventory = [];
        $scope.response = response.data.list.item;         
         angular.forEach($scope.response, function(value, key){
          $scope.inventory.push(value); 
       });
      // console.log($scope.inventory);
      },
      function errorCallback(response) {
         console.log("Unable to perform get request");

       }
    );
  };

 
$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";

    $scope.addItem = function(itemToAdd) {

     $scope.basket.push(itemToAdd);
     var data = $.param({
                item: $scope.basket, 
            });
       
      $http.post('home/save', data).then(
      function successCallback(response) {  
          
       },
      function errorCallback(response) {
              console.log("Unable to perform post request");      

       }
    );
     
  };
  
  
  $scope.clearBasket = function() {
    $scope.basket.length = 0;
  };
  
  $scope.removeItem = function(item) {
    var index = $scope.basket.indexOf(item);
    $scope.basket.splice(index, 1);
  };
 });
angular.module('myApp').controller('listController', function ($scope,$http) {

    $scope.ingredients = [];
    $scope.totalCalories = 0;
 

     var req = {
     method: 'GET',
     url: 'saved_ingredients'
    }
 
    $http(req).then(
      function successCallback(response) {
         $scope.response = response.data;   
         var total = 0;      
         angular.forEach($scope.response, function(value, key){
          
           total = parseFloat(total)+parseFloat(value.total_calories_per_serving);
         
          $scope.ingredients.push(value); 
       });

          $scope.totalCalories = total;
 
      },
      function errorCallback(response) {
        console.log("Unable to perform get request");
      }
    );

});