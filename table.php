<?php

$nums = array('one' => 1, 'two' => 2, 'three' => 3);

echo $nums['one'].' SPACE SPACE TEST SPACE'.$nums['two'];



 


echo '<table border='1' cellspacing='1'>';


  echo '<tr>';
    echo '<th> WORD</th>';
    echo '<th> DIGIT</th>';
  echo '</tr>';
 foreach ($nums as $word => $digit){
                
                
   echo'<td>'. $word.'</td>';
   echo'<td>'. $digit.'</td>';                
   echo '<tr>';
                
 }
 
 
 
 

echo '</table>';


?>
*/