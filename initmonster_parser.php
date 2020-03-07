<?php

// initmonster parser

// set variables
$file="InitMonster.txt";
$nextfour=[];
$monsters=[];


// read file line by line
$handle = fopen($file, "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
		
		// does line start with semi-colon
		if (strpos($line, '; ') === 0) {
			
			// make easier to read name
			$name = str_replace('; ','',$line);

			// display this line
			echo $name.'<br/>';

			// get next file
			$nextfour[] = next4($line,$file);
			
			// display results
			// echo $nextfour[0][2].'<br/>';
			// echo $nextfour[0][3].'<br/>';
			// echo $nextfour[0][4].'<br/>';
			parseline($nextfour[0][2]);
			parseline($nextfour[0][3]);
			parseline($nextfour[0][4]);
			
			echo '<br/>';
			
			// reset array
			$nextfour=[];
		}
		
		
    }

    fclose($handle);
} else {
    // error opening the file.
}

function parseline($line) {
	
	$array = explode(') (', trim($line, '()'));
	
	// display each line of array
	foreach($array as $attr) {
		// strip parantheses
		$attr = str_replace('(','',$attr);
		$attr = str_replace(')','',$attr);
		$attr = str_replace('monster ','',$attr);
		$attr = str_replace('itemgroup','<br/>itemgroup',$attr);
		
		// find first word on left
		$vna = explode(' ',trim($attr));
		$vn = $vna[0];
		$r = $vn.' ';
		$rest = str_replace($r,'',$attr);
		
		// echo $attr.'<br/>';
		echo $vn.' = '.$rest.'<br/>';
	}
	
}


function next4($title,$file) {

	// setup variables
	$counter=0;
	$results=[];
	
	// read file
	$grab = fopen($file, "r");
	if ($grab) {
		while (($line = fgets($grab)) !== false) {
			// check if line eq title
			if ($line == $title) {
				$counter++;
			}
			if ($counter > 0 && $counter < 5) {
				$results[$counter]=$line;
				$counter++;
			}
		}
	}
	
	fclose($grab);
	
	return $results;
	
}


?>
