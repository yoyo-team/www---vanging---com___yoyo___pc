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
                        <tr v-for="(item, index) in hot_points">
                            <td v-if="class_content[index].type==='img'">
                                <img class="hot-point-image" :src=" `//www.vanging.com/yoyo/classes/${class_id}/` + class_content[index].content" alt="">
                            </td>
                            <td v-if="class_content[index].type==='text'">{{class_content[index].content}}</td>
                            <td>{{ hot_points[index] }}</td>
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

    const yoyoSDK = window['www---vanging---com___yoyo___sdk'];

    export default
        {
            data: function () {
                return {
                    class_id:'',

                    // ordered data
                    class_content:[],
                    hot_points:[],

                    // not ordered data
                    raw_class_content:[],
                    raw_hot_points:[],
                };
            },
            methods:
                {
                    error: function(err)
                    {
                        console.log(err);
                        alert('获取课程热点统计数据失败');
                    },
                    update_class_content: function(data)
                    {
                        const self = this;
                        while(this.raw_class_content.length > 0)
                        {
                            this.raw_class_content.pop();
                        }
                        data.forEach(function(e)
                        {
                            self.raw_class_content.push(e);
                        });
                    },
                    update_hot_points: function(data)
                    {
                        while(this.raw_hot_points.length > 0)
                        {
                            this.raw_hot_points.pop();
                        }
                        for(let i = 0 ; i < this.raw_class_content.length ; i ++)
                        {
                            const item = data[`${i}`] || 0;
                            this.raw_hot_points.push(item);
                        }
                    },
                    sort: function()
                    {
                        let max = 0;

                        // get max value
                        this.raw_hot_points.forEach(function(e)
                        {
                            if(e > max)
                            {
                                max = e;
                            }
                        });

                        // clear
                        while(this.class_content.length > 0)
                        {
                            this.class_content.pop();
                        }
                        while(this.hot_points.length > 0)
                        {
                            this.hot_points.pop();
                        }

                        while(max >= 0)
                        {
                            const self = this;
                            this.raw_hot_points.forEach(function(e, i)
                            {
                                if(e === max)
                                {
                                    self.class_content.push(self.raw_class_content[i]);
                                    self.hot_points.push(e);
                                }
                            });
                            max -- ;
                        }
                    }
                },
            mounted: function()
            {
                const self=this;

                document.body.addEventListener('yoyo:show_class_hot_point',function(e)
                {
                    $("#class_hot_point_modal").modal('show');
                    self.class_id=e.message;

                    function sanitize(str)
                    {
                        const valid = /[\u0020-\u007e\u4e00-\u9fa5]/;
                        const invalid = /[]/;
                        let result = '';
                        str.split('').forEach(function(c)
                        {
                            if(valid.test(c))
                            {
                                result += c;
                            }
                        });
                        return result;
                    }

                    step_1();

                    // get class content
                    function step_1()
                    {
                        yoyoSDK.getClassContent(self.class_id)
                            .then(function(result)
                            {
                                console.log(result);
                                self.update_class_content(result);
                                step_2();
                            }, self.error);
                    }

                    // get statistics
                    function step_2()
                    {
                        yoyoSDK.getStatistics(self.class_id)
                            .then(function(result)
                            {
                                result = JSON.parse(result);
                                if(result.status === "ok")
                                {
                                    self.update_hot_points(result.message);

                                    // sort
                                    self.sort();
                                }
                                else
                                {
                                    self.error(result);
                                }
                            }, self.error);
                    }

                });
            }
        }
</script>
<style scoped>
    .hot-point-image
    {
        width:100%;
    }
</style>
