<hr>
<div class="course" id="setting-content-container">    
    <form action="function/tab_function.php?action=slot" method="post" class="form">
        <div class="row">
            <div class="col-6">
                <label for="accepting">Accepting:</label>
                <input type="text" name="accepting" class="form-control  mb-3" onkeypress="return (event.charCode !=8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <=57))" required>
            </div>
            <div class="col-6">
                <label for="waiting">Waiting:</label>
                <input type="text" name="waiting" class="form-control  mb-3" onkeypress="return (event.charCode !=8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <=57))" required>
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
                <select class="form-control input-sm" name="course" id="course" required>
                    <option value=""disbaled selected>Select a course</option>
                    <?php echo $options2; ?> 
                </select>
            </div>
        </div>
        <button class="btn btn-danger mt-3 d-flex ml-auto" type="submit" name="submit" value="submit">Save</button>
    </form>
</div>