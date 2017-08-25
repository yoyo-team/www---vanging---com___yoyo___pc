<template>
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <h3 class="center-block">欢迎发布新课程</h3>
            <br>
            <form @submit.prevent="submit($event)" id="class_form" role="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="class_name">课程名称</label>
                    <input name="class_name" id="class_name" class="form-control" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="class_location">课程所在地（所在学校名称）</label>
                    <input name="class_location" id="class_location" class="form-control" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="class_releaser">发布人</label>
                    <input name="class_releaser" id="class_releaser" class="form-control" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="class_file">课程对应的PPT文件</label>
                    <input name="class_file" type="file" id="class_file" class="form-control" required>
                </div>
                <br><br><br>
                <div class="row">
                    <div class="col-sm-6">
                        <button :disabled="uploading" type="submit" id="class_submit" class="btn btn-primary form-control">发布</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="reset" class="btn btn-danger form-control">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>

    const yoyoSDK = window['www---vanging---com___yoyo___sdk'];

    module.exports =
        {
            data:function()
            {
                return{
                    uploading:false
                }
            },
            methods:
                {
                    submit:function(e)
                    {
                        const self = this;
                        const class_form = document.getElementById('class_form');
                        this.uploading=true;
                        yoyoSDK.releaseClass(class_form)
                            .then(function(result)
                            {
                                result = JSON.parse(result);
                                if(result.status === 'ok')
                                {
                                    alert('发布课程成功');
                                    self.uploading = false;
                                    class_form.reset();
                                }
                            }, function(err)
                            {
                                console.log(err);
                                alert('发布课程失败');
                                self.uploading = false;
                            })
                    }
                }
        }
</script>
<style scoped>

</style>
