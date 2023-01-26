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
    <title>Solo Parent Report (Barangay) <?=date("d M Y")?></title>
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
                            <h5 class="card-title text-secondary fw-bolder">Solo Parents' Population Distribution (Based on Barangay)</h5>
                            <canvas id="myChart" style="max-height: calc(8.5in/2); max-width: 7.5in;"></canvas>
                            <h5 class="card-title text-secondary fw-bolder mt-5">Solo Parents' Barangay Population Distribution</h5>
                            <table class="table table-striped">
                                <?php
                                    $populationPerBarangay = [];
                                    for ($i = 0; $i < 18; $i++) {
                                        $id = $i + 1;
                                        $sql = "SELECT COUNT(soloparents.BarangayID)
                                        FROM soloparents 
                                        WHERE BarangayID = $id";
                                        $result = mysqli_query($connection, $sql);
                                        $barangayPopulation = mysqli_fetch_row($result);

                                        array_push($populationPerBarangay, $barangayPopulation[0]);
                                    }
                                    $ranking = array_rank($populationPerBarangay);
                                ?>
                                <thead>
                                    <tr>
                                        <th class="text-center fw-bold">Barangay</th>
                                        <th class="text-center fw-bold">Population</th>
                                        <th class="fw-bold text-center">Percentage</th>
                                        <th class="fw-bold text-center">Ranking</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="w-50">Baclaran</td>
                                        <td><?=$populationPerBarangay[0]?></td>
                                        <td><?=getPopulationPercentage($populationPerBarangay[0],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[0] . getOrdinal($ranking[0])?></td>
                                    </tr>
                                    <tr>
                                        <td>Banay Banay</td>
                                        <td><?=$populationPerBarangay[1]?></td>
                                        <td><?=getPopulationPercentage($populationPerBarangay[1],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[1] . getOrdinal($ranking[1])?></td>
                                    </tr>
                                    <tr>
                                        <td>Banlic</td>
                                        <td><?=$populationPerBarangay[2]?></td>
                                        <td><?=getPopulationPercentage($populationPerBarangay[2],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[2] . getOrdinal($ranking[2])?></td>
                                    </tr>
                                    <tr>
                                        <td>Barangay Dos</td>
                                        <td><?=$populationPerBarangay[3]?></td>
                                        <td><?=getPopulationPercentage($populationPerBarangay[3],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[3] . getOrdinal($ranking[3])?></td>
                                    </tr>
                                    <tr>
                                        <td>Barangay Tres</td>
                                        <td><?=$populationPerBarangay[4]?></td>
                                        <td><?=getPopulationPercentage($populationPerBarangay[4],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[4] . getOrdinal($ranking[4])?></td>
                                    </tr>
                                    <tr>
                                        <td>Barangay Uno</td>
                                        <td><?=$populationPerBarangay[5]?></td>
                                        <td><?=getPopulationPercentage($populationPerBarangay[5],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[5] . getOrdinal($ranking[5])?></td>
                                    </tr>
                                    <tr>
                                        <td>Bigaa</td>
                                        <td><?=$populationPerBarangay[6]?></td>
                                        <td><?=getPopulationPercentage($populationPerBarangay[6],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[6] . getOrdinal($ranking[6])?></td>
                                    </tr>
                                    <tr>
                                        <td>Butong</td>
                                        <td><?=$populationPerBarangay[7]?></td>
                                        <td><?=getPopulationPercentage($populationPerBarangay[7],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[7] . getOrdinal($ranking[7])?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
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
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center fw-bold">Barangay</th>
                                        <th class="text-center fw-bold">Number of Solo Parents</th>
                                        <th class="fw-bold text-center">Percentage</th>
                                        <th class="fw-bold text-center">Ranking</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <td>Casile</td>
                                        <td><?=$populationPerBarangay[8]?></td>
                                        <td><?=getPopulationPercentage($populationPerBarangay[8],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[8] . getOrdinal($ranking[8])?></td>
                                    </tr>
                                    <tr>
                                        <td>Diezmo</td>
                                        <td><?=$populationPerBarangay[9]?></td>
                                        <td><?=getPopulationPercentage($populationPerBarangay[9],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[9] . getOrdinal($ranking[9])?></td>
                                    </tr>
                                    <tr>
                                        <td class="w-50">Gulod</td>
                                        <td><?=$populationPerBarangay[10]?></td>
                                        <td><?=getPopulationPercentage($populationPerBarangay[10],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[10] . getOrdinal($ranking[10])?></td>
                                    </tr>
                                    <tr>
                                        <td>Mamatid</td>
                                        <td><?=$populationPerBarangay[11]?></td>
                                        <td><?=getPopulationPercentage($populationPerBarangay[11],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[11] . getOrdinal($ranking[11])?></td>
                                    </tr>
                                    <tr>
                                        <td>Marinig</td>
                                        <td><?=$populationPerBarangay[12]?></td>
                                        <td><?=getPopulationPercentage($populationPerBarangay[12],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[12] . getOrdinal($ranking[12])?></td>
                                    </tr>
                                    <tr>
                                        <td>Niugan</td>
                                        <td><?=$populationPerBarangay[13]?></td>
                                        <td><?=getPopulationPercentage($populationPerBarangay[13],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[13] . getOrdinal($ranking[13])?></td>
                                    </tr>
                                    <tr>
                                        <td>Pittland</td>
                                        <td><?=$populationPerBarangay[14]?></td>
                                        <td><?=getPopulationPercentage($populationPerBarangay[14],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[14] . getOrdinal($ranking[14])?></td>
                                    </tr>
                                    <tr>
                                        <td>Pulo</td>
                                        <td><?=$populationPerBarangay[15]?></td>
                                        <td><?=getPopulationPercentage($populationPerBarangay[15],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[15] . getOrdinal($ranking[15])?></td>
                                    </tr>
                                    <tr>
                                        <td>Sala</td>
                                        <td><?=$populationPerBarangay[16]?></td>
                                        <td><?=getPopulationPercentage($populationPerBarangay[16],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[16] . getOrdinal($ranking[16])?></td>
                                    </tr>
                                    <tr>
                                        <td>San Isidro</td>
                                        <td><?=$populationPerBarangay[17]?></td>
                                        <td><?=getPopulationPercentage($populationPerBarangay[17],getTotalPopulationOfSoloParents())?></td>
                                        <td><?=$ranking[17] . getOrdinal($ranking[17])?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">TOTAL</td>
                                        <td class="fw-bold"><?=getTotalPopulationOfSoloParents()?></td>
                                        <td class="fw-bold"><?='100%'?></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <h5 class="card-title text-secondary fw-bolder mt-5">Findings</h5>
                            <p>The report concluded that majority of solo parents are from <b class="fw-bold">BRGY. <?php
                                $maxVal = max($populationPerBarangay);
                                $maxKey = array_search($maxVal, $populationPerBarangay);
                                $barangay = '';
                                switch($maxKey) {
                                    case 0: 
                                        $barangay = 'baclaran';
                                    break;
                                    case 1: 
                                        $barangay = 'banay banay';
                                    break;
                                    case 2: 
                                        $barangay = 'banlic';
                                    break;
                                    case 3: 
                                        $barangay = 'barangay dos';
                                    break;
                                    case 4: 
                                        $barangay = 'barangay tres';
                                    break;
                                    case 5: 
                                        $barangay = 'barangay uno';
                                    break;
                                    case 6: 
                                        $barangay = 'bigaa';
                                    break;
                                    case 7: 
                                        $barangay = 'butong';
                                    break;
                                    case 8: 
                                        $barangay = 'casile';
                                    break;
                                    case 9: 
                                        $barangay = 'diezmo';
                                    break;
                                    case 10: 
                                        $barangay = 'gulod';
                                    break;
                                    case 11: 
                                        $barangay = 'mamatid';
                                    break;
                                    case 12: 
                                        $barangay = 'marinig';
                                    break;
                                    case 13: 
                                        $barangay = 'niugan';
                                    break;
                                    case 14: 
                                        $barangay = 'pittland';
                                    break;
                                    case 15: 
                                        $barangay = 'pulo';
                                    break;
                                    case 16: 
                                        $barangay = 'sala';
                                    break;
                                    case 17: 
                                        $barangay = 'san isidro';
                                    break;
                                }
                                echo strtoupper($barangay);
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
			labels: [<?= getBarangayNames()?>],
			datasets: [{
				label: 'Population',
				data: [
                    <?= getPopulationPerBarangay();?>
				],
                backgroundColor: [
                    '#FF7000',
                    '#54BAB9',
                    '#C8FFD4',
                    '#90C8AC',
                    '#5F7161',
                    '#FCF9BE',
                    '#DBA39A',
                    '#AD8B73',
                    '#FAAB78',
                    '#FFB9B9',
                    '#EF4B4B',
                    '#874C62',
                    '#FF8DC7',
                    '#BA94D1',
                    '#11324D',
                    '#D1D1D1',
                    '#41444B',
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