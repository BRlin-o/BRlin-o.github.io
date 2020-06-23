<!DOCTYPE html>
<html>
    <head>
        <title>Times Table 9x9</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <style>
            * {
                font-size: 16px;
            }
            table {
                border-collapse: collapse;
                margin: auto;
            }
            caption {
                font-family: sans-serif;
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
            td {
                font-family: monospace;
                width: 110px;
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
                                $value = ($i*3+$j+1);
                                echo '<div>' . $value . ' x ' . $k . ' = ' . ($value*$k<10 ? '&nbsp;' : '') . $value*$k . '</div>';
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