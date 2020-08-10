<?php

//
// File: PhpFiles.php
// Description: PhpFilescsv
// Created: Tue. April 26, 2018
// Author: Joshua Santillan
// mail: Santj96@gmail.com
//

class Task {
  private $description;
  private $completed;
  private $date_created;
  private $date_completed;
  public function __construct($description, $completed, $date_created, $date_completed) {
    $this->description = $description;
    $this->completed = $completed;
    $this->date_created = $date_created;
    $this->date_completed = $date_completed;
  }
  public function getDescription() { // $description
    return $this->description;
  }
  public function setDescription($string) {
    $this->description = $string;
  }
  public function getCompleted() { // $completed
    return $this->completed;
  }
  public function setCompleted($string) {
    $this->completed = $string;
  }
  public function getCreationDate() { // $date_created
    return $this->date_created;
  }
  public function setCreationDate($string) {
    $this->date_created = $string;
  }
  public function getCompletionDate() { // $date_completed
    return $this->date_completed;
  }
  public function setCompletionDate($string) {
    $this->date_completed = $string;
  }
}



        class TaskList
        {
            private $txt = array();
            private $ListofTasks = array();
            private $TaskTest = array();

           function __construct() {
                
            }
            public function addTasks($aTask)
            {
                $myfile = fopen("loadRecords.csv", "w") or die("Unable to open file!");
                $txt = "Description,Completed,Date Created, Date Completed\n";
                fwrite($myfile, $txt);

                $txt = "This is the first description, Yes, 08-08-18, 08-09-18\n";
                fwrite($myfile, $txt);
                $txt = "This is the Second description, No, 08-08-18, 00-00-00\n";
                fwrite($myfile, $txt);
                $txt = "This is the Third description, Yes, 10-08-18, 10-09-18\n";
                fwrite($myfile, $txt);




                array_push($this->txt,$aTask->getDescription(). "." .$aTask->getCompleted(). "." .$aTask->getCreationDate(). "." .$aTask->getCompletionDate());
                fputcsv($myfile, $this->txt,'.');
                array_push($this->ListofTasks, $aTask);

                fclose($myfile);

            }

            public function printTasks()
            {                        
                $row = 1;
                if (($handle = fopen("loadRecords.csv", "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $num = count($data);
                        $row++;
                        for ($c=0; $c < $num; $c++) { 
                            echo "<br>$data[$c]<br>"; 
                           
                        }
                    }       
                }

                fclose($handle);
            }
            
            public function saveAll() {}
        }



$f = new Tasklist;
$t = new Task( '', '', '', '');
$f->addTasks($t);
$f->printTasks();



?>
