<div class="container-fluid">
    <h3 class="text-dark mb-4">Setting</h3>
    <div class="card shadow">
        <div class="card-body">
            
            <ul class="nav nav-pills nav-pills-danger justify-content-center nav-fill" id="setting-tab" role="tablist">
                <li class="nav-item">
                    <a href="#default" class="nav-link active" id="default-tab" data-toggle="tab" role="tab" aria-controls="default" aria-selected="false">Requirement</a>
                </li>
                <li class="nav-item">
                    <a href="#course" class="nav-link" id="course-tab" data-toggle="tab" role="tab" aria-controls="course" aria-selected="false">Course</a>
                </li>
                <li class="nav-item">
                    <a href="#collegecollege" class="nav-link" id="collegecollge-tab" data-toggle="tab" role="tab" aria-controls="collegecollege" aria-selected="false">College</a>
                </li>
                <li class="nav-item">
                    <a href="#admission" class="nav-link" id="admission-tab" data-toggle="tab" role="tab" aria-controls="admission" aria-selected="false">Admission</a>
                </li>
                <li class="nav-item">
                    <a href="#slot" class="nav-link" id="slot-tab" data-toggle="tab" role="tab" aria-controls="slot" aria-selected="false">Slot</a>
                </li>
                <li class="nav-item">
                    <a href="#account" class="nav-link" id="account-tab" data-toggle="tab" role="tab" aria-controls="account" aria-selected="false">Account</a>
                </li>
            </ul>

            <div class="tab-content" id="settingTabContent">
                <!-- Requirement -->
                <div class="tab-pane fade show active" id="default" role="tabpanel" aria-labelledby="default-tab">
                    <?php require_once 'tab/requirement_tab.php'; ?>
                </div>
                <!-- Course -->
                <div class="tab-pane fade" id="course" role="tabpanel" aria-labelledby="course-tab">
                    <?php require_once 'tab/course_tab.php'; ?>
                </div>
                <!-- College -->
                <div class="tab-pane fade" id="collegecollege" role="tabpanel" aria-labelledby="collegecollege-tab">
                    <?php require_once 'tab/college_tab.php'; ?>
                </div>
                <!-- Admission -->
                <div class="tab-pane fade" id="admission" role="tabpanel" aria-labelledby="admission-tab">
                    <?php require_once 'tab/admission_tab.php'; ?>
                </div>
                <!-- Slot -->
                <div class="tab-pane fade" id="slot" role="tabpanel" aria-labelledby="slot-tab">
                    <?php require_once 'tab/slot_tab.php'; ?>    
                </div>
                <!-- Account -->
                <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
                    <?php require_once 'tab/account_tab.php'; ?>    
                </div>
            </div> 

        </div>
    </div>
</div>
