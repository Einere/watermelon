<!DOCTYPE html>
<html>

<head>
	<title>Sign Up Page</title>
	<style>
		body {
			font-family: Arial, Helvetica, sans-serif;
		}

		/* The Modal (background) */

		.modal {
			display: none;
			/* Hidden by default */
			position: fixed;
			/* Stay in place */
			z-index: 1;
			/* Sit on top */
			padding-top: 100px;
			/* Location of the box */
			left: 0;
			top: 0;
			width: 100%;
			/* Full width */
			height: 100%;
			/* Full height */
			overflow: auto;
			/* Enable scroll if needed */
			background-color: rgb(0, 0, 0);
			/* Fallback color */
			background-color: rgba(0, 0, 0, 0.4);
			/* Black w/ opacity */
		}

		/* Modal Content */

		.modal-content {
			position: relative;
			background-color: #fefefe;
			margin: auto;
			padding: 0;
			border: 1px solid #888;
			width: 80%;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-webkit-animation-name: animatetop;
			-webkit-animation-duration: 0.4s;
			animation-name: animatetop;
			animation-duration: 0.4s
		}

		/* Add Animation */

		@-webkit-keyframes animatetop {
			from {
				top: -300px;
				opacity: 0
			}
			to {
				top: 0;
				opacity: 1
			}
		}

		@keyframes animatetop {
			from {
				top: -300px;
				opacity: 0
			}
			to {
				top: 0;
				opacity: 1
			}
		}

		/* The Close Button */

		.close {
			color: white;
			float: right;
			font-size: 28px;
			font-weight: bold;
		}

		.close:hover,
		.close:focus {
			color: #000;
			text-decoration: none;
			cursor: pointer;
		}

		.modal-header {
			padding: 2px 16px;
			background-color: #5cb85c;
			color: white;
		}

		.modal-body {
			padding: 2px 16px;
		}

		.modal-footer {
			padding: 2px 16px;
			background-color: #5cb85c;
			color: white;
		}

	</style>
</head>

