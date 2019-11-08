<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>{{config('APP_NAME','Vet Assistant')}} - @yield('title','Vet Assistant')</title>
  <!-- icon -->
  <link rel="icon" type="image/x-icon" href="{{asset('adminlte3/dist/img/logo.jpg')}}">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('adminlte3/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('adminlte3/plugins/summernote/summernote-bs4.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('adminlte3/plugins/select2/css/select2.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('adminlte3/plugins/datatables/dataTables.bootstrap4.min.css')}}">
    <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
   <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlte3/dist/css/adminlte.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
  <style type="text/css" media="print">
    @media print
    {
    html, body { height: auto; }
    .dt-print-table, .dt-print-table thead, .dt-print-table th, .dt-print-table tr {border: 0 none !important;}
    .action { display:none; }
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php $today = date('Y-m-d'); ?>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <button onclick="togglefs()" type="button" class="toggle-expand-btn btn"><i class="fa fa-expand"></i></button>
      </li>   
     
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
         <span id="notifcnt">
           <i class="far fa-bell"></i>
           <?php $cnt = 0; ?>
           @foreach($clientnotif as $c)

            @foreach($c->patients as $cp)
              
              @foreach($cp->appointments as $cpa)
               @if($cpa->isPaid == 0)
                  <?php $cnt++; ?>
                 <span class="badge badge-danger navbar-badge">{{$cnt}}</span>
               @endif
              @endforeach

            @endforeach

           @endforeach
         </span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">Unpaid Appointments</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" style=" margin-bottom: 10px;overflow:scroll;-webkit-overflow-scrolling: touch; height: 230px">
         

           <div id="billingnotif">
             @foreach($clientnotif as $c)

              @foreach($c->patients as $cp)
                
                @foreach($cp->appointments as $cpa)
                 @if($cpa->isPaid == 0)

                  
                     <div class="card">
                       
                       <div class="card-body">
                         <small>Client Name:</small><br>
                         {{$cpa->patient->client->name}}<br>
                         <small>Service Rendered:</small><br>
                         {{$cpa->appointment}}<br>
                         <small>Patient:</small><br>
                         {{$cpa->patient->name}}<br>
                         <small>Amount:</small><br>
                         {{$cpa->price}}<br>
                       </div>
                       <div class="card-footer">
                        <button id="{{$cpa->patient->client->id}}" class="btn ptb btn-primary form-control"> Proceed to bill</button>
                       </div>
                     </div>
                   
                   
                 @endif
                @endforeach

              @endforeach

             @endforeach
           </div>


           
          </a>

         
        </div>
      </li>
      
      <li class="nav-item">
        <form id="logout-form" style="margin:0px" action="{{ route('logout') }}" method="POST" >
            @csrf
            <button type="submit" id="btnLogout" class="btn"><i class="icon ion-log-out"></i> Logout</button>
        </form>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
      <img src="{{asset('adminlte3/dist/img/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Vet Assistant</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://vetassist.s3-ap-southeast-1.amazonaws.com/{{Auth::user()->image}}" class="img-circle elevation-2" alt="User Image" style="width: 40px;height: 40px">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}</a>
            <div class="form-inline">
                <a href="#" class="d-block text-sm">{{ ucfirst(Auth::user()->role) }} - &nbsp;</a> 
                <a href="/dashboard/profile" class="d-block text-sm">View Profile</a>
            </div>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-1 mb-5">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="/dashboard" class="nav-link @if($title=='Dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/dashboard/announcement" class="nav-link @if($title=='Announcement') active @endif">
              <i class="nav-icon fas fa-scroll"></i>
              <p>
                Announcement
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/dashboard/client" class="nav-link @if($title=='Client') active @endif">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Client
              </p>
            </a>
          </li>

        
     
            
              <li class="nav-item">
                 <a href="/dashboard/appointmentlist" class="nav-link  @if($title=='Appointments') active @endif">
                  <i class="nav-icon fa fa-calendar-check"></i>
                  <p>Appointments</p>
                </a>
              </li>
        
 


<!-- 
          <li class="nav-item">
            <a href="/dashboard/billing" class="nav-link @if($title=='Billing') active @endif">
              <i class="fa fa-credit-card"></i>
              <p>
                &nbsp; Billing
              </p>
            </a>
          </li> -->

          <li class="nav-header">INVENTORY</li>
          <li class="nav-item">
            <a href="/dashboard/supplier" class="nav-link @if($title=='Supplier') active @endif">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Supplier
              </p>
            </a>
          </li>

              <li class="nav-item">
                <a href="/dashboard/product" class="nav-link  @if($title=='Product') active @endif">
                  <i class="nav-icon fa fa-archive"></i>
                  <p>
                    Product
                  </p>
                </a>
              </li>


         

           
         

          <li class="nav-item">
            <a href="/dashboard/stockout" class="nav-link @if($title=='Point of Sale') active @endif">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Point of Sale
              </p>
            </a>
          </li>

          @if(Auth::user()->role == 'doctor')
          <li class="nav-item has-treeview  @if($title=='Billing Report' || $title=='Report' || $title=='Inventory Report') menu-open @endif">
            <a href="#" class="nav-link @if($title=='Billing Report' || $title=='Report' || $title=='Inventory Report') active @endif">
              <i class="nav-icon fas fa-archive"></i>
              <p>
                Reports
                <i class="right fas fa-angle-down"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="padding:0 0 0 20px;background-color: #45505a">
              <li class="nav-item">
                <a href="/dashboard/billingreport" class="nav-link @if($title=='Billing Report') active @endif">
                  <i class="nav-icon fas fa-book"></i>
                  <p>
                    Billing Report
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/dashboard/report" class="nav-link @if($title=='Report') active @endif">
                  <i class="nav-icon fas fa-book"></i>
                  <p>
                    Sales Report
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/dashboard/inventoryreport" class="nav-link @if($title=='Inventory Report') active @endif">
                  <i class="nav-icon fas fa-book"></i>
                  <p>
                    Inventory Report
                  </p>
                </a>
              </li>
            </ul>
          </li>

          


          
            @endif

      
          

          <li class="nav-item has-treeview  @if($title=='System Logs' || $title=='Database Backup/Restore' || $title=='Product Unit' || $title=='Product Category' || $title =='Attachments Category'  || $title =='Services' || $title =='Account') menu-open @endif">
            <a href="#" class="nav-link @if($title=='System Logs' || $title=='Database Backup/Restore') active @endif">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Settings
                <i class="right fas fa-angle-down"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="padding:0 0 0 20px;background-color: #45505a">
                @if(Auth::user()->role == 'doctor')
              <li class="nav-item">
                <a href="/dashboard/account" class="nav-link @if($title=='Account') active @endif">
                  <i class="nav-icon fas fa-key"></i>
                  <p>
                    Account
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/dashboard/services" class="nav-link @if($title=='Services') active @endif">
                  <i class="nav-icon fas fa-paw"></i>
                  <p>
                    Services
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/dashboard/attachmentcategory" class="nav-link @if($title=='Attachments Category') active @endif">
                  <i class="nav-icon fas fa-folder"></i>
                  <p>
                    Attachments Category
                  </p>
                </a>
              </li>
              @endif
              <li class="nav-item">
                 <a href="/dashboard/productcategory" class="nav-link  @if($title=='Product Category') active @endif">
                  <i class="nav-icon fa fa-tags"></i>
                  <p>Product Category</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="/dashboard/productunit" class="nav-link  @if($title=='Product Unit') active @endif">
                  <i class="nav-icon fa  fa-balance-scale"></i>
                  <p>Product Unit</p>
                </a>
              </li>
             
                @if(Auth::user()->role == 'doctor')
              <li class="nav-item">
            <a href="/dashboard/systemlog" class="nav-link @if($title=='System Logs') active @endif">
              <i class="nav-icon fas fa-history"></i>
              <p>
                System Log
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/dashboard/database" class="nav-link @if($title=='Database Backup/Restore') active @endif">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Database
              </p>
            </a>
          </li>
          @endif
            </ul>
          </li>

          
      
        </ul>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    <div class="content">
      <div class="container">
        <br/ >
        
        @yield('content')
        <br />
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Made with 💕 Laravel 5.8 Framework
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019-2020 <a href="{{url('/')}}" class="text-info">Vet Assistant</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('adminlte3/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('adminlte3/plugins/moment/moment.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('adminlte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte3/dist/js/adminlte.js')}}"></script>
<!-- for mobile browsers -->
<script src="{{asset('adminlte3/plugins/fastclick/fastclick.js')}}"></script>
<script type="text/javascript">
  var printtype = '<?php echo $title; ?>';
</script>
<script type="text/javascript">
  //Timepicker
  $('#timepicker').datetimepicker({
    format: 'LT'
  })
  $('#datepicker').datetimepicker({
    format: 'L'
  })
</script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote({height:200})
  })
