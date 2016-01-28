<?php

// $numbers = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15);
// foreach($numbers as $number) {
// 	if($number % 3 == 0 && $number % 5 == 0) {
// 		echo 'FizzBuzz<br>';
// 	}
// 	elseif($number % 3 == 0) {
// 		echo 'Fizz<br>';
// 	}
// 	elseif($number % 5 == 0) {
// 		echo 'Buzz<br>';
// 	}
// 	else {	echo $number . '<br>'; }
// }
// for($i = 0; $i<count($numbers); $i++) {
// 	if($numbers[$i] % 3 == 0) {
// 		echo 'Fizz<br>';
// 	}
// 	elseif($numbers[$i] % 5 == 0) {
// 		echo 'Buzz<br>';
// 	}
// 	elseif(($numbers[$i] % 3 == 0) && ($numbers[$i] % 5 == 0)) {
// 		echo 'Fizz Buzz<br>';
// 	}
// 	else {	echo $numbers[$i] . '<br>'; }
// }

// $st = 'kincenvizh';
$st = "wtfbbq";

// $stlen = strlen($st);

// if($stlen < 100000) {
// 	$count = 0;
// 	for($i=0; $i<$stlen; $i++) {
// 		// echo $st . '<br>';
// 		$count++;
		
// 		$index = 1;
// 		$strlen = strlen($st) - 1; 
// 		$st1 = substr($st, $index);
// 		for($a=0; $a<strlen($st1); $a++) {			
// 			// echo $substr = substr($st, 0, $strlen) . '<br>' ;
// 			$strlen--;
// 			$count++;
// 		}
// 		$st = $st1;
		
// 	}
// 	echo $count ;
// }	


$count = 0; 
for($i=0; $i < strlen($st); $i++) {
	// echo 'this is illustration <br>';
	for($j=0; $j<strlen($st)-$i; $j++) {
		echo 'this is jubilant<br>';
		$count++;
	}
}
echo $count;



// $a = array(7,9,5,6,3,2);
// // $a = array(2,3,10,2,4,8,1);

// function maxDifference( $a) {
// 	$maxDiff = -1;
// 	for($i = 0; $i < count($a); $i++) {
// 		for($j = 0; $j < count($a); $j++) {
// 			if($a[$j] - $a[$i] > $maxDiff && ($j > $i)) {
// 				$maxDiff = $a[$j] - $a[$i];
// 			}
// 		}
// 	}

// 	echo $maxDiff;

// }
// maxDifference($a);


// $len = 14;

// for ($row = 0; $row <= $len; $row++)
// {
//     for ($col = 0; $col <= ($row > $len/2 ? $len - $row : $row); $col++)
//     {
//         echo '*';
//     }

//     echo "<br>";
// }
// $letters = range('A', 'K')

// for($alpha = 'A'; $alpha < 'K'; $alpha++) {
// 	for($num = 0; $num < 10; $num++) {
// 		echo $alpha + $num;
// 	}
// 	echo '<br>';
// }

// $letters = range('A', 'J');

// foreach ($letters as $one) {
//   foreach ($letters as $two) {
//     foreach ($letters as $three) {
//       foreach ($letters as $four) {
//         echo "$one$two$three$four<br>";
//       }
//     }
//   }
// }

// $s = "Howdy there what's going on";

// $s2 = str_split($s);
// $len = count($s2);

// for($i = $len - 1; $i >= 0; $i--) {
// 	echo $s2[$i];
// }