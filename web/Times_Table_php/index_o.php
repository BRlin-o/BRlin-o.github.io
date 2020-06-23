<!DOCTYPE html>
<html>
    <head>
        <title>Times Table 9x9</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <style>
            * {
                font-family: monospace;
                font-size: 16px;
            }
            table {
                border-collapse: collapse;
                margin: auto;
            }
            caption {
                background-color: black;
                color: white;
            }
            tr, td {
                padding: 10px 14px;
                border: 1px black solid;
            }
            tr {
                text-align: center;
            }
            .box {
                width: 110px;
                display: inline-block; 
            }
            .Formula {
                text-align: left;
            }
            .ans {
                text-align: right;
            }
            .Form {
                display: inline;
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
                            echo '<td class="box">';
                            for($k=1;$k<=9;++$k){
                                $value = ($i*3+$j+1);
                                echo '<div><span class="Formula">' . $value . ' x ' . $k . ' = </span><span class="ans">' . (log10($value*$k)<=1 ? '&nbsp;' : '') . $value*$k . '</span></div>';
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