<h1>User Activity Analysis</h1>

  <p>
        This is a SQL and PHP project that displays the table contents from the database on a webpage. 
        One can view the recent activity of the users, details of posts such as likes, comments, and shares, 
        and also view the top 3 users with the most followers.
    </p>

  <p>
        Note: All this data is stored in the database, meaning none of the data is taken directly from social media platforms.
    </p>

  <p>
        The project also offers the option to add and delete users directly from the webpage. 
        These changes are reflected in the database as well.
    </p>
<h2>Features</h2>
    <ul>
        <li>Home – Return to the main dashboard</li>
        <li>Recent Activity – Display the most recent user activity</li>
        <li>Posts – View post details including likes, comments, and shares</li>
        <li>Top Followers – View the top 3 users with the most followers</li>
        <li>Add User – Insert a new user with name and follower count</li>
        <li>Delete User – Remove a user by ID</li>
    </ul>

   <h2>Technologies Used</h2>
    <ul>
        <li>HTML5 – Structure of the page</li>
        <li>CSS3 – Styling and layout</li>
        <li>PHP – Backend logic for connecting with the database</li>
        <li>MySQL – Database for storing user, activity, and post data</li>
    </ul>

  <h2>Project Structure</h2>
    <pre>
User-Activity-Analysis
 ┣ index.html
 ┣ index.php
 ┣ README.html
 ┗ images
     ┣ dashboard.png
     ┗ add_user.png
    </pre>

  <h2>How to Run</h2>
    <ol>
        <li>Clone this repository:
            <pre>git clone https://github.com/your-username/User-Activity-Analysis.git</pre>
        </li>
        <li>Place project files in your PHP server directory (e.g., htdocs for XAMPP).</li>
        <li>Import the database dump (if provided) into MySQL.</li>
        <li>Start Apache and MySQL servers.</li>
        <li>Open http://localhost/User-Activity-Analysis/index.php in your browser.</li>
    </ol>

   <h2>Screenshots</h2>
    <p>Dashboard</p>
    <img src="./images/dashboard.png" alt="Dashboard Screenshot" width="600">
    <p>Add User Form</p>
    <img src="./images/add_user.png" alt="Add User Screenshot" width="600">
