<?php
include_once(__DIR__."/DB.php");
$post_data = json_decode(file_get_contents("php://input"),true);
$Method = $_SERVER['REQUEST_METHOD'];

class Covid_info_controller extends DB{

    public function insert_covid_info($post_data){
        $certificate_no =  $post_data['certificate_no'];
        $nid_no =  $post_data['nid_no'];
        $passport_no =  $post_data['passport_no'];
        $nationality =  $post_data['nationality'];
        $name =  $post_data['name'];
        $date_of_birth =  $post_data['date_of_birth'];
        $gender =  $post_data['gender'];
        $dose_first =  $post_data['dose_first'];
        $dose_first_date =  $post_data['dose_first_date'];
        $dose_second =  $post_data['dose_second'];
        $dose_second_date =  $post_data['dose_second_date'];
        $dose_third =  $post_data['dose_third'];
        $dose_third_date =  $post_data['dose_third_date'];
        $total_dose =  $post_data['total_dose'];
        $center =  $post_data['center'];
        $vaccinated_by =  $post_data['vaccinated_by'];
  
        $sql ="INSERT INTO `covid_info`(`certificate_no`, `nid_no`,`passport_no`,`nationality`,`name`,`date_of_birth`,`gender`,`dose_first`,`dose_first_date`,`dose_second`,`dose_second_date`,`dose_third`,`dose_third_date`,`total_dose`,`center`,`vaccinated_by`) VALUES(:certificate_no,:nid_no,:passport_no,:nationality,:name,:date_of_birth,:gender,:dose_first,:dose_first_date,:dose_second,:dose_second_date,:dose_third,:dose_third_date,:total_dose,:center,:vaccinated_by)";
        $stmt= $this->CON->prepare($sql);
        $stmt->execute(['certificate_no'=>$certificate_no,'nid_no'=>$nid_no,'passport_no'=>$passport_no,'nationality'=>$nationality,'name'=>$name,
        'date_of_birth'=>$date_of_birth,'gender'=>$gender,'dose_first'=>$dose_first,'dose_first_date'=>$dose_first_date,'dose_second'=>$dose_second,'dose_second_date'=>$dose_second_date,'dose_third'=>$dose_third,'dose_third_date'=>$dose_third_date,'total_dose'=>$total_dose,'center'=>$center,'vaccinated_by'=>$vaccinated_by]);
        return true;


    }


    public function edit_covid_info($post_data){
        $certificate_no =  $post_data['certificate_no'];
        $nid_no =  $post_data['nid_no'];
        $passport_no =  $post_data['passport_no'];
        $nationality =  $post_data['nationality'];
        $name =  $post_data['name'];
        $date_of_birth =  $post_data['date_of_birth'];
        $gender =  $post_data['gender'];
        $dose_first =  $post_data['dose_first'];
        $dose_first_date =  $post_data['dose_first_date'];
        $dose_second =  $post_data['dose_second'];
        $dose_second_date =  $post_data['dose_second_date'];
        $dose_third =  $post_data['dose_third'];
        $dose_third_date =  $post_data['dose_third_date'];
        $total_dose =  $post_data['total_dose'];
        $center =  $post_data['center'];
        $vaccinated_by =  $post_data['vaccinated_by'];
        $id =  $post_data['id'];
    
        $sql ="UPDATE `covid_info` SET `certificate_no`=:certificate_no, `nid_no`=:nid_no,`passport_no`=:passport_no,`nationality`=:nationality,`name`=:name,`date_of_birth`=:date_of_birth,`gender`=:gender,`dose_first`=:dose_first,`dose_first_date`=:dose_first_date,`dose_second`=:dose_second,`dose_second_date`=:dose_second_date,`dose_third`=:dose_third,`dose_third_date`=:dose_third_date,`total_dose`=:total_dose,`center`=:center,`vaccinated_by`=:vaccinated_by WHERE id=:id" ;
        $stmt= $this->CON->prepare($sql);
        $stmt->execute(['certificate_no'=>$certificate_no,'nid_no'=>$nid_no,'passport_no'=>$passport_no,'nationality'=>$nationality,'name'=>$name,'date_of_birth'=>$date_of_birth,'gender'=>$gender,'dose_first'=>$dose_first,'dose_first_date'=>$dose_first_date,'dose_second'=>$dose_second,'dose_second_date'=>$dose_second_date,'dose_third'=>$dose_third,'dose_third_date'=>$dose_third_date,'total_dose'=>$total_dose,'center'=>$center,'vaccinated_by'=>$vaccinated_by,'id'=>$id]);
        return true;


    }


    public function List_covid_page(){
        $sql = "SELECT * FROM `covid_info`  ORDER BY `id` DESC";
        $stmt = $this->CON->prepare($sql);

        $stmt->execute([]);
        
         if($stmt->rowCount() >0){

            return $stmt;
        }else{
            return false;
        }
      
        return;
    }

    public function get_by_id($id){
        $sql = "SELECT * FROM `covid_info` WHERE id=:id";
        $stmt = $this->CON->prepare($sql);

        $stmt->execute(['id'=>$id]);
        
         if($stmt->rowCount() >0){

            return $stmt;
        }else{
            return false;
        }
      return;
        
    }



    public function delete_covid_info($id){
        $sql = "DELETE FROM  `covid_info` WHERE id = :id";
        $stmt= $this->CON->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return true;
    }


}
$obj_Covid_inf = new Covid_info_controller();

if($Method=='POST' && !empty($post_data['id'])){
    if($obj_Covid_inf->edit_covid_info($post_data) == true){
        echo json_encode(array('message'=>'updated Successfully','condition'=>true));
        
    }else{
        echo json_encode(array('message'=>'updated failed','condition'=>false));

    }
    return ;
}



if($Method=='POST'){
    if($obj_Covid_inf->insert_covid_info($post_data) == true){
        echo json_encode(array('message'=>'uploaded Successfully','condition'=>true));
        
    }else{
        echo json_encode(array('message'=>'upload failed','condition'=>false));

    }
    return ;
}


if($Method=='GET' && !empty($_GET['del_id'])){
   if($obj_Covid_inf->delete_covid_info($_GET['del_id'])==true){

    echo json_encode(array('message'=>'Delete Successfully','condition'=>true));
        
}else{
    echo json_encode(array('message'=>'Delete failed','condition'=>false));

}



}


if( $Method=='GET' && isset($_GET['all_id'])){


    $fetch_data =   $obj_Covid_inf->get_by_id($_GET['all_id']);
    
    $log_json_data = array();

    while($row = $fetch_data ->fetch(PDO::FETCH_ASSOC)){	
        array_push($log_json_data,$row);
    }
    echo json_encode($log_json_data);
    }    


