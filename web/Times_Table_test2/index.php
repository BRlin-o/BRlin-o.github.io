<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">

        <style>
            .container {
                margin: auto;
                width: 100%;
            }
            table{
                border-collapse: collapse;
                margin: auto;
            }
            table th{
                background-color: black;
                color: white;
                font-size: 14px bold;
            }
            table tr, th, td{
                border: 1px solid black;
            }
            table td{
                width: 100px;
                padding: 5px;
                text-align: center;
            }
            pre {
                margin: 0px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <table>
                <tr>
                    <th colspan=3>九九乘法表</td>
                </tr>
                <?php
                    for($i=1;$i<=9;++$i){
                        if(($i-1)%3==0)echo '<tr>';
                        echo '<td>';
                        for($j=1;$j<=9;++$j){
                            echo '<pre>' . sprintf("%d * %d = %2d", $i, $j, $i*$j) . '</pre>';
                        }
                        echo '</td>';
                        if(($i)%3==0)echo '</tr>';
                    }
                ?>
            </table>
        </div>
    </body>
</html>