<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h3 class="text-dark mb-4">Insert new application</h3>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Application Form</p>
        </div>
        <div class="card-body">
            <form action="function/tab_function.php?action=new_applicant" method="POST" class="form">
                <div class="row">
                    <div class="col-6 mt-3">
                        <label for="fname"><span class="text-danger">*</span> First Name:</label>
                        <input type="text" name="fname" class="form-control" required>
                    </div>
                    <div class="col-6 mt-3">
                        <label for="lname"><span class="text-danger">*</span> Last Name:</label>
                        <input type="text" name="lname" class="form-control" required>
                    </div>
                    <div class="col-6 mt-3">
                        <label for="email"><span class="text-danger">*</span> Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-6 mt-3">
                        <label for="cetId"><span class="text-danger">*</span> CET Id:</label>
                        <input type="number" name="cetId" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode == 0 || (event.charCode >=48 && event.charCode <=57))" required>
                    </div>
                    <div class="col-6 mt-3">
                        <label for="cetScore"><span class="text-danger">*</span> CET Score:</label>
                        <input type="number" name="cetScore" class="form-control" required> <!-- Find an onkeypress function that includes '.' dot along with the number from 0 to 9 -->
                    </div>  
                    <div class="col-6 mt-3">
                        <label for="studentType"><span class="text-danger">*</span> Student Type:</label>
                        <select name="studentType" id="studentType" class="form-control" required>
                            <option value="none" hidden selected>Select an option</option>
                            <option value="Regular">Regular</option>
                            <option value="Shiftee">Shiftee</option>
                        </select>
                    </div>
                    <div class="col-6 mt-3">
                        <?php 
                            $sy = mysqli_query($mysqli, "SELECT * FROM admissionbatch WHERE is_active = 1");
                            while ($sy_row = mysqli_fetch_assoc($sy)) {
                                $schoolyear = $sy_row['schoolyear'];
                            } 
                        ?>
                        <label for="sy">School Year:</label>
                        <input type="text" name="sy" class="form-control" value="<?php echo $schoolyear; ?>" required disabled>
                    </div>
                    <div class="col-6 mt-3">
                        <label for="course"><span class="text-danger">*</span> Course:</label>
                        <select name="course" id="course" class="form-control" required>
                            <option value="none" hidden selected>Select an option</option>
                            <?php 
                                $college = $_SESSION["userCollege"];
                                $sql = mysqli_query($mysqli, "SELECT * FROM coursestbl LEFT JOIN college ON college.college_id=coursestbl.college_id WHERE college_name = '$college'");
                                while ($row = mysqli_fetch_assoc($sql)) {
                                    $option = "<option value=".$row['course_name'].">".$row['course_name']."</option>";
                                    echo $option;
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 mt-3 d-flex justify-content-end">
                        <button class="btn btn-danger" type="submit" name="submit" value="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
