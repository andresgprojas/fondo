<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <script type="text/javascript" src="libs/client/js/jquery-1.8.3.js"></script>
        <link href="libs/client/css/BootStrap/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="libs/client/css/general.css" rel="stylesheet" media="screen">
        <script src="http://malsup.github.com/jquery.form.js"></script> 
        <script>
            $(function() {
                var options = {
                    target: '#rta',
                };

                // pass options to ajaxForm 
                $('#myForm').ajaxForm(options);
            })
        </script>
        <style>
        
        </style>
        <title>Login</title>
    </head>
    <body>
        <div class="">
            <form name="myForm" id="myForm" method="POST" action="Controller/Admin/creaXML" class="boxlogin">
                <input type="text" name="Host" value="localhost" placeholder="HOST" class="form-control myBottom">
                <input type="text" name="user" placeholder="USUARIO" class="form-control medios">
                <input type="text" name="password" placeholder="CONTRASEÑA" class="form-control medios">
                <input type="text" name="data" placeholder="BASE DE DATOS" class="form-control myTop">
                <input type="submit" class="btn btn-success btn-primary btn-block">
            </form>
        </div>
        <div id="rta"></div>
    </body>
</html>

<html>
    <head>

    </head>
    
</html>