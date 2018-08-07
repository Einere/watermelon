<?php
    // $this->load->library('form_validation');

    //////////////////////////////검사///////////////////////////////////////////
    // 
    $id = $_POST['memid'];
 
    // if(!$conn){
    //     echo "not connect DB";
    // }
    
    $sql = "SELECT * FROM $db_table WHERE id='$id'";
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);
    
    if($id == ''){
        echo "<script>alert(\"아이디를 입력하세요\");</script>";
        $this->load->view('../../view/member/signinView');
    }
    else{    
        if($count != 0){
            echo "<script>alert(\"아이디가 존재합니다\");</script>";
            $this->load->view('../../view/member/signinView');
        }
    }

    /////////////////////////////////여기부터 해야됨

    $this->form_validation->set_rules('mempw', 'Password', 'required|trim|alpha_numeric');  

    $this->form_validation->set_rules('memcpw', 'Confirm Password', 'required|trim|matches[mempw]'); 

    $this->form_validation->set_rules('memfirstname', 'First name', 'required|trim');  

    $this->form_validation->set_rules('memlastname', 'Last name', 'required|trim');  

    $this->form_validation->set_rules('membirth', 'Birth day', 'required|trim|numeric|min_length[8]');
        
    $this->form_validation->set_rules('memaddr', 'Address', 'required|trim');
        
    $this->form_validation->set_rules('eemail', 'Email', 'required|trim|is_unique[emaillist.eemail]');
    $this->form_validation->set_rules('eemail2', 'Email2', 'trim|is_unique[emaillist.eemail]');
        
    $this->form_validation->set_rules('phphonenum', 'Phone number', 'required|trim|numeric|min_length[11]|is_unique[phone.phphonenum]');
    $this->form_validation->set_rules('phphonenum', 'Phone number', 'trim|numeric|min_length[11]|is_unique[phone.phphonenum]');    

    $this->form_validation->set_rules('memnickname', 'Nick name', 'required|trim|is_unique[member.memnickname]'); 

    $this->form_validation->set_rules('memagree', 'Agree', 'required|trim|xss_clean');

    //회원가입 성공
    if ($this->form_validation->run())  
    {   
        //echo "Welcome, you are logged in.";

        //넘어온 데이터 저장
        $id = $this->input->post('memid'); 
        $pw = $this->input->post('mempw');
        $firstname = $this->input->post('memfirstname');
        $lastname = $this->input->post('memlastname');
        $birth = $this->input->post('membirth');
        $addr = $this->input->post('memaddr');
        $nickname = $this->input->post('memnickname');
        $email = $this->input->post('eemail'); 
        $email2 = $this->input->post('eemail2'); 
        $phonenum = $this->input->post('phphonenum'); 
        $phonenum2 = $this->input->post('phphonenum2');
        $agree = $this->input->post('memagree');
        if($agree=="Agree") {
            $agree = 1;
        }
        else{
            $agree = 0;
        }

       //member table에 저장
        $this->load->library('query/modules/member/memberinsert');
        $this->memberinsert->mem_insert($this->conn, $id, $pw, $firstname, $lastname, $birth, $addr, $nickname, $agree);

        $this->load->library('query/modules/member/memberselect');
        $row = $this->memberselect->select_memseq($this->conn, $id);
        $memseq = $row['memseq'];

        $this->memberinsert->email_insert($this->conn, $memseq, $email);

        //email이 두개면
        if($email2!=NULL){
            $this->memberinsert->email_insert($this->conn, $memseq, $email2);
        }

        $this->memberinsert->phone_insert($this->conn, $memseq, $phonenum);
        //phonenum이 두개면
         if($phonenum2!=NULL){
            $this->memberinsert->phone_insert($this->conn, $memseq, $phonenum2);
         }
         echo "<script>alert('회원가입 성공!');</script>";
         $this->load->view('../../view/board/listView');
    } 

    //회원가입 실패
    else {  
        $this->load->view('../../view/member/signinView');  
    }  

?>