<hr>
<div class="slot" id="setting-content-container">    
    
    <div class="table table-responsive mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
        <table class="table table-bordered table-sm my-0" id="quota_dataTable">
            <thead class="thead-light font-weight-bold text-sm">
                <tr>
                    <th>Course</th>
                    <th>Number of Slots</th>
                    <th>Slots for waiting list</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <?php
                    if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "admin") {
                        $course = "SELECT * FROM coursestbl";
                    } else {
                        $college = $_SESSION["userCollege"];
                        $course = "SELECT * FROM coursestbl LEFT JOIN college ON college.college_id=coursestbl.college_id WHERE college_name = '$college'";
                    }    
                    $result = mysqli_query($mysqli, $course) or die(mysqli_error($mysqli));
                    while ($course_row = mysqli_fetch_array($result)) {
                        echo '<tr>';
                            echo '<td width="55%">'.$course_row['course_name'].'</td>';
                            echo '<td width="20%">'.$course_row['quota'].'</td>';
                            echo '<td width="20%">'.$course_row['waiting'].'</td>';
                            echo '<td width="5%"><button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#updateModal'.$course_row['course_id'].'" data-dismiss="modal"><span class="fas fa-edit"></span></button></td>';
                        echo '</tr>';
                ?>

                        <div class="modal fade" id="updateModal<?php echo $course_row['course_id'] ?>" tabindex="1" role="dialog" aria-labelledby="updateModalTitle" aria-hidden="true">
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
                                            <form action="function/tab_function.php?action=slot" method="post" class="form">
                                                <div class="row">
                                                    
                                                    <div class="col-12">
                                                        <label for="course">Course</label>
                                                        <input type="text" name="course" class="form-control  mb-3" value="<?php echo $course_row['course_name']; ?>" disabled>
                                                        <input type="text" name="course_id" class="form-control  mb-3" value="<?php echo $course_row['course_id']; ?>" hidden>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="accepting">Accepting</label>
                                                        <input type="text" name="accepting" class="form-control  mb-3" value="<?php echo $course_row['quota']; ?>" onkeypress="return (event.charCode !=8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <=57))" required>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="waiting">Waiting</label>
                                                        <input type="text" name="waiting" class="form-control  mb-3" value="<?php echo $course_row['waiting']; ?>" onkeypress="return (event.charCode !=8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <=57))" required>
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