</script>
<script>
// This will toggle fullscreen by on or off
  var fs = false;
  function togglefs(){
    if(fs == false){
      openFullscreen();
      fs = true;
    }if(fs == true){
      closeFullscreen();
      fs = false;
    }
  }
/* Get the documentElement (<html>) to display the page in fullscreen */
var elem = document.documentElement;

/* View in fullscreen */
function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) { /* Firefox */
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE/Edge */
    elem.msRequestFullscreen();
  }
}

/* Close fullscreen */
function closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.mozCancelFullScreen) { /* Firefox */
    document.mozCancelFullScreen();
  } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE/Edge */
    document.msExitFullscreen();
  }
}
</script>
  @include('sweetalert::alert')
  @if($errors->any())
    @foreach($errors->all() as $error)
      <script type="text/javascript">
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });
          Toast.fire({
            type: 'error',
            title: '{{$error}}'
          });
      </script>
    @endforeach
  @endif
<script type="text/javascript">
  $(document).on('click', '.btn-submit', function(e){
    e.preventDefault();
      var form = $(this).parents('form');
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          form.submit();
        }
      });
  });
</script>

<script type="text/javascript">
  $('#btnLogout').click(function(){
      
      $.ajax({
            type: "POST",
            url: '/home/logout',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: "json",
            data: {status: 1},
            success: function(data){
             
          
            },
         
        });
  });
