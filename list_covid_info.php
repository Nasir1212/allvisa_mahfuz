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
            <h1 class="m-0">list covid certificate</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">list covid certificate </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

   <div class="card">
     <table class="table table-striped">
       <thead>
         <tr>
           <th>#</th>
           <th>Name</th>

           <th>Certificate No</th>
           <th>NID No</th>
           <th>Passport No</th>
           <th>Action</th>
         </tr>
       </thead>
       <tbody>
         <?php


          $fetch_data =  $obj_Covid_inf->List_covid_page();
          $i = 1;
          while($row = $fetch_data->fetch(PDO::FETCH_ASSOC)){
            $decode_id = base64_encode($row['id']);
          
           ?>
      
         <tr>
      
           <td><?php echo   $i++; ?></td>
           <td><?php echo   $row['name']; ?></td>

           <td><?php echo   $row['certificate_no']; ?></td>
           <td><?php echo   $row['nid_no']; ?></td>
           <td><?php echo   $row['passport_no']; ?></td>
           <td>
           <a  class="btn btn-success"  href="edit_covid_info.php?id=<?php echo   $row['id']  ?>" class="nav-link"> Edit </a>

           <button class="btn btn-danger" onclick="Page_delete(`<?php echo $row['id']; ?>`)" id="">Delete</button>  
           <button class="btn btn-info"  data-toggle="modal" data-target="#exampleModal" onclick="details_read(`<?php echo $row['id']; ?>`)" id="">All</button>  
           
           <button class="btn btn-success" onclick="copy_path(`http://localhost/createPage/surokkha.gov.bd_e.in/surokkha.gov.bd-e.in/foreigner-verify-online.html?cceerr=<?php echo   $decode_id ?>`)" id="">copy path</button>  
           
          </td>
         </tr>
          <?php  }?>
       </tbody>
     </table>
   </div>
   <script>
     function Page_delete(d){
      let url = "BackEnd/Covid_info_controller.php";
      
swal({
  title: "Are you sure to delete?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
   
fetch(`${url}?del_id=${d}`)
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
});
     }

     function copy_path(path){

     
  navigator.clipboard.writeText(path);
  

  Toastify({
  text: "path copyed",
  className: "info",
  style: {
    background: "linear-gradient(to right, #00b09b, #96c93d)",
  }
}).showToast();
  

     }


     function details_read(d){

      fetch(`BackEnd/Covid_info_controller.php?all_id=${d}`)
.then(response => response.json())
.then(data => {
  
console.log(data);

let temp =/*html */ `
<tr>
  <th scope="row">name</th>
  <td>${data[0]['name']}</td>
</tr>

<tr>
  <th scope="row">certificate no</th>
  <td>${data[0]['certificate_no']}</td>
</tr>

<tr>
  <th scope="row">passport no</th>
  <td>${data[0]['passport_no']}</td>
</tr>

<tr>
  <th scope="row">NID no</th>
  <td>${data[0]['nid_no']}</td>
</tr>

<tr>
  <th scope="row">date of birth</th>
  <td>${data[0]['date_of_birth']}</td>
</tr>

<tr>
  <th scope="row">gender</th>
  <td>${data[0]['gender']}</td>
</tr>

<tr>
  <th scope="row">dose first</th>
  <td>${data[0]['dose_first']}</td>
</tr>

<tr>
  <th scope="row">dose first date</th>
  <td>${data[0]['dose_first_date']}</td>
</tr>

<tr>
  <th scope="row">dose second</th>
  <td>${data[0]['dose_second']}</td>
</tr>

<tr>
  <th scope="row">dose second date</th>
  <td>${data[0]['dose_second_date']}</td>
</tr>

<tr>
  <th scope="row">dose third</th>
  <td>${data[0]['dose_third']}</td>
</tr>
<tr>
  <th scope="row">dose third date</th>
  <td>${data[0]['dose_third_date']}</td>
</tr>

<tr>
  <th scope="row">center</th>
  <td>${data[0]['center']}</td>
</tr>

<tr>
  <th scope="row">vaccinated by</th>
  <td>${data[0]['vaccinated_by']}</td>
</tr>

<tr>
  <th scope="row">total dose</th>
  <td>${data[0]['total_dose']}</td>
</tr>

<tr>
  <th scope="row">nationality</th>
  <td>${data[0]['nationality']}</td>
</tr>








`

document.getElementById("covid_info_show").innerHTML = temp;
  
})

  }


     
     
   </script>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table class="table table-striped">
  <thead>
    <!-- <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr> -->
  </thead>
  <tbody id="covid_info_show">
   
  </tbody>
</table>
      </div>
      
    </div>
  </div>
</div>

    <?php

 include_once("footer.php");
?>

