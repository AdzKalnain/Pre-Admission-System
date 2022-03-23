<?php 

    require_once ("../../include/initialize.php");

    if (isset($_POST['score']) ? $_POST['score'] : null) {
        $score = $_POST['score'];
        $applicant_id = $_POST['user_id'];
        $gpa = $_POST['gpa'];
        
        $search = mysqli_query($mysqli, "SELECT * FROM users WHERE applicantid = '$applicant_id'");
        while ($row = (mysqli_fetch_assoc($search))) {
            $user_id = $row['id'];
            $cet = mysqli_query($mysqli, "SELECT * FROM cetresult WHERE applicantid = '$applicant_id'");
            while ($cet_result = mysqli_fetch_assoc($cet)) {
                $cet_score = $cet_result['cetresult'];
                $average = (($score*10)+$cet_score+$gpa)/3;
                $sql = "UPDATE selectedcourse SET inter_score = ?, gpa = ?, average = ?, userStatus = ? WHERE user_id = ?";
                if ($stmt = $mysqli->prepare($sql)) {
                    $stmt->bind_param("sssss", $param_score, $param_gpa, $param_average, $param_status, $param_userid);
                    $param_score = $score*10;
                    $param_gpa = $gpa;
                    $param_average = $average;
                    $param_status = "phase3";
                    $param_userid = $user_id;
                    if ($stmt->execute()) {
                        message ("Saved!","success");
                        header ("location: ../controller.php?page=interview");
                    }
                }
            }
        } 

    }

?>