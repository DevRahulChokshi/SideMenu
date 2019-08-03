<?php

session_start();


if ($_SESSION['usertype'] == 3 &&  $_SESSION['project_authority'] == 2) 
//   employee with usertype = 3 and project_authority = 2 can access this page
{

?>

<!doctype html>
 <html class="no-js" lang=""> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GIMS - Dashboard</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
     <link rel="shortcut icon" type="image/png" href="../images/favicon.png">
     <link href="https://fonts.googleapis.com/css?family=Lora:400,400i" rel="stylesheet">
   
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">
    
    

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>





    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">-->
    
    
    
    <link rel="stylesheet" href="fullcalendar/fullcalendar.min.css" />
    <script src="fullcalendar/lib/jquery.min.js"></script>
    <script src="fullcalendar/lib/moment.min.js"></script>
    <script src="fullcalendar/fullcalendar.min.js"></script>
    
    




    <!-- here we are started script of Event-Calendar Module with use of JQuery and Ajax-->

<script>
// here we call the id of calendar div section with jquery for performing the operation of add, delete, edit, fatch with use of ajax 

// here bellow function used for fatching the data
$(document).ready(function () {
    

 var calendar = $('#calendar').fullCalendar({
  

  
        editable: true,
        events: "fetch-event.php",
        displayEventTime: false,
        // eventColor: '#ffff00',
       

        eventRender: function (event, element,view) {
         
         
          //code start for changing the event color when its start date and end date is over as comare with current date 
          
            var current_date = new Date();
            if(event.start < current_date && event.end < current_date)
            {
               
                element.css('background-color','#ff000075  ');
                element.css('border','red');

            }
            else if(event.start > current_date && event.end > current_date)
            {
                
                element.css('background-color','#3a87ad54');
                // element.css('border','#3a87ad54');

            }

         //code start for changing the event color when its start date and end date is over as comare with current date 

            if (event.allDay === 'true')
             {
                event.allDay = true;
             } else {
                event.allDay = false;
             }

         
         
        //  if (event.is_old == 0) {
        //     element.css({
        //         'background-color': '#333333',
        //         'border-color': '#333333',
        //         'color': '#ffffff'
        //     });
       

        // }
            
        },
        
        
        
        
        
        
        
        
        
        
        
// here bellow function used for insert the data by call file with the help of ajax method for insert data

        // selectable: true,
        // selectHelper: true, 
        // select: function (start, end, allDay) {
        //     var title = prompt('Event Title:');

        //     if (title) {
        //         var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
        //         var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

        //         $.ajax({
        //             url: 'add-event.php',
        //             data: 'title=' + title + '&start=' + start + '&end=' + end,
        //             type: "POST",
        //             success: function (data) {
        //                 displayMessage("Added Successfully");
        //             }
        //         });
        //         calendar.fullCalendar('renderEvent',
        //                 {
        //                     title: title,
        //                     start: start,
        //                     end: end,
        //                     allDay: allDay
        //                 },
        //         true
        //                 );
        //     }
        //     calendar.fullCalendar('unselect');
        // },
        
// here bellow function used for update the data by call file with the help of ajax method for update data

        editable: true,
        eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: 'edit-event.php',
                        data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                        type: "POST",
                        success: function (response) {
                            displayMessage("Updated Successfully");
                        }
                    });
                },
// here bellow function used for delete the data by call file with the help of ajax method for delete data
       
        

        eventClick: function (event) {
                
            
      
      
       //   var deleteMsg = confirm('Event=' + event.title +("\n")+'Employees=' + event.emp_name+("\n")+'Event Location=' + event.location+("\n")+'Event Time In=' + event.time_in+("\n")+'Event Time Out=' + event.time_out);
            // var deleteMsg = confirm('Event=' + event.title);
        //    if (deleteMsg) {
                $.ajax({
                    type: "POST",
                    url:  'fetch-event.php',
                    data: "&id=" + event.id,
                    success: function (response) {
                       //confirm('Event=' + event.title +("\n")+'Employees=' + event.emp_name+("\n")+'Event Location=' + event.location+("\n")+'Event Time In=' + event.time_in+("\n")+'Event Time Out=' + event.time_out);
                         
                         var id = event.id; 
                           
                         var req = new XMLHttpRequest();
                         req.open("GET","event_response.php?id="+id+"&random=new"+Date(),true);
                         req.send();
         
                         req.onreadystatechange = function(){
        
                         if(req.readyState == 4 && req.status == 200){
                
                         document.getElementById("event_response").innerHTML = req.responseText;
           
                         } }
          
                       
                       
                           var e = document.getElementById("check_modal");
                
                            e.click();
                            
                      
                            
                   
                        // if(parseInt(response) > 0) {
                            // $('#calendar').fullCalendar('removeEvents', event.id);
                            // displayMessage("Deleted Successfully");
                        // }
                    }
                });
           // }
        }

    });
});

// function used to call message

function displayMessage(message) {
      $(".response").html("<div class='success'>"+message+"</div>");
    setInterval(function() { $(".success").fadeOut(); }, 1000);
}
</script>
<!-- here we End the script of Event-Calendar Module with use of JQuery and Ajax-->



<!-- here we are started script of Leave-Calendar Module with use of JQuery and Ajax-->

<script>
// here we call the id of calendar div section with jquery for performing the operation of add, delete, edit, fatch with use of ajax


// here bellow function used for fatching the data
$(document).ready(function () {
    
    
    
    var calendar1 = $('#calendar1').fullCalendar({
        
        editable: true,
        events: 'fetch-leave.php',
        displayEventTime: false,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
  // here bellow function used for update the data by call file with the help of ajax method for update data
        editable: true,
        eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: 'edit-leave.php',
                        data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                        type: "POST",
                        success: function (response1) {
                            displayMessage1("Updated Successfully");
                        }
                    });
                },

   // here bellow function used for delete the data by call file with the help of ajax method for delete data
        // eventClick: function (event) {
        //     var deleteMsg = confirm('Employee=' + event.title);
        //     if (deleteMsg) {
        //         $.ajax({
        //             type: "POST",
        //             // url: 'delete-leave.php',
        //             data: "&id=" + event.id,
        //             success: function (response1) {
                       
        //             }
        //         });
        //     }
        // }
        
          // here bellow function used for fetch the data by call file with the help of ajax method for fetch data
       
        

        eventClick: function (event) {
           //   var deleteMsg = confirm('Event=' + event.title +("\n")+'Employees=' + event.emp_name+("\n")+'Event Location=' + event.location+("\n")+'Event Time In=' + event.time_in+("\n")+'Event Time Out=' + event.time_out);
                // var deleteMsg = confirm('Event=' + event.title);
            //    if (deleteMsg) {
                $.ajax({
                    type: "POST",
                    url:  'fetch-leave.php',
                    data: "&id=" + event.id,
                    success: function (response) {
                       //confirm('Event=' + event.title +("\n")+'Employees=' + event.emp_name+("\n")+'Event Location=' + event.location+("\n")+'Event Time In=' + event.time_in+("\n")+'Event Time Out=' + event.time_out);
                         
                         var id = event.id;                           
                         var req = new XMLHttpRequest();
                         req.open("GET","leave_response.php?id="+id+"&random=new"+Date(),true);
                         req.send();
         
                         req.onreadystatechange = function(){
        
                         if(req.readyState == 4 && req.status == 200){
                
                         document.getElementById("leave_response").innerHTML = req.responseText;
           
                         } }
          
                         var e = document.getElementById("check_modal_leave");
                
                         e.click();

                        // if(parseInt(response) > 0) {
                            // $('#calendar').fullCalendar('removeEvents', event.id);
                            // displayMessage("Deleted Successfully");
                        // }
                    }
                });
           // }
        }   
        

    });
});

// function used to call message

function displayMessage1(message) {
      $(".response1").html("<div class='success'>"+message+"</div>");
    setInterval(function() { $(".success").fadeOut(); }, 1000);
}
</script>
<!-- here we End script of Leave-Calendar Module with use of JQuery and Ajax-->

    
    
    
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<style>
/*body {
    margin-top: 50px;
    text-align: center;
    font-size: 12px;
    font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
}*/

/*#calendar {
    width: 700px;
    margin: 0 auto;
}

.response {
    height: 60px;
}*/

.success {
    background: #cdf3cd;
    padding: 10px 60px;
    border: #c3e6c3 1px solid;
    display: inline-block;
}
</style>


<style>
    
#chart_wrap_one{
 
 position:relative;
 height:0;
 overflow:hidden;
 padding-bottom:100%;
    
}   

#piechart{
    
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:350px;
    
}    
    


#chart_wrap_two{
 
 position:relative;
 height:0;
 overflow:hidden;
 padding-bottom:100%;
    
}   

#chart_wrap_four{
 
 position:relative;
 height:0;
 overflow:hidden;
 padding-bottom:100%;
    
}   

#pieforpending{
    
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:350px;
    
}    
    
    
    
#chart_wrap_three{
 
 position:relative;
 height:0px;
 overflow:hidden;
 padding-bottom:100%;
    
}   

#pie{
    
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:350px;
    
}    
    
        
    
th,td{
  padding:5px 13px; 
 
}    
    table,th,td{
         border: 0px solid black;
    }
    
</style>



<style>
        
        .fc-event,.fc-event-dot
     {
        background-color:#3a87ad54;
        /*background-color: yellow;*/
     }

</style>


</head>
<body>

<?php include"dashboard_sidePnl.php" ?>

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

         <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
              </div> 
                   
              

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php  echo " <img class='user-avatar rounded-circle' src='images/{$_SESSION['image']}' alt='User Avatar'> " ;  ?>
                        </a>

                        <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="admin_profile.php"><i class="fa fa- user"></i>My Profile</a>

                                <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

                                <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>

                                <a class="nav-link" href="logout.php"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                    <div class="language-select dropdown" id="language-select">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                            <i class="flag-icon flag-icon-in"></i>
                        </a>

                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->


<?php
  
   include("connection.php"); // for making connection
   
 ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
         
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                         <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

          
 <div style=" width:100%;">
     
          <?php if($_SESSION['sales_authority'] != '1' ){?>
       <!-- <p style='text-align:center;'>  <img src="target.png" alt="target" width="330" height="150"> </p> -->
     <?php } ?>
     <br>
   
