<style>
    h1,
    h2,
    h3,
    h4,
    h5,
    h6{
        text-align: center;
    }
</style>
<?php
$pptx="application/vnd.openxmlformats-officedocument.presentationml.presentation";
$ppt="application/vnd.ms-powerpoint";
$release_success=true;

$class_name=$_POST['class_name'];
$class_location=$_POST['class_location'];
$releaser_name=$_POST['releaser_name'];
$class_file=$_FILES['class_file'];

if($class_name==null)
{
    info("缺乏课程名称");
    $release_success=false;
}
if($class_location==null)
{
    info("缺乏课程所在地");
    $release_success=false;
}
if($releaser_name==null)
{
    info("缺乏课程发布人");
    $release_success=false;
}
if($class_file==null)
{
    info("缺乏课程对应的PPT文件");
    $release_success=false;
}
else
{
    if($class_file["error"])
    {
        info("文件上传时发生错误 : ".$class_file["error"]);
        $release_success=false;
    }
    else
    {
        $file_type=false;
        if($class_file["type"]===$ppt)
        {
            $affix=".ppt";
            $file_type=true;
        }
        if($class_file["type"]===$pptx)
        {
            $affix=".pptx";
            $file_type=true;
        }
        if($file_type)
        {
            file_info($class_file);

            $url="https://nodejs.twesix.cn/yoyo/class/release";
            $url.="?class_name=${class_name}";
            $url.="&class_location=${class_location}";
            $url.="&releaser_name=${releaser_name}";

//        $res=file_get_contents($url);
//        $res=json_decode($res);

            $class_id=123456789;
            if(store_file($class_file["tmp_name"],"/root/web/twesix.cn/yoyo/yoyo-loves-you/class_files/".$class_id.$affix))
            {
                info("上传文件保存成功");
            }
            else
            {
                info("文件保存失败，请重新上传");
                $release_success=false;
            }
        }
        else
        {
            info("请上传ppt或者pptx类型的文件，不要上传其他类型的文件");
            $release_success=false;
        }
    }

}

if($release_success)
{
    info("课程发布成功");
    back_success();
}
else
{
    info("课程发布失败");
    back_fail();
}

function store_file($temp,$path)
{
    return move_uploaded_file($temp,$path);
}

function info($info)
{
    echo "<h1>${info}</h1>";
}

function file_info($file)
{
    echo <<<file_info
            <h3>file name : ${file["name"]}</h3>
            <h3>file type : ${file["type"]}</h3>
            <h3>file tmp_name : ${file["tmp_name"]}</h3>
            <h3>file error : ${file["error"]}</h3>
            <h3>file size : ${file["size"]}</h3>
file_info;
}

function back_fail()
{
    echo <<<fail
<h1><span id="count_back">30</span>秒后返回</h1>
<h1>您可以手动返回，检查相关信息后重新提交</h1>
<script>
    var ele=document.getElementById('count_back');
    var time=29;
    var timer=setInterval(function()
    {
        ele.innerHTML=time;
        time--;
        if(time===0)
        {
            clearInterval(timer);
            history.back();
        }
    },1000)
</script>
fail;
}

function back_success()
{
    echo <<<success
<h1><span id="count_back">3</span>秒后返回</h1>
<script>
    var ele=document.getElementById('count_back');
    var time=2;
    var timer=setInterval(function()
    {
        ele.innerHTML=time;
        time--;
        if(time===0)
        {
            clearInterval(timer);
            location.assign("https://yoyo.twesix.cn/yoyo-loves-you#done_release_class");
        }
    },1000)
</script>
success;
}

?>

