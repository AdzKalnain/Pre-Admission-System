<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-sm-flex justify-content-between">
            <h3 class="text-dark mb-4">Interviewee List</h3>
            <div>
                <a href="<?php echo web_root; ?>admin/controller.php?page=new_application">
                    <button class="btn btn-danger btn-sm"><span class="fas fa-plus"></span> Insert new application</button>
                </a>
            </div>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Applications</p>
        </div>
        <div class="card-body">
            <div class="table-responsive table table-sm mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="application_dataTable">
                    <thead>
                        <?php 
                            if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "admin") {
                                $query = mysqli_query($mysqli, "SELECT * FROM selectedcourse 
                                LEFT JOIN users ON users.id=selectedcourse.user_id
                                LEFT JOIN coursestbl ON coursestbl.course_id=selectedcourse.course_id
                                LEFT JOIN attachment ON attachment.id=selectedcourse.file_id
                                WHERE userStatus = 'phase2'");
                            } else {
                                $college = $_SESSION["userCollege"];
                                $query = mysqli_query($mysqli, "SELECT * FROM selectedcourse 
                                LEFT JOIN users ON users.id=selectedcourse.user_id
                                LEFT JOIN coursestbl ON coursestbl.course_id=selectedcourse.course_id
                                LEFT JOIN attachment ON attachment.id=selectedcourse.file_id
                                WHERE userStatus = 'phase2' AND college = '$college'");
                            }
                        ?>
                        <tr>
                            <th>Applicant ID</th>
                            <th>Name</th>
                            <th>Student Type</th>
                            <th>Course</th>
                            <th>College</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td width="12%"><?php echo $row['applicantid']; ?></td>
                            <td width="18%"><?php echo $row['fname']." ".$row['lname']; ?></td>
                            <td width="12%"><?php echo $row['studentType']; ?></td>
                            <td width="20%"><?php echo $row['course_name']; ?></td>
                            <td width="23%"><?php echo $row['college']; ?></td>
                            <td width="10%"><?php echo $row['date']; ?></td>
                            <td width="5"><button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#scoreModal<?php echo $row['applicantid']; ?>" data-dismiss="modal"><span class="fas fa-edit"></span></button></td>
                        </tr>

                        <div class="modal fade" id="scoreModal<?php echo $row['applicantid'] ?>" tabindex="1" role="dialog" aria-labelledby="scoreModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-center" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="scoreModalTitle">Set the interview score</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-sm-flex flex-column">
                                            <form id="score-form" action="function/phase1_function.php" method="post">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="applicant_id">Applicant ID:</label>
                                                        <input type="text" name="applicant_id" id="applicant-id" class="form-control  mb-3" value="<?php echo $row['applicantid']; ?>" disabled>
                                                        <input type="text" name="user_id" id="user_id" class="form-control  mb-3" value="<?php echo $row['applicantid']; ?>" hidden>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="applicant_name">Applicant Name:</label>
                                                        <input type="text" name="applicant_name" class="form-control  mb-3" value="<?php echo $row['fname']." ".$row['lname']; ?>" disabled>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="score">Interview Score: <span class="muted">(1-10)</span></label>
                                                        <input type="text" name="score" id="score" class="form-control  mb-3" onkeypress="return (event.charCode !=8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <=57))">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="gpa">GPA:</label>
                                                        <input type="text" name="gpa" id="gpa" class="form-control  mb-3" onkeypress="return (event.charCode !=8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <=57))">
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-end">
                                                        <button class="btn btn-outline-danger mr-2" type="button" data-dismiss="modal">Close</button>
                                                        <button class="btn btn-danger" type="submit" name="submit" id="score-submit" value="submit">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