<div class="container">
    
    <!-- This section shows the target statistics of our sales team which includes parameters like Target,Pipeline,Converted and Closed -->
   <!-- 
    <div class="row">
        <div class="col-sm-12">
             <?php
              error_reporting(E_ERROR | E_PARSE);
               $r = mysqli_query($connector,'SELECT * FROM lead_master WHERE allocated_to = "Pulkit Gaur" ORDER BY lead_master.id DESC ');
               $pipeline_pulkit = 0;
              while ($rowz = mysqli_fetch_assoc($r)){
              $pipeline_pulkit = $rowz['estimated_account'] + $pipeline_pulkit;
            }
           ?>
           
           
           <?php
          
           $result = mysqli_query($connector,'SELECT * FROM lead_master WHERE allocated_to = "Shivani Tak" ORDER BY lead_master.id DESC   ');
            $pipeline_shivani = 0;
            while ($row = mysqli_fetch_assoc($result)){
              $pipeline_shivani = $row['estimated_account'] + $pipeline_shivani;
            }
           ?>
           
            <?php
               $r = mysqli_query($connector,'SELECT * FROM lead_master WHERE allocated_to = "Vivek Dhariwal" ORDER BY lead_master.id DESC ');
               $pipeline_vivek = 0;
              while ($rowz = mysqli_fetch_assoc($r)){
              $pipeline_vivek = $rowz['estimated_account'] + $pipeline_vivek;
            }
           ?>
              <?php
                   $r = mysqli_query($connector,'SELECT * FROM lead_master WHERE allocated_to = "Sunil Agarwal" ORDER BY lead_master.id DESC ');
               $pipeline_sunil = 0;
              while ($rowz = mysqli_fetch_assoc($r)){
              $pipeline_sunil = $rowz['estimated_account'] + $pipeline_sunil;
            }
           ?>
            
                 <?php
                   $r = mysqli_query($connector,'SELECT * FROM lead_master WHERE allocated_to = "Tushar Makwana" ORDER BY lead_master.id DESC ');
               $pipeline_tushar = 0;
              while ($rowz = mysqli_fetch_assoc($r)){
              $pipeline_tushar = $rowz['estimated_account'] + $pipeline_tushar;
            }
           ?>
            
     
     
     
     
        
 <div class="card">
     
           <?php
        
           $result = mysqli_query($connector,'SELECT * FROM lead_master WHERE allocated_to = "Pulkit Gaur" AND status = "converted" ORDER BY lead_master.id DESC   ');
            $converted_pulkit = 0;
            while ($row = mysqli_fetch_assoc($result)){
              $converted_pulkit = $row['estimated_account'] + $converted_pulkit;
            }
           ?>
     
               <?php
        
           $result = mysqli_query($connector,'SELECT * FROM lead_master WHERE allocated_to = "Shivani Tak" AND status = "converted" ORDER BY lead_master.id DESC   ');
            $converted_shivani = 0;
            while ($row = mysqli_fetch_assoc($result)){
              $converted_shivani = $row['estimated_account'] + $converted_shivani;
            }
           ?>
           
            <?php
               $r = mysqli_query($connector,'SELECT * FROM lead_master WHERE allocated_to = "Vivek Dhariwal" AND status = "converted" ORDER BY lead_master.id DESC ');
               $converted_vivek = 0;
              while ($rowz = mysqli_fetch_assoc($r)){
              $converted_vivek = $rowz['estimated_account'] + $converted_vivek;
            }
           ?>
              <?php
                   $r = mysqli_query($connector,'SELECT * FROM lead_master WHERE allocated_to = "Sunil Agarwal" AND status = "converted" ORDER BY lead_master.id DESC ');
               $converted_sunil = 0;
              while ($rowz = mysqli_fetch_assoc($r)){
              $converted_sunil = $rowz['estimated_account'] + $converted_sunil;
            }
           ?>
            
                 <?php
                   $r = mysqli_query($connector,'SELECT * FROM lead_master WHERE allocated_to = "Tushar Makwana" AND status = "converted" ORDER BY lead_master.id DESC ');
               $converted_tushar = 0;
              while ($rowz = mysqli_fetch_assoc($r)){
              $converted_tushar = $rowz['estimated_account'] + $converted_tushar;
            }
           ?>
            
 <div class="card-header">
     
           
                  <?php
        
           $result = mysqli_query($connector,'SELECT * FROM lead_master WHERE allocated_to = "Pulkit Gaur" AND status = "closed" ORDER BY lead_master.id DESC   ');
            $closed_pulkit = 0;
            while ($row = mysqli_fetch_assoc($result)){
              $closed_pulkit = $row['estimated_account'] + $closed_pulkit;
            }
           ?>
           
     
                    <?php
        
           $result = mysqli_query($connector,'SELECT * FROM lead_master WHERE allocated_to = "Shivani Tak" AND status = "closed" ORDER BY lead_master.id DESC   ');
            $closed_shivani = 0;
            while ($row = mysqli_fetch_assoc($result)){
              $closed_shivani = $row['estimated_account'] + $closed_shivani;
            }
           ?>
           
            <?php
               $r = mysqli_query($connector,'SELECT * FROM lead_master WHERE allocated_to = "Vivek Dhariwal" AND status = "closed" ORDER BY lead_master.id DESC ');
               $closed_vivek = 0;
              while ($rowz = mysqli_fetch_assoc($r)){
              $closed_vivek = $rowz['estimated_account'] + $closed_vivek;
            }
           ?>
              <?php
                   $r = mysqli_query($connector,'SELECT * FROM lead_master WHERE allocated_to = "Sunil Agarwal" AND status = "closed" ORDER BY lead_master.id DESC ');
               $closed_sunil = 0;
              while ($rowz = mysqli_fetch_assoc($r)){
              $closed_sunil = $rowz['estimated_account'] + $closed_sunil;
            }
           ?>
            
                 <?php
                   $r = mysqli_query($connector,'SELECT * FROM lead_master WHERE allocated_to = "Tushar Makwana" AND status = "closed" ORDER BY lead_master.id DESC ');
               $closed_tushar = 0;
              while ($rowz = mysqli_fetch_assoc($r)){
              $closed_tushar = $rowz['estimated_account'] + $closed_tushar;
            }
           ?>
     
     <b>Target Statistics (2019-2020) </b>
 </div>    
     <div class="card-body">
           <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
           <script>
           google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawMaterial);

function drawMaterial() {
      var data = google.visualization.arrayToDataTable([
        ['Name', 'Target', 'Pipeline','Converted','Closed'],
        ['Pulkit Gaur', 50000000, <?php echo $pipeline_pulkit; ?>, <?php echo $converted_pulkit; ?>,<?php echo $closed_pulkit; ?>],
        ['Vivek Dhariwal', 50000000, <?php echo $pipeline_vivek; ?>, <?php echo $converted_vivek; ?>,<?php echo $closed_vivek; ?>],
        ['Shivani Tak', 50000000,<?php echo $pipeline_shivani; ?>,<?php echo $converted_shivani; ?>, <?php echo $closed_shivani; ?>],
        ['Sunil Agarwal', 50000000, <?php echo $pipeline_sunil; ?>,<?php echo $converted_sunil; ?>, <?php echo $closed_sunil; ?>],
        ['Tushar Makwana', 50000000, <?php echo $pipeline_tushar; ?>, <?php echo $converted_tushar; ?>,<?php echo $closed_tushar; ?>],
       
      ]);

      var materialOptions = {
        chart: {
          title: ' Target Statistics '
        },
        hAxis: {
          title: 'Rs',
          minValue: 0,
        },
        vAxis: {
          title: 'Names'
        },
        bars: 'horizontal'
      };
      var materialChart = new google.charts.Bar(document.getElementById('chart_v'));
      materialChart.draw(data, materialOptions);
    }
           
         </script>
         
         
           <div id="chart_v"></div>
  
     </div>
     
     
 </div>
 
 
 </div>
 
    </div> -->
    
    
    
    
    
    <!-- This section shows the lead statistics. In this we have used pie chart to show total numbers of leads that are in pipeline,leads that are closed ,leads that are unassigned and leads that are converted. This section also shows the total amount (in Rs) in Pipeline as well as total converted amount  -->
    
    
    
  
  <?php
  $r = mysqli_query($connector,'SELECT * FROM lead_master;');
  $total_leads = 0;
  while($row = mysqli_fetch_assoc($r)){
      
    $total_leads = $total_leads + 1;  
  }
  
  
  
  
  ?>
  
  
  <?php
  
 
  $re = mysqli_query($connector,'SELECT * FROM lead_master WHERE status <> "created" ') ;
  $assigned_leads = 0;
  while($row = mysqli_fetch_assoc($re)){
      
    $assigned_leads = $assigned_leads + 1;  
  }
  
  
  ?>
  
    <?php
  
 
  $res = mysqli_query($connector,'SELECT * FROM lead_master WHERE status = "created" ') ;
  $unassigned_leads = 0;
  while($row = mysqli_fetch_assoc($res)){
      
    $unassigned_leads = $unassigned_leads + 1;  
  }
  
  
  ?>
  
  
    
    <?php
  
 
  $resu = mysqli_query($connector,'SELECT * FROM lead_master WHERE status = "active" ') ;
  $running_leads = 0;
  while($row = mysqli_fetch_assoc($resu)){
      
    $running_leads = $running_leads + 1;  
  }
  
  
  ?>
  
   
    
    <?php
  
 
  $resul = mysqli_query($connector,'SELECT * FROM lead_master WHERE status = "closed" ') ;
  $closed_leads = 0;
  while($row = mysqli_fetch_assoc($resul)){
      
    $closed_leads = $closed_leads + 1;  
  }
  
  
  ?>
     <?php
  
 
  $result = mysqli_query($connector,'SELECT * FROM lead_master WHERE status = "converted" ') ;
  $converted_leads = 0;
  while($row = mysqli_fetch_assoc($result)){
      
    $converted_leads = $converted_leads + 1;  
  }
  
  
  ?>
  
  <div class="row">
      <div class="col-sm-6">
          
          
          
          
          <div class="card" >
                   
                 <div class="card-header">
                        <h4> Lead Statistics </h4>
                    </div>
                        
                  <div class="card-body">        
                        
     <script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Lead Division', 'Numbers'],
  ['Converted', <?php echo $converted_leads; ?>],
  ['Closed', <?php echo $closed_leads; ?>],
  ['Active', <?php echo $running_leads; ?>],
  ['Unassigned', <?php echo $unassigned_leads; ?>],

]);

  // Optional; add a title and set the width and height of the chart
  var options = {title : 'Lead Division', width: '100%' , height : "370"};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('pieforpending_eight'));
  chart.draw(data, options);
}
</script>
<div id="chart_wrap_four">
<div id="pieforpending_eight" >
    
    
</div>
    <p style='color:black'>
                           <br>
                             <?php
  

  $result = mysqli_query($connector,'SELECT * FROM lead_master where status = "converted" ') ;
  $c_amount = 0;
  while($row = mysqli_fetch_assoc($result)){
      
    $c_amount = $row['estimated_account'] + $c_amount;
  }
  
  
  ?>
  
                           Converted  Amount  : <b><?php echo "Rs ".$c_amount." /-";    ?></b>
                      
                         <br>
                             <?php
  
   error_reporting(E_ERROR | E_PARSE);
  $result = mysqli_query($connector,'SELECT * FROM lead_master  ') ;
  $total_amount = 0;
  while($row = mysqli_fetch_assoc($result)){
      
    $total_amount = $row['estimated_account'] + $total_amount;
  }
  
  
  ?>
  
                            Total Amount in Pipeline : <b><?php echo "Rs ".$total_amount." /-";    ?></b>
                        </p>
