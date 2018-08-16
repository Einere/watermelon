<?php
    include '../../common/dbconn.php';

    $search_text = $_POST['search_text'];
    $search_choice = $_POST['search_choice'];

    echo $search_choice.'<br>'.$search_text;
    if($search_choice=='search_title'){

    }
    else if($search_choice=='search_content'){

    }
    else if($search_choice=='search_all'){
        
    }
    //writer
    else{
        
    }


?>