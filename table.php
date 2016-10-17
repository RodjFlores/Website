<?php

$nums = array('one' => 1, 'two' => 2, 'three' => 3);

echo $nums['one'].' SPACE SPACE TEST SPACE'.$nums['two'];

?>







<html>
<body>
<table border='1' cellspacing='1'>
<tbody>


 <?php foreach ($nums as $word => $digit){
                
                
                echo'<td>'. $word[1].'</td>';
                echo'<td>'. $word[0].'</td>';
                echo'<td>'. $word[0].'</td>';
                echo'<tr>';
                
              }
            ?>
</tbody
</table>
</body>
</html>