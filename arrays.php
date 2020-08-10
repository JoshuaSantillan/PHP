<?php

//
// Generate an array of 50 random numbers

$numbers = array();

for($i=0;$i<50;$i++)
{
    $numbers[$i] = rand();
}

//
//  The following is the exercise prompt.
// Implement the code to count the number of odd numbers and the number
// of even numbers are in the array.  The following is how
// to iterate over an array that is already created.
// in order to detect if a number is evenly divisible, use the 
// modulus division operator %
// if a number modulus 2 is 0, then the number is even, if it is
// 1 then it is odd.
for($i=0;$i<count($numbers);$i++)
{
    print "$numbers[$i]<br>";
}



// implement the same operation using a do while loop.
/*

$count_even=0;
 $count_odd=0;
	$i=0;
	do {
         if ($numbers[$i] %2 == 0)
         $count_even++;
     
         if($numbers[$i] %2 == 1 )
             $count_odd++;
		$i++;
}
while ($i<count($numbers));

*/




// do the same operation as above, but use a while loop instead.

/*
 $count_even=0;
 $count_odd=0;
$i=0;
	while($i<count($numbers)) {

         if ($numbers[$i] %2 == 0)
         $count_even++;
     
         if($numbers[$i] %2 == 1 )
             $count_odd++;

		$i++;

	}

*/

// for loop for fun/practice

 $count_even=0;
 $count_odd=0;


 	for($i=0;$i<count($numbers);$i++){
 		if ($numbers[$i] %2 == 0)
 		$count_even++;
 	
 		if($numbers[$i] % 2==1 )
 			$count_odd++;
}



// output the number of even numbers and the number of odd numbers.
	print "<br> <br><b>
	Number of Even Numebrs: </b> $count_even 
	<br> <b> 
	Number of Odd Numbers: </b>$count_odd
		";
