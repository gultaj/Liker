<template>
    <div class="like">
        <a href="#" class="btn like__button" @click.prevent="like"><i class="glyphicon glyphicon-heart"></i></a>
    </div>
</template>

<script>
    import events from '../events';

    export default {
        props: ['post'],
        methods: {
            like() {
                this.$http.post(`/posts/${this.post.id}/likes`)
                    .then(r => {
                        events.$emit('post-liked', this.post, true);
                    });
            }
        }
    }
</script>

<style scoped>
    .like {
        display: none;
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: rgba(0, 0, 0, .05);
        border-radius: 3px;
        box-sizing: border-box;
    }

    .like__button {
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translate(0, -50%);
        font-size: 2em;
        line-height: 1;
    }
</style>