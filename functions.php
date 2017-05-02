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
    echo '</table>';
    echo '<button class="button" onclick="solvePuzzleForm(); return false;">Solve</button>';
    echo '<button class="button" onclick="clearInputs(); return false;">Clear</button>';
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
    echo '<select class="button" id="select_puzzle_box" name="puzzle">';
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
    echo '<div><input type="submit" id="choose_puzzle" class="button" value="Random Puzzle"/></div>';
    echo '</form>';
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

// Solve this puzzle array
function solvePuzzle($puzzle)
{
    // Find the first empty cell
    
    $i = 0;
    while($puzzle[$i] != 0)
    {
        $i++;
        if($i == 81)
        {
            return $puzzle; //found a solution
        }
    }
    
    // Get the positions on the grid for easy use
    $x = $i % 9;
    $y = (int)($i / 9);
    
    //Grab the blocks
    $xb = block($x);
    $yb = block($y);
    
    // Now try to fill the cell with a value
    // Accept values 1 thru 9
    for($v = 1; $v < 10; $v++)
    {
        
        // Check row and column conflicts (both at same time)
        $conflict = 0;
        for($j = 0; $j < 9; $j++)
        {
            // X conflicts
            if($puzzle[indexOf($j, $y)] == $v)
            {
                $conflict = 1;
                break;
            }
            // Y conflicts
            if($puzzle[indexOf($x, $j)] == $v)
            {
                $conflict = 1;
                break;
            }
        }
        
        
        //Check the local block for conflicts
        for($j = 0; $j < 3; $j++)
        {
            for($k = 0; $k < 3; $k++)
            {
                if($puzzle[indexOf((3 * $xb) + $j,(3 * $yb) + $k)] == $v)
                {
                    $conflict = 1;
                    break;
                }
            }
        }
        if($conflict == 1) continue;
        
        // There are no conflicts, so we test-fill this cell with this value, then move on to the next cell
        $puzzle[indexOf($x, $y)] = $v;
        $rec = solvePuzzle($puzzle);
        if($rec != null) return $rec;
        else
        {
            $puzzle[$i]=0;
            continue;
        }
    }
    // return null to let the previous function in the stack know that we could not solve
    return null;
}
?>