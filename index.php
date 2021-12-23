<?php
include ('Config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>


    <title>Form</title>
</head>

<body>

    <div class="container">
        <form id="Add_Form">
            <div class="row">
                <div class="col-md-3"> </div>

                <div class="col-md-6">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="custome-title">Enter User Info</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label> Enter Name: </label>
                                <input type="text" class="form-control" name="Name" id="name"
                                    placeholder="Enter your name" required>
                            </div>
                            <div class="form-group">
                                <label> Enter Contact: </label>
                                <input type="number" class="form-control" name="Contact_No" id="cont"
                                    placeholder="Enter your contact number" required>
                            </div>
                            <div class="form-group">
                                <label> Enter Email: </label>
                                <input type="email" class="form-control" name="Email" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group">
                                <label> Enter Profile: </label>
                                <input type="text" class="form-control" name="Profile" placeholder="Enter your profile" required>
                            </div>
                            <div class="form-group">
                                <label> Enter Password: </label>
                                <input type="password" class="form-control" name="Password"
                                    placeholder="Enter your Password" required>
                            </div>
                            <div class="form-group">
                                <a class="btn btn-warning" onclick="clearField()">Clear</a>
                                <input type="hidden" name="hidden_add_form" value="yes">
                                <button class="btn btn-primary" id="submit">Submit</button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div id="response">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="datatable">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Contact_No</th>
                        <th>Email</th>
                        <th>Profile</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $Get=$conn->Query("SELECT * FROM form");
                    while($Res=$Get->fetch_assoc()){
                    ?>
                    <tr id="<?php echo $Res['Id']; ?>">

                        <td><?php echo $Res['Id']; ?></td>
                        <td><?php echo $Res['Name']; ?></td>
                        <td><?php echo $Res['Contact_No']; ?></td>
                        <td><?php echo $Res['Email']; ?></td>
                        <td><?php echo $Res['Profile']; ?></td>
                        <td><?php echo $Res['Password']; ?></td>

                        <td><button class="btn-primary edit_btn" data-id="<?php echo $Res['Id']; ?>">Edit</button>
                        <button class="btn-danger btn_delete" data-id="<?php echo $Res['Id']; ?>">Delete</button></td>
                    </tr>
                    <?php
                    } 
                    ?>
                </tbody>
            </table>
        </div>

    </div>

    <script>

        $("body").on("submit", "#Add_Form", function () {
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: 'ajaxfun.php',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    var data = data.trim()
                    if (data == '-1') {
                        toastr.error('Email Already Exist ');
                    }
                    if (data == 'Yes') {
                        $("#response").html("<div class='alert alert-success'> Data Inserted </div>")
                        clearField();
                    }
                    if (data == 'Update') {
                        $("#response").html("<div class='alert alert-success'> Data Updated </div>")
                        clearField();
                    }
                    if (data== 'Delete'){
                        $("#response").html("<div class='alert alert-success'> Data Deleted </div>")   
                    }
                }
            });
            return false;
        });

        function clearField() {
            $(".form-control").val("");
        }
        
        $('#myTable').DataTable();

        
        //For Update data which already Exists
        $("body").on("click", ".edit_btn", function() { 
            var Id = $(this).attr('data-id');
		$.ajax({
			url: "ajax-design.php",
			type: "POST",
			cache: false,
			data: 'Id='+Id,
			success: function(data){
				$("#Add_Form").html(data);
                $("html").animate({ scrollTop: 0 }, 500);
			}
		});
	}); 


    //For Delete User From Table
    $("body").on("click", ".btn_delete", function() { 
            var Id = $(this).attr('data-id');
		$.ajax({
			url: "ajaxfun.php",
			type: "POST",
			cache: false,
			data: 'hidden_delete=yes&Id='+Id,
			success: function(data){

                if (data== 'Delete'){
                    $('#'+Id+'').remove();
                }
				
			}
		});
	}); 

    </script>
</body>

</html>