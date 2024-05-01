<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
</head>

<body>

    <script>
        token = localStorage.getItem('user_token');
        if (window.location.pathname == '/login' || window.location.pathname == '/register') {
            if (token != null) {
                window.open('/profile', '_self')
            } else {
                if (token == null) {
                    window.open('/login', '_self')
                }
            }
        }
    </script>
