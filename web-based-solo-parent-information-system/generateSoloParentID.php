<!-- Include database connection and functions -->
<?php include 'includes/connection.php'; ?>
<?php include 'includes/functions.php'; ?>

<!-- Page PHP Code -->
<?php 
if (!isSomeoneIsLoggedIn()) {
    header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] ==='POST' && isset($_POST['saveOfficialsDetails'])){
    $cswdoOfficer = strtoupper(mysqli_real_escape_string($connection, $_POST['cswdoOfficer']));
    $cityMayor = strtoupper(mysqli_real_escape_string($connection, $_POST['cityMayor']));
    $verifier = strtoupper(mysqli_real_escape_string($connection, $_POST['verifier']));
    $cswdoOfficerSignature = $_FILES['cswdoOfficerSignature'];
    $cityMayorSignature = $_FILES['cityMayorSignature'];
    $verifierSignature = $_FILES['verifierSignature'];
    $allowed = array('jpg', 'jpeg', 'png');
    $isAllInputsValid = true;

    $cswdoOfficerSignatureName = $_FILES['cswdoOfficerSignature']['name'];
    $cswdoOfficerSignatureTmpName = $_FILES['cswdoOfficerSignature']['tmp_name'];
    $cswdoOfficerSignatureSize = $_FILES['cswdoOfficerSignature']['size'];
    $cswdoOfficerSignatureError = $_FILES['cswdoOfficerSignature']['error'];
    $cswdoOfficerSignatureType = $_FILES['cswdoOfficerSignature']['type'];
    $cswdoOfficerSignatureExt = explode('.', $cswdoOfficerSignatureName);
    $cswdoOfficerSignatureActualExt = strtolower(end($cswdoOfficerSignatureExt));
    if (!in_array($cswdoOfficerSignatureActualExt, $allowed)) {
        $isAllInputsValid = false;
    }

    $cityMayorSignatureName = $_FILES['cityMayorSignature']['name'];
    $cityMayorSignatureTmpName = $_FILES['cityMayorSignature']['tmp_name'];
    $cityMayorSignatureSize = $_FILES['cityMayorSignature']['size'];
    $cityMayorSignatureError = $_FILES['cityMayorSignature']['error'];
    $cityMayorSignatureType = $_FILES['cityMayorSignature']['type'];
    $cityMayorSignatureExt = explode('.', $cityMayorSignatureName);
    $cityMayorSignatureActualExt = strtolower(end($cityMayorSignatureExt));
    if (!in_array($cityMayorSignatureActualExt, $allowed)) {
        $isAllInputsValid = false;
    }

    $verifierSignatureName = $_FILES['verifierSignature']['name'];
    $verifierSignatureTmpName = $_FILES['verifierSignature']['tmp_name'];
    $verifierSignatureSize = $_FILES['verifierSignature']['size'];
    $verifierSignatureError = $_FILES['verifierSignature']['error'];
    $verifierSignatureType = $_FILES['verifierSignature']['type'];
    $verifierSignatureExt = explode('.', $verifierSignatureName);
    $verifierSignatureActualExt = strtolower(end($verifierSignatureExt));
    if (!in_array($verifierSignatureActualExt, $allowed)) {
        $isAllInputsValid = false;
    }

    $officialsUpdateSuccess = true;
    
    if (empty($cswdoOfficer) || !preg_match('/^([^0-9]*)$/', $cswdoOfficer)){
        $isAllInputsValid = false;
    }
    if (empty($cityMayor) || !preg_match('/^([^0-9]*)$/', $cityMayor)){
        $isAllInputsValid = false;
    }
    if (empty($verifier) || !preg_match('/^([^0-9]*)$/',$verifier)){
        $isAllInputsValid = false;
    }

    if ($isAllInputsValid) {
        updateOfficials($cswdoOfficer, $cityMayor, $verifier);
        $cswdoOfficerSignatureDestination = 'signatures/'. $cswdoOfficerSignatureName;
        move_uploaded_file($cswdoOfficerSignatureTmpName,$cswdoOfficerSignatureDestination);
        $cityMayorSignatureDestination = 'signatures/'. $cityMayorSignatureName;
        move_uploaded_file($cityMayorSignatureTmpName,$cityMayorSignatureDestination);
        $verifierSignatureDestination = 'signatures/'. $verifierSignatureName;
        move_uploaded_file($verifierSignatureTmpName,$verifierSignatureDestination);
    } else {
        $officialsUpdateSuccess = false;
    }
}
?>

<!-- Include page header -->
<?php include 'header.php'; ?>

