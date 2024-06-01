<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Thrive Hub</title>
    
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">

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
			<li class="active">
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
			<li>
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
        <div class="page-header">
            <h2>Selamat datang di Thrive Hub</h2>
        </div>
        <div class="container-fluid">
            <p>Selamat datang di dashboard Thrive Hub. Di sini Anda bisa mengelola komunitas, event, dan banyak lagi.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Komunitas</h3>
                        </div>
                        <div class="panel-body">
                            <p>Kelola komunitas Anda di sini. Lihat daftar komunitas yang ada dan setujui pengajuan baru.</p>
                            <a href="approvalkomunitas.php" class="btn btn-primary">Kelola Komunitas</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Event</h3>
                        </div>
                        <div class="panel-body">
                            <p>Kelola event Anda di sini. Lihat daftar event yang ada dan setujui pengajuan baru.</p>
                            <a href="approvalevent.php" class="btn btn-primary">Kelola Event</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT -->
</body>
</html>
