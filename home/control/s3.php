<?php
    if(isset($_POST)){
        $i=$_POST['i'];
        $s3option=array();
        //此处可查询数据库组织数据
        switch ($i) {
            case 1:
                $s3option=array(
                    array('key'=>'1','value'=>'学生宿舍01栋'),
                    array('key'=>'2','value'=>'学生宿舍02栋'),
                    array('key'=>'3','value'=>'学生宿舍03栋'),
                    array('key'=>'4','value'=>'学生宿舍04栋'),
                    array('key'=>'5','value'=>'学生宿舍05栋'),
                    array('key'=>'6','value'=>'学生宿舍06栋'),
                    array('key'=>'7','value'=>'学生宿舍07栋'),
                    array('key'=>'8','value'=>'学生宿舍08栋'),
                    array('key'=>'9','value'=>'学生宿舍09栋'),
                    array('key'=>'10','value'=>'学生宿舍10栋'),
                );
                break;
            case 2:
                $s3option=array(
                    array('key'=>'10','value'=>'教师村01栋'),
                    array('key'=>'11','value'=>'教师村02栋'),
                    array('key'=>'12','value'=>'教师村03栋'),
                    array('key'=>'13','value'=>'教师村04栋'),
                );
                break;
            case 3:
                $s3option=array(
                    array('key'=>'14','value'=>'学生宿舍01栋'),
                    array('key'=>'15','value'=>'学生宿舍02栋'),
                );
                break;
            case 4:
                $s3option=array(
                    array('key'=>'16','value'=>'教师宿舍01栋'),
                    array('key'=>'17','value'=>'教师宿舍02栋'),
                );
                break;
            default:
                # code...
                break;
        }
        echo json_encode($s3option);
    }
?>