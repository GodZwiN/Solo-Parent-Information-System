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
    <title>Solo Parent Report (Nature) <?=date("d M Y")?></title>
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
                            <h5 class="card-title text-secondary fw-bolder">Solo Parents' Population Distribution (Based on Nature) </h5>
                            <canvas id="myChart" style="max-height: 350px;"></canvas>
                            <h5 class="card-title text-secondary fw-bolder mt-3">Solo Parents' Nature Distribution</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="fw-bold text-center">Nature of Solo Parents</th>
                                        <th class="fw-bold text-center">Population</th>
                                        <th class="fw-bold text-center">Percentage</th>
                                        <th class="fw-bold text-center">Ranking</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $populationPerNature = getPopulationPerNatureOfSoloParent(false);
                                        $ranking = array_rank($populationPerNature);
                                    ?>
                                    <tr>
                                        <td>Victim of Crime</td>
                                        <td><?=$populationPerNature[0]?></td>
                                        <td><?=getPopulationPercentage($populationPerNature[0],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[0] . getOrdinal($ranking[0])?></td>
                                    </tr>
                                    <tr>
                                        <td>Abandoned</td>
                                        <td><?=$populationPerNature[1]?></td>
                                        <td><?=getPopulationPercentage($populationPerNature[1],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[1] . getOrdinal($ranking[1])?></td>
                                    </tr>
                                    <tr>
                                        <td>Widowed</td>
                                        <td><?=$populationPerNature[2]?></td>
                                        <td><?=getPopulationPercentage($populationPerNature[2],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[2] . getOrdinal($ranking[2])?></td>
                                    </tr>
                                    <tr>
                                        <td>Convicted Spouse</td>
                                        <td><?=$populationPerNature[3]?></td>
                                        <td><?=getPopulationPercentage($populationPerNature[3],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[3] . getOrdinal($ranking[3])?></td>
                                    </tr>
                                    <tr>
                                        <td>Incapacitated Spouse</td>
                                        <td><?=$populationPerNature[4]?></td>
                                        <td><?=getPopulationPercentage($populationPerNature[4],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[4] . getOrdinal($ranking[4])?></td>
                                    </tr>
                                    <tr>
                                        <td>Annulled</td>
                                        <td><?=$populationPerNature[5]?></td>
                                        <td><?=getPopulationPercentage($populationPerNature[5],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[5] . getOrdinal($ranking[5])?></td>
                                    </tr>
                                    <tr>
                                        <td>Divorced</td>
                                        <td><?=$populationPerNature[6]?></td>
                                        <td><?=getPopulationPercentage($populationPerNature[6],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[6] . getOrdinal($ranking[6])?></td>
                                    </tr>
                                    <tr>
                                        <td>Immediate Family</td>
                                        <td><?=$populationPerNature[7]?></td>
                                        <td><?=getPopulationPercentage($populationPerNature[7],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[7] . getOrdinal($ranking[7])?></td>
                                    </tr>
                                    <tr>
                                        <td>Separated</td>
                                        <td><?=$populationPerNature[8]?></td>
                                        <td><?=getPopulationPercentage($populationPerNature[8],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[8] . getOrdinal($ranking[8])?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">TOTAL</td>
                                        <td class="fw-bold"><?=getTotalPopulationOfSoloParents()?></td>
                                        <td class="fw-bold"><?='100%'?></td>
                                        <td class="fw-bold"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <h5 class="card-title text-secondary fw-bolder mt-3">Findings</h5>
                            <p>The report concluded that the leading cause of being solo parent is <b class="fw-bold"><?=getLeadingNatureOfSoloParent()?>.</b></p>
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
			labels: ['Victim of Crime', 'Abandoned', 'Widowed','Convicted Spouse', 'Incapacitated Spouse', 'Annuled', 'Divorced', 'Immediate Family', 'Separated'],
			datasets: [{
				label: 'Population',
				data: [
                    <?php getPopulationPerNatureOfSoloParent(true)?>
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