<body>
	<!-- The Modal -->
	<div id="myModal" class="modal">

		<!-- Modal content -->
		<div class="modal-content">
			<div class="modal-header">
				<span class="close">&times;</span>
				<h2>Sigin in</h2>
			</div>
			<div class="modal-body">
				<p>Are you sure to sign in?</p>
			</div>
			<div class="modal-footer">
                <button id="trigger">yes</button>
			</div>
		</div>

	</div>

	<h1>Sign In</h1>
	<form action="../../controller/member/signinController.php" method='post'> 
		<p> ID : <input type="text" name="memid"><label name="memid" style="color:red;"></label></p>
		<p> Password : <input type="password" name="mempw" ><label name="mempw" style="color:red;"></label></p>
		<p> Confirm Password : <input type="password" name="memcpw" ><label name="memcpw" style="color:red;"></label></p>
		<p> First name : <input type="text" name="memfirstname" ><label name="memfirstname" style="color:red;"></label></p>
		<p> Last name : <input type="text" name="memlastname" ><label name="memlastname" style="color:red;"></label></p>
		<p> Birth Day : <input type="text" name="membirth" maxlength='8' placeholder="-없이 생년월일 8자"><label name="membirth" style="color:red;"></label></p>
		<p> Address : <input type="text" name="memaddr" ><label name="memaddr" style="color:red;"></label></p>
		<p> Email : <input type="text" name="eemail" placeholder="example@example.com"><label name="eemail" style="color:red;"></label><input type="text" name="eemail2" placeholder="추가입력(선택)"><label name="eemail2" style="color:red;"></label></p>
		<p> Phone number : <input type="text" name="phone" maxlength='11' placeholder="01012345678"><label name="phone" style="color:red;"></label><input type="text" name="phone2" placeholder="추가입력(선택)" maxlength='11'><label name="phone2" style="color:red;"></label></p>
		<p> Nick name : <input type="text" name="memnickname" ><label name="memnickname" style="color:red;"></label></p>
		<p> Agree : <input type="checkbox" name="memagree" id="memagree"><label name="memagree" style="color:red;"></label></p>
		<p> <input type="submit" name="signin_submit" value="Sign In"></p>
	</form>
    <!-- Trigger/Open The Modal -->
	<p>
        <button id="myBtn">Sign in</button>
    </p>
    <!-- Back to List -->
    <a href="loginView.php" ><input type="button" value="cancle" style="width:50px"></a>
    
	<script>
        window.onload = function(){
            // Get the modal
            var modal = document.getElementById('myModal');

            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            //Get submit button
            let submit = document.getElementsByName('signin_submit')[0];
            submit.setAttribute('hidden', "true");
            //Get modal header
            let header = document.getElementsByClassName('modal-header')[0];

            //Get modal footer
            let footer = document.getElementsByClassName('modal-footer')[0];

            //Get trigger button
            let trigger = document.getElementById('trigger');

            // When the user clicks the button, open the modal 
            btn.onclick = function () {
                let valid = true;

                function warn(inputNode, labelNode, pattern, str){
                    if(pattern.test(inputNode.value) && valid){
                        labelNode.innerText = "";
                        valid = true;
                    }
                    else{
                        labelNode.innerText = str;
                        valid = false;
                    }
                }
                
                //check id validation
                let id = document.getElementsByName('memid');
                warn(id[0], id[1], /^[A-Za-z0-9]{4,10}$/, "영숫자 4~10자.");

                //check password validation
                let pw = document.getElementsByName('mempw');
                warn(pw[0], pw[1], /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/, "영숫자 최소 8자 이상.");

                //check confirm password validation
                let cpw = document.getElementsByName('memcpw');
                if(pw[0].value === cpw[0].value && valid){
                    cpw[1].innerText = "";
                    valid = true;
                    warn(cpw[0], cpw[1], /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/, "영숫자 최소 8자 이상.");
                }
                else{
                    cpw[1].innerText = "비밀번호가 일치하지 않습니다.";
                    valid = false;
                }

                //check first name
                let fname = document.getElementsByName('memfirstname');
                warn(fname[0], fname[1], /^[A-Za-z]{1,2}$/, "영자 1~2자.");

                //check last name
                let lname = document.getElementsByName('memlastname');
                warn(lname[0], lname[1], /^[A-Za-z]{1,16}$/, "영자 1~16자.");

                //check birth
                let birth = document.getElementsByName('membirth');
                warn(birth[0], birth[1], /^[0-9]{8,8}$/, "숫자 8자.");

                //check address
                let address = document.getElementsByName('memaddr');
                warn(address[0], address[1], /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{1,255}$/, "영숫자 최대 255자 이하.");

                //check default email
                let defaultEmail = document.getElementsByName('eemail');
                warn(defaultEmail[0], defaultEmail[1], /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[A-Z]{2}|com|org|net|gov|mil|biz|info|mobi|name|aero|jobs|museum)\b/, "정확한 이메일을 입력해주세요.");

                //check additional email
                let additionalEmail = document.getElementsByName('eemail2');
                if(String(additionalEmail[0].value).length > 0){
                    warn(additionalEmail[0], additionalEmail[1], /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[A-Z]{2}|com|org|net|gov|mil|biz|info|mobi|name|aero|jobs|museum)\b/, "정확한 이메일을 입력해주세요.");
                }

                //check default phone
                let defaultPhone = document.getElementsByName('phone');
                warn(defaultPhone[0], defaultPhone[1], /[0-9]{11}/, "정확한 핸드폰 번호를 입력해주세요.");

                //check additional phone
                let additionalPhone = document.getElementsByName('phone2');
                if(String(additionalPhone[0].value).length > 0){
                    warn(additionalPhone[0], additionalPhone[1], /[0-9]{11}/, "정확한 핸드폰 번호를 입력해주세요.");
                }
                
                //check nickname
                let nick = document.getElementsByName('memnickname');
                warn(nick[0], nick[1], /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{2,15}$/, "영숫자 2~15자.");

                //if validate, show modal 
                if(valid){
                    modal.style.display = "block";
                }
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function () {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            //add event listener to check validation and trigger button
            trigger.addEventListener('click', function(e){
                submit.click();
            });
        };
	</script>
</body>

</html>
