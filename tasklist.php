<?php
//
// File: index.php
// Description: TaskList
// Created: Tue. April 16, 2018
// Author: Joshua Santillan
// mail: Santj96@gmail.com
//

class Task {

	private $description;
	private $completed;
	private $date_created;
	private $date_completed;

  public function getDescription() {
     return $this->description;
  }
  
  public function setDescription($description) {
     $this->description = $description;
  }

  public function getCompleted() {
     return $this->completed;
  }
  
  public function setCompleted($completed) {
     $this->completed = $completed;
  }

  public function getDate_created() {
     return $this->date_created;
  }
  
  public function setDate_created($date_created) {
     $this->date_created = $date_created;
  }

  public function getDate_completed() {
     return $this->date_completed;
  }
  
  public function setDate_completed($date_completed) {
     $this->date_completed = $date_completed;
  }

}


class Tasklist {

	private $Arr = array();
	
	public function addTask($Task1){
		$this->Arr[] = $Task1;
		
  } 

	public function printTask(){

      if(is_array($this->Arr) or is_object($this->Arr)){
           foreach($this->Arr as $Task2 => $value){
               echo "<b>Description:</b> " .$value->getDescription()."<br />";
               echo  "<b>Completed:</b> " .$value->getCompleted()."<br />";
               echo  "<b>Created:</b> " .$value->getDate_Created()."<br />";
               if($value->getCompleted() == "yes"){

                   echo  "<b>Date Completed:</b> " .$value->getDate_Completed();
               }            
           }
       }
     
   }
  
}

$t = new Task();
$f = new Tasklist();

$t->setDescription("php Assignment");
$t->setCompleted("yes");
$t->setDate_Created("4/16/18");
$t->setDate_Completed("4/19/18");


$f->addTask($t);
$f->printTask();

?>
