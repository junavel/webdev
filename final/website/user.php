<!DOCTYPE html>
<html>
<head>
    <title>Your Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <style>
        body {
            background: #E5F3FD;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Prevent horizontal scrolling */
        }

        header {
            background-color: #ff5349;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 10px; /* Increased padding to adjust the height */
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .header-left a {
            margin-right: 20px;
        }

        .header-icons {
            display: flex;
            align-items: center;
        }

        .header-icons a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
        }

        .search-bar {
            display: flex;
            align-items: center;
        }

        .search-bar input[type="text"] {
            padding: 5px;
            border: none;
            border-radius: 3px;
        }

        .search-bar button {
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        .sidebar {
            background-color: #fff;
            color: #fff;
            width: 0;
            position: fixed;
            top: 74px; /* Adjusted to be a bit lower */
            bottom: 0;
            left: 0;
            overflow-x: hidden;
            transition: 0.5s; /* Add smooth transition effect */
        }

        .sidebar.show {
            width: 200px; /* Show the sidebar when it has the "show" class */
        }

        .sidebar a {
            color: black;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            text-decoration: underline;
        }

        .main-content {
            margin-left: 0; /* Adjust based on your sidebar width */
            padding: 20px;
            transition: margin-left 0.5s; /* Add smooth transition effect */
        }

        /* Media query for responsiveness */
        @media screen and (max-width: 768px) {
            .sidebar {
                width: 0; /* Hide sidebar by default on smaller screens */
            }

            .sidebar.show {
                width: 100%; /* Full width when shown */
            }

            .main-content {
                margin-left: 0; /* Adjust based on your sidebar width */
            }
        }

        /* Style for the hamburger icon */
        #toggleSidebar {
            background-color: transparent;
            border: none;
            cursor: pointer;
            color: black;
            font-size: 24px;
            margin-right: 10px; /* Add some spacing from the header content */
            margin-left: 10px; /* Add some spacing from the header content */
            z-index: 999; /* Ensure the button is on top of the sidebar */
        }

        .activityForm {
            display: none;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .activityForm form {
            /* Your form styles */
        }

        .activityForm form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .activityForm form input[type="text"],
        .activityForm form input[type="date"],
        .activityForm form input[type="time"],
        .activityForm form textarea,
        .activityForm form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .activityForm form button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .activityForm form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-left">
            <a href="#"><img src="your-logo.png" alt="MyWebsite Logo"></a>
            <button id="toggleSidebar">&#9776;</button>
        </div>
        <div class="header-icons">
            <a href="#"><i class="fas fa-envelope"></i></a>
            <a href="#"><i class="fas fa-bell"></i></a>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search">
            <button><i class="fas fa-search"></i></button>
        </div>
    </header>

    <div class="sidebar" id="sidebar">
        <a href="#">Profile</a>
        <a href="addactivity.php">Add Activity</a>
        <a href="#">Edit</a>
        <a href="#">Show All</a>
        <a href="#">Log Out</a>
    </div>

    <div class="main-content">
        <!-- Your main content goes here -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Toggle sidebar visibility
        $("#toggleSidebar").on("click", function() {
            $("#sidebar").toggleClass("show");
            $(".main-content").toggleClass("show");
        });

        // Toggle "Add Activity" form visibility
        $("#addActivityLink").on("click", function(e) {
            e.preventDefault();
            $(".activityForm").slideToggle(); // Toggle the form display
        });
    </script>
</body>
</html>
