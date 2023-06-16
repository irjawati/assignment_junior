<!DOCTYPE html>
<html>
<head>
  <title>Electricity Rates Calculator</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <br>
    <h1>Electricity Rates Calculator</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="form-group">
        <label for="voltage">Voltage (V):</label>
        <input type="text" name="voltage" id="voltage" class="form-control" value="<?php echo isset($_POST['voltage']) ? $_POST['voltage'] : ''; ?>" required>
      </div>
      <div class="form-group">
        <label for="current">Current (A):</label>
        <input type="text" name="current" id="current" class="form-control" value="<?php echo isset($_POST['current']) ? $_POST['current'] : ''; ?>" required>
      </div>
      <div class="form-group">
        <label for="rate">Current Rate (RM/kWh):</label>
        <input type="text" name="rate" id="rate" class="form-control" value="<?php echo isset($_POST['rate']) ? $_POST['rate'] : ''; ?>" required>
      </div>
      <br>
      <button type="submit" name="calculate" class="btn btn-primary">Calculate</button>
    </form>
    <br>
    <?php
    function calculateElectricityRates($voltage, $current, $rate)
    {
      // Parse decimal values
      $voltage = floatval($voltage);
      $current = floatval($current);
      $rate = floatval($rate);

      // Calculate power 
      $power = $voltage * $current;

      // Calculate energy 
      $energy = ($power * 1) / 1000;

      // Calculate total charge
      $totalCharge = $energy * $rate;

      // Calculate rates per hour and per day
      $ratePerHour = $totalCharge;
      $ratePerDay = $totalCharge * 24;

      echo "<h2>Results</h2>";
      echo "<p>Power: " . number_format($power, 2) . " W</p>";
      echo "<p>Rate per Hour: RM" . number_format($ratePerHour, 2) . "</p>";

      echo "<h2>Hourly Consumption and Total Charge</h2>";
      echo "<h2></h2>";
      echo "<table class='table'>";
      echo "<thead>";
      echo "<tr>";
      echo "<th>Hour</th>";
      echo "<th>Energy (kWh)</th>";
      echo "<th>Total Charge (RM)</th>";
      echo "</tr>";
      echo "</thead>";
      echo "<tbody>";
      
      $hourlyEnergy = 0;
      $hourlyCharge = 0;
      
      for ($hour = 1; $hour <= 24; $hour++) {
        $hourlyEnergy += $energy;
        $hourlyCharge += $totalCharge;
        
        echo "<tr>";
        echo "<td>$hour</td>";
        echo "<td>" . number_format($hourlyEnergy, 2) . "</td>";
        echo "<td>" . number_format($hourlyCharge, 2) . "</td>";
        echo "</tr>";
      }
      
      echo "</tbody>";
      echo "</table>";
    }

    if (isset($_POST['calculate'])) {
      $voltage = $_POST['voltage'];
      $current = $_POST['current'];
      $rate = $_POST['rate'];

      calculateElectricityRates($voltage, $current, $rate);
    }
    ?>
  </div>
</body>
</html>