</div>
</div>
</div>
          
          
          
      </div>
      
      
      
      <!-- This section shows the leadlog info of sales team in tabular form and one can also jump into client details using this section. -->
      
      
      <div class="col-sm-6">
                          
                    
                     <div class="card" >
                         
 
    <?php
                             
$result = mysqli_query($connector,'SELECT * FROM  leadlog_master WHERE log_type = "visit" AND emp_id = "7"  ');                     
      
$shivani_cnt = 0;

while ($row = mysqli_fetch_assoc($result)){
    
$shivani_cnt = $shivani_cnt + 1;


}

?>

                     <?php
                             
$result = mysqli_query($connector,' SELECT * FROM  leadlog_master WHERE log_type = "call" AND emp_id = "7"    ');                     
      
$shivani_c = 0;

while ($row = mysqli_fetch_assoc($result)){
    
$shivani_c = $shivani_c + 1;


}

?>


                     <?php
                             
$result = mysqli_query($connector,' SELECT * FROM  leadlog_master WHERE log_type = "email"  AND emp_id = "7"   ');                     
      
$shivani_e = 0;

while ($row = mysqli_fetch_assoc($result)){
    
$shivani_e = $shivani_e + 1;


}

?>     
 
 
 
 
 
 
 
 
 
 
 
 
 
 
   <?php
                             
$result = mysqli_query($connector,'SELECT * FROM  leadlog_master WHERE log_type = "visit" AND emp_id = "35"  ');                     
      
$sunil_cnt = 0;

while ($row = mysqli_fetch_assoc($result)){
    
$sunil_cnt = $sunil_cnt + 1;


}

?>

                     <?php
                             
$result = mysqli_query($connector,' SELECT * FROM  leadlog_master WHERE log_type = "call" AND emp_id = "35"    ');                     
      
$sunil_c = 0;

while ($row = mysqli_fetch_assoc($result)){
    
$sunil_c = $sunil_c + 1;


}

?>


                     <?php
                             
$result = mysqli_query($connector,' SELECT * FROM  leadlog_master WHERE log_type = "email"  AND emp_id = "35"   ');                     
      
$sunil_e = 0;

while ($row = mysqli_fetch_assoc($result)){
    
$sunil_e = $sunil_e + 1;


}

?>     
 
 
 
 
 
 
 
 
 
 
 
 
 
                              <?php
                             
$result = mysqli_query($connector,'SELECT * FROM  leadlog_master WHERE log_type = "visit" AND emp_id = "5"  ');                     
      
$vivek_cnt = 0;

while ($row = mysqli_fetch_assoc($result)){
    
$vivek_cnt = $vivek_cnt + 1;


}

?>

                     <?php
                             
$result = mysqli_query($connector,' SELECT * FROM  leadlog_master WHERE log_type = "call" AND emp_id = "5"    ');                     
      
$vivek_c = 0;

while ($row = mysqli_fetch_assoc($result)){
    
$vivek_c = $vivek_c + 1;


}

?>


                     <?php
                             
$result = mysqli_query($connector,' SELECT * FROM  leadlog_master WHERE log_type = "email"  AND emp_id = "5"   ');                     
      
$vivek_e = 0;

while ($row = mysqli_fetch_assoc($result)){
    
$vivek_e = $vivek_e + 1;


}

?>     
 
 
 
 
 
 
 
                  
                  
                  
                  
                  
                  
                  
                             <?php
                             
$result = mysqli_query($connector,'SELECT * FROM  leadlog_master WHERE log_type = "visit" AND emp_id = "6"  ');                     
      
$pulkit_cnt = 0;

while ($row = mysqli_fetch_assoc($result)){
    
$pulkit_cnt = $pulkit_cnt + 1;


}

?>

                     <?php
                             
$result = mysqli_query($connector,' SELECT * FROM  leadlog_master WHERE log_type = "call" AND emp_id = "6"    ');                     
      
$pulkit_c = 0;

while ($row = mysqli_fetch_assoc($result)){
    
$pulkit_c = $pulkit_c + 1;


}

?>


                     <?php
                             
$result = mysqli_query($connector,' SELECT * FROM  leadlog_master WHERE log_type = "email"  AND emp_id = "6"   ');                     
      
$pulkit_e = 0;

while ($row = mysqli_fetch_assoc($result)){
    
$pulkit_e = $pulkit_e + 1;


}

?>          
                  
                  
                  
                  
                  
                  
        
        
        
        
        
                  
                  
                  
                  
                         
                         
<?php
                             
$result = mysqli_query($connector,'SELECT * FROM  leadlog_master WHERE log_type = "visit" AND emp_id = "37"  ');                     
      
$tushar_cnt = 0;

while ($row = mysqli_fetch_assoc($result)){
    
$tushar_cnt = $tushar_cnt + 1;


}

?>

                     <?php
                             
$result = mysqli_query($connector,' SELECT * FROM  leadlog_master WHERE log_type = "call" AND emp_id = "37"    ');                     
      
$tushar_c = 0;

while ($row = mysqli_fetch_assoc($result)){
    
$tushar_c = $tushar_c + 1;


}

?>


                     <?php
                             
$result = mysqli_query($connector,' SELECT * FROM  leadlog_master WHERE log_type = "email"  AND emp_id = "37"   ');                     
      
$tushar_e = 0;

while ($row = mysqli_fetch_assoc($result)){
    
$tushar_e = $tushar_e + 1;


}

?>
       
                    <div class="card-header">
                        <h4>Lead Logs     <a href="view_client.php" style="float:right;" target="blank"><b>View Clients</b></span></a></h4>
                    </div>
                     <div class="card-body" style="text-align:center;"> 
                        <div class="stat-widget-one">
                             <br><br>
                             <div class="stat-icon dib"><ul style="list-style-type:none;">
                                 
                                 <li><a href="view_sales_log.php"><img src="leadlogs.png" width="120" height= "120"></a></li><br><br><br>
                                
                                <table >
                                    <tr>
                                        <th>Name</th>
                                        <th>Emails</th>
                                        <th>Calls</th>
                                        <th>Visits</th>
                                    </tr>
                                    <tr>
                                        <td>Pulkit</td>
                                        <td><?php echo $pulkit_e; ?></td>
                                        <td><?php echo $pulkit_c; ?></td>
                                        <td><?php echo $pulkit_cnt; ?></td>
                                    </tr>
                                       <tr>
                                        <td>Vivek</td>
                                        <td><?php echo $vivek_e; ?></td>
                                        <td><?php echo $vivek_c; ?></td>
                                        <td><?php echo $vivek_cnt; ?></td>
                                    </tr>
                                       <tr>
                                        <td>Shivani</td>
                                        <td><?php echo $shivani_e; ?></td>
                                        <td><?php echo $shivani_c; ?></td>
                                        <td><?php echo $shivani_cnt; ?></td>
                                     </tr>
                                       <tr>
                                        <td>Sunil</td>
                                        <td><?php echo $sunil_e; ?></td>
                                        <td><?php echo $sunil_c; ?></td>
                                        <td><?php echo $sunil_cnt; ?></td>
                                     </tr>
                                       <tr>
                                        <td>Tushar</td>
                                        <td><?php echo $tushar_e; ?></td>
                                        <td><?php echo $tushar_c; ?></td>
                                        <td><?php echo $tushar_cnt; ?></td>
                                      </tr>
                                </table>
                                 
                                 
                                 </ul></div><br>
                        </div>
                    </div>
                </div>
      </div>
      
      
  </div>
  
  

    
    
    
      
       <!--  This piece of code shows how much hours are invested in projects in a bar chart format (google chart is used in this section) -->
    
    <div class="row">
        <?php
        
         $res = mysqli_query($connector,'SELECT * FROM  project_master WHERE on_dashboard = "1" ');   
      
        $itemIndex = 0;
       while ($rows = mysqli_fetch_assoc($res)){
      
           
            $assoc_arr[$itemIndex][0] = $rows['project_name'];
            $assoc_arr[$itemIndex][1] = $rows['id'];
            $assoc_arr[$itemIndex][2] = 0;
            
            $itemIndex = $itemIndex+1;
    }   
        
       for($t =0; $t < $itemIndex ; $t++){
        
        $result = mysqli_query($connector,"SELECT * FROM  worklog_master WHERE project_id = '".$assoc_arr[$t][1]."' ");   
       
        $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $count + $row["hours"];
          
       }
       
       $assoc_arr[$t][2] = $count;
 
       }
       
       
        
       
      ?>
      <div class="col-sm-12">
        <div class="card" >
                   
                 <div class="card-header">
                        <h4> Project - Hour Chart</h4>
                    </div>
                        
                  <div class="card-body">     
          <script>
              google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);
function drawBasic() {

      var data = google.visualization.arrayToDataTable([
        ['Projects', 'Hours',],
  
  
  
     <?php
         
         for($t = 0; $t < $itemIndex ; $t++){
         
         ?>
       
        ['<?php echo  $assoc_arr[$t][0];  ?>' , <?php echo $assoc_arr[$t][2];  ?>],
   
      
      <?php   
      
             
         }
      
      ?>
      
  
  
  
  
      ]);

      var options = {
        title: 'Hours consumed by our Projects',
        chartArea: {width: '55%'},
        hAxis: {
          title: 'Total Hours',
          minValue: 0
        },
        vAxis: {
          title: 'Project Name'
        }
      };

     // set inner height to 30 pixels per row
var chartAreaHeight = data.getNumberOfRows() * 30;
// add padding to outer height to accomodate title, axis labels, etc
var chartHeight = chartAreaHeight + 80;
var chart = new google.visualization.BarChart(document.querySelector('#chart_div'));
chart.draw(data, {
    height: chartHeight,
    chartArea: {
        height: chartAreaHeight
    }
});

      chart.draw(data, options);
    }
          </script>
          
            <div id="chart_div"></div>
      </div>
          
    </div>
  </div>
  </div>
          
          
          
          
          
          
   
   
   
   
   
   
   
   
   
   
   
