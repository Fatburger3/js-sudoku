<!DOCTYPE html>
<html>
	<head>
		<title>Sudoku Solver</title>
		<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
		<script src="sudoku.js"></script>
		<style>
			@import url("css/style.css");
		</style>
	</head>
	<body onload="randomChanged();">
		<div id="main">
		<h1>Sudoku Solver</h1>
		<?php
			include 'functions.php';
			if($_SERVER['REQUEST_METHOD'] === 'POST')
			{
				
				echo '<div class="spacer"></div>';
				echo '<div id="submitted">';
				echo '<h2>You submitted:</h2>';
				displayPuzzle($puzzle);
				echo '</div>';
				
				echo '<div class="spacer">';
				echo '<a class="button" href="index.php">Restart</a>';
				echo '</div>';
				
				
				echo '<div id="solved">';
				echo '<h2>Solved:</h2>';
				
				if($flag == 0){
					echo 'ERROR: puzzle was found to be empty';
				}
				else{
					displayPuzzle(solvePuzzle($puzzle));
				}
				echo '</div>';
				
				echo '<div class="spacer"></div>';
				echo '<img id="checkmark" src="img/checkmark.png"/>';
				
			}
			elseif($_SERVER['REQUEST_METHOD'] === 'GET')
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