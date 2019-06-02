<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class : Home (Ingredients Model)
 * Home Controller to handle the index page
 * @author : Hemant Sharma
 * @version : 1.0
 * @since : 02 May 2019
 */
class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('datasource');
$this->load->helper('security');
	}

	 
	public function index(){ 
		$this->load->view('home');
	}

	/**
     * This function is used to search the ingredients based on the input by the query
     * @return number $result : This is result based on the user query
     */

	public function search(){
 	 	$q = null;
 	 	if($this->input->server('REQUEST_METHOD') == 'GET'){
			$q = $this->input->get('q', TRUE); 
			$param = array(); 			 
			$q = $this->security->xss_clean($q);
			$param = array("q"=>$q);
 			// call the api
			$result  = $this->datasource->apiRequest($param,'search');
			echo $result;
			exit();
		}
	}

	/**
     * This function is used to save the ingredients in the database  when add to list is clicked
    */
	public function save(){

		 $postData = array(); 
		 $postData = $this->input->get_post('item', TRUE); 
		 if(empty($postData)){
		 	return false;
		 } 

		 $ingredientsData = array(); 
		 if($postData){
		 	$this->load->model('Ingredients_model'); 
		 	$this->Ingredients_model->deleteIngredients();
		 	foreach ($postData as $key => $value) {
		 		 $ingredientsData['name'] = $value['name'];
		 		 $ingredientsData['unique_identifier'] = $value['ndbno'];
		 		 $ingredientsData['manufacturer'] = $value['manu'];

		 		 //call api to find the total calories in the added basket
		 		 $param = array(); 
		 		 if(isset($value['ndbno']) && $value['ndbno'] !=""){
					 $param = array('ndbno'=>$value['ndbno']);
					 $result  = json_decode($this->datasource->apiRequest($param,'reports'),true);
					 $total_calories_per_serving = 0;
	 				 if(isset($result['report']['food']['nutrients'][0]['unit']) && $result['report']['food']['nutrients'][0]['unit'] =="kcal"){
	 					$total_calories_per_serving = (isset($result['report']['food']['nutrients'][0]['value']) && $result['report']['food']['nutrients'][0]['value'])?$result['report']['food']['nutrients'][0]['value']:0;
					}		
				 }	 
		 		 $ingredientsData['total_calories_per_serving'] = $total_calories_per_serving;
		 		 $this->Ingredients_model->addNewIngredients($ingredientsData);
		 	}

		 	return true;
		 }
		return false;

	}

	/**
     * This function is used to list the ingredients saved in the database;
    */
	public function list(){
		$this->load->view('listing');
	}

	/**
     * This function is used to fetch the ingredients saved in the database ajax request
    */
	public function saved_ingredients(){
		$ingredients = array(); 
		$this->load->model('Ingredients_model'); 
		$ingredients = $this->Ingredients_model->ingredientsListing();
		echo json_encode($ingredients);
		exit();
	}


}