<!-- started to show monthly Expense price chart -->
   
<div class="row"> 

    <div class="col-sm-12">
        <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <div class="card" >
            <div class="card-header"><h4>Monthly Expenses - Price Chart</h4></div>
            <div class="card-body"> 

            <div id="chartContainer" style="height: 300px; width: 100%;"> 

            <script>

                window.onload = function () 
                {


                    var chart = new CanvasJS.Chart("chartContainer",
                    {
                      title:{
                        text: ""
                    },
                    axisX:{
                        title: "Current Month Dates",
                        gridThickness: 1
                    },
                    axisY:{
                        title: "Total Amount"
                    },




                    data:
                 [
                    {        
                        type: "area",
                        dataPoints: [//array
                        

                        <?php
                        
                         include "connection.php";
                       
                         $d1 = date("Y-m-01");
                         $d2 = date("Y-m-d");

                         //sql to fetch dates record without redundant date record from 1st of month to current date
                         $sql = "SELECT DISTINCT exp_date FROM expense_master WHERE exp_date BETWEEN '{$d1}'  AND '{$d2}'   "; 
                         
                           
                         $result = mysqli_query($connector,$sql);
                       
                         while($row = mysqli_fetch_assoc($result))
                         {
                             //again apply sql to find total count of each expense date
                              $sql_new = "SELECT * FROM expense_master WHERE exp_date = '{$row['exp_date']}' ";
                             
                              $result_new = mysqli_query($connector,$sql_new);
                              
                              $cnt = 0;
                              
                              while ($row_new = mysqli_fetch_assoc($result_new))
                              {
                                 $cnt = $cnt + $row_new['amount'];
                              }
                             
                              $date = $row['exp_date'];
                              $date = explode('-',$date);
                              
                              $year = $date[0];
                              $month = $date[1] - 1;
                              $day = $date[2] ;
                              
                              $amount = $cnt; 
                              //plot the amount with date on graph chart
                             echo  "{ x: new Date($year, 0$month, $day), y: $amount },"
                              
                           ?> 
                          <?php        
                         
                          }
                        
                          ?>     
                          ]//aray close
                    }
                 ]
                });

                    chart.render();
                }

            </script>

            </div>
        </div>
    </div>
</div> 
</div>

<!-- end to show monthly Expense price chart -->

   
   
   
   
   












   
<div class="row">
         <!--  This piece of code shows the prices of projects in a bar chart format (google chart is used in this section) -->
         
         <?php
             $res = mysqli_query($connector,'SELECT * FROM  project_master WHERE on_dashboard = "1" ');   
      
        $itemIndex = 0;
       while ($rows = mysqli_fetch_assoc($res)){
      
           
            $assoc_arr[$itemIndex][0] = $rows['project_name'];
            $assoc_arr[$itemIndex][1] = $rows['id'];
            $assoc_arr[$itemIndex][2] = 0;
            
            $itemIndex = $itemIndex+1;
    }   
        
       for($t =0; $t < $itemIndex ; $t++){
        
        $result = mysqli_query($connector,"SELECT * FROM  outward_master WHERE project_id = '".$assoc_arr[$t][1]."' ");   
       
        $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $count + $row["price"];
          
       }
       
       $assoc_arr[$t][2] = $count;
 
       }
       
       
     
       
         ?>
         
          
         
      <?php
         
           
 ?>



      <div class="col-sm-12">
        <div class="card" >
                   
                 <div class="card-header">
                        <h4> Project - Price Chart</h4>
                    </div>
                        
                  <div class="card-body">     
          <script>
              google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = google.visualization.arrayToDataTable([
       
       
        ['Projects', 'Price (in Rs)',],
        
       <?php
         
         for($t = 0; $t < $itemIndex ; $t++){
         
         ?>
       
        ['<?php echo  $assoc_arr[$t][0];  ?>' , <?php echo $assoc_arr[$t][2];  ?>],
   
      
      <?php   
      
             
         }
      
      ?>
      
      ]);

      var options = {
        title: 'Money invested on our Projects',
        chartArea: {width: '55%'},
         colors: ['#b0120a'],
        hAxis: {
          title: 'Total Price',
          minValue: 0
        },
        vAxis: {
          title: 'Project Name'
        }
      };

     // set inner height to 30 pixels per row
var chartAreaHeight = data.getNumberOfRows() * 30;
// add padding to outer height to accomodate title, axis labels, etc
var chartHeight = chartAreaHeight + 80;
var chart = new google.visualization.BarChart(document.querySelector('#chart_price'));
chart.draw(data, {
    height: chartHeight,
    chartArea: {
        height: chartAreaHeight
    }
});

      chart.draw(data, options);
    }
          </script>
          
            <div id="chart_price"></div>
      </div>
          
    </div>
  </div>
  </div>   


















   

<!-- event leave calendar started div-->
   
   
<div class="row">
   <!-- event calendar started div-->
    <div class="col-lg-6">

    <div class="card" style="padding:20px;">




    <div class="card-header">

     
     <div class="col-sm-6">
        <h4 style="position: relative;right: 32px;"> Event-Calendar</h4>
     </div>

     <div class="col-sm-6">
       
        <button type="button" data-toggle="modal" data-target="#myModal" style="position: relative;left: 100px;font-size: 14px;">ADD </button>
        <button type="button" data-toggle="modal" data-target="#myModal2" style="position: relative;left: 103px;font-size: 14px;">DELETE</button>
     </div>

     <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #8080801f;">
          <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
          <h4 class="modal-title">Show Event Details</h4>
      
        </div>
        <div class="modal-body">
             <div id="event_response">
          
               </div>
          <!--<p>Some text in the modal.</p>-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
        

   <button type="button" id="check_modal" data-toggle="modal" data-target="#myModal3" style="position: relative;left: 100px;font-size: 14px;display:none;">CHECK</button>


        <div class="modal fade" id="myModal" role="dialog">
            <link href="jquery.clockinput.min.css" rel="stylesheet" />
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">

            <div class="modal-header">
              <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
              <h4 class="modal-title">ADD EVENTS</h4>
            </div>


            <div class="modal-body">

            <div class="modal-body">

            <form action="#" method="post" id="form_id" name="form_id">
                       

                        <div class="form-group has-feedback">
                            Event Title Name 
                        </div>

                        <div class="form-group has-feedback">
                          <input type="text" class="form-control" name="title" id="title" placeholder="Enter Name" required="">
                        </div>

                        <div class="form-group has-feedback">
                            Event Start date 
                        </div>

                        <div class="form-group has-feedback">
                          <input type="datetime-local" class="form-control" name="start" id="start" required="">       
                        </div>

                        <div class="form-group has-feedback">
                            Event End date 
                        </div>

                        <div class="form-group has-feedback">
                          <input type="datetime-local" class="form-control glyphicon glyphicon-calendar form-control-feedback" name="end" id="end" required="">                        
                        </div>

                <div class="col-sm-12">

                    <div class="col-sm-6">

                        <div class="form-group has-feedback">
                            Event Time In 
                        </div>

                        <div class="form-group has-feedback">
                          <input type="time" class="form-control glyphicon glyphicon-calendar form-control-feedback" name="time_in" id="time_in" required="">                        
                        </div>
                    </div>
                    <div class="col-sm-6">

                        <div class="form-group has-feedback">
                            Event Time Out 
                        </div>

                        <div class="form-group has-feedback">
                          <input type="time" class="form-control glyphicon glyphicon-calendar form-control-feedback" name="time_out" id="time_out" required="">                        
                        </div>
                    </div>

                </div>
                         
                        <div class="form-group has-feedback">
                            Event Location 
                        </div>

                        <div class="form-group has-feedback">
                          <input type="text" class="form-control" name="location" id="location" required="">       
                        </div>

                        <div class="form-group has-feedback">
                            Select Employee's 
                        </div>

                        <div class="form-group has-feedback">
                            <select id="emp_id" name="emp_id[]" class="form-control" multiple required="">
                             <?php 
                                $query=mysqli_query($connector,"SELECT * FROM `employees_master` WHERE status='0'")or die(mysqli_error($connector));
                                while($arr=mysqli_fetch_array($query))
                                {
                             ?>
                              <option value="<?php echo $arr['id']; ?>|<?php echo $arr['name']; ?>"><?php echo $arr['name']; ?></option> 
                              <!-- <option value="<?php echo $arr['id']; ?>"><?php echo $arr['name']; ?></option> -->

                              <?php } ?>
                              
                             </select>
                        </div>

                        <script>
                            $(document).ready(function(){
                             $('#emp_id').multiselect({
                              nonSelectedText: 'Select Employee',
                              enableFiltering: true,
                              enableCaseInsensitiveFiltering: true,
                              buttonWidth:'400px'
                             });
                            })
                        </script>

                        <div class="col-xs-12">
                          <p id="msg"></p>
                          <button  name="submit" id="save" class="btn btn-primary btn-block btn-flat" style="width: 437px;">Submit</button>
                        </div>
                       

              </form> 

          </div>

            </div>



            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

          </div>
          
        </div>
        <script src="jquery.clockinput.min.js"></script>
    <script>
        $("#time_in").clockInput();
        $("#time_out").clockInput();
    </script>
        </div>




<div class="modal fade" id="myModal2" role="dialog">

<link rel="stylesheet" type="text/css" href="datatables/media/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="datatables/media/css/dataTables.bootstrap.css">
<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css"> -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>

    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="width: 550px;">

    <div class="modal-header">
    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
    <h4 class="modal-title">DELETE EVENTS</h4>
    </div>


    <div class="modal-body">

        <div class="modal-body">

                <div class="col-lg-12" id="reportdata">
                        <table class="datatable table table-striped" id="example" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                               <th>Event Id</th>
                               <th>Event Name</th>
                               <th>Start Date</th>
                               <th>End Date</th>
                               <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                           
                           <?php 
                              include "connection.php";

                             $sql =mysqli_query($connector,"SELECT * FROM `event_master` ")or die(mysqli_error($connector));
                                while($row=mysqli_fetch_array($sql))
                               {
                            ?>

                            <tr id="invoice-23">
                              <td><?php echo $row['id']; ?></td>
                              <td><?php echo $row['title']; ?></td>
                              <td><?php echo $row['start']; ?></td>
                              <td><?php echo $row['end']; ?></td>
                              <td>
                                <a href='#' title='Delete Record' data-toggle="modal" data-target="#deleteModal" onclick="$('#del_id').val('<?php echo $row['id']; ?>');"><span class="icon fa fa-trash"></span></a>
                            </td>
                            </tr>
                       <?php } ?>
                          </tbody>
                        </table>
                </div>

        </div>

    </div>



    <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>

    </div>

    </div>


