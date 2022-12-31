<?php
include_once("BackEnd/Controller.php");
 include_once("header.php");
?>

  <div class="content-wrapper" style="min-height: 274px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
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
           <th>Certificate</th>
          
           <th style="width:15rem">Action</th>
         </tr>
       </thead>
       <tbody>
         <?php
          $fetch_data =  $obj_cont->heading_Read_page();
          $i = 1;
          while($row = $fetch_data->fetch(PDO::FETCH_ASSOC)){
            $encode = base64_encode($row['page__id']);
            
           ?>
      
         <tr>
           <td><?php echo   $i++; ?></td>
           <td><?php echo   $row['text_field']; ?></td>
       
           <td>
           <a  class="btn btn-success"  href="edit_page.php?page__id=<?php echo   $encode  ?>" class="nav-link"> Edit </a>

           <button class="btn btn-danger" onclick="Page_delete(`<?php echo $row['id']; ?>`)" id="">Delete</button>  
           <button class="btn btn-success" onclick="copy_path(`xdx.php?dc=<?php echo  $encode ?>`)" id="">copy URL</button>  
           
          </td>
         </tr>
          <?php  }?>
       </tbody>
     </table>
   </div>
   <script>
     function Page_delete(d){
      let url = "BackEnd/Controller.php";
      
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

     
   </script>



    <?php

 include_once("footer.php");
?>

