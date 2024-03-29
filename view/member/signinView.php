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
		<p> ID : <input type="text" name="memid"></p>
		<p> Password : <input type="text" name="mempw"></p>
		<p> Confirm Password : <input type="text" name="memcpw"></p>
		<p> First name : <input type="text" name="memfirstname"></p>
		<p> Last name : <input type="text" name="memlastname"></p>
		<p> Birth Day : <input type="text" name="membirth" maxlength='8'></p>
		<p> Address : <input type="text" name="memaddr"></p>
		<p> Email : <input type="text" name="eemail"> <input type="text" name="eemail2" placeholder="추가입력(선택)"></p>
		<p> Phone number : <input type="text" name="phphonenum" maxlength='11'> <input type="text" name="phphonenum2" placeholder="추가입력(선택)" maxlength='11'></p>
		<p> Nick name : <input type="text" name="memnickname"></p>
		<p> Agree : <input type="checkbox" name="memagree"></p>
		<p> <input type="submit" name="signin_submit" value="Sign In"></p>
	</form>
    <!-- Trigger/Open The Modal -->
	<p>
        <button id="myBtn">Sign in</button>
    </p>
    <!-- Back to List -->
    <a href="loginView.php" ><input type="button" value="cancle" style="width:50px"></a>
    
	<script>
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
			modal.style.display = "block";
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
        
        //add event listener to trigger button
        trigger.addEventListener('click', function(e){
            submit.click();
        });
	</script>
</body>

</html>