<script type="text/javascript" src="datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="datatables/media/js/dataTables.bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"> </script> -->
    
<script type="text/javascript">
  $(document).ready(function() {
   
         $('#example').DataTable({

     //            "scrollX": true,
     //          "dom": 'lBfrtip',
     // "buttons": [
     //        {
              
               
     //            extend: 'collection',
     //            text: 'Export',
     //            exportOptions: {
     //               columns: [ 0, 1, 2]
     //            },
     //            buttons: [
                    
     //                'excel'
                   
     //                // 'pdf',
     //                // 'print'
     //            ]
     //        }
     //    ]
   
  });

$("[data-toggle=tooltip]").tooltip();
 
var table=$('#example').DataTable();

      table
      .order([[0,'desc']])
      .draw(false);

  });
</script>

</div>



 <!--Delete model start here-->
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="width: 533px;">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                <h4 class="modal-title" align="center">Delete Event</h4>
            </div>
               <form  id="del" autocomplete="off" enctype="multipart/formdata" method="POST">
                    <div class="modal-body" id="deleteContent">
                       <input type="hidden" name="data" id="del_id">
                       <div class="form-group">
                            <p><b>Are you sure want to delete ?</b></p>
                      </div>
                    </div>
                    <center><p id='dmsg'></p></center>
                    <div class="modal-footer">
                       <button class="btn btn-success submit" id="delete_btn" name="submit">Confirm</button>
                       <button type="button" class="btn btn-primary btn-md" data-dismiss="modal">Cancel</button>      
                    </div>
              </form>
        </div>
    </div>
</div>





    </div>






     <div class="response"></div>
     <div id='calendar'></div>

    </div>

    </div>  
<!-- event calendar started div-->





<!-- leave calendar started div-->
    <div class="col-lg-6">

        <div class="card" style="padding:20px;">
            <div class="card-header">
                <center><h4> Leave-Calendar</h4></center>
            </div>
            
            
 <!-- show leave information modal start -->
     <div class="modal fade" id="myModal33" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #8080801f;">
          <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
          <h4 class="modal-title">Employee Leave Detail</h4>
      
        </div>
        <div class="modal-body">
             <div id="leave_response">
          
               </div>
          <!--<p>Some text in the modal.</p>-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
        

   <button type="button" id="check_modal_leave" data-toggle="modal" data-target="#myModal33" style="position: relative;left: 100px;font-size: 14px;display:none;">CHECK</button>

   <!-- show leave information modal start -->           
            
            
            
          <div class="response1"></div>
          <div id='calendar1'></div>
        </div>       

    </div> 
<!-- leave calendar started div-->        
</div>
<!-- event leave calendar started div-->





     
<!-- event popup Modal calendar started div-->
  
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- event popup Modal calendar end div-->          
          
 <!-- Delete Script start -->
<script>
    $("#delete_btn").click(function(e)
    { 
        var id=$('#del_id').val();//user_defied_variable
        e.preventDefault();

           $.ajax({
                    url:'delete-event_new.php',
                    type: "POST",
                    data: {
                           id:id  
                    },
                    success: function(data)
                        {
                          //alert(data);
                            if(data==1)
                            {
                                $("#dmsg").html('<div class="alert alert-success" style="width: 437px;"><button type="button" class="close">×</button>Successfully Delete!</div>');
                                window.setTimeout(function() {
                                  $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                      $(this).remove(); 
                                  });
                                  window.location.href= "dashboard.php";
                                }, 1500);                               
                            }
                            else 
                              {
                               alert('error');
                              }                          
                        }
                });
    })
</script>         
          
          
          
          
          
           <div class="row">
     <div class="col-sm-12">
         
         <!--  This piece of code helps in showing  the message from Super Admin   -->
         
         
         <?php
            $resu = mysqli_query($connector,'SELECT * FROM message_master  ORDER BY id DESC LIMIT 1');   
            
            while($row = mysqli_fetch_assoc($resu))
            {
         

          if($row['date'] == date('Y-m-d') || $row['date'] < date('Y-m-d')){
    ?>   <div class="card" >
                   
                    <div class="card-header">
                        <h4>Message From HR </h4>
                    </div>
                     <div class="card-body" style="text-align:center;"> 
                        <div class="stat-widget-one">
                
                <?php 
                if($row['image'] != ''){
                echo "<p style='text-align:center;'> <img src='photos/{$row['image']}' width='50%'><br></p>" ; 
                          } 
                               echo "<p style='padding:25px;font-size:19px;color:black;text-align:center;font-family:'Lora' , serif;'><i> <br> '{$row['message']}' </i><br><br></p> 
                        </div>
                    </div>
                </div>
         
          
                ";
          }
            }   
            
    
          ?>  
          
          </div>
    </div>     
      
          
          
          
          
          
          
          
          
          
          
          
      
         <div class="row">
             
              <?php
       
       /* This section shows the number of pending ratings department wise , in this we used pie chart from google charts   */
       
       
       $result = mysqli_query($connector,'SELECT worklog_master.hours  FROM  worklog_master INNER JOIN employees_master ON worklog_master.emp_id = employees_master.id  WHERE worklog_master.ratings = "" AND employees_master.department = "Quality Control" AND employees_master.status = "0" ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $count + 1;
          
       }
 

    $quality = $count;
       
       ?>
       
             
             
       <?php
       
       /* This section shows the number of pending ratings department wise , in this we used pie chart from google charts   */
       
       
       $result = mysqli_query($connector,'SELECT worklog_master.hours  FROM  worklog_master INNER JOIN employees_master ON worklog_master.emp_id = employees_master.id  WHERE worklog_master.ratings = "" AND employees_master.department = "Embedded" AND employees_master.status = "0" ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $count + 1;
          
       }
 

    $embedded = $count;
       
       ?>
       
       
         <?php
       $result = mysqli_query($connector,'SELECT worklog_master.hours  FROM  worklog_master INNER JOIN employees_master ON worklog_master.emp_id = employees_master.id  WHERE worklog_master.ratings = "" AND employees_master.department = "Software" AND employees_master.status = "0"  ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $count + 1;
          
       }
 

    $software = $count;
       
       ?>
       
       
            <?php
       $result = mysqli_query($connector,'SELECT worklog_master.hours  FROM  worklog_master INNER JOIN employees_master ON worklog_master.emp_id = employees_master.id  WHERE worklog_master.ratings = "" AND employees_master.department = "Manufacturing / Production / Industrial" AND employees_master.status = "0" ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $count + 1;
       }
 

    $manu = $count;
    

   
       ?>
       
       
             <?php
       $result = mysqli_query($connector,'SELECT worklog_master.hours  FROM  worklog_master INNER JOIN employees_master ON worklog_master.emp_id = employees_master.id  WHERE worklog_master.ratings = "" AND employees_master.department = "Purchase" AND employees_master.status = "0" ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $count + 1;
       }
 

    $purchase = $count;
    

   
       ?>
       
             <?php
       $result = mysqli_query($connector,'SELECT worklog_master.hours  FROM  worklog_master INNER JOIN employees_master ON worklog_master.emp_id = employees_master.id  WHERE worklog_master.ratings = "" AND employees_master.department = "Sales" AND employees_master.status = "0" ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $count + 1;
       }
 

    $sales = $count;
    

   
       ?>
       
       
             <?php
       $result = mysqli_query($connector,'SELECT worklog_master.hours  FROM  worklog_master INNER JOIN employees_master ON worklog_master.emp_id = employees_master.id  WHERE worklog_master.ratings = "" AND employees_master.department = "Graphic Design / Animation" ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $count + 1;
       }
 

    $graphics = $count;
    

   
       ?>
       
       
                    <?php
       $result = mysqli_query($connector,'SELECT worklog_master.hours  FROM  worklog_master INNER JOIN employees_master ON worklog_master.emp_id = employees_master.id  WHERE worklog_master.ratings = "" AND employees_master.department = "Human Resources" ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $count + 1;
       }
 

    $hr = $count;
    

   
       ?>
       
       
       <?php
       
       $total_pendings = $embedded + $software + $manu + $purchase + $sales + $graphics + $hr + $quality;
       
       ?>
       <div class="col-sm-6">
            <a href="employees_worklog.php" style="color:black"> <div class="card" >
                   
                 <div class="card-header">
                        <h4> Pending Worklog Ratings ( Total : <?php echo  $total_pendings; ?> )</h4>
                    </div>
                        
                  <div class="card-body">        
                        
     <script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Department wise division', 'Numbers'],
  ['Embedded', <?php echo $embedded; ?>],
  ['Software', <?php echo $software; ?>],
  ['Purchase', <?php echo $purchase; ?>],
  ['Sales', <?php echo $sales; ?>],
  ['Graphics', <?php echo $graphics; ?>],
  ['Manufacturing', <?php echo $manu; ?>],
  ['Quality Check', <?php echo $quality; ?>],
  ['HR', <?php echo $hr; ?>]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {title : 'Department Wise Division', width: '100%' , height : "370"};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('pieforpending'));
  chart.draw(data, options);
}
</script>
<div id="chart_wrap_four">
<div id="pieforpending" ></div>
</div>
</div>
</div></a>
</div>





<div class="col-sm-6">
                 <div class="card" >
                  
                  
              <!-- This is the section which shows the top three employees along with their ratings , we used 2D array in this particular section 
                   and the name of our 2D array is score_array -->
                
                
                 <div class="card-header">
                        <h4>Top Rated Employees </h4>
                    </div>
                        
                  <div class="card-body">        




