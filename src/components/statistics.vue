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
                    <td>{{class_item.name}}</td>
                    <td>{{class_item.location}}</td>
                    <td>{{class_item.releaser}}</td>
                    <td><button class="btn btn-primary" @click="show_class_hot_point(class_item.cid)">查看</button></td>
                </tr>
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>
</template>
<script>
    module.exports =
        {
            data:function()
            {
                return {
                    classes:[],
                    keyword:'吉大'
                };
            },
            mounted:function()
            {
                let self=this;

                // get class
                document.body.addEventListener('yoyo:get_class:ok',function(e)
                {
                    Vue.set
                    (
                        self.classes[e.message.cid],
                        'source',
                        e.message
                    );
                });
                document.body.addEventListener('yoyo:get_class:error',function(e)
                {
                    console.log('课程加载失败');
                    console.log(e.message);
                });

                // query class
                document.body.addEventListener('yoyo:query_class:ok',function(e)
                {
                    console.log(e.message);
                    while(self.classes.length>0)
                    {
                        self.classes.pop();
                    }
                    e.message.forEach(function(e)
                    {
                        self.classes.push(e);
                    });
                });
                document.body.addEventListener('yoyo:query_class:error',function(e)
                {
                    console.log(e.message);
                    alert('查询失败，')
                });
            },
            methods:
                {
                    query:function(e)
                    {
                        window.luoc.yoyo.query_class
                        (
                            {
                                key:this.keyword
                            }
                        );
                    },
                    show_class_hot_point:function(cid)
                    {
                        console.log(cid);
                        var event=new Event('yoyo:show_class_hot_point');
                        event.message=cid;
                        document.body.dispatchEvent(event);
                    }
                }
        }
</script>
<style scoped>

</style>
