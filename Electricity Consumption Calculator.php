<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Consumption Calculator</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Electricity Consumption Calculator</h1>

                <form method="POST" action="">
            <div class="form-group">
                <label for="voltage">Voltage (V)</label>
                <input type="number" step=".01" class="form-control" id="voltage" name="voltage" required>
            </div>
            <div class="form-group">
                <label for="current">Current (A)</label>
                <input type="number" step=".01" class="form-control" id="current" name="current" required>
            </div>
            <div class="form-group">
                <label for="rate">Current Rate (sen/kWh)</label>
                <input type="number" step=".01" class="form-control" id="rate" name="rate" required>
            </div>
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>


        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $voltage = $_POST['voltage'];
            $current = $_POST['current'];
            $rate = $_POST['rate'];

            $power = $voltage * $current; 
			
	    echo "<table class='table table-bordered mt-4'>";
            echo "<thead><tr><th>#</th><th>Hour</th><th>Energy (kWh)</th><th>Total (RM)</th></tr></thead>";
            echo "<tbody>";
			
			for ($hour = 1; $hour <= 24; $hour++) {
				$energy_per_hour = $power * $hour / 1000; 
				$total_charge_per_hour = $energy_per_hour * ($rate / 100);

				echo "<tr>";
                echo "<td>$hour</td>";
                echo "<td>$hour</td>";
                echo "<td>" . number_format($energy_per_hour, 5) . "</td>";
                echo "<td>" . number_format($total_charge_per_hour, 2) . "</td>";
                echo "</tr>";
            }
			
	    $energy_per_hour = $power * 1 / 1000;
	    $total_charge_per_hour = $energy_per_hour * ($rate / 100);
            $energy_per_day = $energy_per_hour * 24; 
            $total_charge_per_day = $total_charge_per_hour * 24;

            echo "<div class='mt-4'>";
            echo "<h4>Results</h4>";
	    echo "<p>Rate: " . number_format($rate, 2) . " sen/kWh</p>";
            echo "<p>Power: " . number_format($power, 2) . " Watts</p>";
            echo "<p>Energy per Hour: " . number_format($energy_per_hour, 5) . " kWh</p>";
            echo "<p>Energy per Day: " . number_format($energy_per_day, 5) . " kWh</p>";
            echo "<p>Total Charge per Hour: RM " . number_format($total_charge_per_hour, 2) . "</p>";
            echo "<p>Total Charge per Day: RM " . number_format($total_charge_per_day, 2) . "</p>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>

