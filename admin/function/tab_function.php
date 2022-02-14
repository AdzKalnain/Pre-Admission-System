<?php
require_once ("../../include/initialize.php");
	 

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
switch ($action) {
	case 'requirement' :
        requirement();
        break;

    case 'course' :
        course();
        break;

    case 'college' :
        college();
        break;

    case 'slot' :
        slot();
        break;

    case 'account' :
        account();
        break;

    case 'admission' :
        admission();
        break;

    case 'update_schedule' :
        updateSched();
        break;
}

function requirement() {
    global $mysqli;
    $gpa = $cet = $course = "";
    $gpa_error = $cet_error = $course_error = "";

    if(isset($_POST['submit'])){
        // FETCH GPA
        if (empty($_POST["gpa"])) {
            $gpa_error = "true";
        }else {
            $gpa = $_POST["gpa"];
        }
        // FETCH CET
        if (empty($_POST["cet"])) {
            $cet_error = "true";
        }else {
            $cet = $_POST["cet"];
        }
        // FETCH COURSE
        if (empty($_POST["course"])) {
            $course_error = "true";
        }else {
            $course = $_POST["course"];
        }

        // Saving the fetch data upon passing the if statement
        if (empty($gpa_error) && empty($cet_error) && empty($course_error)) {
            $sql = "UPDATE coursestbl SET cet_req = ?, gpa_req = ? WHERE course_name = ?";
            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("sss", $param_gpa, $param_cet, $param_course);
                $param_gpa = $gpa;
                $param_cet = $cet;
                $param_course = $course;
                if ($stmt->execute()) {
                    message ("Saved!","success");
                    header ("location: ../controller.php?page=setting");
                }
            }
        } else {
            message ("Something went wrong please try again later","error");
            header("location: ../controller.php?page=setting");
        }
    }
}

function course() {
    global $mysqli;
    $course = $description = $college = $college_id = "";
    $course_error = $description_error = $college_error = "";

    if(isset($_POST['submit'])) {
        // FETCH THE COURSE NAME
        if (empty($_POST['course-name'])) {
            $course_error = "true";
        } else {
            $course = $_POST['course-name'];
        }
        // FETCH THE COURSE DESCRIPTION
        if (empty($_POST['course-description'])) {
            $description_error = "true";
        } else {
            $description = $_POST['course-description'];
        }
        // FETCH THE COLLEGE WHERE IT BELONG
        if (empty($_POST['college'])) {
            $college_error = "true";
        } else {
            $college = $_POST['college'];
        }

        if (empty($course_error) && empty($description_error) && empty($college_error)) {
            $result = "SELECT * FROM college WHERE college_name = '$college'";
            $query = mysqli_query($mysqli,$result);
            while ($rows = mysqli_fetch_assoc($query)) {
                $sql = "INSERT into coursestbl (course_name, course_description, college_id) VALUES (?,?,?)";
                if ($stmt = $mysqli->prepare($sql)) {
                    $stmt ->bind_param("sss", $param_course, $param_description, $param_college);
                    $param_course = $course;
                    $param_description = $description;
                    $param_college = $rows['college_id'];
                    if ($stmt->execute()) {
                        message ("Saved!","success");
                        header("location: ../controller.php?page=setting");
                    } else {
                        message ("Something went wrong please try again later", "error");
                    }
                } else {
                    message ("Something went wrong please try again later", "error");
                    header("location: ../controller.php?page=setting");
                }
            }
        } else {
            message ("Something went wrong please try again later", "error");
            header("location: ../controller.php?page=setting");
        }
    }
}

function college() {
    global $mysqli;
    $college = $description = "";
    $college_error = $description_error = "";

    if(isset($_POST['submit'])) {
        // FETCH THE COLLEGE NAME
        if (empty($_POST['college-name'])) {
            $college_error = "true";
        } else {
            $college = $_POST['college-name'];
        }
        // FETCH THE COLLEGE DESCRIPTION
        if (empty($_POST['college-description'])) {
            $description_error = "true";
        } else {
            $description = $_POST['college-description'];
        }

        if (empty($college_error) && empty($description_error)) {
            $sql = "INSERT into college (college_name, college_description) VALUES (?,?)";
            if($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("ss",$param_collegename, $param_collegedescription);
                $param_collegename = $college;
                $param_collegedescription = $description;
                if($stmt->execute()) {
                    message("Success", "success");
                    header("location: ../controller.php?page=setting");
                } else {
                    message("Something went wrong please try again", "error");
                    header("location: ../controller.php?page=setting");
                }
            } else {
                message("Something went wrong please try again", "error");
                header("location: ../controller.php?page=setting");
            }
        } else {
            message ("Something went wrong please try again later", "error");
            header("location: ../controller.php?page=setting");
        }
    }
}

function slot() {
    global $mysqli;
    $accepting = $waiting = $course = "";
    $accepting_error = $waiting_error = $course_error = "";

    if (isset($_POST['submit'])) {
        // FETCH THE TOTAL NUMBER OF ACCEPTING APPLICANT
        if (empty($_POST['accepting'])) {
            $accepting_error = "true";
        } else {
            $accepting = $_POST['accepting'];
        }
        // FETCH THE TOTAL NUMBER OF WAITING SLOT
        if (empty($_POST['waiting'])) {
            $waiting_error = "true";
        } else {
            $waiting = $_POST['waiting'];
        }
        // FETCH THE COURSE WHERE IT BELONG
        if (empty($_POST['course'])) {
            $course_error = "true";
        } else {
            $course = $_POST['course'];
        }

        if (empty($accepting_error) && empty($waiting_error) && empty($course_error)) {
            $sql = "UPDATE coursestbl SET quota = ?, waiting = ? WHERE course_name = ?";
            if($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("iis", $param_accepting, $param_waiting, $param_course);
                $param_accepting = $accepting;
                $param_waiting = $waiting;
                $param_course = $course;
                if($stmt->execute()) {
                    message("Saved!","success");
                    header("location: ../controller.php?page=setting");
                } else {
                    message("Something went wrong please try again", "error");
                    header("location: ../controller.php?page=setting");
                }
            } else {
                message("Something went wrong please try again", "error");
                header("location: ../controller.php?page=setting");
            }
        } else {
            message("Something went wrong please try again", "error");
            header("location: ../controller.php?page=setting");
        }
    }
}

