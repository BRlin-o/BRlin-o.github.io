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
                color: white;
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
            td.center {
                text-align: center;
            }
        </style>
    </head>

    <body>
        <?php
            print_r($_POST);
            $connect = mysqli_connect("localhost","root","","test");
            $sql = "set names utf8";
            mysqli_query($connect, $sql);
            $select_info = array();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_POST['sure']) && $_POST['message']!=""){
                    $sql = sprintf("INSERT INTO tbl_message (post_ID, message) VALUE ('%s', '%s');", $_POST['person'], $_POST['message']);
                    mysqli_query($connect, $sql);
                    $_POST['message']="";
                }
                if(isset($_POST['edit'])){
                    $select_info['id'] = key($_POST['edit']);
                    $select_info['exist'] = true;
                    $select_info['type'] = "edit";
                }
                if(isset($_POST['delete'])){
                    $select_info['id'] = key($_POST['delete']);
                    $select_info['exist'] = true;
                    $select_info['type'] = "delete";
                }
                if(isset($_POST['cancel'])){
                    $select_info = array();
                }
                if(isset($_POST['save'])){
                    $select_info['id'] = key($_POST['save']);
                    if(isset($select['type']) && $$select['type']=="edit"){
                        $msg = $_POST['msg'][$select_id];
                        $sql = sprintf("UPDATE tbl_message SET message='%d' WHERE mid='%d';", $msg, $select_id);
                        mysqli_query($connect, $sql);
                    }else if(isset($select['type']) && $$select['type']=="delete"){
                        $sql = sprintf("DELETE FROM tbl_message WHERE mid='%d';", $select_id);
                        mysqli_query($connect, $sql);
                    }
                    $select_info = array();
                }
                
            }
            print_r($select_info);
        ?>
        <div class="container">
            <form method="post" enctype="multipart/form-data">
                <div class="mInput">
                    UserName: <input type="text" name="person" id="">
                    message: <textarea name="message" rows="5"></textarea>
                    <input type="submit" name="sure" value="留言">
                </div>
                <div class='all_message'>
                    <table border="1" class="mTable">
                        <tr>
                            <th>選取</th>
                            <th>留言人 ID</th>
                            <th>內容</th>
                            <th>時間</th>
                            <th>動作</th>
                        </tr>
                        <?php
                            $sql = sprintf("SELECT * FROM tbl_message ORDER BY create_date DESC;");
                            $messageList = mysqli_query($connect, $sql);
                            while($row = mysqli_fetch_assoc($messageList)){
                                echo '<tr>';
                                echo '<td class="center"><input type="checkbox" name=isselect['.$row['mid'].']></td>';
                                echo '<td><span>"'.$row['post_ID'].'"</span></td>';
                                if(isset($select_info['id']) && $select_info['id'] == $row['mid'] && $select_info['type']=="edit"){
                                    echo '<td><input type="text" name="msg[' . $row['mid'] . ']" value="' . $row['message'] . '"></td>';
                                }else{
                                    echo '<td>"'.$row['message'].'"</td>';
                                }
                                echo '<td>"'.$row['create_date'].'"</td>';
                                echo '<td>';
                                if(isset($select_info['id']) && $select_info['id'] == $row['mid']){
                                    echo '<input type="submit" name="save[' . $row['mid'] .']" value="儲存"><input type="submit" name="cancel[' . $row['mid'] .']" value="取消"></td>';
                                }else{
                                    echo '<input type="submit" name="edit[' . $row['mid'] .']" value="編輯"><input type="submit" name="delete[' . $row['mid'] .']" value="刪除"></td>';
                                }
                                echo '</tr>';
                            }
                        ?>
                    </table>
                </div>
            </form>
        </div>
    </body>
</html>