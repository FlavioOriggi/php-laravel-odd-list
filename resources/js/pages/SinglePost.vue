<template>
    <div class="container mt-3">
        <div class="card">
            <h5 class="card-header"> {{ post.title }} </h5>
            <div class="card-body">
                <h5 class="card-title" v-if="post.category"> {{ post.category.name }} </h5>
                <p class="card-text"> {{ post.content }} </p>
                <Tag :tags="post.tags"/>

                <!-- <div v-if="post.tags">
                    <span class="badge badge-success" v-for="tag in post.tags" :key="tag.id">
                        {{ tag.name }}
                    </span>
                </div> -->
                
            </div>
        </div>
    </div>
</template>

<script>
import Tag from '../components/Tag';

export default {
    name: "SinglePost",
    components: {
        Tag
    },
    data(){
        return{
            post: []
        }
    },
    mounted() {

        axios.get('/api/post/' + this.$route.params.slug)
            .then( response => {
                this.post = response.data.results;
                console.log(this.post);
            })
            .catch(error =>{
                console.log(error);
            });
    },
};
</script>

<style lang="scss" scoped> 

</style>
