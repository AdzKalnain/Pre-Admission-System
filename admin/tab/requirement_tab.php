<hr>
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
</div>