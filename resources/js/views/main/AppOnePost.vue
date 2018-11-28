<template>
<div>
    <div class="row">
        <div class="col bd-highlight bg-white mb-3 rounded">
            <div class="d-flex p-2 mb-3 align-items-center ">
                <img :src="post.image" :alt="post.title" width="200" height="200" class="rounded-circle mr-3">
                <div>
                    <h2>{{ post.title }}</h2>
                    <p>{{ post.name_author +' | '+ dateParse(post.created_at) }}</p>
                </div>
            </div>
            <p>{{ post.description }}</p>
        </div>
    </div>
    <div v-if="post.stories && post.stories.length >= 1" class="row">   
        <div class="col-12 mb-3 bgChess rounded" v-for="story in post.stories" :key="story.id">
             <h4 class="text-center">{{ story.name }}</h4> 
             <template v-if="story.moments && story.moments.length">
                 <div class="col-12 " v-for="moment in story.moments" :key="moment.id">
                     <div class="d-flex justify-content-around">
                        <p>{{ moment.title }}</p>
                        <p v-if="moment.date">{{ dateParse(moment.date) }}</p>
                    </div>
                    <p class="text-center">{{ moment.description }}</p>
                 </div>
             </template>
        </div>
    </div>
    
</div>    
</template>

<script>
export default {
    data(){
        return {
            post:[
                
            ]
        }
    },
    created(){
         axios.get(`/api/post/${this.id}`)
             .then((response)=>{ 
                this.post = response.data[0]
             })
    },
  	computed: {
			id(){
				return this.$route.params.id;
            },

      },
      methods: {
        dateParse(date){
            let d = new Date(date);
            return d.toDateString();
        }
      }  
}
</script>

