<template>
    <div>
    <h2>All posts</h2>           
  <table class="table table-dark table-striped">
    <thead>
      <tr>
        <th>Author</th>
        <th>Title</th>
        <th>Description</th>
        <th>Image</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="post in posts" :key="post.id">
        <td class="align-middle">{{ post.name_author }}</td>
        <td class="align-middle">{{ post.title }}</td>
        <td class="align-middle">{{ textTruncate(post.description) }}</td>
        <td class="align-middle"><img :src="post.image" :alt="post.title" width="100px"></td>
        <td class="align-middle">
            <router-link :to="{ name: 'post', params: { id: post.id }}">
                read more
             </router-link>
            
        </td>
      </tr>
    </tbody>
  </table>
    </div>
</template>

<script>
export default {
    data(){
        return {
            posts:[]
        }
    },
    created(){
        axios.get("/api/posts")
             .then(({data})=>{
                 this.posts = data
             })
    },
    methods:{
        textTruncate(str, length = 100, ending = '...') {
         if(str !== null) {
            if (str.length > length) {
            return str.substring(0, length - ending.length) + ending;
            } else {
            return str;
            }
        }
       },
    }
}
</script>

