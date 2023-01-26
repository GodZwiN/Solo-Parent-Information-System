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
    <title>Solo Parent Report (PWD Status) <?=date("d M Y")?></title>
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
                            <h5 class="card-title text-secondary fw-bolder">Solo Parents' Population Distribution (Based on PWD Status) </h5>
                            <canvas id="myChart" style="max-height: 350px;"></canvas>
                            <h5 class="card-title text-secondary fw-bolder mt-4">Solo Parents' PWD Status Distribution</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="fw-bold text-center">PWD Category</th>
                                        <th class="fw-bold text-center">Population</th>
                                        <th class="fw-bold text-center">Percentage</th>
                                        <th class="fw-bold text-center">Rank</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $populationOfEverySoloParentsPWDStatus = getPopulationOfEverySoloParentsPWDStatus();
                                        $ranking = array_rank($populationOfEverySoloParentsPWDStatus);
                                    ?>
                                    <tr>
                                        <td>Person with psychosocial disability</td>
                                        <td><?=$populationOfEverySoloParentsPWDStatus[0]?></td>
                                        <td><?=getPopulationPercentage($populationOfEverySoloParentsPWDStatus[0],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[0] . getOrdinal($ranking[0])?></td>
                                    </tr>
                                    <tr>
                                        <td>Person that is disabled due to chronic illness</td>
                                        <td><?=$populationOfEverySoloParentsPWDStatus[1]?></td>
                                        <td><?=getPopulationPercentage($populationOfEverySoloParentsPWDStatus[1],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[1] . getOrdinal($ranking[1])?></td>
                                    </tr>
                                    <tr>
                                        <td>Person with learning disability</td>
                                        <td><?=$populationOfEverySoloParentsPWDStatus[2]?></td>
                                        <td><?=getPopulationPercentage($populationOfEverySoloParentsPWDStatus[2],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[2] . getOrdinal($ranking[2])?></td>
                                    </tr>
                                    <tr>
                                        <td>Person with mental disability</td>
                                        <td><?=$populationOfEverySoloParentsPWDStatus[3]?></td>
                                        <td><?=getPopulationPercentage($populationOfEverySoloParentsPWDStatus[3],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[3] . getOrdinal($ranking[3])?></td>
                                    </tr>
                                    <tr>
                                        <td>Person with visual disability</td>
                                        <td><?=$populationOfEverySoloParentsPWDStatus[4]?></td>
                                        <td><?=getPopulationPercentage($populationOfEverySoloParentsPWDStatus[4],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[4] . getOrdinal($ranking[4])?></td>
                                    </tr>
                                    <tr>
                                        <td>Person with orthopedic disability</td>
                                        <td><?=$populationOfEverySoloParentsPWDStatus[5]?></td>
                                        <td><?=getPopulationPercentage($populationOfEverySoloParentsPWDStatus[5],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[5] . getOrdinal($ranking[5])?></td>
                                    </tr>
                                    <tr>
                                        <td>Person with communication disability</td>
                                        <td><?=$populationOfEverySoloParentsPWDStatus[6]?></td>
                                        <td><?=getPopulationPercentage($populationOfEverySoloParentsPWDStatus[6],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[6] . getOrdinal($ranking[6])?></td>
                                    </tr>
                                    <tr>
                                        <td>Not PWD</td>
                                        <td><?=$populationOfEverySoloParentsPWDStatus[7]?></td>
                                        <td><?=getPopulationPercentage($populationOfEverySoloParentsPWDStatus[7],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[7] . getOrdinal($ranking[7])?></td>
                                    </tr>
                                    <tr>
                                        <th class="fw-bold">Total</th>
                                        <th class="fw-bold"><?=getTotalPopulationOfSoloParents();?></th>
                                        <th class="fw-bold"><?='100%';?></th>
                                        <th class="fw-bold"></th>
                                    </tr>
                                </tbody>
                            </table>
                            <h5 class="card-title text-secondary fw-bolder mt-4">Findings</h5>
                            <p>The report concluded that majority of the solo parents's PWD status is <b class="fw-bold"><?php 
                                $maxVal = max($populationOfEverySoloParentsPWDStatus);
                                $maxKey = array_search($maxVal, $populationOfEverySoloParentsPWDStatus);

                                switch($maxKey) {
                                    case 0: 
                                        echo strtoupper("Person with psychosocial disability");
                                    break;
                                    case 1: 
                                        echo strtoupper("Person that is disabled due to chronic illness");
                                    break;
                                    case 2: 
                                        echo strtoupper("Person with learning disability");
                                    break;
                                    case 3: 
                                        echo strtoupper("Person with mental disability");
                                    break;
                                    case 4: 
                                        echo strtoupper("Person with visual disability");
                                    break;
                                    case 5: 
                                        echo strtoupper("Person with orthopedic disability");
                                    break;
                                    case 6: 
                                        echo strtoupper("Person with communication disability");
                                    break;
                                    case 7: 
                                        echo strtoupper("Not PWD");
                                    break;
                                }
                            ?>.</b></p>
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
			labels: [
                'Person with psychosocial disability',
                'Person that is disabled due to chronic illness',
                'Person with learning disability',
                'Person with mental disability',
                'Person with visual disability',
                'Person with orthopedic disability',
                'Person with communication disability',
                'Not PWD',
            ],
			datasets: [{
				label: 'Population',
				data: [
                    <?php
                        $populationOfEverySoloParentsPWDStatus = getPopulationOfEverySoloParentsPWDStatus();
                        print_r(implode(', ', $populationOfEverySoloParentsPWDStatus));
                    ?>
				],
                backgroundColor: [
                    '#33a8c7',
                    '#52e3e1',
                    '#a0e426',
                    '#fdf148',
                    '#ffab00',
                    '#f77976',
                    '#f050ae',
                    '#d883ff',
                    '#9336fd',
                    ],
				},
			],
		},
        options: {},
	});
</script>
<script>
    window.onload = function(){
        setTimeout(function(){
        window.print();
    }, 900);
    };
    window.onafterprint = function(){
        location.replace("generateSoloParentReport.php?generationSuccessful");
    }
</script>
<!-- Include page footer
<?php include 'footer.php'; ?>