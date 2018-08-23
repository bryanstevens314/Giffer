

<?php

require_once 'phpMyAdmin/class.order.php';
include_once 'phpMyAdmin/orderconfig.php';
require_once 'phpMyAdmin/class.url.php';
include_once 'phpMyAdmin/URLConfig.php';
$URLs = new URL();
date_default_timezone_set('America/Los_Angeles');
?>
    <style>
            /* Dropdown Button */
        .dropbtn {
            height:40px;
            width:56px;
            background-color: #3498DB;
            color: white;
            font-size: 16px;
            cursor: pointer;
            
            margin-left:5px;
            margin-top:7px;
        
            
        }
        
        /* Dropdown button on hover & focus */
        .dropbtn:hover, .dropbtn:focus {
            background-color: #2980B9;
        }
        
        /* The container <div> - needed to position the dropdown content */
        .dropdown {
            
            position: relative;
            display: inline-block;
            margin-right:15px;
        float:right;
        }
        
        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        
        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        
        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {background-color: #ddd}
        
        /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
        .show {display:block;}
            .head {
                width: 100%;
                margin-top:10px;
            }
            .containerImageStyle {
                width:100%;
                margin:0px auto;
            }
            .content {
                width:40%;
                border:1px solid black;
                margin:0px auto;
            }
            .hStyle {
                margin:0px auto;
            }

            .table{
                margin:0px auto;
                margin-top:20px;
            }

            #navButton{
                
                width:30px;
                height:30px; 
                margin-left:40px;

            }
            h1{
                font-size: 60px;
                color: #a6a6a6;
                margin: auto;
                margin-left:10px;
                display:inline-block;
            }
            html, body{
                margin:0;
                background-color:#f2f2f2;
            }
            .header{
                height:100px;
                background-color:#f2f2f2;
                
            }
            .currenPage{
                display:flex;
            }
            .next,.prep{
                display:flex;
            }
            .skip{
                display:flex;
            }
            #containerdiv{
              display: flex;
              margin-bottom:4px;
              display: flex;
              justify-content: center;
            }
            #containerdiv > button {
              background-color: #ffffff;
              width: 50px;
              height:38px;
              color:#8c8c8c;
              text-align: center;
            }
            .plus{
                width:35px;
                display:inline-block;
                float:right;
                padding-top:7px;
                padding-right:5px;
            }
            .topnav input[type=text] {
                width:70%;
                padding: 6px;
                border: none;
                margin:0 auto;
                margin-top: 8px;
                margin-right: 16px;
                margin-left:5px;
                font-size: 17px;
            }

            .ad{
                margin-top:20px;
                width:100%;
                height:75px;
                background-color:black;
            }
            h3{
                font-size:40px;
                padding-top:10px;
                text-align:center;
                margin:0 auto;
                color:grey;
            }

    </style>
<html>

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <!-- gifplayer.css v0.4.1 -->
        <link rel="stylesheet" href="https://unpkg.com/react-gif-player@0.4.1/dist/gifplayer.css">
        <title>Gif.com</title>
    </head>
    
    <body>
        <div class="header" >
             <a class="navbar-brand" href="index.php" style="width:315px; height:80px;">
                <h1>Gif.com</h1>
                
             </a>
            <div>
                <div class="dropdown">
                     <button onclick="myFunction()" class="dropbtn"></button>
                     <div id="myDropdown" class="dropdown-content">
                        <a href="favorites.php">Favorites</a>
                        <a href="add.php">Add</a>
                        <a href="#">Log Out</a>
                     </div>
            </div>
             <div class="topnav">
                 <input type="text" placeholder="Search..">
                 <a href="add.php" ><img src="plus.png" class="plus"></img></a>
             </div>
             
        </div>




        <div class="ad">
            <h3>AD</h3>
        </div>
        

        <table class='table'>
            <thead>
                <?php
                $pageNum = 1;
                  if (is_numeric($_GET['page_no'])) {
                        $pageNum = $_GET['page_no'];
                  }
                  $query = 'SELECT * FROM main ORDER BY id DESC';
                  $records_per_page = 5;
                  $newquery = $URLs->paging($query, $records_per_page);
                  $URLs->dataview($newquery,$pageNum,$id);
                ?>
            </thead>
        </table>

  <div id="containerdiv" align="right">
      <input type="button" onclick="location.href='index.php?page_no=<?php echo $pageNum-1 ?>';" value="Prev" />
      <input type="button" value=<?php echo $pageNum ?> >
      <input type="button" onclick="location.href='index.php?page_no=<?php echo $pageNum+1 ?>';" value="Next" />
      
  </div>
  
        <script>
                    /* When the user clicks on the button, 
                toggle between hiding and showing the dropdown content */
                function myFunction() {
                    document.getElementById("myDropdown").classList.toggle("show");
                }
                
                // Close the dropdown menu if the user clicks outside of it
                window.onclick = function(event) {
                  if (!event.target.matches('.dropbtn')) {
                
                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    var i;
                    for (i = 0; i < dropdowns.length; i++) {
                      var openDropdown = dropdowns[i];
                      if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                      }
                    }
                  }
                }
        </script>
    </body>
</html>