<!-- Page HTML -->
<div class="container d-flex">
    <div class="sidebar" id="side_nav">
        <div class="px-3 pt-3 pb-2">
            <h1 class="fs-4 text-white text-center fw-bolder">Solo Parent Information System</h1>
        </div>
        <div class="px-3 pb-3">
            <h1 class="fs-lg text-white text-center fw-bold" id="dateTime"><?php date_default_timezone_set('Asia/Manila'); echo date("D, d M Y | h:i A"); ?></h1>
        </div>
        <div class="px-3 pt-3 pb-4">
            <h1 class="fs-5 text-white text-center fw-bold"><?=$_SESSION['loggedAccount']['FirstName'] . " " . $_SESSION['loggedAccount']['LastName'] ?></h1>
        </div>
        <ul class="px-2">
            <li class="px-2 py-3"><a href="index.php" class="text-decoration-none d-block text-white"><i class="fa-solid fa-house"></i>Dashboard</a></li>
            <li class="px-2 py-3"><a href="manageSoloParent.php" class="text-decoration-none d-block text-white"><i class="fa-solid fa-people-roof"></i>Manage Solo Parent Data</a></li>
            <li class="px-2 py-3 active"><a href="generateSoloParentID.php" class="text-decoration-none d-block text-white"><i class="fa-solid fa-id-card"></i>Generate Solo Parent ID</a></li>
            <li class="px-2 py-3"><a href="generateSoloParentReport.php" class="text-decoration-none d-block text-white"><i class="fa-solid fa-chart-simple"></i>Generate Solo Parent Report</a></li>
            <li class="px-2 py-3"><a href="archiveInformativeMaterial.php" class="text-decoration-none d-block text-white"><i class="fa-solid fa-box-archive"></i>Archive Informative Materials</a></li>
        </ul>
        <?php 
        if($_SESSION['loggedAccount']['AccountID'] == 1) {
            echo "<hr class='h-color mx-2'>
                <ul class='px-2'>
                    <li class='px-2 py-3'><a href='employeeAccountManagement.php' class='text-decoration-none d-block text-white'><i class='fa-solid fa-people-group'></i>Manage Employees Account</a></li>
                </ul>";
                echo "
                <ul class='px-2'>
                    <li class='px-2 py-3'><a href='auditTrail.php' class='text-decoration-none d-block text-white'><i class='fa-sharp fa-solid fa-book'></i>Audit Trail</a></li>
                </ul>";
        }
        ?>
        <hr class="h-color mx-2">
        <ul class="px-2">
            <li class="px-2 py-3"><a href="accountSettings.php" class="text-decoration-none d-block text-white"><i class="fa-solid fa-gear"></i>Account Settings</a></li>
            <li class="px-2 py-3"><a href="logout.php" class="text-decoration-none d-block text-white"><i class="fa-solid fa-right-from-bracket"></i>Log Out</a></li>
        </ul>
    </div>
    <div class="content d-flex justify-content-center">
        <div class="main-content p-5">
            <div class="row mb-5">
                <div class="col border-bottom border-danger pb-2">
                    <h1 class="fs-2 fw-bold">Solo Parent's ID Generation</h1>
                </div>
            </div>
            <div class="row">
                <?php 
                if (isset($_POST['saveOfficialsDetails'])){
                    if($officialsUpdateSuccess){
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                Officials details for ID contents updated successfully.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    } else {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Officials details for ID contents updated unsuccessful. Please try again.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    }
                }
                ?>
            </div>
            <div class="row mb-2 px-5">
                <!-- Button trigger modal -->
                <div class="col-3 d-grid">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Configure ID Contents
                </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Officials' Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="cswdoOfficer" class="form-label">City Social Welfare & Development Officer</label>
                                    <input type="text" autocomplete="off" name="cswdoOfficer" id="cswdoOfficer" class="form-control" value="<?= $_COOKIE['cswdoOfficer'];?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="cswdoOfficer" class="form-label">City Social Welfare & Development Officer Signature</label>
                                    <input type="file" autocomplete="off" name="cswdoOfficerSignature" id="cswdoOfficerSignature" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="cityMayor" class="form-label">City Mayor</label>
                                    <input type="text" autocomplete="off" name="cityMayor" id="cityMayor" class="form-control" value="<?= $_COOKIE['cityMayor'];?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="cityMayor" class="form-label">City Mayor Signature</label>
                                    <input type="file" autocomplete="off" name="cityMayorSignature" id="cityMayorSignature" class="form-control" value="signatures/cityMayorSignature.png">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                <label for="verifier" class="form-label">ID Verifier</label>
                                    <input type="text" autocomplete="off" name="verifier" id="verifier" class="form-control" value="<?= $_COOKIE['idVerifier'];?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                <label for="verifier" class="form-label">ID Verifier Signature</label>
                                    <input type="file" autocomplete="off" name="verifierSignature" id="verifierSignature" class="form-control" value="signatures/verifierSignature.png">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-3 text-center" style="font-size: small;">
                                    NOTE: Please make sure that the images that contains signatures are sized 300x100 and named cityMayorSignature, cswdoOfficerSignature, verifierSignature respectively.
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="saveOfficialsDetails" class="btn btn-danger">Save changes</button>
                        </form>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="row mb-5 px-5">
                <table id="soloParentsTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>CTRL #</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Age</th>
                            <th>Birthdate</th>
                            <th>Sex</th>
                            <th>Barangay</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            generateSoloParentRecordsForIDGeneration();
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>CTRL #</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Age</th>
                            <th>Birthdate</th>
                            <th>Sex</th>
                            <th>Barangay</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Include page footer -->
<?php include 'footer.php'; ?>