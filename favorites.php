<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <!-- gifplayer.css v0.4.1 -->
        <link rel="stylesheet" href="https://unpkg.com/react-gif-player@0.4.1/dist/gifplayer.css">
        <title>Gif.com</title>
    </head>
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
        float:left;
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
            .gif{
                width:90%;
                display: block;
                margin-left: auto;
                margin-right: auto;
                margin-bottom:10px;
            }
            .table{
                margin:0px auto;
            }
            #navBar{
                width:100%;
                height:15px;
                background-color: #595959;
               
                padding-top: 40px;
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
                background-color:#ffffe6;
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

    </style>
    
    <body>
        <div class="header">
            <a class="navbar-brand" href="index.php" style="width:315px; height:80px;">
              <h1>Gif.com</h1>
            </a>
        </div>

                    <div class="dropdown">
              <button onclick="myFunction()" class="dropbtn"></button>
              <div id="myDropdown" class="dropdown-content">
                    <a href="favorites.php">Favorites</a>
                    <a href="add.php">Add</a>
                    <a href="#">Log Out</a>
              </div>
        </div>
        <div id='navBar'></div>
        
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