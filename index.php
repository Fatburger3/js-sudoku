<!DOCTYPE html>
<html>
	<head>
		<title>Sudoku Solver</title>
		<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
		<script src="sudoku.js"></script>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.css">
	
	</head>
	<body onload="randomChanged();">
		<div id="main">
		<h1>Sudoku Solver</h1>
		<?php
		
		
		$puzzles = array();
		$puzzles[]=array(
		    8,0,0,  0,0,0,  0,0,0,
		    0,0,3,  6,0,0,  0,0,0,
		    0,7,0,  0,9,0,  2,0,0,
		    
		    0,5,0,  0,0,7,  0,0,0,
		    0,0,0,  0,4,5,  7,0,0,
		    0,0,0,  1,0,0,  0,3,0,
		                
		    0,0,1,  0,0,0,  0,6,8,
		    0,0,8,  5,0,0,  0,1,0,
		    0,9,0,  0,0,0,  4,0,0
		);
		$puzzles[]=array(
		    0,0,0,  0,0,0,  0,0,0,
		    0,8,9,  4,1,0,  0,0,0,
		    0,0,6,  7,0,0,  1,9,3,
		    
		    2,0,0,  0,0,0,  7,0,0,
		    3,4,0,  6,0,0,  0,1,0,
		    0,0,0,  9,0,0,  0,0,5,
		    
		    0,0,0,  0,2,0,  0,5,0,
		    6,5,0,  0,4,0,  0,2,0,
		    7,3,0,  1,0,0,  0,0,0
		);
		$puzzles[]=array(
		    0,0,0,  0,4,0,  0,0,0,
		    5,0,0,  0,0,3,  0,8,0,
		    0,6,0,  0,0,0,  5,2,7,
		    
		    0,0,0,  0,0,0,  0,0,0,
		    0,0,0,  0,3,6,  0,0,0,
		    0,0,7,  0,2,8,  0,6,9,
		    
		    0,2,0,  9,8,0,  0,0,0,
		    3,0,0,  0,1,5,  0,4,0,
		    0,0,0,  0,0,4,  0,7,8
		);
		$puzzles[]=array(
		    0,0,0,  8,0,2,  0,1,0,
		    0,0,1,  0,9,5,  0,0,0,
		    0,0,8,  1,0,0,  2,4,7,
		    
		    9,7,0,  0,5,0,  6,0,0,
		    0,0,0,  4,1,0,  0,8,0,
		    0,0,0,  0,0,0,  0,0,9,
		    
		    0,5,0,  0,0,0,  0,0,6,
		    0,0,0,  6,0,0,  0,2,3,
		    0,0,7,  0,3,0,  0,0,0
		);
		$puzzles[]=array(
		    0,0,0,  0,0,3,  0,0,4,
		    7,0,0,  0,0,0,  6,0,1,
		    1,0,0,  0,0,8,  0,0,2,
		    
		    2,0,0,  0,8,7,  0,0,9,
		    4,0,0,  5,0,0,  0,0,0,
		    0,7,0,  0,0,0,  5,1,0,
		    
		    9,0,0,  0,0,1,  0,8,0,
		    0,3,2,  0,0,5,  0,0,0,
		    0,5,0,  0,3,0,  0,4,6
		);
		// $puzzles[]=array(
		//     0,0,0,  0,0,0,  0,0,0,
		//     0,0,0,  0,0,0,  0,0,0,
		//     0,0,0,  0,0,0,  0,0,0,
		    
		//     0,0,0,  0,0,0,  0,0,0,
		//     0,0,0,  0,0,0,  0,0,0,
		//     0,0,0,  0,0,0,  0,0,0,
		    
		//     0,0,0,  0,0,0,  0,0,0,
		//     0,0,0,  0,0,0,  0,0,0,
		//     0,0,0,  0,0,0,  0,0,0
		// );
		
		// aw what the hell, lets throw in a MIND-NUMBINGLY easy puzzle.
		$puzzles[]=array(
		    0,9,5,  7,4,3,  8,6,1,
		    4,3,1,  8,6,5,  9,2,7,
		    8,7,6,  1,9,2,  5,4,3,
		    
		    3,8,7,  4,5,9,  2,1,6,
		    6,1,2,  3,8,7,  4,9,5,
		    5,4,9,  2,1,6,  7,3,8,
		    
		    7,6,3,  5,3,4,  1,8,9,
		    9,2,8,  6,7,1,  3,5,4,
		    1,5,4,  9,3,8,  6,7,2
		);
		$puzzles_len = count($puzzles) - 1;
		// Get a random puzzle
		function getRandPuzzle()
		{
		    global $puzzles;
		    global $puzzles_len;
		    return $puzzles[rand(0, $puzzles_len)];
		}
		function getPuzzle($i)
		{
		    global $puzzles;
		    return $puzzles[$i];
		}
		
		// Get the index of these x, y coords
		function indexOf($x, $y)
		{
		    return (9 * $y) + $x;
		}
		
		// Get the index of these x, y, xb, yb coords
		function indexOfBlock($xb, $yb, $x, $y)
		{
		    return indexOf((3*$xb)+$x,(3*$yb)+$y);
		}
		
		// Gets the block # that this cartesian index(x or y) is in
		function block($xy)
		{
		    return (int) ($xy / 3);
		}

		// Display the puzzle on the form
		function displayPuzzle($puzzle)
		{
		    echo '<table align="center" class="puzzle">';
		    for($yb = 0; $yb < 3; $yb++)
		    {
		        echo '<tr class="puzzle_block_row">';
		        for($xb = 0; $xb < 3; $xb++)
		        {
		            echo '<td class="puzzle_block"><table>';
		            for($y = 0; $y < 3; $y++)
		            {
		                echo '<tr class="puzzle_row">';
		                for($x = 0; $x < 3; $x++)
		                {
		                    $i = indexOfBlock($xb, $yb, $x, $y);
		                    echo '<td class="puzzle_cell">';
		                    //echo ($puzzle[$i] == 0?' ':$puzzle[$i]);
		                    echo ($puzzle[$i]);
		                    echo '</td>';
		                }
		                echo '</tr>';
		            }
		            echo '</table></td>';
		        }
		        echo '</tr>';
		    }
		    echo '</table>';
		}
		
		// Display the puzzle on the form
		function displayPuzzleForm($puzzle)
		{
		    //echo '<form class="puzzle_form">';
		    echo '<table align="center" class="puzzle">';
		    $i = 0;
		    for($yb = 0; $yb < 3; $yb++)
		    {
		        echo '<tr class="puzzle_block_row">';
		        for($xb = 0; $xb < 3; $xb++)
		        {
		            echo '<td class="puzzle_block"><table>';
		            for($y = 0; $y < 3; $y++)
		            {
		                echo '<tr class="puzzle_row">';
		                for($x = 0; $x < 3; $x++)
		                {
		                    $i = indexOfBlock($xb, $yb, $x, $y);
		                    $v = $puzzle[$i];
		                    echo '<td class="puzzle_cell">';
		                    echo '<input class="puzzle_input_cell" type="text" size="1" name="'.$i.'" id="'.$i.'" ';
		                    if($v != 0)
		                    {
		                        echo 'value="'.$v.'"';
		                    }
		                    echo '/>';
		                    echo '</td>';
		                }
		                echo '</tr>';
		            }
		            echo '</table></td>';
		        }
		        echo '</tr>';
		    }
		    echo '</table><br/>';
		    echo '<div class="btn-group" role="group" aria-label="Basic example">';
		    echo '<button class="btn btn-success" onclick="solvePuzzleForm(); return false;">Solve</button>';
		    echo '<button class="btn btn-warning" onclick="clearInputs(); return false;">Clear</button>';
		    echo '</div>';
		    //echo '</form>';
		}
		function displayPuzzleChooser($random, $puzzle_index)
		{
		    echo '<form class="puzzle_chooser" action="index.php" method="get">';
		    
		    echo 'Pick a random puzzle: ';
		    echo '<input type="radio" id="random_on"  name="random" value="Yes" onclick="randomChanged();"';
		    if ($random==='Yes') echo 'checked';
		    echo '>Yes</input>';
		    echo '&nbsp;';
		    echo '<input id="random_off" type="radio" name="random" value="No" onclick="randomChanged();"';
		    if ($random==='No') echo 'checked';
		    echo '>No</input>';
		    
		    echo '<div id="select_puzzle">';
		    echo 'Select a puzzle: ';
		    echo '<select id="select_puzzle_box" name="puzzle">';
		    global $puzzles_len;
		    for($i = 0; $i < $puzzles_len; $i++)
		    {
		        echo '<option value="';
		        echo $i;
		        echo '" ';
		        if($i == $puzzle_index)
		        {
		            echo 'selected="selected"';
		        }
		        echo '>';
		        $x = $i + 1;
		        echo $x;
		        echo '</option>';
		    }
		    echo '</select>';
		    echo '</div>';
		    echo '<div><input type="submit" id="choose_puzzle" class="btn btn-primary" value="Random Puzzle"/></div>';
		    echo '</form>';
		}
			if($_SERVER['REQUEST_METHOD'] === 'GET')
			{
				$puzzle = array();
				for($j = 0; $j < 9; $j++)
				{
					for($k = 0; $k < 9; $k++)
					{
						$i = indexOf($k, $j);
						$puzzle[]=$_POST[(string)$i];
					}
				}
				$flag = 0;
				for($j = 0; $j < 9; $j++)
				{
					for($k = 0; $k < 9; $k++)
					{
						$i = indexOf($k, $j);
						if(isset($puzzle[$i]) && $puzzle[$i] != 0)
						{
							$flag = 1;
							break 2;
						}
					}
				}
				$random = 'Yes';
				$puzzle_index = 0;
				
				if(isset($_GET['random'])) $random = $_GET['random'];
				if(isset($_GET['puzzle'])) $puzzle_index = intval($_GET['puzzle']);
				
				if($random == '')
				{
					echo 'ERROR: No value was selected for "Pick random puzzle"';
				}
				if($random === 'No' && $_GET['puzzle'] == '')
				{
					echo 'ERROR: No puzzle was selected';
				}
				
				if($random == 'Yes')
				{
					$puzzle = getRandPuzzle();
				}
				else
				{
					$puzzle = getPuzzle($puzzle_index);
				}
				echo '<div align="center">';
				displayPuzzleForm($puzzle);
				echo '<br/>';
				echo '<br/>';
				displayPuzzleChooser($random, $puzzle_index);
				echo '</div>';
					
			}
			
		?>
		</div>
		<hr>
		<table align="center"><tfoot>
			<tr>
				<th>
					2017 &copy; Carsen Yates.
				</th>
			</tr>
			<tr>
				<td>
					Disclaimer: All material above is used for teaching purposes.  Information might be inaccurate.
				</td>
			</tr>
			<tr>
				<td>
					<img src="img/csumb-logo.png" alt="CSUMB Logo"/>
				</td>
			</tr>
		</tfoot></table>
	</body>
</html>