<?php
  error_reporting(E_ERROR | E_PARSE);
    $reccount = 0;
   $score_array = [[]];
   
        $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
                       
        $last = date('Y-m-d');// $last = date('Y-m-d');
        
        $res_outer = mysqli_query($connector,"select * from employees_master where status = '0' AND  usertype='1' AND id <> '53' ");
    
        while ($row_outer = mysqli_fetch_assoc($res_outer)){
       
        
        $cnt = 0;
        $base = 0;
     
 
        $res_inner = mysqli_query($connector,"SELECT * FROM worklog_master  WHERE  (emp_id = '".$row_outer['id']."')
        AND (w_date BETWEEN '$first_day_this_month' AND '$last')

        ");
        
        
    
        
        
        
        while ($row_inner = mysqli_fetch_assoc($res_inner)){
            
          
                     $cnt = $row_inner['ratings'] + $cnt;
                        
                        if($row_inner['ratings'] != ''){
                            $base = $base + 1;
                        }
                        
             
                }
               
                    $average  =  $cnt/$base;
                    $final    =  number_format($average,1);    
             
                    $score_array[$reccount][0] = $row_outer['name'];
                    $score_array[$reccount][1] = $final;
                
                    $reccount= $reccount+1;
        
 }
   

 $retry=1;
again:

    for($i=0; $i < $reccount-1 ; $i++){

        $var=0;
       if( $score_array[$i][1]< $score_array[$i+1][1]){
          $tmp_id = $score_array[$i][0];
          $score_array[$i][0] = $score_array[$i+1][0];
          $score_array[$i+1][0] = $tmp_id;
           
          $tmp = $score_array[$i][1];
          $score_array[$i][1] = $score_array[$i+1][1];
          $score_array[$i+1][1] = $tmp;
          $var=1;
       }
        
      
    }


    $retry=$retry+1;
   if($var=1&&$retry<105){
         
          goto again;
     }
   //with Score  ".$score_array[0][1]."</p>";
  //with Score ".$score_array[1][1]."
 // with Score ".$score_array[2][1]."   
 
    echo " ";
    echo "<p style='text-align:left;color:black;'><img src='images/{$score_array[0][0]}.jpg' width='98' height='140' >";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. ".$score_array[0][0]." with Score  ".$score_array[0][1]."</p>"; 
    echo "<p style='text-align:left;color:black;'><img src='images/{$score_array[1][0]}.jpg' width='98' height='140' >";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. ".$score_array[1][0]." with Score ".$score_array[1][1]." ";
    echo "<p style='text-align:left;color:black;'><img src='images/{$score_array[2][0]}.jpg' width='98' height='140' >";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. ".$score_array[2][0]."  with Score ".$score_array[2][1]."   ";


?>


</div>
</div>
    
</div>







</div>
        

      
      
    
        
                 <?php
       $result = mysqli_query($connector,'SELECT stock_master.item_name,stock_master.total_quantity,stock_master.item_code,stock_master.remaining_quantity,stock_master.unit_price,vendor_master.name FROM stock_master INNER JOIN vendor_master ON stock_master.vendor_id = vendor_master.id WHERE stock_master.remaining_quantity <> "0" AND stock_master.unit_price <> "0" AND stock_master.item_code LIKE "ME%"  ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $count + ($row['remaining_quantity'] * $row['unit_price']);
          
       }
 

    $me = $count;
       
       ?>
    
         <?php
       $result = mysqli_query($connector,'SELECT stock_master.item_name,stock_master.total_quantity,stock_master.item_code,stock_master.remaining_quantity,stock_master.unit_price,vendor_master.name FROM stock_master INNER JOIN vendor_master ON stock_master.vendor_id = vendor_master.id WHERE stock_master.remaining_quantity <> "0" AND stock_master.unit_price <> "0" AND  stock_master.item_code LIKE "HK%"   ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $count + ($row['remaining_quantity'] * $row['unit_price']);
          
       }
 

    $hk = $count;
       
       ?>
     
            <?php
       $result = mysqli_query($connector,'SELECT stock_master.item_name,stock_master.total_quantity,stock_master.item_code,stock_master.remaining_quantity,stock_master.unit_price,vendor_master.name FROM stock_master INNER JOIN vendor_master ON stock_master.vendor_id = vendor_master.id WHERE stock_master.remaining_quantity <> "0" AND stock_master.unit_price <> "0" AND  stock_master.item_code LIKE "EE%"  ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $count + ($row['remaining_quantity'] * $row['unit_price']);
          
       }
 

    $ee = $count;

       ?>
       
          <?php
       $result = mysqli_query($connector,'SELECT stock_master.item_name,stock_master.total_quantity,stock_master.item_code,stock_master.remaining_quantity,stock_master.unit_price,vendor_master.name FROM stock_master INNER JOIN vendor_master ON stock_master.vendor_id = vendor_master.id WHERE stock_master.remaining_quantity <> "0" AND stock_master.unit_price <> "0" AND  stock_master.item_code LIKE "EC%" ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $count + ($row['remaining_quantity'] * $row['unit_price']);
          
       }
 

    $ec = $count;

       ?>
       
          <?php
       $result = mysqli_query($connector,'SELECT stock_master.item_name,stock_master.total_quantity,stock_master.item_code,stock_master.remaining_quantity,stock_master.unit_price,vendor_master.name FROM stock_master INNER JOIN vendor_master ON stock_master.vendor_id = vendor_master.id WHERE stock_master.remaining_quantity <> "0" AND stock_master.unit_price <> "0" AND  stock_master.item_code LIKE "MV%"  ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $count + ($row['remaining_quantity'] * $row['unit_price']);
          
       }
 

    $mv= $count;

       ?>
       
                 <?php
                 
       $result = mysqli_query($connector,'SELECT stock_master.item_name,stock_master.total_quantity,stock_master.item_code,stock_master.remaining_quantity,stock_master.unit_price,vendor_master.name FROM stock_master INNER JOIN vendor_master ON stock_master.vendor_id = vendor_master.id WHERE stock_master.remaining_quantity <> "0" AND stock_master.unit_price <> "0" AND  stock_master.item_code LIKE "IT%" ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $count + ($row['remaining_quantity'] * $row['unit_price']);
          
       }
 

    $it = $count;

       ?>
       
                        <?php
                 
       $result = mysqli_query($connector,'SELECT stock_master.item_name,stock_master.total_quantity,stock_master.item_code,stock_master.remaining_quantity,stock_master.unit_price,vendor_master.name FROM stock_master INNER JOIN vendor_master ON stock_master.vendor_id = vendor_master.id WHERE stock_master.remaining_quantity <> "0" AND stock_master.unit_price <> "0" AND  stock_master.item_code LIKE "PN%"  ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $count + ($row['remaining_quantity'] * $row['unit_price']);
          
       }
 

    $pn = $count;

       ?>
       
                        <?php
                 
       $result = mysqli_query($connector,'SELECT stock_master.item_name,stock_master.total_quantity,stock_master.item_code,stock_master.remaining_quantity,stock_master.unit_price,vendor_master.name FROM stock_master INNER JOIN vendor_master ON stock_master.vendor_id = vendor_master.id WHERE stock_master.remaining_quantity <> "0" AND stock_master.unit_price <>"0" AND  stock_master.item_code LIKE "ST%"  ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $count + ($row['remaining_quantity'] * $row['unit_price']);
          
       }
 

    $st = $count;

       ?>
        
        
        
        
        
        
        
   <div class="row">
                                <?php
                             
$result = mysqli_query($connector,'SELECT * FROM  stock_master WHERE unit_price <> "0"  AND remaining_quantity <> "0" ');                     
      
$counting = 0;

while ($row = mysqli_fetch_assoc($result)){
    

$counting = $counting + ($row['remaining_quantity']  * $row['unit_price'] ) ;

}

?>        
              <div class="col-sm-6">
                  <div class="card-header">
                        <h5>Inventory Check </h5> <?php echo " <b style='font-size:18px;color:#ef524e;'> Total : Rs ".$counting." /- </b>" ;  ?> 
                    </div>

                     <div class="card" >
                   
                   
      <!-- This section is for checking the inventory and this also shows the total invested cost uptodate..     -->
                   
                   
                    

                     <?php
                             
$result = mysqli_query($connector,'SELECT * FROM  stock_master WHERE unit_price > "5000"    ');                     
      
$cn = 0;

while ($row = mysqli_fetch_assoc($result)){
    
$cn = $cn + 1;


}

?>
    
    

    
    


                     <div class="card-body" style="text-align:center;"> 
                        <div class="stat-widget-one">
                             <br>
                             <div class="stat-icon dib"><ul style="list-style-type:none;">
                                 
                                 <script>
                                     google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);


        // Draw the chart and set the chart values
function drawChart() {
 
  var data = google.visualization.arrayToDataTable([
  ['Department wise division', 'Total Prices'],
  ['Mechanical', <?php echo $me ?>],
  ['House Keeping', <?php echo $hk ?>],
  ['Electronics', <?php echo $ec ?>],
  ['Information Technology', <?php echo $it ?>],
  ['Electricals', <?php echo $ee ?>],
  ['Machine Vision', <?php echo $mv ?>],
  ['Stationary', <?php echo $st ?>],
  ['Pantry', <?php echo $pn ?>]
  
]);

  // Optional; add a title and set the width and height of the chart
  var options = {title : 'Total Inward Prices (Departmentwise) ', width: '100%' , height : "500"};

  // Display the chart inside the <div> element with id="piechart"
  document.getElementById('piechart').innerHTML = "";
// alert(document.getElementById('piechart').innerHTML);
  
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
  
  //chart = "";
}

                                     
                                 </script>
                                 

