<!-- Include database connection and functions -->
<?php include 'includes/connection.php'; ?>
<?php include 'includes/functions.php'; ?>

<!-- Page PHP Code -->
<?php 
if (!isSomeoneIsLoggedIn()) {
    header("Location: login.php");
}
?>

<!-- Include page header -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solo Parent Report (Age) <?=date("d M Y")?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Roboto Font -->
    <link rel="stylesheet" href="css/robotoFont.css">
    <!-- CSS Reset -->
    <link rel="stylesheet" href="css/styleReset.css">
    <!-- CSS -->
    <link rel="stylesheet" href="css/baseStyle.css">
    <!-- Font Awesome -->
    <script src="js/fontawesome.js" crossorigin="anonymous"></script>
    <!-- Chart.js -->
    <script src="js/chart.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="css/reportStyle.css">
<body>
    <div class="container d-flex justify-content-evenly bondPaper">
        <div class="main-content px-5 pt-4">
        <div class="row mb-3">
                <div class="col pb-3 mb-4" style="border-bottom: 2px solid black">
                    <div class="row">
                        <div class="col-2 ps-5 d-flex justify-content-center"><img src="images/cityOfCabuyaoLogo.png" width="100px" height="100px" alt=""></div>
                        <div class="col text-center">
                                    <div class="mb-1">Republic of the Philippines</div>
                                    <div class="mb-1 fw-bold">CITY SOCIAL WELFARE AND DEVELOPMENT OFFICE</div>
                                    <div class="mb-2">City of Cabuyao, Laguna</div>
                                    <div class="mb-1">Rosario Village, Brgy. Sala, City of Cabuyao, Laguna</div>
                                    <div>Email: <span class="text-primary text-decoration-underline">cswd.cabuyao@yahoo.com</span></div>
                        </div>
                        <div class="col-2 pe-5 d-flex justify-content-center"><img src="images/cswdoLogo.png" width="100px" height="100px" alt=""></div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col mb-3">
                    <div class="card reportBody">
                        <div class="card-body">
                            <h5 class="card-title text-secondary fw-bolder">Solo Parents' Population Distribution (Based on Age) </h5>
                            <canvas id="myChart" style="max-height: calc(8.5in/2);"></canvas>
                            <h5 class="card-title text-secondary fw-bolder mt-5">Solo Parents' Age Distribution</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="fw-bold text-center">Age Groups</th>
                                        <th class="fw-bold text-center">Number of Solo Parents</th>
                                        <th class="fw-bold text-center">Percentage</th>
                                        <th class="fw-bold text-center">Ranking</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $ageBelow18 = getPopulationOfMinorSoloParents();
                                        $ageFrom18To30 = getPopulationOfYoungAdultSoloParents();
                                        $ageFrom31To50 = getPopulationOfMiddleAgedAdultSoloParents();
                                        $ageFrom51Above = getPopulationOfOldAgedAdultSoloParents();
                                        $totalPopulationOfSoloParents = getTotalPopulationOfSoloParents();
                                        $popuLationPerAgeBracket = [$ageBelow18, $ageFrom18To30, $ageFrom31To50, $ageFrom51Above];
                                        $ranking = array_rank($popuLationPerAgeBracket);
                                    ?>
                                    <tr>
                                        <td>Ages below 18</td>
                                        <td><?=$ageBelow18?></td>
                                        <td><?=getPopulationPercentage($ageBelow18, $totalPopulationOfSoloParents)?></td>
                                        <td><?=$ranking[0] . getOrdinal($ranking[0])?></td>
                                    </tr>
                                    <tr>
                                        <td>Ages 18-30</td>
                                        <td><?=$ageFrom18To30?></td>
                                        <td><?=getPopulationPercentage($ageFrom18To30, $totalPopulationOfSoloParents)?></td>
                                        <td><?=$ranking[1] . getOrdinal($ranking[1])?></td>
                                    </tr>
                                    <tr>
                                        <td>Ages 31-50</td>
                                        <td><?=$ageFrom31To50?></td>
                                        <td><?=getPopulationPercentage($ageFrom31To50, $totalPopulationOfSoloParents)?></td>
                                        <td><?=$ranking[2] . getOrdinal($ranking[2])?></td>
                                    </tr>
                                    <tr>
                                        <td>Ages 51 and above</td>
                                        <td><?=$ageFrom51Above?></td>
                                        <td><?=getPopulationPercentage($ageFrom51Above, $totalPopulationOfSoloParents)?></td>
                                        <td><?=$ranking[3] . getOrdinal($ranking[3])?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">TOTAL</td>
                                        <td class="fw-bold"><?=$totalPopulationOfSoloParents?></td>
                                        <td class="fw-bold"><?='100%'?></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <h5 class="card-title text-secondary fw-bolder mt-5">Findings</h5>
                            <p>The report concluded that majority of solo parents' population are <b class="fw-bold"><?=getMajorityOfSoloParentsByAge()?>.</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
<script>
	const ctx = document.getElementById('myChart').getContext('2d');
	new Chart(ctx, {
		type: 'pie',
		data: {
			labels: ['Ages below 18', 'Ages 18-30', 'Ages 31-50','Ages 51 and above'],
			datasets: [{
				label: 'Population',
				data: [
                    <?=getPopulationOfMinorSoloParents()?>,<?=getPopulationOfYoungAdultSoloParents()?>,<?=getPopulationOfMiddleAgedAdultSoloParents()?>,<?= getPopulationOfOldAgedAdultSoloParents()?>
				],
                backgroundColor: [
                    '#33a8c7',
                    '#52e3e1',
                    '#a0e426',
                    '#fdf148',
                    ],
				},
			],
		},
        options: {},
	});
</script>
<script>
    setTimeout(function(){
        window.print();
    }, 900);
    window.onafterprint = function(){
        location.replace("generateSoloParentReport.php?generationSuccessful");
    }
</script>
<!-- Include page footer
<?php include 'footer.php'; ?>