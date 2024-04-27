<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <h1>Employee Registeration</h1>
    <form action="https://127.0.0.1:8000/api/register" method="POST" id="register_form">
        <input type="text" name="name" id="emp_id" placeholder="Employee Name"> <br>
        <span class="error err_name"></span>
        <br><br>
        <input type="email" name="email" id="email" placeholder="example@gmail.com"><br>
        <span class="error err_email"></span>
        <br><br>
        <input type="password" name="password" id="password" placeholder="Enter password"><br>
        <span class="error err_password"></span>
        <br><br>
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="confirm password"><br>
        <span class="error err_password_confirmation"></span>
        <br><br>
        <input type="submit" value="Register"><br>
    </form>
    <script>
        $(document).ready(function () {
            $("#register_form").submit(function(event){
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url:'https://127.0.0.1:8000/api/register',
                    type:'post',
                    data: form_data,
                    success: function (data) {
                        console.log(data);
                        if(data.msg){

                        }else{
                            printErrorMsg(data);
                        }
                    }
                });

            });
            function printErrorMsg(msg)


        });
    </script>
</body>
</html>
