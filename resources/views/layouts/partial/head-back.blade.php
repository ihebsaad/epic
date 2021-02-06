 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="eSolutions">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{  URL::asset('public/img/favicon.png') }}">
    <meta charset="UTF-8">
    <title>
        @section('title')
              SAAMP
        @show
    </title>
	
<style>
.btn-primary{background-color:#e29d09;}
.brn-success{background-color:#0054f3;}
#headtable th{color:black;}

 .form-control {display:inline!important;}
.select2-container--default .select2-selection--single {    
    height: 38px!important;
    padding-top: 5px!important;
}

 #mytable_filter{right:30px!important;position:absolute!important;}
     #swal2-content{font-size:15px;}
	 .editor{width:800px;}
	table, #mytable{display:table !important;width:100%!important;margin-top:10px !important;border:1px solid lightgrey;}
 	
	.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
    z-index: 3;
    color: #fff;
    cursor: default;
    background-color: #337ab7;
    border-color: #337ab7;
}
.pagination>li>a, .pagination>li>span {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #337ab7;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
	margin-top:12px;
}
#mytable_length select{margin-left:5px;margin-right:5px;}
 .metal{height:50px;padding-top:15px;margin-bottom:10px;color:white;}
 
 select:disabled ,  button:disabled ,.form-control:disabled{opacity:0.4!important; }
 .searchfield{width:100px;}
		 #mytable{width:100%!important;margin-top:10px !important;}


     </style>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      <!-- CSRF Token -->
 {{ csrf_field() }}
 
     <script src="{{ URL::asset('public/sbadmin/vendor/jquery/jquery.min.js')}}"></script>

 <!--<script src="{{ URL::asset('public/sbadmin/vendor/jquery/jquery.min.js')}}"></script> -->
 <!-- Bootstrap core JavaScript -->

<!-- --------->

<?php /*  if  ($view_name != 'home')   {  ?>
   <script  src="{{ asset('public/js/jquery-3.5.1.js') }}"  type="text/javascript"></script>  

<!--<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>-->
<?php } */ ?>
       <!-- CSS DAtatable  

<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/dataTables.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/buttons.bootstrap.css') }}" />
 <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/scroller.bootstrap.css') }}" />
 -->
  <link  href="{{ asset('public/sbadmin/datatables/dataTables.bootstrap4.css') }}"  rel="stylesheet">

 
   <link rel="stylesheet" href="{{ URL::asset('public/bootstrap/css/bootstrap.min.css') }}">
  
 <link href="{{ URL::asset('public/css/datepicker.css') }}" rel="stylesheet">
  
  <link rel="stylesheet" href="{{ URL::asset('public/front/css/default.css') }}">

    <!-- include alertify css -->

<link rel="stylesheet" href="{{ URL::asset('resources/assets/css/alertify.css') }}">
<link rel="stylesheet" href="{{ URL::asset('resources/assets/css/alertify-bootstrap.css') }}">


<!-- include alertify script
<script src="{{ URL::asset('resources/assets/js/alertify.js') }}"></script>
 <!-- include notify script -->


  
 <link href="{{ asset('public/js/select2/css/select2.css') }}" rel="stylesheet" type="text/css"/>
 <link href="{{ asset('public/js/select2/css/select2-bootstrap.css') }}" rel="stylesheet" type="text/css"/>

 
<script>
/* if(parseInt(window.screen.availWidth) < 1024 ) 
 { //alert('mobile');
	// $('#sidebarToggleTop').trigger('click');
	
 //   $("body").toggleClass("sidebar-toggled");
    $("body").addClass("sidebar-toggled");
 //   $(".sidebar").toggleClass("toggled");
    $(".sidebar").addClass("toggled");
 	
 }else{
	// alert('desktop');
 }
 */
  $(document).ready(function(){
 if(parseInt(window.screen.availWidth) < 1024 ) 
 {   
 // $('#sidebarToggleTop').trigger('click');
 $("body").toggleClass("sidebar-toggled");
  //  $("body").addClass("sidebar-toggled");
 $(".sidebar").toggleClass("toggled");
  //  $(".sidebar").addClass("toggled");
 	
 }else{
	 
  }
	}); 
</script>
 
  <!-- Custom fonts for this template-->
  <link href="{{ asset('public/sbadmin/fontawesome-free/css/all.min.css') }}"    rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link  href="{{ asset('public/sbadmin/css/sb-admin-2.css') }}"    rel="stylesheet">
  
    <!-- Responsive-->
  <link  href="{{ asset('public/css/responsive.css') }}"    rel="stylesheet">
  
 <script src="{{ URL::asset('public/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
 <!-- Core plugin JavaScript -->
 <script src="{{ URL::asset('public/sbadmin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

</head>