function account() {
    global $mysqli;
    $fname = $lname = $email = $password = $college = $role = "";
    $fname_error = $lname_error = $email_error = $password_error = $college_error = $role_error = "";

    if (isset($_POST['submit'])) {
        // FETCH FIRSTNAME
        if (empty($_POST['firstname'])) {
            $fname_error = "true";
        } else {
            $fname = $_POST['firstname'];
        }
        // FETCH LASTNAME
        if (empty($_POST['lastname'])) {
            $lname_error = "true";
        } else {
            $lname = $_POST['lastname'];
        }
        // FETCH EMAIL
        if (empty($_POST['email'])) {
            $email_error = "true";
        } else {
            $email = $_POST['email'];
        }
        // FETCH PASSWORD
        if (empty($_POST['password'])) {
            $password_error = "true";
        } else {
            $password = $_POST['password'];
        }
        // FETCH COLLEGE WHERE IT BELONG
        if (empty($_POST['college'])) {
            $college_error = "true";
        } else {
            $college = $_POST['college'];
        }
        // FETCH THE ACCOUNT ROLE
        if (empty($_POST['role'])) {
            $role_error = $_POST['role'];
        } else {
            $role = $_POST['role'];
        }

        if (empty($fname_error) && empty($lname_error) && empty($email_error) && empty($password_error) && empty($college_error) && empty($role_error)) {
            
            $sql = "INSERT into users (username, fname, lname, email, user_type, password, college) VALUES (?,?,?,?,?,?,?)";
            if($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("sssssss",$param_username, $param_fname, $param_lname, $param_email, $param_type, $param_password, $param_college);
                $param_username = $email;
                $param_fname = $fname;
                $param_lname = $lname;
                $param_email = $email;
                $param_type = $role;
                $param_password = md5($password);
                $param_college = $college;
                if($stmt->execute()) {
                    message("Success", "success");
                    header("location: ../controller.php?page=setting");
                } else {
                    message("Something went wrong please try again", "error");
                    header("location: ../controller.php?page=setting");
                }
            } else {
                message("Something went wrong please try again", "error");
                header("location: ../controller.php?page=setting");
            }
        } else {
            message("Something went wrong please try again", "error");
            header("location: ../controller.php?page=setting");
        }
    }
}

function admission() {
    global $mysqli;
    $opening = $closing = $sy = "";
    $opening_error = $closing_error = $sy_error = "";

    if (isset($_POST['submit'])) {
        if (empty($_POST['start'])) {
            $opening_error = "true";
        } else {
            $opening = $_POST['start'];
        }

        if (empty($_POST['stop'])) {
            $closing_error = "true";
        } else {
            $closing = $_POST['stop'];
        }

        if (empty($_POST['sy'])) {
            $sy_error = "true";
        } else {
            $sy = $_POST['sy'];
        }

        if (empty($opening_error) && empty($closing_error) && empty($sy_error)) {
            $sql = "INSERT into admissionbatch (start_date, end_date, is_active, schoolyear) VALUE (?,?,?,?)";
            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("ssis", $param_start, $param_end, $param_active, $param_sy);
                $param_start = $opening;
                $param_end = $closing;
                $param_active = 1;
                $param_sy = $sy;
                if ($stmt->execute()) {
                    message("Success", "success");
                    header("location: ../controller.php?page=setting");
                } else {
                    message("Something went wrong please try again", "error");
                    header("location: ../controller.php?page=setting");        
                }
            } else {
                message("Something went wrong please try again", "error");
                header("location: ../controller.php?page=setting");
            }
        } else {
            message("Something went wrong please try again", "error");
            header("location: ../controller.php?page=setting");
        }
    }
}

function updateSched() {
    global $mysqli;
    $start = $stop = $sy = "";
    $start_error = $stop_error = $sy_error = "";

    if (isset($_POST['submit'])) {
        // FETCH THE STARTING DATE
        if (empty($_POST['start'])) {
            $start_error = "true";
        } else {
            $start = $_POST['start'];
        }
        // FETCH THE END DATE
        if (empty($_POST['stop'])) {
            $stop_error = "true";
        } else {
            $stop = $_POST['stop'];
        }
        // FETCH THE SCHOOLYEAR
        if (empty($_POST['sy'])) {
            $sy_error = "true";
        } else {
            $sy = $_POST['sy'];
        }

        if (empty($start_error) && empty($stop_error) && empty($sy_error)) {
            $sql = "UPDATE admissionbatch SET start_date = ?, end_date = ?, schoolyear = ? WHERE is_active = ?";
            if($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("sssi", $param_start, $param_end, $param_sy, $param_status);
                $param_start = $start;
                $param_end = $stop;
                $param_sy = $sy;
                $param_status = 1;
                if($stmt->execute()) {
                    message("Saved!","success");
                    header("location: ../controller.php?page=setting");
                } else {
                    message("Something went wrong please try again", "error");
                    header("location: ../controller.php?page=setting");
                }
            } else {
                message("Something went wrong please try again", "error");
                header("location: ../controller.php?page=setting");
            }
        } else {
            message("Something went wrong please try again", "error");
            header("location: ../controller.php?page=setting");
        }
    }
}

?>