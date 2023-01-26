<!-- Include database connection and functions -->
<?php include 'includes/connection.php'; ?>
<?php include 'includes/functions.php'; ?>

<!-- Page PHP Code -->
<?php

    $soloParentID = $_GET['SoloParentID'];

    if (!mysqli_query($connection, markSoloParentAsIneligible($soloParentID))) {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        echo "AN ERROR OCCURED, PLEASE CONTACT THE DEVELOPERS.";
    } else {
        $sql = "SELECT * FROM soloparents WHERE SoloParentID = '$soloParentID'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $soloParentFullName = $row['FirstName'] . " " . $row['MiddleName'] . " " . $row['LastName'];
        addMarkSoloParentIneligibleAudit($_SESSION['loggedAccount']['FirstName'],$_SESSION['loggedAccount']['LastName'], $soloParentFullName, $row['ControlNumber'], $_SESSION['loggedAccount']['Username']);
        mysqli_close($connection);
        header("Location: editOrViewSoloParentRecord.php?SoloParentID=$soloParentID&soloParentRenewalSuccessful");
    }

?>

<!-- Include page header -->
<?php include 'header.php'; ?>



<!-- Include page footer -->
<?php include 'footer.php'; ?>