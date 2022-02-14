<hr>
<div class="course" id="setting-content-container">    
    <form action="function/tab_function.php?action=account" method="post" class="form">
        <div class="row">
            <div class="col-6">
                <label for="firstname">First Name:</label>
                <input type="text" name="firstname" class="form-control  mb-3" required>
            </div>
            <div class="col-6">
                <label for="lastname">Last Name:</label>
                <input type="text" name="lastname" class="form-control  mb-3" required>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control  mb-3" required>
            </div>
            <div class="col-12">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control  mb-3" required>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
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
            <div class="col-6">
                <label class="control-label mt-3" for="role">Select Role:</label>
                <select class="form-control input-sm" name="role" id="role" required>
                    <option value=""disbaled selected>Select a role</option>
                    <option value="admission officer">Admission Officer</option>
                    <option value="evaluator">Evaluator</option>
                    <option value="interviewer">Interviewer</option>
                </select>
            </div>
        </div>
        <button class="btn btn-danger mt-3 d-flex ml-auto" type="submit" name="submit" value="submit">Save</button>
    </form>
</div>