<a href='inventory_datewise_check.php'><div id="piechart" ></div></a>
                            
                                 
                                 
                                 
                                 
                                 
                                
                                  <li><a href="#">Costly Items : <strong> <?php echo $cn  ?></strong></a></li>
                                
                                 <li><a href="#">Inventory Expenditure : <strong> <?php echo "Rs&nbsp;". $counting  ?></strong></a></li>
                                 </ul></div><br>
                        </div>
                    </div>
                </div>
                
        </div>
       
       
       
      <!-- This section is for checking the complete expenses of the company for current month (we used piechart to divide all the expenses headwise) we can 
      click on the piechart we used in the section for jumping furthur in all_expense.php page to check the expenses in more details -->
      
      
  <?php
       
      
       $f = date("Y-m-01");
       $l = date("Y-m-d"); 
      
       
       $result = mysqli_query($connector,'SELECT * FROM expense_master WHERE (head = "Petrol") AND (is_approved = 1) AND exp_date BETWEEN "'.$f.'" AND "'.$l.'" ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $row['amount'] + $count;
          
       }
 

    $petrol = $count;
       
       ?>    
 
 
 
 
   <?php
       
      
       $f = date("Y-m-01");
       $l = date("Y-m-d"); 
      
       
       $result = mysqli_query($connector,'SELECT * FROM expense_master WHERE (head = "Labour") AND (is_approved = 1) AND exp_date BETWEEN "'.$f.'" AND "'.$l.'" ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $row['amount'] + $count;
          
       }
 

    $labour = $count;
       
       ?>  
       
       
       
       
       
       
          <?php
       
      
       $f = date("Y-m-01");
       $l = date("Y-m-d"); 
      
       
       $result = mysqli_query($connector,'SELECT * FROM expense_master WHERE (head = "Legal") AND (is_approved = 1) AND exp_date BETWEEN "'.$f.'" AND "'.$l.'" ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $row['amount'] + $count;
          
       }
 

    $legal = $count;
       
       ?>  
       
 
        
          <?php
       
      
       $f = date("Y-m-01");
       $l = date("Y-m-d"); 
      
       
       $result = mysqli_query($connector,'SELECT * FROM expense_master WHERE (head = "Transportation") AND (is_approved = 1) AND exp_date BETWEEN "'.$f.'" AND "'.$l.'" ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $row['amount'] + $count;
          
       }
 

      $transportation = $count;
       
       ?>
       
       
       
       
       
 
 
           <?php
       
      
       $f = date("Y-m-01");
       $l = date("Y-m-d"); 
      
       
       $result = mysqli_query($connector,'SELECT * FROM expense_master WHERE (head = "Stationary") AND (is_approved = 1) AND exp_date BETWEEN "'.$f.'" AND "'.$l.'" ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $row['amount'] + $count;
          
       }
 

      $stationary = $count;
       
       ?> 
 
      
      
                <?php
       
      
       $f = date("Y-m-01");
       $l = date("Y-m-d"); 
      
       
       $result = mysqli_query($connector,'SELECT * FROM expense_master WHERE (head = "Office Pantry") AND (is_approved = 1) AND exp_date BETWEEN "'.$f.'" AND "'.$l.'" ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $row['amount'] + $count;
          
       }
 

      $pantry = $count;
       
       ?> 
      
    
    
    
    
    
          
                <?php
       
      
       $f = date("Y-m-01");
       $l = date("Y-m-d"); 
      
       
       $result = mysqli_query($connector,'SELECT * FROM expense_master WHERE (head = "Mobile") AND (is_approved = 1) AND exp_date BETWEEN "'.$f.'" AND "'.$l.'" ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $row['amount'] + $count;
          
       }
 

      $mobile = $count;
       
       
       
       ?> 
    
    
    
    
    
       
          
 <?php
       
      
       $f = date("Y-m-01");
       $l = date("Y-m-d"); 
      
       
       $result = mysqli_query($connector,'SELECT * FROM expense_master WHERE (head = "Travel") AND (is_approved = 1) AND exp_date BETWEEN "'.$f.'" AND "'.$l.'" ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $row['amount'] + $count;
          
       }
 

    $travel = $count;
       
       ?>
       
              <?php
       
      
       
       
       $result = mysqli_query($connector,'SELECT * FROM expense_master WHERE (head = "Office Consumables") AND (is_approved = 1) AND exp_date BETWEEN "'.$f.'" AND "'.$l.'" ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $row['amount'] + $count;
          
       }
 

    $oc = $count;
       
       ?>
       
      <?php
 
       
       $result = mysqli_query($connector,'SELECT * FROM expense_master WHERE (head = "Salary") AND (is_approved = 1) AND exp_date BETWEEN "'.$f.'" AND "'.$l.'" ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $row['amount'] + $count;
          
       }
 

    $salary = $count;
       
       ?>
       

    <?php
    
       
       $result = mysqli_query($connector,'SELECT * FROM expense_master WHERE (head = "Vendors Payment") AND (is_approved = 1) AND exp_date BETWEEN "'.$f.'" AND "'.$l.'"');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $row['amount'] + $count;
          
       }
 

    $vp = $count;
       
     ?>
      
   
   
    <?php
    
       
       $result = mysqli_query($connector,'SELECT * FROM expense_master WHERE (head = "Rent") AND (is_approved = 1)  AND exp_date BETWEEN "'.$f.'" AND "'.$l.'"');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $row['amount'] + $count;
          
       }
 

    $rent = $count;
       
       ?>
   
       <?php
    
       
       $result = mysqli_query($connector,'SELECT * FROM expense_master WHERE (head = "Tax") AND (is_approved = 1)  AND exp_date BETWEEN "'.$f.'" AND "'.$l.'"');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $row['amount'] + $count;
          
       }
 

    $tax = $count;
       
       ?>
   
         <?php
    
       
       $result = mysqli_query($connector,'SELECT * FROM expense_master WHERE (head = "RnD") AND (is_approved = 1)  AND exp_date BETWEEN "'.$f.'" AND "'.$l.'"');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $row['amount'] + $count;
          
       }
 

    $rnd = $count;
       
       ?>
       
                <?php
    
       
       $result = mysqli_query($connector,'SELECT * FROM expense_master WHERE (head = "Bills") AND (is_approved = 1) AND exp_date BETWEEN "'.$f.'" AND "'.$l.'" ');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $row['amount'] + $count;
          
       }
 

    $bills = $count;
       
       ?>
       
       
       
       
                       <?php
    
       
       $result = mysqli_query($connector,'SELECT * FROM expense_master WHERE (head = "Others") AND (is_approved = 1) AND exp_date BETWEEN "'.$f.'" AND "'.$l.'"');   
       
       $count = 0;
       
       while ($row = mysqli_fetch_assoc($result)){
           
        $count = $row['amount'] + $count;
          
       }
 

    $others = $count;
       
       ?>
       
       
    
       
       <?php
       
       $total =  $petrol + $labour + $legal + $transportation + $stationary + $pantry + $mobile + $vp + $travel + $oc + $salary + $rent + $tax + $others + $rnd + $bills;
       
       ?>
       <div class="col-sm-6">
            <a href="all_expense.php" style="color:black"> <div class="card" >
                   
                 <div class="card-header">
                        <h4>Expense Check : Current Month </h4> <?php echo " <b style='font-size:18px;color:#ef524e;'> Total : Rs ".$total." /- </b>" ;  ?> 
                    </div>
                        
                  <div class="card-body">        
                        
     <script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Head wise division', 'Amount'],
  ['Petrol', <?php echo $petrol; ?>],
  ['Labour', <?php echo $labour; ?>],
  ['Legal', <?php echo $legal; ?>],
  ['Transportation', <?php echo $transportation; ?>],
  ['Stationary', <?php echo $stationary; ?>],
  ['Office Pantry', <?php echo $pantry; ?>],
  ['Mobile', <?php echo $mobile; ?>],
  ['Travel', <?php echo $travel; ?>],
  ['Office Consumables', <?php echo $oc; ?>],
  ['Salary', <?php echo $salary; ?>],
  ['Vendors Payment', <?php echo $vp; ?>],
  ['Rent', <?php echo $rent; ?>],
  ['Tax', <?php echo $tax; ?>],
  ['R & D', <?php echo $rnd; ?>],
  ['Bills', <?php echo $bills; ?>],
  ['Others', <?php echo $others; ?>],
]);

  // Optional; add a title and set the width and height of the chart
  var options = {title : 'Head Wise Division', width: '100%' , height : "370"};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('pieforpendingtwo'));
  chart.draw(data, options);
}
</script>
<div id="chart_wrap_five">
<div id="pieforpendingtwo" ></div>
    <br><br><br><br><br>
</div>
</div>
</div></a>
</div>
        
      <br><br><br><br>    <br><br><br><br>
        

    
                            
                          
                            
         
        
        
 </div>
        
        <br>


     <div class="row">
        
  
       <!-- <div class="col-sm-4">
                     <div class="card" >
                   
                   <!-- This section is to check the petty cash current balance....  -->
                   
             <!--       <div class="card-header">
                        <h4>Petty Cash [Ahemdabad]</h4>
                    </div>
                     
       <?php
          
          
       /*   $q1= "SELECT * FROM petty_master WHERE transaction_type = 'in' ";
          $in = 0;
          $result = mysqli_query($connector,$q1);
          while($rows = mysqli_fetch_assoc($result))
          {
              $in = $in + $rows['amount'];
          }
          
          
          $q2= "SELECT * FROM petty_master WHERE transaction_type = 'out' ";
          $out = 0;
          $res = mysqli_query($connector,$q2);
          while($row = mysqli_fetch_assoc($res))
          {
              $out = $out + $row['amount'];
          }
          
          $bal = $in - $out;
          
          */
          
          
    ?>


                     <div class="card-body" style="text-align:center;"> 
                        <div class="stat-widget-one">
                             <br>
                             <div class="stat-icon dib"><ul style="list-style-type:none;">
                                 
                                 <li><a href="show_petty.php"><img src="petty-cash.png" width="130" height= "130"></a></li><br>
                                  <li><a href="#">Current Balance : <strong> <?php /*echo 'Rs '.$bal;  */ ?></strong></a></li>
                                 
                               
                                 </ul></div><br>
                        </div>
                    </div>
                </div>
                
                

                
                
        </div> -->
        
        
        
        
        
                          <div class="col-sm-4">
                     <div class="card" >
                   
                   <!-- This section is to check the attendance of employees after clicking you will be directed to check attendance page ....  -->
                   
                    <div class="card-header">
                        <h4>Check Attendance</h4>
                    </div>
                     
       <?php
        $doe = date("Y-m-d");
        $r = mysqli_query($connector,'SELECT * FROM attendance_master WHERE date = "'.$doe.'" AND status = "0" ');  
        $c = 0;
        while(mysqli_fetch_assoc($r)){
            
        if($r['is_present'] == 0){
            $c = $c + 1;
        }
            
        }
        
          
          
       
         
         
         
         
      ?>
             <div class="card-body" style="text-align:center;"> 
                      <div class="stat-widget-one">
                             <br>
                             <div class="stat-icon dib"><ul style="list-style-type:none;">
                                 
                                 <li><a href="check_attendance.php" ><img src="attd.png" width="110" height= "110"></a></li><br><br>
                                  <li><a href="#">Number of Absentees (Today) : <strong> <?php echo $c; ?></strong></a></li>
                                 
                               
                                 </ul></div><br>
                        </div>
                    </div>
                </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
             <div class="col-sm-4">
                     <div class="card" >
                   
                   <!-- This section is to check the missed worklogs of employees for current month and after clicking you will be directed to check attendance page ....  -->
                   
                    <div class="card-header">
                        <h4>Check Missed Worklogs</h4>
                    </div>
                     
       <?php
         
         $total = 0;
    
         $que = " SELECT * FROM employees_master WHERE status = '0' AND usertype = '1' OR usertype = '4'  ";
         $result = mysqli_query($connector,$que); 

  while ($rowz = mysqli_fetch_assoc($result)){
    
    
                    {
                       
                   
                        $f = date('Y-m-01'); // hard-coded '01' for first day
                       
                        $l = date('Y-m-d'); // $last  = date('Y-m-d');
                   
                        $sql = "SELECT * FROM `attendance_master` WHERE emp_id = '".$rowz['id']."' AND is_present = '1' AND date BETWEEN '$f' AND '$l'  ORDER BY id ASC " ; 
                     
                        $present = 0;
                      
                        $resultant = mysqli_query($connector,$sql);  
                      
                        while ($row = mysqli_fetch_assoc($resultant)){
                    
                        $present = $present + 1;
                    
                        }
                    
                    
                    }
                      

               {

                    $first = date('Y-m-01'); // hard-coded '01' for first day
                       
                    $last = date('Y-m-d'); // $last  = date('Y-m-d');
                   
                    $query = "SELECT DISTINCT w_date  FROM `worklog_master` WHERE emp_id = '".$rowz['id']."'  AND  w_date BETWEEN '$first' AND '$last'  " ; 
                     
                    $worklogs = 0;
                      
                    $resultancy = mysqli_query($connector,$query);  
                      
                    while ($rows = mysqli_fetch_assoc($resultancy)){
                    
                        $worklogs = $worklogs + 1;
                    
                    }
                
                      
                } 
               
             $miss = $present - $worklogs;
            // echo "<br>".$rowz['name']." : ".$miss."<br>";   
               
               $total = $miss + $total;
               
         }           
          
       
         
         
         
         
      ?>
             <div class="card-body" style="text-align:center;"> 
                      <div class="stat-widget-one">
                             <br>
                             <div class="stat-icon dib"><ul style="list-style-type:none;">
                                 
                                 <li><a href="missed_worklog.php" ><img src="missed.png" width="110" height= "110"></a></li><br><br>
                                  <li><a href="#">Total Missed (Current Month) : <strong> <?php echo $total; ?></strong></a></li>
                                 
                               
                                 </ul></div><br>
                        </div>
                    </div>
                </div>
        </div>
        
        
        
        
        
                 <div class="col-sm-4">
                   
                    <!-- This is the section for Super Admins in which they can check the number of tasks assigned by them which 
                    are currently running and can also check the number of tasks assigned by them which crossed their respective deadlines -->
                    
                    
                     <div class="card" >
                     <?php
                             
