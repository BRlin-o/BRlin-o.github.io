<!DOCTYPE html>
<html>
    <head>
        <title>English - Words - Test</title>
        <meta http-equiv="type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
        <style>
            body{
                background-color: #7ab6eb;
                color: white;
                font-family: 'Open Sans';
            }

            .jfk {
                background: url('icon/jkf.png') top center;
                width: 25px;
            }

            div.container {
                padding: 50px;
                background-color: #0584F2;
                margin: auto;
                width: 60%;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }
            div.box {
                text-align: center;
                padding: 50px;
                margin: auto;
                width: 60%;
                }
            table {
                border: 3px solid #9899dc;
            }

            table td{
                border: 2px solid #9899dc;
                text-align: left;
            }
            table.image {
                text-align: center;
            }

            div.card {
                width: 100%;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                text-align: center;
            }

            div.topic {
                background-color: #4CAF50;
                color: white;
                text-align: center;
                font-size: 40px;
            }

            div.require {
                padding: 10px;
            }
        </style>
    </head>
    
        
    <body>
        <div class="container">
            <h1>Test</h1>
            <input type="submit" name="startTest" onclick="getWord()" value="開始測驗">
            <div class="box">
                <?php 
                    /*
                    require 'word.php';
                    $TestWord = new WordList();
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if(isset($_POST['startTest'])){
                            $Wordlist = $Word->getTest(2, 6);
                        }
                        if(isset($_POST['delete'])){
                            
                        }
                    }
                    */
                ?>
                
                <div class="card">
                    <span class="topic" id="topic"></span>
                    <input type="text" id="answer">
                    <input type="submit" name="startTest" onclick="getTopic()" value="->Next->">
                </div>
            </div>
        </div>
        <script>
            var jArray;
            var index;
            var answer;
            function getWord(){
                <?php require 'word.php';
                    $Word = new WordList();
                    $Wordlist = $Word->getTest(2, 6);
                ?>
                jArray = <?php echo json_encode($Wordlist); ?>;
                console.log(jArray);
                index = 0;
                getTopic();
            }

            function getTopic(){
                document.getElementById("topic").textContent=jArray[index][0] == 2 ? jArray[index][1][0] : jArray[index][1][1];
                $answer = document.getElementById("answer").value;
                
                ++index;
            }
        </script>
    </body>
</html>