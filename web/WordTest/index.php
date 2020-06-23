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
                background-color: #0584F2;
                margin: auto;
                width: 60%;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }
            div.box {
                margin: 0 auto;
                padding: 50px;
                width: 300px;
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
                width: 400px;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                text-align: center;
            }

            div.topic {
                background-color: #4CAF50;
                color: white;
                font-size: 40px;
            }

            div.require {
                padding: 10px;
            }
        </style>
    </head>
    
        
    <body>
        <div class="container">
            <div class="box">
                <h1>Word List</h1>
                <div>
                    <table>
                        <tr>
                            <th>英文</th>
                            <th>中文</th>
                            <th>音檔</th>
                        </tr>
                        <?php require 'word.php';
                            $Word = new WordList();
                            $Wordlist = $Word->getList();
                            foreach($Wordlist as $word){
                                echo '<tr>';
                                echo '<td>' . $word[0] . '</td>';
                                echo '<td>' . $word[1] . '</td>';
                                echo '<td><input type="button" class="jfk image" id="' . $word[0] . '" onclick="doAudio(this)"></td>';
                                //echo '<td><audio src="https://translate.google.com/translate_tts?ie=UTF-8&tl=en&client=tw-ob&q=' . $word[0] . '"controls id="audio_' . $word[0] . '"></audio></td>';
                                echo '</tr>';
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <script>
            function httpGet(theUrl)
            {
                var xmlHttp = new XMLHttpRequest();
                xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
                xmlHttp.send( null );
                return xmlHttp.responseText;
            }
            async function doAudio(e){
                console.log(e.id);
                var i=10;
                var audio;
                while(--i){
                    try{
                        audio = new Audio("https://translate.google.com/translate_tts?client=tw-ob&tl=en&q=" + (e.id).toString());
                        console.log('Loading...');
                        break;
                    }catch(err){
                        console.log('Failed to load...' + err);
                    }
                }
                i=10;
                while(--i){
                    try {
                        await audio.play();
                        console.log('Playing...');
                        break;
                    } catch (err) {
                        console.log('Failed to play...' + err);
                    }
                }
            }
        </script>
    </body>
</html>