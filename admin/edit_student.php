<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include "header.php";
include('../db_connection.php');
$db = new DB_FUNCTIONS();
$getsubjects = $db ->getsubjects();
$id = $_GET["id"];
$getStudent = $db ->getStudentById($id);


if(isset($_POST['submit'])){
    $s_email = $_POST["email"];
    $s_name = $_POST["name"];
    $p_email = $_POST["pemail"];
    $p_name = $_POST["pname"];
    $s_rollno = $_POST["s_rollno"];
    $edit_student = $db->edit_student($s_rollno,$s_email,$s_name,$p_email,$p_name,$id );
    $db->redirect_to("student.php");
}

if($getStudent) {
    foreach ($getStudent as $row) {
        $s_rollno = $row['s_rollno'];
        $s_name = $row['s_name'];
        $p_email = $row['p_email'];
        $s_email = $row['s_email'];
        $p_name = $row['p_name'];
echo'
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Edit Student '.$s_name.'</h5>
                <div class="ibox-tools">
                   
                </div>
            </div>
            <div class="ibox-content">
                <form method="post" class="form-horizontal">
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Student Roll No</label>
                        <div class="col-sm-10"><input type="text" value="'.$s_rollno.'" name="s_rollno" id="s_rollno" class="form-control"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Student Name</label>
                        <div class="col-sm-10"><input type="text" value="'.$s_name.'" name="name" id="name" class="form-control"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Student Email</label>
                        <div class="col-sm-10"><input type="email" value="'.$s_email.'" name="email" id="email" class="form-control"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Parent Name</label>
                        <div class="col-sm-10"><input type="text" name="pname" value="'.$p_name.'" id="pname" class="form-control"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Parent Email</label>
                        <div class="col-sm-10"><input type="email" name="pemail" value="'.$p_email.'" id="pemail" class="form-control"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-white" type="submit">Cancel</button>
                            <button class="btn btn-primary" name="submit" type="submit" onclick="check_student_validations();">Submit</button>
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

    function check_student_validations(){

        // var rollno = $('#s_rollno').val();
        // $.ajax({
        //     type:"POST",
        //     url:"checkRollNo.php",
        //     data: { rollno: rollno },
        //     success:function(result){
        //         //alert(result);
        //         if(result != 0){
        //             alert('Roll No Already Exists!');
        //             return false;
        //         }
        //     }
        // });
    }
</script>



