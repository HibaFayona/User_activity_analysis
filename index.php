<!doctype html>
<html>
    <head>
        <title>User Activity Analysis</title>
        <style>
            body {
                font-family: Copperplate, Papyrus, fantasy;
                background-color:rgb(180, 168, 168);
                padding: 20px;
            }

            h1 {
                color:rgb(31, 26, 26);
                font-size: 70px;
            }

            .button-container {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                margin-top: 20px;
            }

            input[type="submit"] {
                margin: 8px 0;
                padding: 12px 24px;
                font-size: 16px;
                border: none;
                border-radius: 6px;
                background-color:  #5C4E4E;
                color: white;
                cursor: pointer;
                box-shadow: 0 2px 5px #5C4E4E;
                transition: background-color 0.3s ease;
            }

            input[type="submit"]:hover {
                background-color: #988686;
            }

            table {
                margin-top: 20px;
                border-collapse: collapse;
                width: 100%;
                background-color: rgb(197, 188, 188);
            }

            th, td {
                padding: 10px;
                border: 1px solid #333;
                text-align: center;
                font-family : Garamond, serif ;
                font-size: 20px;
            }

            h2 {
                margin-top: 40px;
                color:rgb(67, 49, 49);
                font-size: 25px;
            }

            h3 {
                color:rgb(67, 49, 49);
                font-size: 22px;
            }
        </style>
    </head>
    <body>

        <h1>User Activity Analysis</h1>

        <?php
            #connecting to database
            $user = 'root';
            $password = 'newpassword';
            $database = 'user_activity_analysis';
            $servername = '127.0.0.1:3307';

            $mysqli = new mysqli($servername, $user, $password, $database);
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            #home button
            if (isset($_POST['home']) || empty($_POST)) {
                echo "<h3>Welcome to the User Activity Dashboard. Choose an option below to display data.</h3>";
            }

            #displaying the recent activity list
            if (isset($_POST['recent_activity'])) {
                echo "<h2># Recent Activity List of the Users:</h2>";
                $query = "SELECT 
                            U.u_id AS user_id, 
                            U.uuname AS user_name, 
                            A.activity_type AS activity_type, 
                            A.timestamp AS activity_timestamp
                        FROM userss U
                        JOIN ActivityLog A ON U.u_id = A.user_id
                        WHERE A.timestamp >= DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL 30 DAY)";
                $result = $mysqli->query($query);
                if ($result->num_rows > 0) {
                    echo "<table>
                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Activity Type</th>
                                <th>Timestamp</th>
                            </tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['user_id']}</td>
                                <td>{$row['user_name']}</td>
                                <td>{$row['activity_type']}</td>
                                <td>{$row['activity_timestamp']}</td>
                            </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No recent user activity found.";
                }
            }

            #displaying the post details
            if (isset($_POST['post_likes'])) {
                echo "<h2># Post Details:</h2>";
                $query = "SELECT 
                            P.post_id AS post_id,
                            P.content AS post_content,
                            P.likes AS post_likes,
                            P.comments AS post_comments,
                            P.shares AS post_shares
                        FROM posts P";
                $result = $mysqli->query($query);
                if ($result->num_rows > 0) {
                    echo "<table>
                            <tr>
                                <th>ID</th>
                                <th>Post</th>
                                <th>Likes</th>
                                <th>Comments</th>
                                <th>Shares</th>
                            </tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['post_id']}</td>
                                <td>{$row['post_content']}</td>
                                <td>{$row['post_likes']}</td>
                                <td>{$row['post_comments']}</td>
                                <td>{$row['post_shares']}</td>
                            </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No post data found.";
                }
            }

            #displaying top followers
            if (isset($_POST['top_followers'])) {
                echo "<h2>#Users with Top Followers:</h2>";
                $query = "SELECT 
                            U.u_id AS user_id,
                            U.uuname AS user_name,
                            U.followers AS top_followers
                        FROM userss U
                        ORDER BY U.followers DESC
                        LIMIT 3";
                $result = $mysqli->query($query);
                if ($result->num_rows > 0) {
                    echo "<table>
                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Followers</th>
                            </tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['user_id']}</td>
                                <td>{$row['user_name']}</td>
                                <td>{$row['top_followers']}</td>
                            </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No followers data found.";
                }
            }

            // Add User
            if (isset($_POST['add_user'])) {
                $uname = $mysqli->real_escape_string($_POST['uname']);
                $followers = intval($_POST['followers']);
                $insert_query = "INSERT INTO userss (uuname, followers) VALUES ('$uname', $followers)";
                if ($mysqli->query($insert_query) === TRUE) {
                    echo "<h3>✅ User '$uname' added successfully!</h3>";
                } else {
                    echo "<h3>❌ Error adding user: " . $mysqli->error . "</h3>";
                }
            }

            // Delete User
            if (isset($_POST['delete_user'])) {
                $delete_id = intval($_POST['delete_id']);
                $delete_query = "DELETE FROM userss WHERE u_id = $delete_id";
                if ($mysqli->query($delete_query) === TRUE) {
                    echo "<h3>✅ User with ID $delete_id deleted successfully!</h3>";
                } else {
                    echo "<h3>❌ Error deleting user: " . $mysqli->error . "</h3>";
                }
            }



        ?>
        
        <!--buttons-->
        <form method="post" class="button-container">
            <input type="submit" name="home" value="🏠 Home" />
            <input type="submit" name="recent_activity" value="📅 Recent Activity" />
            <input type="submit" name="post_likes" value="👍 Posts" />
            <input type="submit" name="top_followers" value="⭐ Top Followers" />
        </form>

        <!-- User Insert/Delete -->
        <h2># Add New User</h2>
        <form method="post" class="button-container">
            <input type="text" name="uname" placeholder="User Name" required />
            <input type="number" name="followers" placeholder="Followers Count" required />
            <input type="submit" name="add_user" value="➕ Add User" />
        </form>

        <h2># Delete User</h2>
        <form method="post" class="button-container">
            <input type="number" name="delete_id" placeholder="User ID to Delete" required />
            <input type="submit" name="delete_user" value="🗑️ Delete User" />
        </form>

    </body>
</html>

