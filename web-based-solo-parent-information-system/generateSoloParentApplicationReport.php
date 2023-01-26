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
    <title>Solo Parent Report (Solo Parent Application) <?=date("d M Y")?></title>
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
                            <h5 class="card-title text-secondary fw-bolder">Solo Parents' Population Distribution (New Applications) </h5>
                            <canvas id="myChart" style="max-height: 225px;"></canvas>
                            <h5 class="card-title text-secondary fw-bolder mt-4">Solo Parents' Monthly New Application Distribution</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="fw-bold text-center">Month</th>
                                        <th class="fw-bold text-center">New Solo Parents</th>
                                        <th class="fw-bold text-center">Percentage</th>
                                        <th class="fw-bold text-center">Ranking</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $newSoloParentsPerMonth = getAllNewApplications();
                                        $newSoloParentsPopulationPerMonth = [];
                                        $currentYearTotalNewSoloParent = array_sum($newSoloParentsPerMonth);
                                        for ($i = 0; $i < count($newSoloParentsPerMonth); $i++) {
                                            array_push($newSoloParentsPopulationPerMonth, $newSoloParentsPerMonth[$i]);
                                        }
                                        $ranking = array_rank($newSoloParentsPopulationPerMonth);
                                    ;?>
                                    <tr>
                                        <td>January</td>
                                        <td><?=$newSoloParentsPerMonth[0]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[0],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[0] . getOrdinal($ranking[0])?></td>
                                    </tr>
                                    <tr>
                                        <td>February</td>
                                        <td><?=$newSoloParentsPerMonth[1]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[1],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[1] . getOrdinal($ranking[1])?></td>
                                    </tr>
                                    <tr>
                                        <td>March</td>
                                        <td><?=$newSoloParentsPerMonth[2]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[2],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[2] . getOrdinal($ranking[2])?></td>
                                    </tr>
                                    <tr>
                                        <td>April</td>
                                        <td><?=$newSoloParentsPerMonth[3]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[3],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[3] . getOrdinal($ranking[3])?></td>
                                    </tr>
                                    <tr>
                                        <td>May</td>
                                        <td><?=$newSoloParentsPerMonth[4]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[4],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[4] . getOrdinal($ranking[4])?></td>
                                    </tr>
                                    <tr>
                                        <td>June</td>
                                        <td><?=$newSoloParentsPerMonth[5]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[5],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[5] . getOrdinal($ranking[5])?></td>
                                    </tr>
                                    <tr>
                                        <td>July</td>
                                        <td><?=$newSoloParentsPerMonth[6]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[6],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[6] . getOrdinal($ranking[6])?></td>
                                    </tr>
                                    <tr>
                                        <td>August</td>
                                        <td><?=$newSoloParentsPerMonth[7]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[7],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[7] . getOrdinal($ranking[7])?></td>
                                    </tr>
                                    <tr>
                                        <td>September</td>
                                        <td><?=$newSoloParentsPerMonth[8]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[8],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[8] . getOrdinal($ranking[8])?></td>
                                    </tr>
                                    <tr>
                                        <td>October</td>
                                        <td><?=$newSoloParentsPerMonth[9]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[9],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[9] . getOrdinal($ranking[9])?></td>
                                    </tr>
                                    <tr>
                                        <td>November</td>
                                        <td><?=$newSoloParentsPerMonth[10]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[10],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[10] . getOrdinal($ranking[10])?></td>
                                    </tr>
                                    <tr>
                                        <td>December</td>
                                        <td><?=$newSoloParentsPerMonth[11]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[11],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[11] . getOrdinal($ranking[11])?></td>
                                    </tr>
                                    <tr>
                                        <th class="fw-bold">Total</th>
                                        <th class="fw-bold"><?=array_sum($newSoloParentsPerMonth);?></th>
                                        <th class="fw-bold"><?='100%';?></th>
                                        <th class="fw-bold"></th>
                                    </tr>
                                </tbody>
                            </table>
                            <h5 class="card-title text-secondary fw-bolder mt-4">Findings</h5>
                            <p>The report concluded that majority of the new solo parents come from the month of <b class="fw-bold"><?php 
                                $maxVal = max($newSoloParentsPerMonth);
                                $maxKey = array_search($maxVal, $newSoloParentsPerMonth);

                                switch($maxKey) {
                                    case 0: 
                                        echo strtoupper("january");
                                    break;
                                    case 1: 
                                        echo strtoupper("february");
                                    break;
                                    case 2: 
                                        echo strtoupper("march");
                                    break;
                                    case 3: 
                                        echo strtoupper("april");
                                    break;
                                    case 4: 
                                        echo strtoupper("may");
                                    break;
                                    case 5: 
                                        echo strtoupper("june");
                                    break;
                                    case 6: 
                                        echo strtoupper("july");
                                    break;
                                    case 7: 
                                        echo strtoupper("august");
                                    break;
                                    case 8: 
                                        echo strtoupper("september");
                                    break;
                                    case 9: 
                                        echo strtoupper("october");
                                    break;
                                    case 10: 
                                        echo strtoupper("november");
                                    break;
                                    case 11: 
                                        echo strtoupper("december");
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
		type: 'line',
		data: {
			labels: [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December',
            ],
			datasets: [{
				label: 'Population',
				data: [
                    <?php
                        $newSoloParentsPerMonth = getAllNewApplications();
                        print_r(implode(', ', $newSoloParentsPerMonth));
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
                            <h5 class="card-title text-secondary fw-bolder">Solo Parents' Population Distribution (Renewal) </h5>
                            <canvas id="myChart2" style="max-height: 225px;"></canvas>
                            <h5 class="card-title text-secondary fw-bolder mt-4">Solo Parents' Monthly Renewal Distribution</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="fw-bold text-center">Month</th>
                                        <th class="fw-bold text-center">Population</th>
                                        <th class="fw-bold">Percentage</th>
                                        <th class="fw-bold">Ranking</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $newSoloParentsPerMonth = getAllRenewalApplications();
                                        $newSoloParentsPopulationPerMonth = [];
                                        $currentYearTotalNewSoloParent = array_sum($newSoloParentsPerMonth);
                                        for ($i = 0; $i < count($newSoloParentsPerMonth); $i++) {
                                            array_push($newSoloParentsPopulationPerMonth, $newSoloParentsPerMonth[$i]);
                                        }
                                        $ranking = array_rank($newSoloParentsPopulationPerMonth);
                                    ;?>
                                    <tr>
                                        <td>January</td>
                                        <td><?=$newSoloParentsPerMonth[0]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[0],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[0] . getOrdinal($ranking[0])?></td>
                                    </tr>
                                    <tr>
                                        <td>February</td>
                                        <td><?=$newSoloParentsPerMonth[1]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[1],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[1] . getOrdinal($ranking[1])?></td>
                                    </tr>
                                    <tr>
                                        <td>March</td>
                                        <td><?=$newSoloParentsPerMonth[2]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[2],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[2] . getOrdinal($ranking[2])?></td>
                                    </tr>
                                    <tr>
                                        <td>April</td>
                                        <td><?=$newSoloParentsPerMonth[3]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[3],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[3] . getOrdinal($ranking[3])?></td>
                                    </tr>
                                    <tr>
                                        <td>May</td>
                                        <td><?=$newSoloParentsPerMonth[4]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[4],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[4] . getOrdinal($ranking[4])?></td>
                                    </tr>
                                    <tr>
                                        <td>June</td>
                                        <td><?=$newSoloParentsPerMonth[5]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[5],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[5] . getOrdinal($ranking[5])?></td>
                                    </tr>
                                    <tr>
                                        <td>July</td>
                                        <td><?=$newSoloParentsPerMonth[6]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[6],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[6] . getOrdinal($ranking[6])?></td>
                                    </tr>
                                    <tr>
                                        <td>August</td>
                                        <td><?=$newSoloParentsPerMonth[7]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[7],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[7] . getOrdinal($ranking[7])?></td>
                                    </tr>
                                    <tr>
                                        <td>September</td>
                                        <td><?=$newSoloParentsPerMonth[8]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[8],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[8] . getOrdinal($ranking[8])?></td>
                                    </tr>
                                    <tr>
                                        <td>October</td>
                                        <td><?=$newSoloParentsPerMonth[9]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[9],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[9] . getOrdinal($ranking[9])?></td>
                                    </tr>
                                    <tr>
                                        <td>November</td>
                                        <td><?=$newSoloParentsPerMonth[10]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[10],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[10] . getOrdinal($ranking[10])?></td>
                                    </tr>
                                    <tr>
                                        <td>December</td>
                                        <td><?=$newSoloParentsPerMonth[11]?></td>
                                        <td><?=getPopulationPercentage($newSoloParentsPerMonth[11],$currentYearTotalNewSoloParent)?></td>
                                        <td><?=$ranking[11] . getOrdinal($ranking[11])?></td>
                                    </tr>
                                    <tr>
                                        <th class="fw-bold">Total</th>
                                        <th class="fw-bold"><?=array_sum($newSoloParentsPerMonth);?></th>
                                        <th class="fw-bold"><?='100%';?></th>
                                        <th class="fw-bold"></th>
                                    </tr>
                                </tbody>
                            </table>
                            <h5 class="card-title text-secondary fw-bolder mt-4">Findings</h5>
                            <p>The report concluded that majority of the renewal come from the month of <b class="fw-bold"><?php 
                                $maxVal = max($newSoloParentsPerMonth);
                                $maxKey = array_search($maxVal, $newSoloParentsPerMonth);

                                switch($maxKey) {
                                    case 0: 
                                        echo strtoupper("january");
                                    break;
                                    case 1: 
                                        echo strtoupper("february");
                                    break;
                                    case 2: 
                                        echo strtoupper("march");
                                    break;
                                    case 3: 
                                        echo strtoupper("april");
                                    break;
                                    case 4: 
                                        echo strtoupper("may");
                                    break;
                                    case 5: 
                                        echo strtoupper("june");
                                    break;
                                    case 6: 
                                        echo strtoupper("july");
                                    break;
                                    case 7: 
                                        echo strtoupper("august");
                                    break;
                                    case 8: 
                                        echo strtoupper("september");
                                    break;
                                    case 9: 
                                        echo strtoupper("october");
                                    break;
                                    case 10: 
                                        echo strtoupper("november");
                                    break;
                                    case 11: 
                                        echo strtoupper("december");
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
	const ctx2 = document.getElementById('myChart2').getContext('2d');
	new Chart(ctx2, {
		type: 'line',
		data: {
			labels: [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December',
            ],
			datasets: [{
				label: 'Population',
				data: [
                    <?php
                        $newSoloParentsPerMonth = getAllRenewalApplications();
                        print_r(implode(', ', $newSoloParentsPerMonth));
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