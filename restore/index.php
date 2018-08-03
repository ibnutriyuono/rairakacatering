

<?php
$conn = mysqli_connect("localhost", "root", "", "db_sbd");
if (! empty($_FILES)) {
    // Validating SQL file type by extensions
    if (! in_array(strtolower(pathinfo($_FILES["backup_file"]["name"], PATHINFO_EXTENSION)), array(
        "sql"
    ))) {
        $response = array(
            "type" => "error",
            "message" => "Invalid File Type"
        );
    } else {
        if (is_uploaded_file($_FILES["backup_file"]["tmp_name"])) {
            move_uploaded_file($_FILES["backup_file"]["tmp_name"], $_FILES["backup_file"]["name"]);
            $response = restoreMysqlDB($_FILES["backup_file"]["name"], $conn);
        }
    }
}

function restoreMysqlDB($filePath, $conn)
{
    $sql = '';
    $error = '';
    
    if (file_exists($filePath)) {
        $lines = file($filePath);
        
        foreach ($lines as $line) {
            
            // Ignoring comments from the SQL script
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }
            
            $sql .= $line;
            
            if (substr(trim($line), - 1, 1) == ';') {
                $result = mysqli_query($conn, $sql);
                if (! $result) {
                    $error .= mysqli_error($conn) . "\n";
                }
                $sql = '';
            }
        } // end foreach
        
        if ($error) {
            $response = array(
                "type" => "error",
                "message" => $error
            );
        } else {
            $response = array(
                "type" => "success",
                "message" => "Database Restore Completed Successfully."
            );
        }
        exec('rm ' . $filePath);
    } // end if file exists
    
    return $response;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RaiRakaRestore</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
    <style>
    body {
        /* max-width: 550px; */
        font-family: "Segoe UI", Optima, Helvetica, Arial, sans-serif;
    }

    #frm-restore {
        background: #aee5ef;
        padding: 20px;
        border-radius: 2px;
        border: #a3d7e0 1px solid;
    }

    .form-row {
        margin-bottom: 20px;
    }

    .input-file {
        background: #FFF;
        padding: 10px;
        margin-top: 5px;
        border-radius: 2px;
    }

    /* .response {
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 2px;
    } */

    .error {
        background: #fbd3d3;
        border: #efc7c7 1px solid;
    }

    .success {
        background: #cdf3e6;
        border: #bee2d6 1px solid;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="section">
            <div class="row">
            <h2 class="center-align">RaiRakaRestore</h2>
                <?php
                if (! empty($response)) {
                    ?>
                <div class="response <?php echo $response["type"]; ?>">
                <?php echo nl2br($response["message"]); ?>
                </div>
                <?php
                }
                ?>
                <form method="post" action="" enctype="multipart/form-data"
                    id="frm-restore">
                    <div class="form-row">
                        <div>Choose Backup File</div>
                        <div>
                            <input type="file" name="backup_file" class="input-file" />
                        </div>
                    </div>
                    <div>
                        <input type="submit" name="restore" value="Restore"
                            class="btn blue lighten-1" />
                    </div>
                    <br>
                    <a href="../rairakacatering/admin">Kembali Ke Menu Admin</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>