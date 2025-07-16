    <script src="<?php echo URL_UPLOAD;?>assets/js/jquery.min.js"></script>
    <script src="<?php echo URL_UPLOAD;?>assets/js/jquery-migrate.min.js"></script>
    <script src="<?php echo URL_UPLOAD;?>assets/js/modernizr.js?v=2"></script>


    <script src="<?php echo URL_UPLOAD;?>assets/js/jquery.actual.min.js?v=2"></script>

    

    <script src="<?php echo URL_UPLOAD;?>assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo URL_UPLOAD;?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo URL_UPLOAD;?>assets/js/mask.js"></script>
    <script src="<?php echo URL_UPLOAD;?>assets/js/validate.js"></script>
    <script src="<?php echo URL_UPLOAD;?>assets/vendors/simple-datatables/simple-datatables.js"></script>

    <script src="<?php echo URL_UPLOAD;?>assets/js/printThis.js"></script>



    <script src="<?php echo URL_UPLOAD;?>assets/vendors/apexcharts/apexcharts.js"></script>
    
    <?php if(@$link['0'] == ""){ ?>
    <script type="text/javascript">
    <?php 
    $clientes_parciais = 'SELECT COUNT(id) as totalizado, dt_adesao, DATE_FORMAT(dt_adesao, "%m") as mestotalizador FROM clientes WHERE dt_adesao <= NOW() and dt_adesao >= Date_add(Now(),interval - 12 month) GROUP BY EXTRACT(YEAR_MONTH FROM dt_adesao) ORDER by dt_adesao ASC';
    $resultados_clientes_parciais = $database->get_results($clientes_parciais);

    $valor = array();
    $mes = array();
    foreach ($resultados_clientes_parciais as $key => $value) {
        $valor[] = $value['totalizado'];


            switch($value['mestotalizador']){   
                case "01":
                $monthNameSpanish = "Jan";
                break;

                case "02":
                $monthNameSpanish = "Fev";
                break;

                case "03":
                $monthNameSpanish = "Mar";
                break;

                case "04":
                $monthNameSpanish = "Abr";
                break;

                case "05":
                $monthNameSpanish = "Mai";
                break;

                case "06":
                $monthNameSpanish = "Jun";
                break;

                case "07":
                $monthNameSpanish = "Jul";
                break;

                case "08":
                $monthNameSpanish = "Ago";
                break;

                case "09":
                $monthNameSpanish = "Set";
                break;

                case "10":
                $monthNameSpanish = "Out";
                break;

                case "11":
                $monthNameSpanish = "Nov";
                break;

                case "12":
                $monthNameSpanish = "Dez";
                break;
            }

        $mes[] = $monthNameSpanish;
    }

    $valoresseparados = implode(',', $valor);
    //$messeparados = implode(',', $mes);

    $messeparados='"'.implode('", "', $mes).'"';

    ?>

    var optionsProfileVisit = {
        annotations: {
            position: 'back'
        },
        dataLabels: {
            enabled:false
        },
        chart: {
            type: 'bar',
            height: 300
        },
        fill: {
            opacity:1
        },
        plotOptions: {
        },
        series: [{
            name: 'Clientes',
            data: [<?php echo $valoresseparados?>]
        }],
        colors: '#435ebe',
        xaxis: {
            categories: [<?php echo $messeparados?>],
        },
    }

    var chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit);
    chartProfileVisit.render();    
    </script>    
    <?php }?>
    <script src="<?php echo URL_UPLOAD;?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo URL_UPLOAD;?>assets/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo URL_UPLOAD;?>assets/js/dataTables.responsive.min.js"></script> 
    <script src="<?php echo URL_UPLOAD;?>assets/js/dataTables.bootstrap4.min.js"></script>

    <script src="<?php echo URL_UPLOAD;?>assets/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo URL_UPLOAD;?>assets/js/dataTables.buttons.print.min.js"></script>

    <script src="<?php echo URL_UPLOAD;?>assets/js/dataTables.pdfmake.min.js"></script>
    <script src="<?php echo URL_UPLOAD;?>assets/js/dataTables.vfs_fonts.js"></script>
    
    <script src="<?php echo URL_UPLOAD;?>assets/js/dataTables.jszip.min.js"></script>
    <script src="<?php echo URL_UPLOAD;?>assets/js/dataTables.buttons.html5.min.js"></script>

    <script>
        $(window).on("load",function(){
            
          $(".loader-wrapper").fadeOut("slow").delay( 800 );
        });
    </script>

    <script src="<?php echo URL_UPLOAD;?>assets/js/main.js?v=<?php echo date("Gis");?>"></script>
</body>

</html>
