<template>
    <form action="#" class="form-vertical" @submit.prevent="post">
        <div class="form-group">
            <textarea class="form-control" cols="30" rows="3" v-model="body"></textarea>
        </div>
        <button type="submit" class="btn btn-default">Post it!</button>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                body: null
            }
        },
        methods: {
            post() {
                this.$http.post('/posts', { body: this.body}).then(r => r.json())
                    .then(data => {
                        this.$emit('postAdded', data);
                        this.body = null;
                    });
            }
        }
    }
</script>