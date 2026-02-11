<?php
    echo "richiesta POST";
    var_dump($_POST);
    if($_POST && isset($_POST['submit']) && isset($_FILES))
    {
        var_dump($_FILES);

        if(isset($_FILES["file1"]))
        {
            var_dump($_FILES["file1"]);

            $path = $_FILES['file1']['tmp_name'];

            if(file_exists($path))
            {
                $contenuto = file_get_contents($_FILES['file1']['tmp_name']);//$_FILES è una struttura formata da un doppio array associativo
                $contenuto_decode= json_decode($contenuto, true);//true ritorna array associativo, false un oggetto
                var_dump($contenuto_decode);

                foreach($contenuto_decode as $key => $value)
                {
                    var_dump($key);
                    var_dump($value);
                    //inserisco la tupla appena letta nel database
                }
            }
            else
            {
                echo "file non trovato";
            }   
        }
        if(isset($_FILES["file2"]))
        {
            var_dump($_FILES["file2"]);
            $path = $_FILES['file2']['tmp_name'];

            if(file_exists($path))
            {
                move_uploaded_file($path, './' . $_FILES['file2']['name']);
            }
            else
            {
                echo "file non trovato";
            }
            //inserimento del file nel database

        } 
    }
?>
<!DOCTYPE html>
<html>
    <body>
        <form action="" method="post" enctype="multipart/form-data">
        Select image to upload:
            <br>
            <input type="file" name="file1" id="file1">
            <br>
            <input type="file" name="file2" id="file2
            ">
            <br>
            <input type="submit" value="Upload Image" name="submit">
        </form>
    </body>
</html>