<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Timeline</div>

                    <div class="panel-body">
                        <post-form @postAdded="addPost"></post-form>
                        <hr>
                        <post v-for="post in posts" :post="post"></post>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Post from './Post.vue';
    import PostForm from './PostForm.vue';

    export default {
        components: {Post, PostForm},
        data() {
            return {
                posts: []
            }
        },
        methods: {
            addPost(post) {
                this.posts.unshift(post);
            }
        },
        mounted() {
            this.$http.get('/posts').then(r => r.json())
                .then(data => {
                    this.posts = data;
                });
        }
    }
</script>
