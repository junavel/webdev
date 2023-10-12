<main id="main" class="main">
    <div class="pagetitle">
        <h1>Members</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Admins</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <?php
        // Replace with your database connection details
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'mywebsite';

        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Handle the edit action
        if (isset($_GET['edit_id'])) {
            $editId = $_GET['edit_id'];

            // Fetch the user data by ID
            $sql = "SELECT * FROM access WHERE id = $editId";
            $editResult = $conn->query($sql);

            if ($editResult->num_rows == 1) {
                $row = $editResult->fetch_assoc();
                // Here, you can display a form to edit user data with pre-filled values
                echo '<form method="post" action="update_user.php">'; // Create an update_user.php for processing the form data
                echo '<input type="hidden" name="edit_id" value="' . $row['id'] . '">';
                echo 'First Name: <input type="text" name="firstname" value="' . $row['firstname'] . '"><br>';
                echo 'Last Name: <input type="text" name="lastname" value="' . $row['lastname'] . '"><br>';
                // Add other input fields for email, age, address, gender, etc.
                echo '<input type="submit" value="Save Changes">';
                echo '</form>';
            } else {
                echo 'User not found.';
            }
        }

        // Query to select users with the role "user" and exclude "admin"
        $sql = "SELECT id, firstname, lastname, email, password, age, address, gender, status FROM access WHERE role = 'user'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<div class="row">';
            echo '<div class="col-lg-12">';
            echo '<div class="card">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">Members</h5>';

            echo '<table border="1">
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>';

            // Output data of each member
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>' . $row['firstname'] . '</td>
                        <td>' . $row['lastname'] . '</td>
                        <td>' . $row['email'] . '</td>
                        <td>' . $row['password'] . '</td>
                        <td>' . $row['age'] . '</td>
                        <td>' . $row['address'] . '</td>
                        <td>' . $row['gender'] . '</td>
                        <td>' . $row['status'] . '</td>
                        <td><a href="?edit_id=' . $row['id'] . '">Edit</a></td>
                      </tr>';
            }

            echo '</table>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        } else {
            echo 'No members found.';
        }

        // Close the database connection
        $conn->close();
        ?>
    </section>
</main><!-- End #main -->
