<template>
    <form action="#" class="form-vertical" @submit.prevent="post">
        <div class="form-group">
            <textarea class="form-control" cols="30" rows="3" v-model="body"></textarea>
        </div>
        <button type="submit" class="btn btn-default">Post it!</button>
    </form>
</template>

<script>
    import events from '../events';

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
                        events.$emit('post-added', data);
                        this.body = null;
                    });
            }
        }
    }
</script>