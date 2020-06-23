<!DOCTYPE html>
<html>
    <head>
        <title>MyCommit</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <style>
            body {
                background-color: lightblue;
            }
            .mTable {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }
            .mTable td {
                border: 1px solid #9899dc;
                text-align: left;
                padding: 8px;
            }
            .mTable tr:nth-child(even) {
                /*偶數格*/
                background-color: #bac1fe;
            }
            .mTable tr:hover {
                /*屬標放上去時*/
                background-color: #6d9afe;
            }
            .mTable th {
                /*標題欄*/
                background-color: #4041dc;
                border: 2px solid #9899dc;
                color: white;
                padding: 5px;
            }
            .mInput {
                background-color: #0584F2;
                margin: auto;
                width: 60%;
                padding: 10px;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }
            .all_message {
                padding: 30px;
                margin: auto;
                width: 80%;
            }
        </style>
    </head>

    <body>
        <?php require 'php/class/cls_db.php';
            $statusHandler = new statusHandler();
            $database = new database();
            $database->connect();
            $sql = new MysqliFactory($database->session, $statusHandler);
            $sql->SETCommand("SET NAMES utf8", array());
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_POST['sure'])){
                    $sql->INSERTCommand("INSERT INTO tbl_message (post_ID, message) VALUE (?, ?);", array($_POST['person'], $_POST['message']));
                }
                if(isset($_POST['delete'])){
                    
                }
            }
        ?>
        <div class="container">
            <div class="mInput">
                <form method="post">
                    UserName: <input type="text" name="person" id="">
                    message: <textarea name="message" rows="5"></textarea>
                    <input type="submit" name="sure" value="留言">
                </form>
            </div>
            <div class='all_message'>
                <table border="1" class="mTable">
                    <tr>
                        <th>留言人 ID</th>
                        <th>內容</th>
                        <th>時間</th>
                        <th>動作</th>
                    </tr>
                    <?php
                        $sql->SELECTListCommand("SELECT * FROM tbl_message WHERE post_ID = ? ORDER BY create_date DESC;", array(1));
                        $messageList = $sql->getResult();
                        foreach($messageList as $row){
                            echo '<tr>';
                            echo '<td>'.$row['post_ID'].'</td>';
                            echo '<td>'.$row['message'].'</td>';
                            echo '<td>'.$row['create_date'].'</td>';
                            echo '<td><input type="submit" name="delete" value="刪除"><input type="submit" name="edit" value="刪除"></td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>