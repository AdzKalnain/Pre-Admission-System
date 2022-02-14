<hr>
<div class="college" id="setting-content-container">    
    <form action="function/tab_function.php?action=college" method="post" class="form">
        <div class="row">
            <div class="col-12">
                <label for="college-name">College Name:</label>
                <input type="text" name="college-name" class="form-control  mb-3" required>
            </div>
            <div class="col-12">
                <label for="college-description">Description:</label>
                <textarea name="college-description" id="college-description" cols="30" rows="10" class="form-control w-100"></textarea>
            </div>
            <div class="col-12 d-flex justify-content-end mt-3">
                <button class="btn btn-outline-danger mr-2" type="button" data-toggle="modal" data-target="#collegeModal">See Colleges</button>
                <button class="btn btn-danger" type="submit" name="submit" value="submit">Save</button>
            </div>
        </div>
    </form>

    <div class="modal fade" id="collegeModal" tabindex="1" role="dialog" aria-labelledby="collegeModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-center modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="coursesModalTitle">College List</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-sm-flex flex-column">
                        <?php
                            $college = "SELECT * FROM college";
                            $college_list = mysqli_query($mysqli, $college) or die( mysqli_error($mysqli)); 
                        ?>
                        <table class="table table-bordered">
                            <thead>
                                <th>College Name</th>
                                <th>College Description</th>
                            </thead>
                            <tbody>
                                <?php while ($college_row = mysqli_fetch_array($college_list)) { ?>
                                <tr>
                                    <td><?php echo $college_row['college_name']; ?></td>
                                    <td><?php echo $college_row['college_description'] ?></td>
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