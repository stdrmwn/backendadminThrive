<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="style.css">

	<title>AdminHub - Event</title>

	<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        #sidebar {
            width: 250px;
            height: 100vh;
            background-color: #2c3e50;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            color: #f39c12; /* Kuning tua untuk teks */
        }

        #sidebar .brand {
            text-align: center;
            margin-bottom: 30px;
        }

        #sidebar .brand .text {
            color: #f39c12; /* Kuning tua */
            font-size: 24px;
            font-weight: bold;
        }

        #sidebar .side-menu {
            list-style: none;
            padding: 0;
        }

        #sidebar .side-menu li {
            width: 100%;
            padding: 15px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #sidebar .side-menu li a {
            color: #f39c12; /* Kuning tua */
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        #sidebar .side-menu li a i {
            margin-right: 15px;
            font-size: 20px;
        }

        #sidebar .side-menu li.active,
        #sidebar .side-menu li:hover {
            background-color: #1abc9c;
        }

        #sidebar .side-menu li a span {
            font-size: 16px;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .content .page-header {
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .content .page-header h2 {
            margin-top: 0;
            color: #34495e;
        }

        .content .container-fluid {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .content .panel {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .content .panel-heading {
            background-color: #3498db;
            color: #fff;
            border-radius: 8px 8px 0 0;
        }

        .content .panel-title {
            font-size: 18px;
        }

        .content .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
        }

        .content .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        .content .panel-body p {
            color: #7f8c8d;
        }
    </style>
</head>
<body>

	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<span class="text">Thrive.org</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="landingpage.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="approvalkomunitas.php">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Komunitas</span>
				</a>
			</li>
			<li class="active">
				<a href="approvalevent.php">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Event</span>
				</a>
			</li>
            <li>
				<a href="signout.php">
					<i class='bx bx-log-out'></i>
					<span class="text">LOG OUT</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->

	<!-- CONTENT -->
	<div class="content">
		<div class="page-header clearfix">
			<h2 class="pull-left">Event</h2>
			<div class="pull-right">
				<form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form>
			</div>
		</div>
		<div class="container-fluid">
			<?php
			// Include config2 file
			require_once "config2.php";

			// Define the number of results per page
			$results_per_page = 10;

			// Process search query
			$search = isset($_GET['search']) ? $_GET['search'] : '';
			$where_clause = !empty($search) ? "WHERE nama_event LIKE '%$search%' OR waktu_mulai LIKE '%$search%' OR waktu_selesai LIKE '%$search%' OR tanggal LIKE '%$search%'" : '';

			// Find out the number of results stored in database
			$sql = "SELECT COUNT(*) AS total FROM events $where_clause";
			$result = mysqli_query($link, $sql);
			$row = mysqli_fetch_assoc($result);
			$total_results = $row['total'];

			// Determine number of total pages available
			$total_pages = ceil($total_results / $results_per_page);

			// Determine which page number visitor is currently on
			$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
			if ($page > $total_pages) $page = $total_pages;
			if ($page < 1) $page = 1;

			// Determine the sql LIMIT starting number for the results on the displaying page
			$starting_limit_number = ($page-1) * $results_per_page;

			// Get the results with limit
			$sql = "SELECT * FROM events $where_clause LIMIT $starting_limit_number, $results_per_page";
			$result = mysqli_query($link, $sql);

			if($result){
				if(mysqli_num_rows($result) > 0){
					echo "<table class='table table-bordered table-striped'>";
					echo "<thead>";
					echo "<tr>";
					echo "<th>Event_Id</th>";
					echo "<th>Nama Event</th>";
					echo "<th>Tanggal</th>";
					echo "<th>Waktu Mulai</th>";
					echo "<th>Waktu Selesai</th>";
					echo "<th>Lokasi</th>";
					echo "<th>Pengaturan</th>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					while($row = mysqli_fetch_array($result)){
						echo "<tr>";
						echo "<td>" . $row['event_id'] . "</td>";
						echo "<td>" . $row['nama_event'] . "</td>";
						echo "<td>" . $row['tanggal'] . "</td>";
						echo "<td>" . $row['waktu_mulai'] . "</td>";
						echo "<td>" . $row['waktu_selesai'] . "</td>";
						echo "<td>" . $row['lokasi'] . "</td>";
						echo "<td>";
						echo "<a href='terima.php?id=". $row['event_id'] ."' title='Terima' data-toggle='tooltip' class='btn btn-success btn-sm'>Terima</a>";
						echo "<a href='tolakevent.php?id=". $row['event_id'] ."' title='Tolak' data-toggle='tooltip' class='btn btn-danger btn-sm'>Tolak</a>";
						echo "</td>";
						echo "</tr>";
					}
					echo "</tbody>";
					echo "</table>";

					// Free result set
					mysqli_free_result($result);

					// Display pagination
					echo '<nav aria-label="Page navigation">';
					echo '<ul class="pagination">';
					for ($page = 1; $page <= $total_pages; $page++) {
						echo '<li class="page-item"><a class="page-link" href="approvalevent.php?page=' . $page . '&search=' . $search . '">' . $page . '</a></li>';
					}
					echo '</ul>';
					echo '</nav>';
				} else{
					echo "<p class='lead'><em>No records were found.</em></p>";
				}
			} else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
			}
			?>
		</div>
	</div>
	<!-- CONTENT -->

</body>
</html>
