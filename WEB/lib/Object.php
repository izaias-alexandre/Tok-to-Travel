<?php

namespace lib;
class Object{
    public function __construct($method = null, $all = true) {
        if($method == 'POST'){
            foreach($_POST as $ind => $val){
                $this->$ind = $val; 
            }
        }
               if(isset($_FILES)){
        if(isset($_FILES['logo']))
        {
           $aaa= array( 'logo' => $_FILES['logo']['name']);
           foreach ($aaa as $key=>$val)
               $this->$key = $val;
             $id_alb=0;
              $mkdir = 'content/site/img/logoParceiros/'.$id_alb.'/';
              //echo $mkdir;
              $situacao = false;
              while($situacao == false)
              {
               if(!is_dir($mkdir)){ 
              
  
  mkdir($mkdir, 0777);
$situacao = true;
}else{
$situacao = false;
$id_alb = $id_alb+1;
$mkdir = 'content/site/img/logoParceiros/'.$id_alb.'/';
}
}
              $upload_arquivo = $mkdir.$val;
                 if(move_uploaded_file($_FILES['logo']['tmp_name'], $upload_arquivo)){
                  
                   
                     $this->$key=$upload_arquivo;
                
                
}
               
            
        


}
    }
  }

}