</script>

<!-- DataTables -->
<script src="{{asset('adminlte3/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte3/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('adminlte3/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pjax/pjax.min.js"></script>
<script type="text/javascript">
  var pjax = new Pjax({
  elements: "a", // default is "a[href], form[action]"
  selectors: ["title","body"]
})

</script> -->

<script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('adminlte3/plugins/select2/js/select2.full.min.js')}}"></script>
<script type="text/javascript">
  //Initialize Select2 Elements
  $('.select2').select2();

</script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script> -->
<script type="text/javascript" src="{{asset('adminlte3/dist/js/dttprint.js')}}"></script>
<script>
  $(function () {
    $("#productlist").DataTable();
     $("#productlist2").DataTable();
      $("#servicelist").DataTable();
      $("#table2").DataTable();
   
    
  });
</script>
<script type="text/javascript">
  $(document).on('click','.ptb',function(){
    let id = $(this).attr('id');
    window.location.href = "<?php echo url('/'); ?>/dashboard/billing/"+id+"/client/create";
  });


</script>
<script>
    $(document).ready(function() {
        var d = new Date();
        var getsdate = d.getMonth()+' / '+d.getDate()+' / '+d.getFullYear();
       var user1 = '<?php echo Auth::user()->name; ?>';

        // DataTable initialisation
        $('#table').DataTable({
            "dom": 'Bfrtilp',
            "paging": true,
            "autoWidth": true,
            "columnDefs": [{
                "visible": true,
                "targets": -1
            }],
            buttons: ['copy','excel','csv','pdf',{
                extend: 'print',
                autoPrint: true,
                title: '',

                //For repeating heading.
                repeatingHead: {
                    logo: 'https://i.imgur.com/2arTww8.png',
                    logoPosition: 'float-left',
                    logoStyle: 'width:30%',
                    title: '<h3>Dr S & J Veterinary Clinic and Grooming Centre</h3>',
                    dates: getsdate,
                    users: user1,
                    reporttype: printtype
                }
            }]
        });
    });
</script>
<script type="text/javascript">
	$('#tableapplist').DataTable({
		
		"aaSorting": [[3,'desc']]
	});
</script>
@yield('script','')
</body>
</html>
