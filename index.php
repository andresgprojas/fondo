<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <script type="text/javascript" src="libs/client/js/jquery-1.8.3.js"></script>
        <script type="text/javascript" src="libs/client/js/BootSrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="libs/client/js/Jquery-UI/jquery-ui-1.9.2.custom.min.js"></script>
        <script src="libs/client/js/ajaxForm.js"></script> 
        
        <link href="libs/client/css/BootStrap/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="libs/client/css/Jquery-UI/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" media="screen">
        <link href="libs/client/css/general.css" rel="stylesheet" media="screen">
        <script>
            $(function(){
                
                options = {
                    success: function(a){;
                        if (a == 'TRUE'){
                            window.location.replace("View/home");
                        }
                        else{
                            $("#salida .modal-body").html(a);
                            $('#salida').modal('show')
                        }
                    }
                }
                $('#login').ajaxForm(options);
            })
        </script>
        <title>Login</title>
    </head>
    <body>
        <div class="jumbotron boxlogin">
            <form id="login" method="POST" action="Controller/Usuario" class="form-signin" autocomplete="off">
                <h2 class="form-signin-heading">Ingresa</h2>
                <div class="campo">
                    <input type="text" name="nuip" id="nuip" class="form-control myBottom" required placeholder="Usuario">
                </div>
                <div class="campo">
                    <input type="password" name="psw" id="psw" class="form-control myTop" required placeholder="Contraseña">
                </div>
                <div class="campo">
                    <input type="submit" value="Acceder" name="action" class="btn btn-lg btn-primary btn-block">
                </div>
            </form>
        </div>
        <div class="modal fade" id="salida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Error!</h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
