<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include "header.php";
include('../db_connection.php');
$db = new DB_FUNCTIONS();
$getsubjects = $db->getsubjects();
$t_email = $_GET["t_email"];

$getteacherbyemail = $db ->getteacherbyemail($t_email);

if(isset($_POST['submit'])){
    $t_name = $_POST["name"];
    $t_email = $_POST['email'];
    $t_subjects = $_POST["subject"];
    $user_role = "teacher";
    $edit_teacher = $db->edit_teacher($t_email,$t_name,$t_subjects,$user_role);
    $db->redirect_to("teacher.php");
}
if($getteacherbyemail) {
    foreach ($getteacherbyemail as $row) {
        $t_name = $row['t_name'];
        $t_subjects = $row['t_subjects'];
echo'
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Edit teacher '.$t_name.'</h5>
                
            </div>
            <div class="ibox-content">
                <form method="post" action="edit_teacher.php" class="form-horizontal">
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10"><input type="text" value="'.$t_name.'" name="name" class="form-control"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10"><input type="email" value="'.$t_email.'" name="email" class="form-control"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-10"><select class="form-control m-b" name="subject">';
                        if($getsubjects){
                            foreach ($getsubjects as $row2) {
                                if($row2["sub_name"]){
                                    if($t_subjects == $row2["sub_name"]){
                                        echo'<option selected>'.$row2["sub_name"].'</option>';
                                    }
                                    else{
                                        echo'<option>'.$row2["sub_name"].'</option>';
                                    }
                                }
                            }
                        }
                        echo'</select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-primary" name="submit" type="button" onclick="check_student_validations();">Add</button</div>
                        <button type="button" class="btn btn-white"" onclick="window.history.back();">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>';
    }
}
    include "footer.php";
?>