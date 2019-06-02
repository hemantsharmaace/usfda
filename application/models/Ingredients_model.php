<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Ingredients_model (Ingredients Model)
 * User model class to get to handle Ingredients related data 
 * @author : Hemant Sharma
 * @version : 1.0
 * @since : 02 May 2019
 */
class Ingredients_model extends CI_Model
{
    /**
     * This function is used to get the ingredients listing count
     * @return number $count : This is row count
     */
    function ingredientsListingCount()
    {
        $this->db->select('BaseTbl.name, BaseTbl.unique_identifier, BaseTbl.total_calories_per_serving');
        $this->db->from('tbl_ingredients as BaseTbl');         
        $this->db->where('BaseTbl.status =', 1);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the ingredients listing
     * @return array $result : This is result
     */
    function ingredientsListing()
    {
        $this->db->select('BaseTbl.name, BaseTbl.unique_identifier, BaseTbl.total_calories_per_serving');
        $this->db->from('tbl_ingredients as BaseTbl');         
        $this->db->where('BaseTbl.status =', 1);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }
     
    
    
    /**
     * This function is used to add new ingredients to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewIngredients($ingredientsInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_ingredients', $ingredientsInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
     
    
   
    /**
     * This function is used to delete the ingredients
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteIngredients()
    { 
       $this->db->where('status', 1); 
       $this->db->delete('tbl_ingredients'); 
       return $this->db->affected_rows();
    } 

}

