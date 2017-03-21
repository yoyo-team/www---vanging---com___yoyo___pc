<template>
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <form @submit.prevent="submit($event)">
                <br>
                <div class="form-group">
                    <label>位置</label>
                    <input v-model="location" type="text" class="form-control"  placeholder="你的位置" required />
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <button type="submit" id="class_submit" class="btn-success form-control">确定</button>
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
            data: function () {
                return {
                    location:''
                };
            },
            methods:
                {
                    submit:function(e)
                    {
                        console.log(e);
                        if(window.luoc.navbar.online)
                        {
                            window.luoc.yoyo.set_location
                            (
                                {
                                    uid:window.luoc.navbar.data.uid,
                                    location:this.location
                                }
                            );
                        }
                        else
                        {
                            alert('请登录');
                        }
                    }
                }
        }
</script>
<style scoped>

</style>
