<hr>

<?php
    $admission_date = "SELECT * FROM admissionbatch WHERE is_active = 1";
    $date_result = mysqli_query($mysqli, $admission_date) or die( mysqli_error($mysqli)); 
    if (mysqli_num_rows($date_result) == 0) {
?>

<div class="admission" id="setting-content-container">    
    <form action="function/tab_function.php?action=admission" method="post" class="form">
        <div class="row">
            <div class="col-12">
                <label for="start">Start receiving applicant on:</label>
                <input type="date" name="start" class="form-control  mb-3" required>
            </div>
            <div class="col-12">
                <label for="stop">Stop receiving applicant on:</label>
                <input type="date" name="stop" class="form-control  mb-3" required>
            </div>
            <div class="col-12">
                <label for="sy">School year:</label>
                <input type="text" name="sy" class="form-control  mb-3" required>
            </div>
        </div>
        <div class="d-sm-flex justify-content-end mt-2">
            <button class="btn btn-danger mx-1" type="submit" name="submit" value="submit">Save</button>
        </div>
    </form>
</div>
<?php 
    } else {
?>
    <div class="admission" id="setting-content-container">
        <?php
            while ($date_row = mysqli_fetch_array($date_result)) {
                $openingdate = date_create($date_row['start_date']);
                $closingdate = date_create($date_row['end_date']);
                $currentdate = date_create(@date('Y-m-d H:i:s'));
                $closing_difference = date_diff($closingdate, $currentdate)->format('%d day/s and %h hour/s');
                $opening_difference = date_diff($openingdate, $currentdate)->format('%d day/s and %h hour/s');
                if($currentdate > $openingdate && $currentdate < $closingdate) {
                    echo '<div class="font-weight-bold">Opening: <span class="text-success">'.$opening = $openingdate->format("M-d-Y").'</span></div>';
                    echo '<div class="font-weight-bold">Closing: <span class="text-success"> '.$closing = $closingdate->format("M-d-Y").'</span></div>';
                    echo '<div class="font-weight-bold">Remaining: <span class="text-success"> '.$closing_difference.'</span></div>';
                } elseif ($currentdate < $openingdate && $currentdate < $closingdate) {
                    echo '<div><span class="font-weight-bold text-danger">Pre-admission is currently closed until '.$opening = $openingdate->format("M-d-Y").'</span></div>';
                    echo '<div class="font-weight-bold">Opening : <span class="text-success">'.$opening = $openingdate->format("M-d-Y").'</span></div>';
                    echo '<div class="font-weight-bold">Closing :<span class="text-success"> '.$closing = $closingdate->format("M-d-Y").'</span></div>';
                } elseif ($currentdate > $closingdate) {  
                    echo '<div><span class="font-weight-bold text-danger">Pre-admission is temporarily closed until the schedule is set</span></div>';        
                }
            }
        ?>

        <hr>
        <div class="d-sm-flex justify-content-end mt-2">
            <a href="function/tab_function.php?action=disable_schedule"><button class="btn btn-outline-danger" type="submit" name="submit" value="submit">Force Close</button></a>
            <button class="btn btn-danger ml-2" type="button" data-toggle="modal" data-target="#updateModal" data-dismiss="modal">Update</button>
        </div>

        <div class="modal fade" id="updateModal" tabindex="1" role="dialog" aria-labelledby="updateModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-center" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalTitle">Update Pre-admission Schedule</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-sm-flex flex-column">
                            <?php
                                $admission_date = "SELECT * FROM admissionbatch WHERE is_active = 1";
                                $date_result = mysqli_query($mysqli, $admission_date) or die( mysqli_error($mysqli)); 
                                if (mysqli_num_rows($date_result) == 1) {
                                    while ($date_row = mysqli_fetch_array($date_result)) {
                            ?>
                                    <form action="function/tab_function.php?action=update_schedule" method="post" class="form">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="start">Start receiving applicant on:</label>
                                                <input type="date" name="start" class="form-control  mb-3" value="<?php echo $date_row['start_date']; ?>" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="stop">Stop receiving applicant on:</label>
                                                <input type="date" name="stop" class="form-control  mb-3" value="<?php echo $date_row['end_date']; ?>" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="sy">School year:</label>
                                                <input type="text" name="sy" class="form-control  mb-3" value="<?php echo $date_row['schoolyear']; ?>" required>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button class="btn btn-outline-danger mr-2" type="button" data-dismiss="modal">Close</button>
                                                <button class="btn btn-danger" type="submit" name="submit" value="submit">Save</button>
                                            </div>
                                        </div>
                                    </form>
                            <?php
                                    }
                                } else {
                                    echo '<div><span class="font-weight-bold text-danger">Pre-admission is temporarily closed until the schedule is set</span></div>';    
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php
    } 
?>