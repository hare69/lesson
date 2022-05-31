<?php
    // ■1-1
    // 1,2,3
    // 4,6
    // 7,8,9
    for($i=1;$i<=9;$i++){
        if($i == 5){
            continue;
        }else{
            echo $i;
        }   
        
        if ($i % 3 == 0) {
            echo "<br>";
        }else if(!$i % 3 == 0){
            echo ',';
        }  
    }
    

    // ■1-2
    // 1-1,1-2,1-3
    // 2-1,2-2,2-3
    // 3-1,3-2,3-3
    // 5-1,5-3
    for($n=1;$n<=5;$n++){
        for($m=1;$m<=3;$m++){
            if($n == 4){
                continue;
            }else if($n == 5 && $m == 2){
                continue;
            }else{
                echo $n.'-'.$m;
            }
            if ($m % 3 == 0) {
                echo "<br>";
            }else if(!$m % 3 == 0){
                echo ',';
            }  
        }
    }

    ?>
   



