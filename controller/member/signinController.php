<?php
    include '../../query/connect.php';
    $dbConnect = new connect();
    $conn = $dbConnect->get_conn();
    // $this->load->library('form_validation');

    //////////////////////////////검사///////////////////////////////////////////
    // 
    //넘어온 데이터 저장
    $id = $_POST['memid']; 
    $pw = $_POST['mempw'];
    $cpw = $_POST['memcpw'];
    $firstname = $_POST['memfirstname'];
    $lastname = $_POST['memlastname'];
    $birth = $_POST['membirth'];
    $addr = $_POST['memaddr'];
    $nickname = $_POST['memnickname'];
    $email = $_POST['eemail']; 
    $email2 = $_POST['eemail2']; 
    $phonenum = $_POST['phphonenum']; 
    $phonenum2 = $_POST['phphonenum2'];
    $agree = $_POST['memagree'];
 
    
    if(strlen($id) == 0){
        echo "<script>alert(\"아이디를 입력하세요\");location.replace('../../view/member/signinView.php');</script>";
     }
    else{
        //중복 검사
        $sql = "SELECT * FROM member WHERE memid='$id'";
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);    
        if($count != 0){
            echo "<script>alert(\"아이디가 존재합니다\");location.replace('../../view/member/signinView.php');</script>";
        }
    }

    //pw 검사
    if(strlen($pw) == 0){
        echo "<script>alert(\"비밀번호를 입력하세요\");location.replace('../../view/member/signinView.php');</script>";
    }

    //cpw 검사
    if(strlen($cpw) == 0){
        echo "<script>alert(\"비밀번호를 확인해주세요\");location.replace('../../view/member/signinView.php');</script>";
    }
    else{
        if($pw != $cpw){
            echo "<script>alert(\"비밀번호를 확인해주세요\");location.replace('../../view/member/signinView.php');</script>";
        }
    }

    //이름 검사
    if(strlen($firstname) == 0){
        echo "<script>alert(\"성을 입력해주세요\");location.replace('../../view/member/signinView.php');</script>";
    }
    
    if(strlen($lastname) == 0){
        echo "<script>alert(\"이름을 입력해주세요\");location.replace('../../view/member/signinView.php');</script>";
    }

    if(strlen($birth) == 0){
        echo "<script>alert(\"생일을 입력해주세요\");location.replace('../../view/member/signinView.php');</script>";
    }
    else{
        if (preg_match('/[^\d]/',$birth)) {
            echo "<script>alert(\"생일은 숫자만 입력해주세요\");location.replace('../../view/member/signinView.php');</script>";
        }
        else if(strlen($birth)<8){
            echo "<script>alert(\"생일을 형식에 맞게 입력해주세요\");location.replace('../../view/member/signinView.php');</script>";
        }
    }

    if(strlen($addr) == 0){
        echo "<script>alert(\"주소를 입력해주세요\");location.replace('../../view/member/signinView.php');</script>";
    }
    
    //email 검사
    if(strlen($email)==0){
        echo "<script>alert(\"이메일을 입력해주세요\");location.replace('../../view/member/signinView.php');</script>";
    }
    else{
        $sql = "SELECT * FROM emaillist WHERE eemail='$email'";
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);
        //중복확인
        if($count!=0){
            echo "<script>alert(\"이메일이 이미 존재합니다\");location.replace('../../view/member/signinView.php');</script>";
        }
    }

    if(strlen($email2)!=0){
        $sql = "SELECT * FROM emaillist WHERE eemail='$email2'";
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);
        //중복확인
        if($count!=0){
            echo "<script>alert(\"이메일이 이미 존재합니다\");location.replace('../../view/member/signinView.php');</script>";
        }
    }

    if(strlen($phonenum)==0){
        echo "<script>alert(\"전화번호를 입력해주세요\");location.replace('../../view/member/signinView.php');</script>";
    }
    else{
        if(preg_match('/[^\d]/',$phonenum)){
            echo "<script>alert(\"전화번호는 숫자만 입력해주세요\");location.replace('../../view/member/signinView.php');</script>";
        }
        else{
            if(strlen($phonenum)<11){
                echo "<script>alert(\"전화번호를 형식에 맞게 입력해주세요\");location.replace('../../view/member/signinView.php');</script>";
            }
            $sql = "SELECT * FROM phone WHERE phphonenum='$phonenum'";
            $result = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($result);
            //중복확인
            if($count!=0){
                echo "<script>alert(\"전화번호가 이미 존재합니다\");location.replace('../../view/member/signinView.php');</script>";
            }
        }
    }

    if(strlen($phonenum2)!=0){
        if(preg_match('/[^\d]/',$phonenum2)){
            echo "<script>alert(\"전화번호는 숫자만 입력해주세요\");location.replace('../../view/member/signinView.php');</script>";
        }
        else{
            if(strlen($phonenum2)<11){
                echo "<script>alert(\"전화번호를 형식에 맞게 입력해주세요\");location.replace('../../view/member/signinView.php');</script>";
            }
            $sql = "SELECT * FROM phone WHERE phphonenum='$phonenum2'";
            $result = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($result);
            //중복확인
            if($count!=0){
                echo "<script>alert(\"전화번호가 이미 존재합니다\");location.replace('../../view/member/signinView.php');</script>";
            }
            
        }
    }

    if(strlen($nickname)==0){
        echo "<script>alert(\"닉네임을 입력해주세요\");location.replace('../../view/member/signinView.php');</script>";
    }
    else{
            $sql = "SELECT * FROM member WHERE memnickname='$nickname'";
            $result = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($result);
            //중복확인
            if($count!=0){
                echo "<script>alert(\"닉네임이 이미 존재합니다\");location.replace('../../view/member/signinView.php');</script>";
            }
    }


    




    echo "<script>alert(\"회원가입 되었습니다!\");location.replace('../../view/board/listView.php');</script>";


    /////////////////////////////////여기부터 해야됨

        
    // $this->form_validation->set_rules('eemail', 'Email', 'required|trim|is_unique[emaillist.eemail]');
    // $this->form_validation->set_rules('eemail2', 'Email2', 'trim|is_unique[emaillist.eemail]');
        
    // $this->form_validation->set_rules('phphonenum', 'Phone number', 'required|trim|numeric|min_length[11]|is_unique[phone.phphonenum]');
    // $this->form_validation->set_rules('phphonenum', 'Phone number', 'trim|numeric|min_length[11]|is_unique[phone.phphonenum]');    

    // $this->form_validation->set_rules('memnickname', 'Nick name', 'required|trim|is_unique[member.memnickname]'); 

    // $this->form_validation->set_rules('memagree', 'Agree', 'required|trim|xss_clean');

    // //회원가입 성공
    // if ($this->form_validation->run())  
    // {   
    //     //echo "Welcome, you are logged in.";

    //     //넘어온 데이터 저장
    //     $id = $this->input->post('memid'); 
    //     $pw = $this->input->post('mempw');
    //     $firstname = $this->input->post('memfirstname');
    //     $lastname = $this->input->post('memlastname');
    //     $birth = $this->input->post('membirth');
    //     $addr = $this->input->post('memaddr');
    //     $nickname = $this->input->post('memnickname');
    //     $email = $this->input->post('eemail'); 
    //     $email2 = $this->input->post('eemail2'); 
    //     $phonenum = $this->input->post('phphonenum'); 
    //     $phonenum2 = $this->input->post('phphonenum2');
    //     $agree = $this->input->post('memagree');
    //     if($agree=="Agree") {
    //         $agree = 1;
    //     }
    //     else{
    //         $agree = 0;
    //     }

    //    //member table에 저장
    //     $this->load->library('query/modules/member/memberinsert');
    //     $this->memberinsert->mem_insert($this->conn, $id, $pw, $firstname, $lastname, $birth, $addr, $nickname, $agree);

    //     $this->load->library('query/modules/member/memberselect');
    //     $row = $this->memberselect->select_memseq($this->conn, $id);
    //     $memseq = $row['memseq'];

    //     $this->memberinsert->email_insert($this->conn, $memseq, $email);

    //     //email이 두개면
    //     if($email2!=NULL){
    //         $this->memberinsert->email_insert($this->conn, $memseq, $email2);
    //     }

    //     $this->memberinsert->phone_insert($this->conn, $memseq, $phonenum);
    //     //phonenum이 두개면
    //      if($phonenum2!=NULL){
    //         $this->memberinsert->phone_insert($this->conn, $memseq, $phonenum2);
    //      }
    //      echo "<script>alert('회원가입 성공!');</script>";
    //      $this->load->view('../../view/board/listView');
    // } 

    // //회원가입 실패
    // else {  
    //     $this->load->view('../../view/member/signinView');  
    // }  

?>