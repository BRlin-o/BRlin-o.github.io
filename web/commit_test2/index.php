<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <style>
            .input {
                margin: auto;
                width: 60%;
                text-align: center;
            }

            .output {
                width: 100%;
                text-align: center;
            }

            .box {
                border: 2px solid black;
                margin: auto;
                width: 80%;
            }

            table{
                border-collapse: collapse;
            }

            table tr, td, th{
                border: 1px solid black;
            }
        </style>
    </head>

    <body>
        <?php
            $connect = mysqli_connect('localhost', 'root', '', 'test');
            if(!$connect){
                echo '連接錯誤';
                return;
            }
            mysqli_query($connect, 'set names utf8');

            $select_id = null;
            if(isset($_POST['edit'])){
                $select_id = key($_POST['edit']);
            }
            if(isset($_POST['delete'])){
                //$select_id = key($_POST['delete']);
                mysqli_query($connect, sprintf("DELETE FROM tbl_message_v2 WHERE mid='%s';", key($_POST['delete'])));
            }
            if(isset($_POST['save'])){
                mysqli_query($connect, sprintf("UPDATE tbl_message_v2 SET message='%s' WHERE mid='%s';", $_POST['editmessage'], key($_POST['save'])));
            }
            if(isset($_POST['select_delete']) && isset($_POST['check'])){
                print_r($_POST['check']);
                for($i=0;$i<count($_POST['check']);++$i){
                    mysqli_query($connect, sprintf("DELETE FROM tbl_message_v2 WHERE mid='%d'", $_POST['check'][$i]));
                }
                // foreach($_POST['check'] as $key => $value){
                //     mysqli_query($connect, sprintf("DELETE FROM tbl_message_v2 WHERE mid='%s'", $key));
                // }
            }
            if(isset($_POST['postingMessage'])){
                mysqli_query($connect, sprintf("INSERT INTO tbl_message_v2 (username, message) VALUE ('%s', '%s');", $_POST['username'], $_POST['message']));
            }
        ?>

        <form method="POST">
            <div class="input">
                username:
                <input type="text" name="username">
                <br>
                message:
                <textarea name="message"></textarea>
                <br>
                <input type="submit" name="postingMessage" value="送出訊息">
            </div>
            <div class="box">
                <table class="output">
                    <tr>
                        <td><input type="submit" name="select_delete" value="勾選刪除"></td>
                    </tr>
                    <tr>
                        <th>選取</th>
                        <th>動作</th>
                        <th>發起人</th>
                        <th>訊息</th>
                        <th>時間</th>
                    </tr>
                    <?php
                        $sql_result = mysqli_query($connect, sprintf("SELECT * FROM tbl_message_v2 ORDER BY build_date DESC;"));
                        while($row = mysqli_fetch_assoc($sql_result)){
                            echo '<tr>';
                            echo '<td><input type="checkbox" name="check[]" value="' . $row['mid'] . '"></td>';
                            //echo '<td><input type="checkbox" name="check[' . $row['mid'] . ']"></td>';
                            if($select_id == $row['mid']){
                                echo '<td><input type="submit" name="save[' . $row['mid'] . ']" value="確認"><input type="submit" name="cercal[' . $row['mid'] . ']" value="取消"></td>';
                            }else{
                                echo '<td><input type="submit" name="edit[' . $row['mid'] . ']" value="修改"><input type="submit" name="delete[' . $row['mid'] . ']" value="刪除"></td>';
                            }
                            echo '<td>' . htmlspecialchars($row['username']) . '</td>';
                            if($select_id == $row['mid']){
                                echo '<td><input type="text" name="editmessage" value="' . htmlspecialchars($row['message']). '"></td>';
                            }else{
                                echo '<td>' . htmlspecialchars($row['message']) . '</td>';
                            }
                            echo '<td>' . htmlspecialchars($row['build_date']) . '</td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
        </form>
    </body>
</html>