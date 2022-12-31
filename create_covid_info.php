<?php
include_once("BackEnd/Covid_info_controller.php");
 include_once("header.php");
?>

  <div class="content-wrapper" style="min-height: 274px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Create covid info</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create covid info </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    
    
    <div class="ml-3">
    							

    <form name="covid_info_insert">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="">Certificate No</label>
      <input type="text" class="form-control" name="certificate_no" placeholder="Certificate No">
    </div>
     <div class="form-group col-md-6">
      <label for="">NID Number</label>
      <input type="text" class="form-control" name="nid_no" placeholder="NID Number">
    </div>
     <div class="form-group col-md-6">
      <label for="">Passport  No</label>
      <input type="text" class="form-control" name="passport_no" placeholder="Passport No">
    </div>
     <div class="form-group col-md-6">
      <label for="">Nationality</label>
      <input type="text" class="form-control" name="nationality" placeholder="Nationality">
    </div>
     <div class="form-group col-md-6">
      <label for="">Name</label>
      <input type="text" class="form-control" name="name" placeholder="Name">
    </div>
     <div class="form-group col-md-6">
      <label for="">Date of Birth</label>
      <input type="text" class="form-control" name="date_of_birth" placeholder="Date of Birth">
    </div>
     <div class="form-group col-md-6">
      <label for="">Gender</label>
      <input type="text" class="form-control" name="gender" placeholder="Gender">
    </div>
     <div class="form-group col-md-6">
      <label for="">Date of Vaccination (Dose 1)</label>
      <input type="text" class="form-control"  name="dose_first_date"  placeholder="Date of Vaccination (Dose 1)">
    </div>
     <div class="form-group col-md-6">
      <label for="">Name of Vaccine (Dose 1)</label>
      <input type="text" class="form-control" name="dose_first" placeholder="Name of Vaccine (Dose 1)">
    </div>
     <div class="form-group col-md-6">
      <label for="">Date of Vaccination (Dose 2)</label>
      <input type="text" class="form-control" name="dose_second_date" placeholder="Date of Vaccination (Dose 2)">
    </div>
     <div class="form-group col-md-6">
      <label for="">Name of Vaccine (Dose 2)</label>
      <input type="text" class="form-control"   name="dose_second" placeholder="Name of Vaccine (Dose 2)">
    </div>

    <div class="form-group col-md-6">
      <label for="">Date of Vaccination (Dose 3)</label>
      <input type="text" class="form-control"   name="dose_third_date"  placeholder="Date of Vaccination (Dose 3)">
    </div>
     <div class="form-group col-md-6">
      <label for="">Name of Vaccine (Dose 3)</label>
      <input type="text" class="form-control" name="dose_third" placeholder="Name of Vaccine (Dose 3)">
    </div>

     <div class="form-group col-md-6">
      <label for="">Vaccination Center</label>
      <input type="text" class="form-control" name="center"  placeholder="Vaccination Center">
    </div>
     <div class="form-group col-md-6">
      <label for="">Vaccinated By</label>
      <input type="text" class="form-control" name="vaccinated_by" placeholder="Vaccinated By">
    </div>
     <div class="form-group col-md-6">
      <label for="">Total Doses Given</label>
      <input type="text" class="form-control" name="total_dose" placeholder="Total Doses Given">
    </div>
    
    
  </div>
  
  
  
  
  
  
  <button type="button" onclick="insert_covid_info()" class="btn btn-primary">Create New Covid Certificate</button>
</form>

    </div>
    <br/>
<script>
    function insert_covid_info(){
        let MyData = Object.fromEntries(new FormData(document.forms['covid_info_insert']));
      

        let url = "BackEnd/Covid_info_controller.php";
fetch(`${url}`,{
    method: 'POST',
    body: JSON.stringify(MyData)
})
.then(response => response.json())
.then(data => {
  console.log(data);
 
  if(data['condition']==true){
    swal("success", `${data['message']}`, "success");
    location.reload();
  }else {
    swal("Opps!",  `${data['message']}`, "error");
  }
})

    }
</script>

<?php include_once("footer.php") ?>
   