 <?php
        $servername = env('DB_HOST', 'localhost');
        $username   = env('DB_USERNAME', 'forge');
        $password   = env('DB_PASSWORD', 'forge');
        $dbname     = env('DB_DATABASE', 'forge');

        $i = 0;
        $j = 0;
        $m = 0;
        $f = 0;
        $dorm1 = 0;
        $dorm2 = 0;
        $link = mysqli_connect($servername,$username,$password,$dbname);
        mysqli_set_charset($link, "utf8");
        $sq3 = "SELECT * FROM user_profiles JOIN departments ON user_profiles.dept_id = departments.id ORDER BY user_profiles.gender";
        $result3 = mysqli_query($link,$sq3);
        $result4 = mysqli_query($link,$sq3);

        ?>

