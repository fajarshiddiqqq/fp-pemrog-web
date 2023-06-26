<!DOCTYPE html>
<html>
<head>
    <title>PHP Navbar Example</title>
    <style>
        /* CSS for navbar */
        ul.navbar {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }
        
        ul.navbar li {
            float: left;
        }
        
        ul.navbar li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        
        ul.navbar li a:hover {
            background-color: #111;
        }
    </style>
</head>
<body>
    <ul class="navbar">
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>
    </ul>
</body>
</html>