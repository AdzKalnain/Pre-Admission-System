                <?php  
                    function receive_today() {
                        if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "admin") {
                            global $mysqli;
                            $date =  @date('Y-m-d');
                            $sql = mysqli_query($mysqli,"SELECT COUNT(id) AS amount FROM selectedcourse WHERE date = '$date'");
                            $row = mysqli_fetch_assoc($sql);
                            $receive_today = $row['amount'];

                            return $receive_today;
                        } else {
                            global $mysqli;
                            $college = $_SESSION["userCollege"];
                            $date =  @date('Y-m-d');
                            $sql = mysqli_query($mysqli,"SELECT COUNT(id) AS amount FROM selectedcourse WHERE date = '$date' AND college = '$college'");
                            $row = mysqli_fetch_assoc($sql);
                            $receive_today = $row['amount'];
                            
                            return $receive_today;
                        }
                    }

                    function receive_yesterday() {
                        if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "admin") {
                            global $mysqli;
                            $date = @date('Y-m-d', strtotime("yesterday"));
                            $sql = mysqli_query($mysqli, "SELECT COUNT(id) as amount FROM selectedcourse WHERE date = '$date'");
                            $row = mysqli_fetch_assoc($sql);
                            $receive_yesterday = $row['amount'];

                            return $receive_yesterday;
                        } else {
                            global $mysqli;
                            $college = $_SESSION["userCollege"];
                            $date = @date('Y-m-d', strtotime("yesterday"));
                            $sql = mysqli_query($mysqli, "SELECT COUNT(id) as amount FROM selectedcourse WHERE date = '$date' AND college = '$college'");
                            $row = mysqli_fetch_assoc($sql);
                            $receive_yesterday = $row['amount'];

                            return $receive_yesterday;
                        }
                    }

                    function total_applicant() {
                        if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "admin") {
                            global $mysqli;
                            $sql = mysqli_query($mysqli, "SELECT COUNT(id) as amount FROM selectedcourse");
                            $row = mysqli_fetch_assoc($sql);
                            $total_applicant = $row['amount'];

                            return $total_applicant;
                        } else {
                            global $mysqli;
                            $college = $_SESSION["userCollege"];
                            $sql = mysqli_query($mysqli, "SELECT COUNT(id) as amount FROM selectedcourse WHERE college = '$college'");
                            $row = mysqli_fetch_assoc($sql);
                            $total_applicant = $row['amount'];

                            return $total_applicant;
                        }
                    }
                ?>

                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h4 class="text-dark mb-0">Dashboard</h4>
                        <!-- <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a> -->
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-secondary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-secondary font-weight-bold text-xs mb-1"><span>Number of Applicant</span></div>
                                            <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo total_applicant(); ?></span></div>
                                        </div>
                                        <!-- <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-secondary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-secondary font-weight-bold text-xs mb-1"><span>Amount receive yesterday</span></div>
                                            <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo receive_yesterday(); ?></span></div>
                                        </div>
                                        <!-- <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-secondary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-secondary font-weight-bold text-xs mb-1"><span>Amount receive today</span></div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="text-dark font-weight-bold h5 mb-0 mr-3"><span><?php echo receive_today(); ?></span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-secondary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-secondary font-weight-bold text-xs mb-1"><span>Processed</span></div>
                                            <div class="text-dark font-weight-bold h5 mb-0"><span>20</span></div>
                                        </div>
                                        <!-- <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-sm-flex justify-content-between">
                        <?php
                            $admission_date = "SELECT * FROM admissionbatch WHERE is_active = 1";
                            $date_result = mysqli_query($mysqli, $admission_date) or die(mysqli_error($mysqli)); 
                            if (mysqli_num_rows($date_result) == 1) {
                                while ($date_row = mysqli_fetch_array($date_result)) {
                                    $openingdate = date_create($date_row['start_date']);
                                    $closingdate = date_create($date_row['end_date']);
                                    $currentdate = date_create(@date('Y-m-d H:i:s'));
                                    $closing_difference = date_diff($closingdate, $currentdate)->format('%y year/s %m month/s %d day/s and %h hour/s');
                                    $opening_difference = date_diff($openingdate, $currentdate)->format('%y year/s %m month/s %d day/s and %h hour/s');
                                    
                                    
                                    // Check if closing date is ahead of the date today
                                    // Throw a notice of the schedule of opening, closing, and remaining time until pre-admission end
                                    // Check if the opening date is behind the date of today
                                    if($currentdate > $openingdate && $currentdate < $closingdate) {
                                    echo '<h4 class="text-dark mb-4">Courses Slots</h4><div><span class="font-weight-bold text-success">'.$closing_difference.' till pre-admission end</span></div>';
                                    
                                    
                                    // Check if the opening date is ahead of the date today
                                    // Check if the closing date is ahead of the date today
                                    // Throw notice indicating the schedule of opening, closing, and the remaining time until pre-admission will open
                                    } elseif ($currentdate < $openingdate && $currentdate < $closingdate) {
                                        echo '<h4 class="text-dark mb-4">Courses Slots</h4><div><span class="font-weight-bold text-danger">Pre-admission is currently closed until '.$opening = $openingdate->format("M-d-Y").'</span></div>';
                                    
                                    
                                    // Check if the closing date of pre-admission is already behind the date today.
                                    // Throw notice indicating pre-admission is temporarily closed.
                                    } elseif ($currentdate > $closingdate) {
                                        echo '<h4 class="text-dark mb-4">Courses Slots</h4><div><span class="font-weight-bold text-danger">Pre-admission is currently closed</span></div>';        
                                    }
                                }
                            } else {
                                echo '<h4 class="text-dark mb-4">Courses Slots</h4><div><span class="font-weight-bold text-danger">Pre-admission is currently closed</span></div>';
                            }
                        ?>
                    </div>
                    
                    <?php if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "admin") { ?>
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="table table-responsive mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                    <table class="table table-bordered table-sm my-0" id="dashboard_dataTable">
                                        <thead class="thead bg-secondary text-white font-weight-bold text-sm">
                                            <tr>
                                                <th>Course</th>
                                                <th>Occupied/Slot</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-sm">
                                            <?php
                                                $course = "SELECT * FROM coursestbl WHERE quota != 0";
                                                $result = mysqli_query($mysqli, $course) or die(mysqli_error($mysqli));;
                                                while ($course_row = mysqli_fetch_array($result)) {
                                                    $course_id = $course_row['course_id'];
                                                    $count_occupied = "SELECT  COUNT(course_id) as num_occupied FROM selectedcourse WHERE userStatus = 'phase2' and course_id = '$course_id'";
                                                    $count_result = mysqli_query($mysqli, $count_occupied) or die(mysqli_error($mysqli));
                                                    while ($count_row = mysqli_fetch_array($count_result)) {
                                                        echo '<tr>';
                                                            echo '<td>'.$course_row['course_name'].'</td>';
                                                            echo '<td>'.$count_row['num_occupied'].'/'.$course_row['quota'].'</td>';
                                                        echo '</tr>';
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php }else { ?>
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="table table-responsive mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                    <table class="table table-bordered">
                                        <?php
                                            $college = $_SESSION["userCollege"];
                                            $course = "SELECT * FROM coursestbl LEFT JOIN college ON college.college_id=coursestbl.college_id WHERE quota != 0 AND college_name = '$college'";
                                            $result = mysqli_query($mysqli, $course) or die(mysqli_error($mysqli));;
                                            while ($course_row = mysqli_fetch_array($result)) {
                                                $course_id = $course_row['course_id'];
                                                $count_occupied = "SELECT  COUNT(course_id) as num_occupied FROM selectedcourse WHERE userStatus = 'phase2' and course_id = '$course_id'";
                                                $count_result = mysqli_query($mysqli, $count_occupied) or die(mysqli_error($mysqli));
                                                while ($count_row = mysqli_fetch_array($count_result)) {
                                                    echo '<tr>';
                                                        echo '<td class="text-uppercase text-secondary font-weight-bold text-xs">'.$course_row['course_name'].'</td>';
                                                        echo '<td class="text-uppercase text-secondary font-weight-bold text-xs">'.$count_row['num_occupied'].'/'.$course_row['quota'].'</td>';
                                                    echo '</tr>';
                                                }
                                            }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
       