<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-sm-flex justify-content-between">
            <h3 class="text-dark mb-4">Pre-qualified List</h3>
           <div>
                <button class="btn btn-danger">Sort</button>
            </div>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Applications</p>
        </div>        
        <div class="card-body">
            <div class="table-responsive table table-sm mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="eligible_dataTable">
                    <thead>
                        <?php 
                            if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "admin") {
                            
                                $query = mysqli_query($mysqli, "SELECT * FROM selectedcourse 
                                LEFT JOIN users ON users.id=selectedcourse.user_id
                                LEFT JOIN coursestbl ON coursestbl.course_id=selectedcourse.course_id
                                LEFT JOIN attachment ON attachment.id=selectedcourse.file_id
                                WHERE userStatus = 'phase3' ORDER BY average DESC LIMIT 40");
                            
                            } else {

                                $college = $_SESSION["userCollege"];
                                $query = mysqli_query($mysqli, "SELECT * FROM selectedcourse 
                                LEFT JOIN users ON users.id=selectedcourse.user_id
                                LEFT JOIN coursestbl ON coursestbl.course_id=selectedcourse.course_id
                                LEFT JOIN attachment ON attachment.id=selectedcourse.file_id
                                WHERE userStatus = 'phase3' AND college = '$college' ORDER BY average DESC LIMIT 40");
                            
                            }
                        ?>
                        <tr>
                            <th>Applicant ID</th>
                            <th>Name</th>
                            <th>Student Type</th>
                            <th>Course</th>
                            <th>Overall Percentage</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while ($row = mysqli_fetch_assoc($query)) {
                        ?>

                        <tr>
                            <td width="10%"><?php echo $row['applicantid']; ?></td>
                            <td width="20%"><?php echo $row['fname']." ".$row['lname']; ?></td>
                            <td width="15%"><?php echo $row['studentType']; ?></td>
                            <td width="30%"><?php echo $row['course_name']; ?></td>
                            <td width="15%"><?php echo $row['average']; ?>%</td>
                            <td width="10%"><?php echo $row['date']; ?></td>
                        </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
