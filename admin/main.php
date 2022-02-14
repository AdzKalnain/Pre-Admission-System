                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h4 class="text-dark mb-0">Dashboard</h4>
                        <!-- <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a> -->
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Number Application</span></div>
                                            <div class="text-dark font-weight-bold h5 mb-0"><span>$40,000</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Amount receive yesterday</span></div>
                                            <div class="text-dark font-weight-bold h5 mb-0"><span>$215,000</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-info py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>Amount receive today</span></div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="text-dark font-weight-bold h5 mb-0 mr-3"><span>50%</span></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-info" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"><span class="sr-only">50%</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>Processed</span></div>
                                            <div class="text-dark font-weight-bold h5 mb-0"><span>18</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
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
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="table table-responsive mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table table-bordered table-sm my-0" id="dashboard_dataTable">
                                    <thead class="thead-light font-weight-bold text-sm">
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
                                                $count_occupied = "SELECT  COUNT(course_id) as num_occupied FROM coursestbl WHERE quota != 0";
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
                </div>
       