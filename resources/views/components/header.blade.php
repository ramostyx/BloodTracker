<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<style>

    /* Style the menu container */
    .menu {
        width: 90%;
        margin: auto;
        margin-top: 5px;
        display: flex;
        background-color: white;
        overflow: auto;
        justify-content: center;
        border-radius: 20px;
        box-shadow : 1px 1px 5px rgb(81, 81, 81);
    }
    /* Style the menu items */
    .menu a {
        float: left;
        color: #333;
        text-align: center;
        font-family:sans-serif ;
        padding: 14px 16px;
        text-decoration:none;
        font-size: 17px;
        justify-content: center;
    }
    /* Style the active menu item */
    .menu a.active {
        background-color: #F42A40;
        color: white;
    }
    /* Style the menu items on hover */
    .menu a:hover {
        color: white;
        background-color: #F4F5F9;
    ;
        color: black;
    }
    /* Style the menu items on hover when the screen is less than 500px */
    @media screen and (max-width: 500px) {
        .menu a:hover {
            background-color:white;
            color: black;
        }
    }
</style>
<body>
<div class="menu">
    <a class="active" href="#">Home</a>
    <a href="#">Categories</a>
    <a href="#">About Us</a>
</div>
</body>
</html>
