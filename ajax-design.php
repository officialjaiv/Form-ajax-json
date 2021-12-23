<?php
    include('Config.php');
    print_r($_POST);
    $Res_User = $conn->Query ("SELECT * FROM form WHERE Id = '".$_POST['Id']."' ")->fetch_assoc();

?>

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
                                    placeholder="Enter your name" value="<?php echo $Res_User['Name']; ?>"  required>
                            </div>
                            <div class="form-group">
                                <label> Enter Contact: </label>
                                <input type="number" class="form-control" name="Contact_No" id="cont"
                                    placeholder="Enter your contact number" value="<?php echo $Res_User['Contact_No']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label> Enter Email: </label>
                                <input type="email" class="form-control" name="Email" placeholder="Enter your email" value="<?php echo $Res_User['Email']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label> Enter Profile: </label>
                                <input type="text" class="form-control" name="Profile" placeholder="Enter your profile" value="<?php echo $Res_User['Profile']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label> Enter Password: </label>
                                <input type="password" class="form-control" name="Password"
                                    placeholder="Enter your Password" value="<?php echo $Res_User['Password']; ?>" required>
                            </div>
                            <div class="form-group">
                                <a class="btn btn-warning" onclick="clearField()">Clear</a>
                                <input type="hidden" name="hidden_update_form" value="yes">
                                <input type="hidden" name="Id" value="<?php echo $_POST['Id']; ?>">
                                <button class="btn btn-success w-sm"> Update </button>
                            </div>
                        </div>
                            <div class="card-footer">
                                <div id="response">
                                </div>
                            </div>
                    </div>
                </div>
    
</div>
