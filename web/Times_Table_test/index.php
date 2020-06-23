<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">

        <style>
            .container{
                /*background-color: green;*/
                margin: auto;
                width: 100%;
                height: 100%;
            }

            .myTable {
                margin: auto;
                border-collapse: collapse;
                text-align: center;
            }
            .myTable th{
                background-color: black;
                color: white;
                font-size: 14px;
                font-size: bold;
            }
            .myTable tr, td, th{
                border: 1px black solid;
            }
            .mol {
                padding: 5px;
            }
            pre{
                margin: 1px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <table class="myTable">
                <tbody>
                    <tr>
                        <th colspan="3">九九乘法表</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="mol">
                                <pre>1*1 =  1</pre>
                                <pre>1*2 =  2</pre>
                                <pre>1*3 =  3</pre>
                                <pre>1*4 =  4</pre>
                                <pre>1*5 =  5</pre>
                                <pre>1*6 =  6</pre>
                                <pre>1*7 =  7</pre>
                                <pre>1*8 =  8</pre>
                                <pre>1*9 =  9</pre>
                            </div>
                        </td>
                        <td>
                            <div class="mol">
                                <pre>2*1 =  2</pre>
                                <pre>2*2 =  4</pre>
                                <pre>2*3 =  6</pre>
                                <pre>2*4 =  8</pre>
                                <pre>2*5 = 10</pre>
                                <pre>2*6 = 12</pre>
                                <pre>2*7 = 14</pre>
                                <pre>2*8 = 16</pre>
                                <pre>2*9 = 18</pre>
                            </div>
                        </td>
                        <td>
                            <div class="mol">
                                <pre>3*1 =  3</pre>
                                <pre>3*2 =  6</pre>
                                <pre>3*3 =  9</pre>
                                <pre>3*4 = 12</pre>
                                <pre>3*5 = 15</pre>
                                <pre>3*6 = 18</pre>
                                <pre>3*7 = 21</pre>
                                <pre>3*8 = 24</pre>
                                <pre>3*9 = 27</pre>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="mol">
                                <pre>4*1 =  4</pre>
                                <pre>4*2 =  8</pre>
                                <pre>4*3 = 12</pre>
                                <pre>4*4 = 16</pre>
                                <pre>4*5 = 20</pre>
                                <pre>4*6 = 24</pre>
                                <pre>4*7 = 28</pre>
                                <pre>4*8 = 32</pre>
                                <pre>4*9 = 36</pre>
                            </div>
                        </td>
                        <?php
                            for($i=5;$i<7;++$i){
                                echo '<td><div class="mol">';
                                for($j=1;$j<=9;++$j){
                                    echo '<pre>' . sprintf("%d*%d = %2d", $i, $j, $i*$j) . '</pre>';
                                }
                                echo '</div></td>';
                            }
                        ?>
                    </tr>
                    
                    <?php
                        echo '<tr>';
                        for($i=7;$i<10;++$i){
                            echo '<td><div class="mol">';
                            for($j=1;$j<=9;++$j){
                                echo '<pre>' . sprintf("%d*%d = %2d", $i, $j, $i*$j) . '</pre>';
                            }
                            echo '</div></td>';
                        }
                        echo '</tr>';
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>