<template>
    <div class="row profile-item">
        <div class="col-sm-10 col-sm-offset-1">
            <h3>我的笔记列表</h3>
            <br>
            <button @click="refresh($event)" class="btn btn-default">刷新</button>
            <br>
            <br>
            <table class="table table-bordered">
                <thead>
                <tr class="info">
                    <td>课程名称</td>
                    <td>地点</td>
                    <td>发布人</td>
                    <td>删除</td>
                </tr>
                </thead>
                <tbody id="notes">
                <tr id="note_template" v-for="(note,cid) in notes">
                    <td>{{note.source.meta.name}}</td>
                    <td>{{note.source.meta.location}}</td>
                    <td>{{note.source.meta.releaser}}</td>
                    <td><button class="btn btn-danger" @click="delete_note(cid)">删除</button></td>
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
                    notes:{}
                };
            },
            mounted:function()
            {
                var self=this;

                // get class
                document.body.addEventListener('yoyo:get_class:ok',function(e)
                {
                    Vue.set
                    (
                        self.notes[e.message.cid],
                        'source',
                        e.message
                    );
                });
                document.body.addEventListener('yoyo:get_class:error',function(e)
                {
                    console.log('课程加载失败');
                    console.log(e.message);
                });

                // get notes
                document.body.addEventListener('yoyo:get_notes:ok',function(e)
                {
                    self.notes={};
                    e.message.forEach(function(e)
                    {
                        Vue.set
                        (
                            self.notes,
                            e.cid,
                            {
                                segments:e.segments,
                                source:
                                    {
                                        cid:'',
                                        meta:{},
                                        segments:[]
                                    }
                            }
                        );
                        window.luoc.yoyo.get_class({cid:e.cid})
                    });
                });
                document.body.addEventListener('yoyo:get_notes:error',function(e)
                {
                    alert('刷新笔记列表失败，请检查网络环境');
                });

                // delete note
                document.body.addEventListener('yoyo:delete_note:ok',function()
                {
                    self.refresh();
                })
            },
            methods:
                {
                    refresh:function(e)
                    {
                        if(window.luoc.navbar.online)
                        {
                            window.luoc.yoyo.get_notes
                            (
                                {
                                    uid:window.luoc.navbar.data.uid
                                }
                            );
                        }
                        else
                        {
                            alert('您没有登录');
                        }
                    },
                    delete_note:function(cid)
                    {
                        window.luoc.yoyo.delete_note
                        (
                            {
                                uid:window.luoc.navbar.data.uid,
                                cid:cid
                            }
                        );
                    }
                }
        }
</script>
<style scoped>

</style>
