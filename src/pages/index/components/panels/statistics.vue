<template>
    <div class="row profile-item">
        <div class="col-sm-10 col-sm-offset-1">
            <br>
            <input class="form-control" type="text" v-model="keyword" placeholder="请输入搜索关键字">
            <br>
            <button @click="query()" class="btn btn-default">搜索</button>
            <br>
            <h3>搜索结果</h3>
            <br>
            <table class="table table-bordered">
                <thead>
                <tr class="info">
                    <td>课程名称</td>
                    <td>地点</td>
                    <td>发布人</td>
                    <td>查看</td>
                </tr>
                </thead>
                <tbody id="notes">
                <tr id="note_template" v-for="class_item in classes">
                    <td>{{class_item.class_name}}</td>
                    <td>{{class_item.class_location}}</td>
                    <td>{{class_item.class_releaser}}</td>
                    <td><button class="btn btn-primary" @click="show_class_hot_point(class_item.class_id)">查看</button></td>
                </tr>
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>
</template>
<script>

    const yoyoSDK = window['www---vanging---com___yoyo___sdk'];

    module.exports =
        {
            data:function()
            {
                return {
                    classes:[],
                    keyword:'吉大'
                };
            },
            methods:
                {
                    query:function(e)
                    {
                        const self = this;
                        yoyoSDK.queryClass(this.keyword)
                            .then(function(result)
                            {
                                result = JSON.parse(result);
                                if(result.status === 'ok')
                                {
                                    while(self.classes.length>0)
                                    {
                                        self.classes.pop();
                                    }
                                    result.message.forEach(function(e)
                                    {
                                        self.classes.push(e);
                                    });
                                }
                            }, function(err)
                            {
                                console.log(err);
                                alert('查询失败');
                            })
                    },
                    show_class_hot_point:function(cid)
                    {
                        console.log(cid);
                        const event=new Event('yoyo:show_class_hot_point');
                        event.message=cid;
                        document.body.dispatchEvent(event);
                    }
                }
        }
</script>
<style scoped>

</style>
