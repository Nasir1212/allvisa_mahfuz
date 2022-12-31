<?php
include_once(__DIR__."/DB.php");
$post_data = json_decode(file_get_contents("php://input"),true);
$Method = $_SERVER['REQUEST_METHOD'];

class Controller extends DB{

    public function auth_login($post_data){

        $email=  $post_data['email'];
        $password=  $post_data['password'];
        $sql = "SELECT * FROM `page_auth` WHERE `email`=:email AND `password`=:password";
        $stmt = $this->CON->prepare($sql);

        $stmt->execute(['email'=>$email,'password'=>$password]);
        
         if($stmt->rowCount() >0){

            return $stmt;
        }else{
            return false;
        }
       

    }

    public function insert_page($post_data){

        
       $heading=  $post_data['heading']; 
       $heading_bottom =   $post_data['heading_bottom'];  
       $left_title=  $post_data['left_title'] ; 
       $right_title =  $post_data['right_title'] ;
       $text_field =  $post_data['text_field'];
       $date =  $post_data['date'] ;
       $ref_no  = $post_data['ref_no'];  
       $page__id =  $post_data['page__id'];
       $left_title_top =  $post_data['left_title_top'];
       $right_title_top =  $post_data['right_title_top'];
       
        $sql ="INSERT INTO `create_page`(`heading`,`heading_bottom`,`left_title`,`right_title`,`text_field`,`date`,`ref_no`,`page__id`,`left_title_top`,`right_title_top`) VALUES(:heading,:heading_bottom,:left_title,:right_title,:text_field,:date,:ref_no,:page__id,:left_title_top,:right_title_top)";
        $stmt= $this->CON->prepare($sql);
        $stmt->execute(['heading'=>$heading,'heading_bottom'=>$heading_bottom,'left_title'=>$left_title,'right_title'=>$right_title,'text_field'=>$text_field,'date'=>$date,'ref_no'=>$ref_no,'page__id'=>$page__id,'left_title_top'=>$left_title_top,'right_title_top'=>$right_title_top]);
        return true;

  
   }
   
   public function delete_page_id($id){
       $sql = "DELETE FROM  `create_page` WHERE id = :id";
       $stmt= $this->CON->prepare($sql);
       $stmt->execute(['id'=>$id]);
       return true;
   }

   public function update_page($post_data){

   
    $heading=  $post_data['heading']; 
    $heading_bottom =   $post_data['heading_bottom'];  
    $left_title=  $post_data['left_title'] ; 
    $right_title =  $post_data['right_title'] ;
    $text_field =  $post_data['text_field'];
    $date =  $post_data['date'] ;
    $ref_no  = $post_data['ref_no'];  
    $table_id =  $post_data['table_id'];
    $left_title_top =  $post_data['left_title_top'];
    $right_title_top =  $post_data['right_title_top'];

     $sql ="UPDATE `create_page` SET `heading`=:heading,`heading_bottom`=:heading_bottom,`left_title`=:left_title,`right_title`=:right_title,`text_field`=:text_field,`date`=:date,`ref_no`=:ref_no ,`right_title_top`=:right_title_top , `left_title_top`=:left_title_top WHERE `id`=:table_id";
     $stmt= $this->CON->prepare($sql);
     $stmt->execute(['heading'=>$heading,'heading_bottom'=>$heading_bottom,'left_title'=>$left_title,'right_title'=>$right_title,'text_field'=>$text_field,'date'=>$date,'ref_no'=>$ref_no,'table_id'=>$table_id,'left_title_top'=>$left_title_top,'right_title_top'=>$right_title_top]);
    


    return true;
   }

    public function Read_page($page_id){
        $sql = "SELECT * FROM `create_page` WHERE page__id=:page__id";
        $stmt = $this->CON->prepare($sql);

        $stmt->execute(['page__id'=>$page_id]);
        
         if($stmt->rowCount() >0){

            return $stmt;
        }else{
            return false;
        }
      return;
        
    }

    public function heading_Read_page(){
        $sql = "SELECT * FROM `create_page`  ORDER BY `id` DESC";
        $stmt = $this->CON->prepare($sql);

        $stmt->execute([]);
        
         if($stmt->rowCount() >0){

            return $stmt;
        }else{
            return false;
        }
      
        return;
    }

}

$obj_cont = new Controller();

if($Method=='POST' && !empty($post_data['table_id'])){
    if($obj_cont->update_page($post_data) == true){
        echo json_encode(array('message'=>'uploaded Successfully','condition'=>true));
        
    }else{
        echo json_encode(array('message'=>'upload failed','condition'=>false));

    }

    return;
}

if($Method=='GET' && !empty($_GET['del_id'])){
    if($obj_cont->delete_page_id($_GET['del_id']) == true){
        echo json_encode(array('message'=>'Delete Successfully','condition'=>true));
        
    }else{
        echo json_encode(array('message'=>'Delete failed','condition'=>false));

    }

    return;
}

if($Method=='POST' && !empty($post_data['heading'])  && !empty($post_data['heading_bottom'])  && !empty($post_data['left_title'])  && !empty($post_data['right_title'])  && !empty($post_data['text_field'])  && !empty($post_data['date'])  && !empty($post_data['ref_no']) && !empty($post_data['page__id']) && !empty($post_data['left_title_top']) && !empty($post_data['right_title_top'])){
    if($obj_cont->insert_page($post_data) == true){
        echo json_encode(array('message'=>'uploaded Successfully','condition'=>true));
        
    }else{
        echo json_encode(array('message'=>'upload failed','condition'=>false));

    }
    return ;
}

if($Method=='POST' && !empty($post_data['email']) && !empty($post_data['password'])){


$auth = $obj_cont->auth_login($post_data);

if(! $auth==false){
    $log_json_data = array();
    while($row = $auth->fetch(PDO::FETCH_ASSOC)){	
        array_push($log_json_data,$row);

    }
    echo json_encode(array('data'=>$log_json_data,'login_status'=>true));

}else{
    echo json_encode(array('message'=>'email or password not match','condition'=>false));
}


return;

}

