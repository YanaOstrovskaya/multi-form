<template>
    <div>
        <form @submit.prevent="onPost"  enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Your name:</label>
                <input type="text" 
                       class="form-control" 
                       id="name" 
                       v-model="form.name" 
                       v-validate="'required|min:2|max:55'" 
                       name="name">
                <span class="error">{{ errors.first('name') }}</span>
            </div>
            
            <div class="form-group">
                <label for="title">Title post:</label>
                <input type="text" 
                       class="form-control" 
                       id="title" 
                       v-model="form.title" 
                       v-validate="'required|min:2|max:55'" 
                       name="title">
                <span class="error">{{ errors.first('title') }}</span>
            </div>

            <div class="form-group">
                <label for="description">Description post:</label>
                <textarea class="form-control" 
                          id="description" 
                          v-model="form.description" 
                          v-validate="'required|min:5'" 
                          name="description"></textarea>
                <span class="error">{{ errors.first('description') }}</span>
            </div>

            <div class="form-group">
                <label for="image">Image post:</label>
                <input type="file" 
                        class="form-control" 
                        id="image" 
                        v-validate="'required|image'" 
                        data-vv-as="image" 
                        name="image" 
                        @change="onImageChange" 
                        >
 
            </div>
            <!-- <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" name="image" v-validate="'required|image'" v-on:vdropzone-success="showSuccess"></vue-dropzone> -->
            <span class="error">{{ errors.first('image') }}</span>



            <div class="form-group form-check">
                <label class="form-check-label">
                <input class="form-check-input" type="checkbox" v-model="checked"> Stories
                </label>
            </div>
           
            <form-story :checked-story="checked" @store="storeInformation" @change-checked-story="checkedStory"></form-story>
            <button type="submit" class="btn btn-success mt-2" :disabled="errors.any()" >Submit</button>
        </form>
    </div>
</template>

<script>
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import FormStory from "./FormStory";

    export default {
      
      components: {
        FormStory,
        vueDropzone: vue2Dropzone
      },

      data() {
        return {
          checked: false,
          formData: new FormData(),
          success: false,
          form: {
            name: "",
            title: "",
            description: "",
            image: "",
          },
          stories: null,
          dropzoneOptions: { 
            url: '/api/formSubmit',
            thumbnailWidth: 150,
            maxFilesize: 0.5,
            maxFiles:1,
            addRemoveLinks:true,
            dictDefaultMessage: "UPLOAD ME"
      }
          
        };
      },
      methods: {
    //       showSuccess(file) {
    //         console.log('A file was successfully uploaded', file)
    // },
        onImageChange(event) {
          this.form.image = event.target.files[0];
        },
        checkedStory(data) {
          this.checked = data;
        },
        storeInformation(data) {
          this.stories = data;
        },
        onPost() {
    this.$validator.validate().then(result => {
        if (!result) {
          console.log(result);
        }
        else{
          this.formData.append("name_author", this.form.name);
          this.formData.append("title", this.form.title);
          this.formData.append("description", this.form.description);
          this.formData.append("image", this.form.image);
          this.formData.append("stories", JSON.stringify(this.stories));

            axios.post("/api/post", this.formData)
            .then(({data}) =>
            {
                this.success = data.success
                this.$router.push({name: 'posts'})   
            }
            
          )
        }
      });     
        },
    //     showSuccess(response) {
		// 	let resp = JSON.parse(response.xhr.response)
		// 	this.form.image = resp.image_url
		// 	this.image = false
		// 	this.error = false
		// 	this.$refs.myVueDropzone.removeAllFiles()
		// },
      }
    };
</script>

<style>
.error {
    color: #ff4d4d;
}
</style>
