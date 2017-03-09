<template>
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <h3 class="center-block">欢迎发布新课程</h3>
            <br>
            <form @submit.prevent="submit($event)" id="class_form" role="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="class_name">课程名称</label>
                    <input name="name" type="text" id="class_name" class="form-control" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="class_location">课程所在地（所在学校名称）</label>
                    <input name="location" type="text" id="class_location" class="form-control" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="releaser_name">发布人</label>
                    <input name="releaser" type="text" id="releaser_name" class="form-control" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="class_file">课程对应的PPT文件</label>
                    <input name="file" type="file" id="class_file" class="form-control" required>
                </div>
                <br><br><br>
                <div class="row">
                    <div class="col-sm-6">
                        <button type="submit" id="class_submit" class="btn-success form-control">发布</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="reset" class="btn-danger form-control">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    module.exports =
        {
            methods:
                {
                    submit:function(e)
                    {
                        window.luoc.yoyo.release(document.getElementById('class_form'));
                    }
                },
            mounted:function()
            {
                document.body.addEventListener('yoyo:release:args_check_failed',function(e)
                {
                    console.log(e);
                });
                document.body.addEventListener('yoyo:release:error',function(e)
                {
                    console.log(e);
                    alert('发布课程失败');
                });
                document.body.addEventListener('yoyo:release:ok',function(e)
                {
                    console.log(e);
                    alert('发布课程成功');
                    document.getElementById('class_form').reset();
                });
            }
        }
</script>
<style scoped>

</style>
