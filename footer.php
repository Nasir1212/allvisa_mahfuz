 <!-- /.content -->
 </div>
  
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022-2023 <a href="https://adminlte.io">Md.Mahfujor Rhaman</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<script>
   tinymce.init({
        selector: '#mytextarea'
      });

      function create_page(){

        let heading = document.getElementById("heading").innerText;
      let heading_bottom = document.getElementById("heading_bottom").innerText;
      let left_title = document.getElementById("left_title").innerText;
      let right_title = document.getElementById("right_title").innerText;
      let text_field =tinyMCE.get('mytextarea').getContent();
      let date = document.getElementById("date").innerText;
      let ref_no = document.getElementById("ref_no").innerText;
      let left_title_top = document.getElementById("left_title_top").innerText;
      let right_title_top = document.getElementById("right_title_top").innerText;
   
     let json_data = {
        heading:heading,
        heading_bottom:heading_bottom,
        left_title:left_title,
        right_title:right_title,
        text_field:text_field,
        text_field:text_field,
        date:date,
        ref_no:ref_no,
        left_title_top:left_title_top,
        right_title_top:right_title_top,
        page__id:Date.now()
      }

let url = "BackEnd/Controller.php";
fetch(`${url}`,{
    method: 'POST',
    body: JSON.stringify(json_data)
})
.then(response => response.json())
.then(data => {
 
  if(data['condition']==true){
    swal("success", `${data['message']}`, "success");
    location.reload();
  }else {
    swal("Opps!",  `${data['message']}`, "error");
  }
})


      }

   

</script>

</body>
</html>
