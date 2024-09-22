<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add_oil.css">
    <title>Oil Consumption and Monitoring</title>
    <script>
        function fetchMachineNames() {
            const machineNames = ['Machine 1', 'Machine 2', 'Machine 3', 'Machine 4'];
            const datalist = document.getElementById('machine_names');
            machineNames.forEach(name => {
                const option = document.createElement('option');
                option.value = name;
                datalist.appendChild(option);
            });
        }
    </script>
</head>
<body onload="fetchMachineNames()">
    <header>
        <nav class="navbar">
            <a href="index.php">Dashboard</a>
            <a href="add_oil.php">Add Oil</a>
            <div class="user-logo">
                <img src="logo.jpeg" alt="User Logo">
            </div>
        </nav>
    </header>
    <br>
    <h2 class="entry">Oil Entry</h2>
    <form action="" method="POST">
        <label for="line_no">Line Name:</label>
        <select id="line_no" name="line_no" required>
            <option value="">Select Line</option>
            <option value="1">JOHN DEER CLUTCH HOUSING LINE</option>
            <option value="2">JOHN DEER (FT-4) LINE </option>
            <option value="3">bullcage line</option>
            <option value="4">CRANK CASE-393/265</option>
            <option value="5">MAHINDRA H1</option>
            <option value="6">2.2 BLOCK LINE</option>
            <option value="7">KUBOTA FA</option>
            <option value="8">KUBOTA CASE TRANSMISSION (CT)</option>
            <option value="9">VECTRA NO 2 oil</option>
            <option value="10">DTE 24 oil</option>
            <option value="11">NEW BFW MACHINE NON68 OIL</option>
        </select>
        <br><br>
        <label for="machine_name">Machine Name: </label>
        <input type="text" id="machine_name" name="msch_name" list="machine_names" required>
        <datalist id="machine_names"></datalist>
        <br><br>
        <label for="calender">Calender: </label>
        <input type="date" id="calender" name="date" value="<?php echo date('Y-m-d'); ?>" required readonly>
        <br><br>
        <label for="oil_quantity">Oil Quantity: </label>
        <input type="number" id="oil_quantity" name="oil" required>
        <br><br>
        <input type="checkbox" name="details_checked" id="details_checked" required> I have checked all the details entered above.
        
        <br><br>
        <input type="submit" name="submit" value="submit"  >
        <br><br>
    </form>
    <div class="recently-added-oil-machines">
        <h4>Recently Added Oil Machines</h4>
        <ul>
          <li>Machine 1</li>
          <li>Machine 2</li>
          <li>Machine 3</li>
        </ul>
      </div>
</body>
</html>

<?php

include "config.php";

if(isset($_POST['submit'])) {
    $line_no = $_POST['line_no'];
    $msch_name = $_POST['msch_name'];
    $date = $_POST['date'];
    $oil = $_POST['oil'];

    // First, check if the machine exists in the machine_info table
    $check_query = "SELECT msch_id FROM machine_info WHERE msch_name = '$msch_name'";
    $result = mysqli_query($conn, $check_query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $msch_id = $row['msch_id'];

        // Insert data into entries table
        $insert_entries_query = "INSERT INTO entries (msch_id, date, oil) VALUES ('$msch_id', '$date', '$oil')";
        $res_entries = mysqli_query($conn, $insert_entries_query);

        if($res_entries) {
            ?>
            <script>
                alert("Data inserted properly");
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Failed to insert data into entries table");
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert("Machine not found in the machine_info table");
        </script>
        <?php
    }
}
?>