$result = mysqli_query($connector,'SELECT * FROM  task_master WHERE status = "Work in Progress" and allocator_id = "'.$_SESSION['id'].'"   ');                     
      
$cnt = 0;

while ($row = mysqli_fetch_assoc($result)){
    
$cnt = $cnt + 1;


}

?>

                     <?php
                             
$result = mysqli_query($connector,'SELECT * FROM  task_master WHERE status = "Time Out" and allocator_id = "'.$_SESSION['id'].'"   ');                     
      
$c = 0;

while ($row = mysqli_fetch_assoc($result)){
    
$c = $c + 1;


}

?>
       
                    <div class="card-header">
                        <h4>Total Running Tasks</h4>
                    </div>
                     <div class="card-body" style="text-align:center;"> 
                        <div class="stat-widget-one">
                             <br>
                             <div class="stat-icon dib"><ul style="list-style-type:none;">
                                 
                                 <li><a href="check_task.php"><img src="runningtask.png" width="108" height= "108"></a></li><br>
                                 <li><a href="#">Running Tasks: <strong><?php echo $cnt  ?></strong></a></li>
                                 <li><a href="#">Timeout Tasks : <strong><?php echo $c  ?></strong></a></li>
                                 
                                 
                                 
                                 </ul></div><br>
                        </div>
                    </div>
                </div>
        </div> <!-- .content -->
        
        
        
        
        
        
        
        
        
        
  
  </div>


 <div class="row">
        
  
  
  
  
   <!--     <div class="col-sm-4">
                     <div class="card" >
                   
                   <!-- This section is to check the petty cash current balance....  -->
                   
                   <!-- <div class="card-header">
                        <h4>Vendors Pay Check </h4>
                    </div>
                     
       <?php
          
      /*    $total_due = 0;
          $s = "SELECT * FROM vendor_master";
          $result_vend = mysqli_query($connector,$s);
          
          while ($row = mysqli_fetch_assoc($result_vend)){
              
          
             
               $g = "SELECT * FROM pay_master WHERE vendor_id = '".$row['id']."' ORDER BY id DESC LIMIT 1 ";
               $result_pay = mysqli_query($connector,$g);
               
               $b = 0;
               $p = 0;
               if($result_pay != NULL){
               while ($rows = mysqli_fetch_assoc($result_pay)){
                   
                 $b = $b + $rows['bill_amount']; 
                 $p = $p + $rows['paid_amount'];
                   
               }
              
              $total_due  = $b - $p;
          } 
          
          }
          
          
          
          */
      
          ?>


                     <div class="card-body" style="text-align:center;"> 
                        <div class="stat-widget-one">
                             <br>
                             <div class="stat-icon dib"><ul style="list-style-type:none;">
                                 
                                 <li><a href="check_vendor_pay.php"><img src="shake_hands.png" width="110" height= "110"></a></li><br>
                                  <li><a href="#">Total Amount Due : <strong> <?php /*echo "Rs ".$total_due ; */  ?></strong></a></li>
                                 
                               
                                 </ul></div><br>
                        </div>
                    </div>
                </div>
                
                

                
                 
        </div>   -->
        
        
                
                
                
                
                
  
      
        
        
        
        
        
        

        
        
        
        
        
        
        
    <!--    <div class="col-sm-4">
                     <div class="card" >
                   
                   <!-- This section is to check the petty cash current balance....  -->
        <!--           
                    <div class="card-header">
                        <h4>Petty Cash [Pune]</h4>
                    </div>
                     
       <?php
          
        /*  
          $q1= "SELECT * FROM petty_master_pune WHERE transaction_type = 'in' ";
          $in = 0;
          $result = mysqli_query($connector,$q1);
          while($rows = mysqli_fetch_assoc($result))
          {
              $in = $in + $rows['amount'];
          }
          
          
          $q2= "SELECT * FROM petty_master_pune WHERE transaction_type = 'out' ";
          $out = 0;
          $res = mysqli_query($connector,$q2);
          while($row = mysqli_fetch_assoc($res))
          {
              $out = $out + $row['amount'];
          }
          
          $bal = $in - $out;
         */
         
         
          ?>


                     <div class="card-body" style="text-align:center;"> 
                        <div class="stat-widget-one">
                             <br>
                             <div class="stat-icon dib"><ul style="list-style-type:none;">
                                 
                                 <li><a href="show_petty_pune.php"><img src="petty-cash.png" width="130" height= "130"></a></li><br>
                                  <li><a href="#">Current Balance : <strong> <?php /*echo 'Rs '.$bal;  */  ?></strong></a></li>
                                 
                               
                                 </ul></div><br>
                        </div>
                    </div>
                </div>
                
                

                
                
        </div> -->
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        </div>

        
        
        
        
        <div class="row">
                           
                <div class="col-sm-4">
                     <div class="card" >
                   
                   <!-- This section is for adding personal expense and check those expenses whether they aere approved or not    -->
                   
                    <div class="card-header">
                        <h4><a href="add_expense.php" style="color:black" > Add Expense </a> / <a href="view_expense.php" style="color:black">View Expense</a> </h4>
                    </div>
                     
       <?php
          

          ?>


                     <div class="card-body" style="text-align:center;"> 
                        <div class="stat-widget-one">
                             <br>
                             <div class="stat-icon dib"><ul style="list-style-type:none;">
                                 <br>
                                 <li><a href="add_expense.php"><img src="expense.jpg" width="135" height= "135"></a></li><br>
                                  <br><br>
                                
                                 
                               
                                 </ul></div><br>
                        </div>
                    </div>
                </div>
                
                

                
                
        </div>
            
            
 <div class="col-sm-8">
            
      <!--      
              <div class="card-header">
                        <h5><a href="#" style="color:black" > Event Calendar (Current Month) </a></h4>
                    </div>
            <div class="card" style="padding:20px;">
            
            <table>
                
              <?php
 /*             
     $k = 1;
             for ($i=0 ; $i<7; $i++){
                 
                 echo "<tr>";
                
                 for($j=0;$j<5;$j++){
                     
                     if ($k >= '31')
                     {
                     echo "<td> {$k} </td>";
                     $k = '';
                     break;
                     }
                     
                      else if ($k <= '31')
                     {
                     echo "<td> {$k} </td>";
                     
                       $k++;
                     }
                     
                   
                     
                 }
                 
                 echo "</tr>";
       
             }
              
              
              
             
              
             */ 
              
              
              ?>
            
                
                
            </table>
            <br>
              <div class="row">
              <div class="col-sm-5" >
              <form action="event_update.php" method="POST"> 
              <label>Event</label>&nbsp;
              <input type="text" name="event_info" >  
              </div>
              <div class="col-sm-5" >
              <label> Date</label>&nbsp;
              <input type="date" name="event_date"    > 
               </div>
              <div class="col-sm-2" >
              <button type="submit" name="submit" >Submit</button>
              </div>
              </form>
              
              </div>
              
              </div>
        
        
        -->
            
    </div>
       
        </div>
        
        
        
        
        
        
        
    </div>    
    </div><!-- /#right-panel -->

     <!-- Right Panel -->

   


    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
         <!--  Chart js -->
    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="assets/js/lib/chart-js/chartjs-init.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      
    

    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
    <script>
        ( function ( $ ) {
            "use strict";

            jQuery( '#vmap' ).vectorMap( {
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: [ '#1de9b6', '#03a9f5' ],
                normalizeFunction: 'polynomial'
            } );
        } )( jQuery );
    </script>

</body>
</html>



<script>
    $('#form_id').submit(function(e){
 
  e.preventDefault(); 
          $.ajax({
                     url:'add-event.php',
                     type:'POST',
                     data:new FormData(this),
                     contentType:false,
                     processData:false,

                     success: function(data)

                         {
                            if(data==1)
                              {
                               $("#msg").html('<div class="alert alert-success" style="width: 437px;"><button type="button" class="close"></button>Successfully Registered!</div>');
                                window.setTimeout(function() {
                                  $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                      $(this).remove(); 
                                  });
                                  window.location.href= "dashboard.php";
                                }, 1500);
                              }                              
                            else if(data ==4){
                                
                              
                               $("#msg").html('<div class="btn btn-warning" style="width: 437px;"><button type="button" class="close"></button>Already in Database !!!</div>');
                                window.setTimeout(function() {
                                  $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                      $(this).remove(); 
                                  });
                                  // window.location.href= "user_list.php";
                                }, 1500);
                                      
                            } 
                            else
                              {
                               alert('error');
                              }
                          }

                })
          
             });
          
</script>



<?php

}

else{

echo "
<html>
<center>
<br><br><br>
<h2> You are looking for wrong Page !!! </h2>


</center>
</html>";


}

?>