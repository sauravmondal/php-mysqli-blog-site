<?php
    // This is how you redirect to a new page
    //have to keep this function in function file and call it and use it
    function redirect_function($page_name){
        header("Location: ".$page_name);
        exit;
    }

    // Test if there was a query error
    function confirm_query ($current_post_set){
        if(!$current_post_set){
            die("Database query failed.");
        }
    }

    function find_all_posts($public=true){
        global $connection;

        // 2. Perform database query
        $query = "SELECT * ";
        $query .= "FROM posts ";
        if($public){
            $query .= "WHERE visible = 1";
        }
        $posts = mysqli_query($connection, $query);
        // Test if there was a query error
        confirm_query ($posts);

        return $posts;
    }

    function find_post_by_id($post_no){
        global $connection;
        $safe_post_no = mysqli_real_escape_string($connection, $post_no);

        // 2. Perform database query
        $query = "SELECT * ";
        $query .= "FROM posts ";
        $query .= "WHERE id = '{$safe_post_no}'";
        $query .= "LIMIT 1";
        $current_post = mysqli_query($connection, $query);
        // Test if there was a query error
        confirm_query ($current_post);

        return $current_post;
    }

    // 2. Perform database query AND // 3. Use returned data (if any)
    function find_post_by_id_2($post_no){
        global $connection;
        $safe_post_no = mysqli_real_escape_string($connection, $post_no);

        // 2. Perform database query
        $query = "SELECT * ";
        $query .= "FROM posts ";
        $query .= "WHERE id = '{$safe_post_no}'";
        $query .= "LIMIT 1";
        $current_post = mysqli_query($connection, $query);
        // Test if there was a query error
        confirm_query ($current_post);

        // 3. Use returned data (if any)
        $post_id=mysqli_fetch_assoc($current_post);

        return $post_id;
    }

    function find_comments_for_post($post_no, $public=true){
        global $connection;
        $safe_post_no = mysqli_real_escape_string($connection, $post_no);

        // 2. Perform database query
        $query = "SELECT * ";
        $query .= "FROM comments ";
        $query .= "WHERE post_id = '{$safe_post_no}' ";
        if($public){
            $query .= "AND visible = 1";
        }
        $comments = mysqli_query($connection, $query);
        // Test if there was a query error
        confirm_query ($comments);

        return $comments;
    }
    // 2. Perform database query AND // 3. Use returned data (if any)
    //find_all_admin + s
    function find_all_admin(){
        global $connection;

        // 2. Perform database query
        $query = "SELECT * ";
        $query .= "FROM admins ";
        $results = mysqli_query($connection, $query);

        // Test if there was a query error
        confirm_query ($results);

        // 3. Use returned data (if any)
        //$admin_list=mysqli_fetch_assoc($results);
        
        //mysqli_free_result($results);    
        return $results;
    }

    // 2. Perform database query AND // 3. Use returned data (if any)
    function find_admin_by_id($admin_id){
        global $connection;
        $safe_admin_id = mysqli_real_escape_string($connection, $admin_id);

        // 2. Perform database query
        $query = "SELECT * ";
        $query .= "FROM admins ";
        $query .= "WHERE id = '{$safe_admin_id}'";
        $query .= "LIMIT 1";
        $result = mysqli_query($connection, $query);
        // Test if there was a query error
        confirm_query ($result);

        // 3. Use returned data (if any)
        if($admin_id=mysqli_fetch_assoc($result)){
            return $admin_id;
        }
        else {
            return null;
        }
    }

    function find_admin_by_username($username){
        global $connection;
        $safe_admin_username = mysqli_real_escape_string($connection, $username);

        // 2. Perform database query
        $query = "SELECT * ";
        $query .= "FROM admins ";
        $query .= "WHERE username = '{$safe_admin_username}'";
        $query .= "LIMIT 1";
        $result = mysqli_query($connection, $query);
        // Test if there was a query error
        confirm_query ($result);

        // 3. Use returned data (if any)
        if($admin=mysqli_fetch_assoc($result)){
            return $admin;
        }
        else {
            return null;
        }
    }

    function atempt_login($username, $password){
        $admin=find_admin_by_username($username);
        if($admin){
            if(password_verify($password, $admin["hashed_password"])){
                return $admin;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    function logged_in(){
        return isset($_SESSION["admin_id"]);
    }

    function confirm_logged_in(){
        if(!logged_in()){
            redirect_function ("login.php");
        }
    }
    
    function form_errors($new_var=array()){
        $output ="";
        if (!empty ($new_var)){
            $output .= "Please fix the following errors:";
            $output .="<ul>";
            foreach($new_var as $k => $v){
                $output .="<li>$v</li>";
            }
            $output .="</ul>";
        }
        return $output;
    }
    
?>