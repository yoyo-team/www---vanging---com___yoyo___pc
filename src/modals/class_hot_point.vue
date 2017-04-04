<template>
    <div class="modal fade" id="class_hot_point_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>课程热点</h3>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="info">
                            <td>内容</td>
                            <td>频率</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in hot_points">
                            <td v-if="class_content[item.index].type==='img'">
                                <img class="hot-point-image" :src="class_content[item.index].url" alt="">
                            </td>
                            <td v-if="class_content[item.index].type==='text'">{{class_content[item.index].content}}</td>
                            <td>{{item.value}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    module.exports =
        {
            data: function () {
                return {
                    cid:'',
                    class_content:[],
                    hot_points:[]
                };
            },
            mounted:function()
            {
                let self=this;

                document.body.addEventListener('yoyo:show_class_hot_point',function(e)
                {
                    $("#class_hot_point_modal").modal('show');
                    self.cid=e.message;
                    window.luoc.yoyo.get_class({cid:e.message});
                });

                document.body.addEventListener('yoyo:get_class:ok',function(e)
                {
                    console.log(e.message);
                    self.class_content=[];
                    e.message.segments.forEach(function(e)
                    {
                        if(e.type==='img')
                        {
                            e.url=`//luoc.co/yoyo/classes/${self.cid}/${e.url}`;
                        }
                        self.class_content.push(e);
                    });
                    window.luoc.yoyo.get_statistics({cid:self.cid});
                });

                document.body.addEventListener('yoyo:get_statistics:ok',function(e)
                {
                    self.hot_points=[];
                    let max=0;

                    // get max value
                    for(let key in e.message)
                    {
                        if(e.message[key]>max)
                        {
                            max=e.message[key];
                        }
                    }

                    // push into array in the order of value
                    while(max>0)
                    {
                        for(let key in e.message)
                        {
                            if(e.message[key]==max)
                            {
                                self.hot_points.push
                                (
                                    {
                                        index:key,
                                        value:e.message[key]
                                    }
                                );
                            }
                        }
                        max--;
                    }

                    console.log(e.message);
                })
            }
        }
</script>
<style scoped>
    .hot-point-image
    {
        width:100%;
    }
</style>
