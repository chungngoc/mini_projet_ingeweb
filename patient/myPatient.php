<?php
$content = '<div class="row">
<div class="col-xs-12">
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Patients List</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="patients" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th>Name</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Health_Condition</th>
        <th>Doctor_ID</th>
        <th>Nurse_ID</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
      <tr>
        <th>Name</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Health_Condition</th>
        <th>Doctor_ID</th>
        <th>Nurse_ID</th>
        <th>Action</th>
      </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
</div>
</div>';
session_start();

if (!isset($_SESSION['name'])) {
  $_SESSION['msg'] = "You must log in first";
  $host = $_SERVER['HTTP_HOST'];
  $host = "http://" . $host . "/doctor/doc_login.php";
  header('location: ' . $host);
}

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['name']);
  header("location: doc_login.php");
}

$dashboard = "Doctor";
$content = '<div class="row">
<div class="col-xs-12">
<div class="box">
  <div class="box-header">
    <h3 class="box-title">List of my Patients</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="patients" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th>Name</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Health_Condition</th>
        <th>Doctor_ID</th>  
        <th>Nurse_ID</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
      <tr>
      <th>Name</th>
      <th>Phone</th>
      <th>Gender</th>
      <th>Health_Condition</th>
      <th>Doctor_ID</th>  
      <th>Nurse_ID</th>
      <th>Action</th>
      </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
</div>
</div>';
include('../master.php');
?>
<!-- page script -->
<script>

  // JQuery: AJAX : Appel Asynchrone
  $(document).ready(function() {
    $.ajax({
      type: "GET",
      url: "../api/patient/read_patient_by_doctorID.php",
      data: {
             id: <?php echo $_SESSION['doctor_id'] ?>
             },
      dataType: 'json',
      success: function(data) {
        var response = "";
        for (var user in data) {
          response += "<tr>" +
            "<td>" + data[user].name + "</td>" +
            "<td>" + data[user].phone + "</td>" +
            "<td>" + ((data[user].gender == 0) ? "Male" : "Female") + "</td>" +
            "<td>" + data[user].health_condition + "</td>" +
            "<td>" + data[user].doctor_id + "</td>" +
            "<td>" + data[user].nurse_id + "</td>" +
            "<td><a href='/patient/update.php?id=" + data[user].id + "'>Edit</a> | <a href='#' onClick=Remove('" + data[user].id + "')>Remove</a></td>" +
            "</tr>";
        }
        $(response).appendTo($("#patients")); //JQuery
      }
    });
  });

  function Remove(id) {
    var result = confirm("Are you sure you want to Delete the Patient Record?");
    if (result == true) {
      $.ajax({
        type: "POST",
        url: '../api/patient/delete.php',
        dataType: 'json',
        data: {
          id: id
        },
        error: function(result) {
          alert(result.responseText);
        },
        success: function(result) {
          if (result['status'] == true) {
            alert("Successfully Removed Patient!");
            window.location.href = '/patient';
          } else {
            alert(result['message']);
          }
        }
      });
    }
  }
</script>