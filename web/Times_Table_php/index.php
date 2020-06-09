<!DOCTYPE html>
<html>
    <head>
        <title>Times Table 9x9</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <style>
            table, tr, td {
                border: 1px solid black;
                border-collapse: collapse;
            }

            .mForm {
                justify-content: center;
            }

            .mP {
                
            }
        </style>
    </head>
    <body>
        <div class="mForm">
            <table>
                <caption>Monthly savings</caption>
                <?php
                    for($i=0;$i<3;++$i){
                        echo '<tr>';
                        for($j=0;$j<3;++$j){
                            echo '<td>';
                            for($k=1;$k<=9;++$k){
                                echo '<form class="mP">' . ($i*3+$j+1) . ' x ' . $k . ' = ' . ($i*3+$j+1)*$k . '<br/></form>';
                                //echo '<span>' . ($i*3+$j+1) . '</span>';
                                //echo '<span> x </span>' . $k . '<span> = </span>';
                                //echo '<span>' . ($i*3+$j+1)*$k . '<br/><span>';
                            }
                            echo '</td>';
                        }
                        echo '</tr>';
                    }
                ?>
            </table>
        </div>
    </body>
</html>