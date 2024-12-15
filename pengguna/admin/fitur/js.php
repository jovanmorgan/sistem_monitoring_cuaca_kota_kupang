 <!--   Core JS Files   -->
 <script src="../../assets/js/core/jquery-3.7.1.min.js?v=<?= time(); ?>"></script>
 <script src="../../assets/js/core/popper.min.js?v=<?= time(); ?>"></script>
 <script src="../../assets/js/core/bootstrap.min.js?v=<?= time(); ?>"></script>

 <!-- jQuery Scrollbar -->
 <script src="../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js?v=<?= time(); ?>"></script>

 <!-- Chart JS -->
 <script src="../../assets/js/plugin/chart.js/chart.min.js?v=<?= time(); ?>"></script>

 <!-- jQuery Sparkline -->
 <script src="../../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js?v=<?= time(); ?>"></script>

 <!-- Chart Circle -->
 <script src="../../assets/js/plugin/chart-circle/circles.min.js?v=<?= time(); ?>"></script>

 <!-- Datatables -->
 <script src="../../assets/js/plugin/datatables/datatables.min.js?v=<?= time(); ?>"></script>

 <!-- Bootstrap Notify -->
 <script src="../../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js?v=<?= time(); ?>"></script>

 <!-- jQuery Vector Maps -->
 <script src="../../assets/js/plugin/jsvectormap/jsvectormap.min.js?v=<?= time(); ?>"></script>
 <script src="../../assets/js/plugin/jsvectormap/world.js?v=<?= time(); ?>"></script>

 <!-- Sweet Alert -->
 <script src="../../assets/js/plugin/sweetalert/sweetalert.min.js?v=<?= time(); ?>"></script>

 <!-- Kaiadmin JS -->
 <script src="../../assets/js/kaiadmin.min.js?v=<?= time(); ?>"></script>

 <!-- Kaiadmin DEMO methods, don't include it in your project! -->
 <script src="../../assets/js/setting-demo.js?v=<?= time(); ?>"></script>
 <script src="../../assets/js/demo.js?v=<?= time(); ?>"></script>
 <script>
     $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
         type: "line",
         height: "70",
         width: "100%",
         lineWidth: "2",
         lineColor: "#177dff",
         fillColor: "rgba(23, 125, 255, 0.14)",
     });

     $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
         type: "line",
         height: "70",
         width: "100%",
         lineWidth: "2",
         lineColor: "#f3545d",
         fillColor: "rgba(243, 84, 93, .14)",
     });

     $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
         type: "line",
         height: "70",
         width: "100%",
         lineWidth: "2",
         lineColor: "#ffa534",
         fillColor: "rgba(255, 165, 52, .14)",
     });
 </script>