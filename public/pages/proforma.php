<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!--<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">-->

        <title>Startmin - Bootstrap Admin Theme</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="../css/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <style>
       
    

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: orange;
        }


        @media print {
            body {
                font-size: 10px;
            }
            table {
                border: 1px solid black;
            }
            #printButton {
                display: none;
            }
            .no-imprimir {
                display: none;
            }
        }
    </style>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top no-imprimir" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">LIBRERIA BRECOL</a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-nav navbar-left navbar-top-links">
                    <li><a href="#"><i class="fa fa-home fa-fw"></i> Website</a></li>
                </ul>

                <ul class="nav navbar-right navbar-top-links">
                    <li class="dropdown navbar-inverse">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-comment fa-fw"></i> New Comment
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                        <span class="pull-right text-muted small">12 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> Message Sent
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-tasks fa-fw"></i> New Task
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>Jose David<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->
            </nav>

        <!--asidee-->
             
        <aside class="sidebar navbar-default no-imprimir" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                       
                        <li>
                            <a href="../../presentation/User/index.php" class="active"><i class="fa fa-user fa-fw"></i> Usuarios</a>
                        </li>
                        <li>
                            <a href="../../presentation/cliente/index.php" class="active"><i class="fa fa-user fa-fw"></i> Clientes</a>
                        </li>
                        <li>
                            <a href="../../presentation/Productos/index.php" class="active"><i class="fa fa-user fa-fw"></i> Productos</a>
                        </li>
                        <!--<li>
                            <a href="../Rol/index.php" class="active"><i class="fa fa-user fa-fw"></i> Roles</a>
                        </li>-->
                        
                        <li>
                            <a href="../../public/Pages/proforma.php"><i class="fa fa-table fa-fw"></i>PROFORMA</a>
                        </li>
                        <!--<li>
                            <a href="forms.html"><i class="fa fa-edit fa-fw"></i>GALERIA</a>
                        </li>-->
                      

                       
                    </ul>
                </div>
            </aside>
            <!-- /.sidebar -->




            <div id="page-wrapper" style="margin-top: 50px; ;">
                <div class="container-fluid">
                    
                <div class="row">
                    <div class="col-12"> 

                    <figure>
                        <img src="../img/logo.png" width="160px" height="100px">
                    </figure>
                        <p>Dirección: Av. Centenario Nro 235, Santa Cruz de la Sierra, Bolivia</p>
                      <p>Teléfono: 78053015</p>
                     </div>
                 </div>

                <h1 style="text-align:center;">PROFORMA</h1>
                <div class="row">
                    <div class="col-md-4">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" class="form-control">
                       <!-- <select id="cliente" class="form-control">

                        </select>-->


                    </div>
                    <div class="col-md-2" style="margin-left:10%;">
                        <label for="fecha">Fecha:</label>
                        <input type="date" id="fecha" class="form-control">
                    </div>
                </div>

        
    <!--se crea las tablas-->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><input type="text" class="form-control"></td>
                                <td><input type="number" class="form-control"></td>
                                <td><input type="number" class="form-control"></td>
                                <td><input
                                 type="text" disabled class="form-control"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><input type="text" class="form-control"></td>
                                <td><input type="number" class="form-control"></td>
                                <td><input type="number" class="form-control"></td>
                                <td><input
                                 type="text" disabled class="form-control"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><input type="text" class="form-control"></td>
                                <td><input type="number" class="form-control"></td>
                                <td><input type="number" class="form-control"></td>
                                <td><input
                                 type="text" disabled class="form-control"></td>
                            </tr>
                            </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4"><b>Total</b></td>
                                <td><input type="text" id="total" disabled class="form-control"></td>
                            </tr>
                        </tfoot>
                    </table>

                        <button class="btn btn-primary" id="printButton" onclick="calcularTotal()">Calcular Total</button><!--boton para calcular el total-->
                      
                        <button class="btn btn-secondary" id="printButton" onclick="window.print()">Imprimir</button><!--boton para imprimir factura-->

                </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->





        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- Flot Charts JavaScript -->
        <script src="../js/flot/excanvas.min.js"></script>
        <script src="../js/flot/jquery.flot.js"></script>
        <script src="../js/flot/jquery.flot.pie.js"></script>
        <script src="../js/flot/jquery.flot.resize.js"></script>
        <script src="../js/flot/jquery.flot.time.js"></script>
        <script src="../js/flot/jquery.flot.tooltip.min.js"></script>
        <script src="../js/flot-data.js"></script>

        <!-- Custom Theme JavaScript -->
        
        <script>
    function calcularTotal() {
        const filas = document.querySelectorAll('tbody tr');
        let total = 0;

        filas.forEach(fila => {
            const cantidad = parseFloat(fila.cells[2].querySelector('input').value) || 0;
            const precioUnitario = parseFloat(fila.cells[3].querySelector('input').value) || 0;
            const subtotal = cantidad * precioUnitario;
            fila.cells[4].querySelector('input').value = subtotal.toFixed(2);
            total += subtotal;
        });

        document.getElementById('total').value = total.toFixed(2);
    }
</script>

<script src="../js/startmin.js"></script>
    </body>

</html>