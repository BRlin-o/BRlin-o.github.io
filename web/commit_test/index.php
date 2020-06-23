<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Contnct-type" content="text/html; charset=utf-8">

        <style>
            .container {
                margin: auto;
                width: 100%;
                
            }

            .container-input {
                background-color: #2499ff;
                margin: auto;
                width: 60%;
                text-align: center;
            }

            .container-output {
                margin: auto;
                width: 80%;
            }

            .userInput{
                padding: 5px;
                text-align: center;
            }

            .messageInput{
                margin: auto;
                height: 100%;
                padding: 5px;
                text-align: center;
                vertical-align: middle;
            }

            .commit-message{
                border-collapse: collapse;
                width: 100%;
                margin: auto;
            }

            .commit-message th{
                background-color: #4041dc;
                border: 2px solid #9899dc;
                color: white;
            }

            .commit-message td{
                background-color: #9899dc;
                text-align: center;
            }

            .bigSubmit{
                height: 60px;
                width: 100px;
            }

            .PostButton{
                border-radius: 5px;
            }
        </style>
    </head>

    <body>
        <?php
            $connect = mysqli_connect("localhost", 'root', '', 'test');
            if($connect == false){
                echo "連線失敗";
                return;
            }
            mysqli_query($connect, 'set names utf8');
            session_start();
            //print_r($_POST);
            //echo '<br>';
            //print_r($_SESSION);
            $select_id = array();
            if(isset($_POST['edit'])){
                $select_id = key($_POST['edit']);
                $_SESSION['type'] = 'edit';
            }
            if(isset($_POST['delete'])){
                $select_id = key($_POST['delete']);
                $_SESSION['type'] = 'delete';
            }
            if(isset($_POST['save'])){
                if(isset($_SESSION['type'])){
                    if($_SESSION['type'] == 'delete'){
                        mysqli_query($connect, sprintf("DELETE FROM tbl_message_v2 WHERE mid='%s';", key($_POST['save'])));
                    }else if($_SESSION['type'] == 'save'){
                        mysqli_query($connect, sprintf("UPDATE tbl_message_v2 SET message='%s' WHERE mid='%s';", $_POST['editmessage'][key($_POST['save'])], key($_POST['save'])));
                    }
                    unset($_SESSION['type']);
                }
            }
            if(isset($_POST['cancel'])){
                unset($_SESSION['type']);
            }
            if(isset($_POST['select_delete'])){
                foreach($_POST['check'] as $key => $value){
                    mysqli_query($connect, sprintf("DELETE FROM tbl_message_v2 WHERE mid='%s';", $key));
                }
                unset($_SESSION['select_all']);
            }
            if(isset($_POST['select_all'])){
                $_SESSION['select_all'] = (isset($_SESSION['select_all']) ? 1-$_SESSION['select_all'] : 1);
            }

            if(isset($_POST['postingMessage']) && $_POST['postName']!="" && $_POST['postMessage']!=""){
                mysqli_query($connect, sprintf("INSERT INTO tbl_message_v2(username, message) VALUE ('%s', '%s');", (string)$_POST['postName'], (string)$_POST['postMessage']));
                
                //echo sprintf('<br>insert Over {%s} {%s} <br>', $_POST['postName'], $_POST['postMessage']);
            }

            //echo '<hr>';
            //print_r($_POST);
            //echo '<br>';
            //print_r($_SESSION);
        ?>
        <form method="POST">
            <div class="container-input">
                <div class="userInput">
                    UserName:
                    <input type="text" name="postName">
                </div>
                <table class="messageInput">
                    <tbody>
                        <tr>
                            <td>Message:</td>
                            <td><textarea name="postMessage"></textarea></td>
                        </tr>
                    </tbody>
                </table>
                <input type="submit" class="PostButton bigSubmit" name="postingMessage">
                <hr>
            </div>
            <div class="container-output">
                <table class="commit-message">
                    <tr>
                        <td colspan=1><input type="submit" name="select_all" value="全選"></td>
                        <td colspan=1><input type="submit" name="select_delete" value="勾選刪除"></td>
                    </tr>
                    <tr>
                        <th>選取</th>
                        <th>動作</th>
                        <th>發言人</th>
                        <th>訊息</th>
                        <th>日期</th>
                    </tr>
                    <?php
                        $sql_result = mysqli_query($connect, "SELECT * FROM tbl_message_v2 ORDER BY mid DESC;");
                        while($row = mysqli_fetch_assoc($sql_result)){
                            echo '<tr>';
                            echo '<td><input type="checkbox" name="check[' . $row['mid'] . ']" ' . ((isset($_SESSION['select_all']) && $_SESSION['select_all'] == 1) ? 'checked' : '') . '></td>';
                            if(isset($select_id) && $select_id == $row['mid']){
                                echo '<td><input type="submit" class="PostButton" name="save[' . $row['mid'] . ']" value="確認"><input type="submit" class="PostButton" name="cancel" value="取消"></td>';
                            }else{
                                echo '<td><input type="submit" class="PostButton" name="edit[' . $row['mid'] . ']" value="修改"><input type="submit" class="PostButton" name="delete[' . $row['mid'] . ']" value="刪除"></td>';
                            }
                            echo '<td>' . htmlspecialchars($row['username']) . '</td>';
                            if(isset($select_id) && $select_id == $row['mid'] && $_SESSION['type'] == 'edit'){
                                echo '<td><input type="input[' . $row['mid'] . ']" name="editmessage[' . $row['mid'] . ']" value="' . htmlspecialchars($row['message']) . '">';
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