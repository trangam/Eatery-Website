<?php
class menuItem
{
    private $description ;
    private $price ;
    private $itemName;

    
	public function __construct($itemName,$description,$price) {
		$this-> setItemName($itemName);
		$this-> setDescription($description);
		$this-> setPrice($price);
		
			
		}
	public function setItemName($itemName) {
          $this-> itemName=$itemName;		   }

       public function getItemName(){
			return $this->itemName;
		}
	
	 public function setDescription($description) {
          $this->description= $description;		 }
	
	 public function getDescription(){
			return $this->description;
		}
	  public function setPrice($price) { 
	  $this->price=$price;}
	  
	  public function getPrice(){
			return $this->price;
		}
		
	
}
	
	
?>