<?php
    include_once './conn.php';
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Music4U</title>
        <link rel="stylesheet" type="text/css" href="css/styletrend.css">
    </head>

    <body>
        <div id="container">
            <div id='header'>
                <h1>Music4U</h1>
            </div>
            
            <div id='content'>
                <div id='nav'>
                    <ul>
                        <li><a href="home.html">Home</a></li>
                        <li class="active"><a href="#">Trending</a></li>                   
                        <li><a href="#">Music for you</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="contactus.html">Contact Us</a></li>
                    </ul>
                </div>

                <div id="main">
                    <h1>Trending Music you should try</h1>
                    <h4>English</h4>

                    <table id="t01">
                        <tr>
                            <th>Title</th>
                            <th>Artist</th>
                            <th>listen_count</th>
                        </tr>
                    <?php
                        $sql = "SELECT * FROM trending_song
                                ORDER BY listen_count DESC
                                LIMIT 15;";
                        $result = mysqli_query($conn,$sql);
                        $resultCheck = mysqli_num_rows($result);
                        if($resultCheck > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                ?>
                            <tr>
                                <td><a href="https://www.youtube.com/results?search_query=<?php echo $row["title"]?>"><?php echo $row["title"] ?></a></td>
                                <td><?php echo $row["artist_name"] ?></td>
                                <td><?php echo $row["listen_count"] ?></td>
                            <?php
                            }
                        }
                    ?>
                    </table>
                    
                </div>
            </div>

            <div id='footer'>
                Copyright &copy; 2020 vadaPAV Inc.
            </div>
        </div>
    </body>