<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
 header('location:logout.php');
  } else{
if(isset($_POST['submit']))
  {
    
    $vid=$_GET['viewid'];
    $bp=$_POST['bp'];
    $bs=$_POST['bs'];
    $weight=$_POST['weight'];
    $temp=$_POST['temp'];
   $pres=$_POST['pres'];
   
 
      $query.=mysqli_query($con, "insert   tblmedicalhistory(PatientID,BloodPressure,BloodSugar,Weight,Temperature,MedicalPres)value('$vid','$bp','$bs','$weight','$temp','$pres')");
    if ($query) {
    echo '<script>alert("Medikal Geçmişiniz Eklendi.")</script>';
    echo "<script>window.location.href ='manage-patient.php'</script>";
  }
  else
    {
      echo '<script>alert("Bir şeyler yanlış gitti. Lütfen tekrar deneyin")</script>';
    }

  
}

?>
<!DOCTYPE html>
<html lang="tr">
	<head>
		<title>Doktor | Hastaları Yönet</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
	</head>
	<body>
		<div id="app">		
<?php include('include/sidebar.php');?>
<div class="app-content">
<?php include('include/header.php');?>
<div class="main-content" >
<div class="wrap-content container" id="container">
						
<section id="page-title">
<div class="row">
<div class="col-sm-8">
<h1 class="mainTitle">Doktor | Hastaları Yönet</h1>
</div>
<ol class="breadcrumb">
<li>
<span>Doktor</span>
</li>
<li class="active">
<span>Hastaları Yönet</span>
</li>
</ol>
</div>
</section>
<div class="container-fluid container-fullw bg-white">
<div class="row">
<div class="col-md-12">
<h5 class="over-title margin-bottom-15"><span class="text-bold">Hastaları Yönet</span></h5>
<?php
                               $vid=$_GET['viewid'];
                               $ret=mysqli_query($con,"select * from tblpatient where ID='$vid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
                               ?>
<table border="1" class="table table-bordered">
 <tr align="center">
<td colspan="4" style="font-size:20px;color:blue">
Hasta Detayları</td></tr>

    <tr>
    <th scope>Hasta Adı</th>
    <td><?php  echo $row['PatientName'];?></td>
    <th scope>E-Posta</th>
    <td><?php  echo $row['PatientEmail'];?></td>
  </tr>
  <tr>
    <th scope>Telefon</th>
    <td><?php  echo $row['PatientContno'];?></td>
    <th>Adres</th>
    <td><?php  echo $row['PatientAdd'];?></td>
  </tr>
    <tr>
    <th>Cinsiyet</th>
    <td><?php  echo $row['PatientGender'];?></td>
    <th>Hastanın Yaşı</th>
    <td><?php  echo $row['PatientAge'];?></td>
  </tr>
  <tr>
    
    <th>Hastanın Medikal Geçmişi (varsa)</th>
    <td><?php  echo $row['PatientMedhis'];?></td>
     <th>Hasta Kayıt Tarihi</th>
    <td><?php  echo $row['CreationDate'];?></td>
  </tr>
 
<?php }?>
</table>
<?php  

$ret=mysqli_query($con,"select * from tblmedicalhistory  where PatientID='$vid'");



 ?>
<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  <tr align="center">
   <th colspan="8" >Medikal Geçmiş</th> 
  </tr>
  <tr>
    <th>#</th>
<th>Tansiyon</th>
<th>Kilo</th>
<th>Şeker</th>
<th>Vücut Isısı</th>
<th>Reçete</th>
<th>Ziyaret Tarihi</th>
</tr>
<?php  
while ($row=mysqli_fetch_array($ret)) { 
  ?>
<tr>
  <td><?php echo $cnt;?></td>
 <td><?php  echo $row['BloodPressure'];?></td>
 <td><?php  echo $row['Weight'];?></td>
 <td><?php  echo $row['BloodSugar'];?></td> 
  <td><?php  echo $row['Temperature'];?></td>
  <td><?php  echo $row['MedicalPres'];?></td>
  <td><?php  echo $row['CreationDate'];?></td> 
</tr>
<?php $cnt=$cnt+1;} ?>
</table>

<p align="center">                            
 <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">Medikal Geçmiş Ekle</button></p>  

<?php  ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Medikal Geçmiş Ekle</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <table class="table table-bordered table-hover data-tables">

                                 <form method="post" name="submit">

      <tr>
    <th>Tansiyon :</th>
    <td>
    <input name="bp" placeholder="Tansiyon" class="form-control wd-450" required="true"></td>
  </tr>                          
     <tr>
    <th>Şeker :</th>
    <td>
    <input name="bs" placeholder="Şeker" class="form-control wd-450" required="true"></td>
  </tr> 
  <tr>
    <th>Kilo :</th>
    <td>
    <input name="weight" placeholder="Kilo" class="form-control wd-450" required="true"></td>
  </tr>
  <tr>
    <th>Vücut Isısı :</th>
    <td>
    <input name="temp" placeholder="Vücut Isısı" class="form-control wd-450" required="true"></td>
  </tr>
                         
     <tr>
    <th>Reçete :</th>
    <td>
    <textarea name="pres" placeholder="Reçete" rows="12" cols="14" class="form-control wd-450" required="true"></textarea></td>
  </tr>  
   
</table>
</div>
<div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
 <button type="submit" name="submit" class="btn btn-primary">Onayla</button>
  
  </form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
		
	<?php include('include/footer.php');?>
			
	<?php include('include/setting.php');?>
			
		
		</div>
	
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>

		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		
		<script src="assets/js/main.js"></script>
	
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		
	</body>
</html>
<?php }  ?>
