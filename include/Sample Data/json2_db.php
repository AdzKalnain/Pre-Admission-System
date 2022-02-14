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

            $json = "sample_applicant.json";
            $jsondata = file_get_contents($json);
            $user_data = json_decode($jsondata, true);

            
            foreach ($user_data as $row) {
                $query = "INSERT INTO selectedcourse (user_id, course_id, userStatus, college, school_year, date) 
                           VALUES ('".$row["user_id"]."', '".$row["course_id"]."', '".$row["userStatus"]."', '".$row["college"]."', '".$row["school_year"]."', '".$row["date"]."');";
                $table_data = '
                    <tr>
                        <td>'.$row["user_id"].'</td>
                        <td>'.$row["course_id"].'</td>
                        <td>'.$row["userStatus"].'</td>
                        <td>'.$row["college"].'</td>
                        <td>'.$row["school_year"].'</td>
                        <td>'.$row["date"].'</td>
                    </tr>'; 
                    if (mysqli_query($mysqli, $query)) {
                        echo '
                            <table class="table table-bordered">
                                <tr>
                                    <th width="10%">User ID</th>
                                    <th width="10%">Course ID</th>
                                    <th width="20%">User Status</th>
                                    <th width="40%">College</th>
                                    <th width="10%">School-Year</th>
                                    <th width="10%">Date</th> 
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