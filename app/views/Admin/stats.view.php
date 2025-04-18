<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrative Staff Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/stats.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <?php
        $this->renderComponent('navbar', $active);
        ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Header -->
            <?php
            $pageTitle = "Statistic Reports"; // Set the text you want to display
            include $_SERVER['DOCUMENT_ROOT'] . '/WELLBE/app/views/Components/header.php';
            ?>

            <!--Content Container-->
            <div class="content-container">
                <div class = "stat-section">
                    <span class = "section-title">Patients</span>
                    <div class = "filter-label">
                        <span class = "filters">Age Range: </span>
                        <input type = "text" name = "start-age"> 
                        <span class = "filters">To</span>
                        <input type = "text" name = "end-age">
                    </div>
                    <div class = "filter-label">
                        <span class = "filters">Gender: </span>
                        <select name = "filter-dropdown" class = "filter-dropdown">
                            <option value="All">All</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                    </div>
                    <div class="filter-label">
                        <span class="filters">Location: </span>
                        <input list="cities" class = "filter-dropdown" name="location" placeholder = "All">
                        <datalist id="cities">
                            <option value="All">
                            <option value="Colombo">
                            <option value="Kandy">
                            <option value="Galle">
                            <option value="Jaffna">
                            <option value="Negombo">
                            <option value="Gampaha">
                            <option value="Anuradhapura">
                            <option value="Batticaloa">
                            <option value="Kurunegala">
                            <option value="Matara">
                            <option value="Trincomalee">
                            <option value="Nuwara Eliya">
                            <option value="Ratnapura">
                            <option value="Polonnaruwa">
                            <option value="Badulla">
                            <option value="Hambantota">
                        </datalist>
                    </div> 
                    
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    <div class = "filter-label">
                        <button type = "submit" class = "generate-btn" onclick="generateReport()">Generate Report</button>
                    </div> 

                    <script>
                        function generateReport() {
                            let startAge = document.querySelector("input[name='start-age']").value;
                            let endAge = document.querySelector("input[name='end-age']").value;
                            let gender = document.querySelector("select[name='filter-dropdown']").value;
                            let location = document.querySelector("input[name='location']").value;

                            console.log("Sending Request with:", { startAge, endAge, gender, location });

                            fetch("<?= ROOT ?>/admin/getPatientStats", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/x-www-form-urlencoded",
                                },
                                body: `startAge=${startAge}&endAge=${endAge}&gender=${gender}&location=${location}`
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log("Fetched Data:", data); // Check if data is returned correctly
                                renderChart(data);
                                openModal(); // Show the modal after fetching data
                            })
                            .catch(error => console.error("Error:", error));
                        }

                        function openModal() {
                            document.getElementById("reportModal").style.display = "flex";
                        }

                        // function closeModal() {
                        //     document.getElementById("reportModal").style.display = "none";
                        // }

                        document.addEventListener("DOMContentLoaded", function () {
                            function closeModal() {
                                document.getElementById("reportModal").style.display = "none";
                            }

                            // Close modal when clicking on the close button
                            document.querySelector(".close-btn").addEventListener("click", closeModal);

                            // Close modal when clicking outside the modal content
                            window.addEventListener("click", function (event) {
                                let modal = document.getElementById("reportModal");
                                if (event.target === modal) {
                                    closeModal();
                                }
                            });
                        });

                        function renderChart(data) {
                            const ctx = document.getElementById("patientChart").getContext("2d");

                            let ageCounts = {}; // Store counts for each age
                            data.forEach(entry => {
                                ageCounts[entry.age] = entry.count;
                            });

                            // Get the start and end age
                            let startAge = parseInt(document.querySelector("input[name='start-age']").value) || 0;
                            let endAge = parseInt(document.querySelector("input[name='end-age']").value) || 100;

                            // Collect all unique ages from data
                            let allAges = Object.keys(ageCounts).map(age => parseInt(age));
                            allAges.sort((a, b) => a - b); // Ensure ages are in ascending order

                            // Generate X-axis labels with a step size of 10
                            let ageLabels = [];
                            for (let age = startAge; age <= endAge; age += 10) {
                                ageLabels.push(age);
                            }

                            // Map patient counts to all available ages (ensuring a continuous line)
                            let patientCounts = allAges.map(age => ageCounts[age] || 0);
                            console.log(patientCounts);

                            // Destroy the previous chart if it exists
                            if (window.patientChart && typeof window.patientChart.destroy === 'function') {
                                window.patientChart.destroy();
                            }

                            // Create the Line Chart
                            window.patientChart = new Chart(ctx, {
                                type: "line",
                                data: {
                                    labels: allAges, // Use all ages for a continuous line
                                    datasets: [{
                                        label: "Number of Patients",
                                        data: patientCounts, // Y-axis values
                                        borderColor: "rgb(21, 165, 165)",
                                        backgroundColor: "rgba(21, 165, 165, 0.5)",
                                        pointBackgroundColor: "rgb(21, 165, 165)",
                                        pointBorderColor: "rgb(73, 106, 106)",
                                        borderWidth: 2,
                                        fill: false,
                                        tension: 0.3 // Smoother curve
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        x: {
                                            title: {
                                                display: true,
                                                text: "Age"
                                            },
                                            ticks: {
                                                callback: function (value, index, values) {
                                                    return ageLabels.includes(value) ? value : ""; // Show only multiples of 10
                                                }
                                            }
                                        },
                                        y: {
                                            beginAtZero: true,
                                            title: {
                                                display: true,
                                                text: "Number of Patients"
                                            }
                                        }
                                    }
                                }
                            });
                        }


                    </script>
                </div>  

                <div id="reportModal" class="modal">
                    <div class="modal-content">
                        <span class="close-btn">&times;</span>
                        <canvas id="patientChart"></canvas>
                    </div>
                </div>
            </div>     
        </div>
    </div>
</body>
</html>
