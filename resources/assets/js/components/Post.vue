<template>
    <div class="media" v-if="post">

        <like-button v-if="post.canBeLikedByCurrentUser" :post="post"></like-button>

        <div class="media-left">
            <a href="#">
                <img :src="post.user.avatar" width="45" height="45" :alt="post.user.name + ' avatar'">
            </a>
        </div>
        <div class="media-body">
            <strong>{{ post.user.name }}</strong>
            <p>{{ post.body }}</p>
            <p>{{ likeCount }}</p>
        </div>
    </div>
</template>

<script>
    import pluralize from 'pluralize';
    import LikeButton from './LikeButton.vue';

    export default {
        props: ['post'],
        components: { LikeButton },
        computed: {
            likeCount() {
                return pluralize('like', this.post.likeCount, true);
            }
        }
    }
</script>

<style scoped>
    .media {
        position: relative;
        margin: 0;
        padding: 10px;
    }
    .media:hover .like {
        display: block;
    }
</style>