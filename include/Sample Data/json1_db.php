<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    
    <title>JSON to DB</title>

    <style>
        .box {
            width: 100vw;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div class="container box">
        <h3 align="center">
            Import JSON 
            data into database
        </h3><br />

        <?php 
    
            $mysqli = mysqli_connect("localhost", "root", "", "initialsystem");
 
            $query = '';
            $table_data = '';

            $json = "sample_user.json";
            $jsondata = file_get_contents($json);
            $user_data = json_decode($jsondata, true);

            
            foreach ($user_data as $row) {
                $query = "INSERT INTO users (applicantid, username, fname, lname, email, user_type, password, studentType, college) 
                           VALUES ('".$row["applicantid"]."', '".$row["username"]."', '".$row["fname"]."', '".$row["lname"]."', '".$row["email"]."', '".$row["user_type"]."', '".md5($row["password"])."', '".$row["studentType"]."', '".$row["college"]."');";
                $table_data = '
                    <tr>
                        <td>'.$row["applicantid"].'</td>
                        <td>'.$row["username"].'</td>
                        <td>'.$row["fname"].'</td>
                        <td>'.$row["lname"].'</td>
                        <td>'.$row["email"].'</td>
                        <td>'.$row["user_type"].'</td>
                        <td>'.$row["studentType"].'</td>
                        <td>'.$row["college"].'</td>
                    </tr>'; 
                    if (mysqli_query($mysqli, $query)) {
                        echo '
                            <table class="table table-bordered">
                                <tr>
                                    <th width="5%">Applicant ID</th>
                                    <th width="10%">Username</th>
                                    <th width="15%">FirstName</th>
                                    <th width="15%">LastName</th>
                                    <th width="15%">Email</th>
                                    <th width="5%">User Type</th>
                                    <th width="5%">Student Type</th>
                                    <th width="30%">College</th> 
                                </tr>';
                                echo $table_data;  
                            echo '</table>';
                    } else {
                        echo '<h3 class="text-center">No Action!</h3><br />';
                    }
            }
        ?>

        <br />
    </div>

</body>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</html>