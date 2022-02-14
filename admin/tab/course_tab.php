<hr>
<div class="course" id="setting-content-container">    
    <form action="function/tab_function.php?action=course" method="post" class="form">
        <div class="row">
            <div class="col-12">
                <label for="course-name">Course Name:</label>
                <input type="text" name="course-name" class="form-control  mb-3" required>
            </div>
            <div class="col-12">
                <label for="course-description">Course Description:</label>
                <textarea name="course-description" id="course-description" cols="30" rows="10" class="form-control w-100"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php  
                    $query2 = "SELECT * FROM college";
                    $result2 = mysqli_query($mysqli, $query2);
                    $options2 = "";
                    while ($row2 = mysqli_fetch_array($result2)){
                        $options2 = $options2."<option>$row2[1]</option>";
                    }
                ?>
                <label class="control-label mt-3" for="college">Select College:</label>
                <select class="form-control input-sm" name="college" id="college" required>
                    <option value=""disbaled selected>Select a college</option>
                    <?php echo $options2; ?> 
                </select>
            </div>
            <div class="col-12 d-flex justify-content-end mt-3">
                <button class="btn btn-outline-danger mr-2" type="button" data-toggle="modal" data-target="#coursesModal">See Courses</button>
                <button class="btn btn-danger" type="submit" name="submit" value="submit">Save</button>
            </div>
        </div>
    </form>

    <div class="modal fade" id="coursesModal" tabindex="1" role="dialog" aria-labelledby="coursesModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-center modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="coursesModalTitle">Courses List</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-sm-flex flex-column">
                        <?php
                            $courses = "SELECT * FROM coursestbl";
                            $courses_list = mysqli_query($mysqli, $courses) or die( mysqli_error($mysqli)); 
                        ?>
                        <table class="table table-bordered">
                            <thead>
                                <th>Course Name</th>
                                <th>College Name</th>
                                <th>Course Description</th>
                            </thead>
                            <tbody>
                                <?php while ($course_row = mysqli_fetch_array($courses_list)) { ?>
                                <tr>
                                    <td><?php echo $course_row['course_name']; ?></td>
                                    <td><?php echo $course_row['college_id'] ?></td>
                                    <td><?php echo $course_row['course_description'] ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>    
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>