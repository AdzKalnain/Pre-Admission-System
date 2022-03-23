<hr>
<div class="requirement" id="setting-content-container">    
    
    <div class="table table-responsive mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
        <table class="table table-bordered table-sm my-0" id="requirement_dataTable">
            <thead class="thead-light font-weight-bold text-sm">
                <tr>
                    <th>Course Name</th>
                    <th>GPA Requirement</th>
                    <th>CET Requirement</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <?php
                    if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "admin") {
                        $course = "SELECT * FROM coursestbl";
                        $result = mysqli_query($mysqli, $course) or die(mysqli_error($mysqli));
                    } else {
                        $college = $_SESSION["userCollege"];
                        $course = "SELECT * FROM coursestbl LEFT JOIN college ON college.college_id=coursestbl.college_id WHERE college_name = '$college'";
                        $result = mysqli_query($mysqli, $course) or die(mysqli_error($mysqli));
                    }
                    while ($course_row = mysqli_fetch_array($result)) {
                        echo '<tr>';
                            echo '<td width="55%">'.$course_row['course_name'].'</td>';
                            echo '<td width="20%">'.$course_row['gpa_req'].'</td>';
                            echo '<td width="20%">'.$course_row['cet_req'].'</td>';
                            echo '<td width="5%"><button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#editModal'.$course_row['course_id'].'" data-dismiss="modal"><span class="fas fa-edit"></span></button></td>';
                        echo '</tr>';
                ?>

                        <div class="modal fade" id="editModal<?php echo $course_row['course_id'] ?>" tabindex="1" role="dialog" aria-labelledby="updateModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-center" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateModalTitle">Setting the slots</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-sm-flex flex-column">
                                            <form action="function/tab_function.php?action=requirement" method="post" class="form">
                                                <div class="row">
                                                    
                                                    <div class="col-12">
                                                        <label for="course">Course</label>
                                                        <input type="text" name="course" class="form-control  mb-3" value="<?php echo $course_row['course_name']; ?>" disabled>
                                                        <input type="text" name="course_id" class="form-control  mb-3" value="<?php echo $course_row['course_id']; ?>" hidden>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="gpa">GPA Requirement</label>
                                                        <input type="text" name="gpa" class="form-control  mb-3" value="<?php echo $course_row['gpa_req']; ?>" onkeypress="return (event.charCode !=8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <=57))" required>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="cet">CET Requirement</label>
                                                        <input type="text" name="cet" class="form-control  mb-3" value="<?php echo $course_row['cet_req']; ?>" onkeypress="return (event.charCode !=8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <=57))" required>
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-end">
                                                        <button class="btn btn-outline-danger mr-2" type="button" data-dismiss="modal">Close</button>
                                                        <button class="btn btn-danger" type="submit" name="submit" value="submit">Save</button>
                                                    </div>
                                                    
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php
                    }
                ?>
            </tbody>
        </table>
        
    </div>
</div>

<!-- <hr>
<div class="requirement" id="setting-content-container">    
    <h4 class="sett-name mb-5">
        <?php if (isset($message1)): ?>
        <span class="message" id="message"><?php echo $message1; ?></span>
        <?php endif ?>
        <?php if (isset($message2)): ?>
        <span class="message" id="message"><?php echo $message2; ?></span>
        <?php endif ?>
    </h4>
    <form action="function/tab_function.php?action=requirement" method="post" class="form">
        <div class="row">
            <div class="col-6">
                <label for="gpa">GPA (Grade Point Average)</label>
                <input type="text" name="gpa" class="form-control  mb-3" onkeypress="return (event.charCode !=8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <=57))" required>
            </div>
            <div class="col-6">
                <label for="cet">CET Score (College Entrance Test)</label>
                <input type="text" name="cet" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <=57))" required>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php  
                    $query2 = "SELECT * FROM coursestbl";
                    $result2 = mysqli_query($mysqli, $query2);
                    $options2 = "";
                    while ($row2 = mysqli_fetch_array($result2)){
                    $options2 = $options2."<option>$row2[1]</option>";
                    }
                ?>
                <label class="control-label mt-3" for="course">Select Course:</label>
                <select class="form-control input-sm" name="course" id="course_req" required>
                    <option value=""disbaled selected>Select a course</option>
                    <?php echo $options2; ?> 
                </select>
            </div>
        </div>
        <button class="btn btn-danger mt-3 d-flex ml-auto" type="submit" name="submit" value="submit">Save</button>
    </form>
</div> -->