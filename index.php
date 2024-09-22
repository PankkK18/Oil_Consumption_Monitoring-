<?php
// include "config.php";
function getAllMachines()
{
    include "config.php";

    // Fetch all machines
    $sql = "SELECT msch_name ,line_no FROM machine_info";
    $result = $conn->query($sql);

    $machines = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $machines[] = $row;
        }
    }

    // Close connection
    $conn->close();

    return $machines;
}

function getRecentlyAddedMachines()
{
    include "config.php";

    // Fetch recently added machines
    $sql = "SELECT msch_name ,line_no FROM machine_info ORDER BY msch_id  DESC LIMIT 5";
    $result = $conn->query($sql);

    $recentMachines = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $recentMachines[] = $row;
        }
    }

    // Close connection
    $conn->close();

    return $recentMachines;
}
function getHighestOilConsumption()
{
    include "config.php";

    // Fetch machines with oil consumption
    $sql = "SELECT mi.msch_name, mi.line_no, od.oil
            FROM machine_info mi
            JOIN entries od ON mi.msch_id = od.msch_id";
    $result = $conn->query($sql);

    $highestConsumptionMachines = []; // Array to store machines with highest consumption

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $machineKey = $row['msch_name'] . '_' . $row['line_no']; // Generate unique key for machine and line number
            
            // Check if machine exists in the array
            if (isset($highestConsumptionMachines[$machineKey])) {
                // Compare current oil consumption with previous one
                if ($row['oil'] > $highestConsumptionMachines[$machineKey]['oil']) {
                    // If current consumption is higher, update the array
                    $highestConsumptionMachines[$machineKey] = [
                        'msch_name' => $row['msch_name'],
                        'line_no' => $row['line_no'],
                        'oil' => $row['oil']
                    ];
                }
            } else {
                // If machine doesn't exist, add it to the array
                $highestConsumptionMachines[$machineKey] = [
                    'msch_name' => $row['msch_name'],
                    'line_no' => $row['line_no'],
                    'oil' => $row['oil']
                ];
            }
        }
    }

    // Close connection
    $conn->close();

    return $highestConsumptionMachines;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Oil Consumption and Monitoring</title>
    <style>
        #machine-list,
        #machine-list2 {
            list-style: none;
            padding: 0;
        }

        #machine-list2 li {
            display: none;
        }

        #machine-list2 li.show {
            display: block;
        }

        .highlight {
            background-color: yellow;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <a href="index.php">Dashboard</a>
            <a href="add_oil.php">Add Oil</a>
            <div class="user-logo">
                <img src="/logo.jpeg" alt="User Logo">
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="recent_machines">
            <h4>Recently added oil machines</h4>
            <ul class="list">
                <?php
                // Example PHP code to fetch recently added machines from the database
                $recentMachines = getRecentlyAddedMachines();
                foreach ($recentMachines as $machine) {
                    echo  "<li>{$machine['msch_name']} - {$machine['line_no']}</li>";
                }
                ?>
            </ul>
        </div>
        <div class="history">
            <h4>Machine oil History</h4>
            <input type="text" id="search-box" placeholder="Search" oninput="filterMachineList()">
            <ul class="list" id="machine-list">
                <!-- Placeholder for dynamically populated suggestions -->
            </ul>

            <ul class="list" id="machine-list2">
                <?php
                // Fetch all machines
                $allMachines = getAllMachines();

                // Check if $allMachines is not empty before using foreach
                if (!empty($allMachines)) {
                    foreach ($allMachines as $machine) {
                        echo "<li>{$machine['msch_name']}</li>";
                    }
                } else {
                    echo "<li>No machines found</li>";
                }
                ?>
            </ul>
        </div>

       
        <div class="highest-oil-consumption">
    <h4>Machine(s) with Highest Oil Consumption</h4>
    <ul>
        <?php
        // Fetch machines with highest oil consumption
        $highestConsumption = getHighestOilConsumption();
        if (!empty($highestConsumption)) {
            foreach ($highestConsumption as $machineData) {
                // Display each machine with its oil consumption
                echo "<li>{$machineData['msch_name']} (Line {$machineData['line_no']}) - Oil Consumption: {$machineData['oil']}</li>";
            }
        } else {
            echo "<li>No data available.</li>";
        }
        ?>
    </ul>
</div>

    </div>

    <script>
        function filterMachineList() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById('search-box');
            filter = input.value.toUpperCase();
            ul = document.getElementById('machine-list');
            li = ul.getElementsByTagName('li');

            // Clear previous suggestions
            ul.innerHTML = '';

            // Display matching suggestions
            for (i = 0; i < li.length; i++) {
                a = li[i].textContent || li[i].innerText;
                if (a.toUpperCase().indexOf(filter) > -1) {
                    var suggestion = document.createElement('li');
                    suggestion.textContent = a;
                    ul.appendChild(suggestion);
                }
            }

            // Display/hide full list based on search input
            var machineList2 = document.getElementById('machine-list2');
            li = machineList2.getElementsByTagName('li');

            for (i = 0; i < li.length; i++) {
                a = li[i].textContent || li[i].innerText;
                if (a.toUpperCase().indexOf(filter) > -1) {
                    li[i].classList.add('show');
                } else {
                    li[i].classList.remove('show');
                }
            }
        }
    </script>
</body>

</html>
