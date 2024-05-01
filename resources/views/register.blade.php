@include('header')
<style>
    span.error {
        color: red
    }
</style>

<h1>Employee Registeration</h1>
<form id="register_form">
    <input type="text" name="name" id="emp_id" placeholder="Employee Name"> <br>
    <span class="error name_err"></span>
    <br><br>
    <input type="email" name="email" id="email" placeholder="example@gmail.com"><br>
    <span class="error email_err"></span>
    <br><br>
    <input type="password" name="password" id="password" placeholder="Enter password"><br>
    <span class="error password_err"></span>
    <br><br>
    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="confirm password"><br>
    <span class="error password_confirmation_err"></span>
    <br><br>
    <input type="submit" value="Register"><br>

</form>
<br>
<p class="result"></p>
<script>
    $(document).ready(function() {
        $("#register_form").submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "http://127.0.0.1:8000/api/register",
                type: "POST",
                data: formData,
                success: function(data) {
                  // data parameters is in response -> json in UserController 
                    if (data.status == 'success') {
                        // console.log(data);
                        $('.error').text('');
                        $('.result').text('registertion was successful'); //did not work
                        $('#register_form')[0].reset(); //did not work

                    } else {
                        printErrorMsg(data);
                    }
                }
            });

        });

        function printErrorMsg(msg) {
            $(".error").text("");
            $.each(msg, function(key, value) {
                // console.log(key);
                // console.log(value);
                // $("."+key+"_err").text(value);
                if (key == 'password') {
                    // console.log(value);
                    if (value.length > 1) {
                        $(".password_err").text(value[0]);
                        $(".password_confirmation_err").text(value[1]);
                    } else {
                        if (value[0].includes('password confirmation')) {
                            $(".password_confirmation_err").text(value);
                        } else {
                            $(".password_err").text(value);
                        }
                    }
                } else {
                    $("." + key + "_err").text(value);
                }
            });
        }


    });
</script>
</body>

</html>
