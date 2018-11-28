<template>
    <div v-if="checkedStory">
        <div v-for="(story, indexStory) in form.stories" :key="indexStory" class="bgChess p-3">
        <div class="form-group">
            <h5>Story {{indexStory+1}} <button type="button" class="btn btn-dark btn-sm btn-rounded" @click="removeStory(indexStory)">x</button></h5>
            <input type="text" 
                   class="form-control" 
                   id="name" 
                   placeholder="Name story"
                   @change="storeInformation" 
                   v-model="form.stories[indexStory].name" 
                   v-validate="'required|min:2|max:55'" 
                   :name="nameStory(indexStory)"
                    >
                   <span class="error">{{ errors.first(nameStory(indexStory)) }}</span>
        </div>
                    <div class="row d-flex justify-content-between">
                    <div class="col-2 d-flex align-items-center">     
                        <input type="button" class="btn btn-light" @click="addMoments(indexStory)" value="Add moments"> 
                    </div>
                    <div class="col-10">
                      <div class="row">
                        <div v-for="(moment, indexMoment) in form.stories[indexStory].moments" :key="moment.id" class="col-6">
                            <div>
                                <h6>Moment {{indexMoment+1}} <button type="button" class="btn btn-dark btn-sm btn-rounded" @click="removeMoment(indexStory, indexMoment)">x</button></h6>
                                <div class="form-group">
                                    <input type="text" 
                                          class="form-control" 
                                          id="title" 
                                          placeholder="Title"
                                          v-model="form.stories[indexStory].moments[indexMoment].title" 
                                          @change="storeInformation"
                                          v-validate="'required|min:2|max:55'" 
                                          :name="titleMoment(indexMoment, indexStory)"
                                          :key="`title${indexMoment}${indexStory}`">
                                          <span class="error">{{ errors.first(titleMoment(indexMoment, indexStory)) }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="date">Date:</label>
                                    <input type="date" 
                                          class="form-control" 
                                          id="date" 
                                          placeholder="Date"
                                          v-model="form.stories[indexStory].moments[indexMoment].date" 
                                          @change="storeInformation">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" 
                                              id="description" 
                                              placeholder="Description"
                                              v-model="form.stories[indexStory].moments[indexMoment].description" 
                                              @change="storeInformation"
                                              v-validate="'required|min:5'" 
                                              :name="descriptionMoment(indexMoment, indexStory)"></textarea>
                                              <span class="error">{{ errors.first(descriptionMoment(indexMoment, indexStory)) }}</span>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <button type="button" @click="addStory" class="m-3 btn btn-light">Add Story</button>
                    </div>
                    
    </div>
    </div>
</template>

<script>
let id = 0;
    export default {
      data() {
        return {
          form: {
            stories: [
                {
                 name: "" ,
                 moments: []
                }
                ],
          }
        };
      },
      inject: ['$validator'],
      props: ["checkedStory"],
      methods: {
        nameStory(index){
          return `name ${index+1}`
        },
        titleMoment(indexMoment, indexStory){
          return `title ${indexMoment+1}(${indexStory+1})`
        },
        descriptionMoment(indexMoment, indexStory){
          return `description ${indexMoment+1}(${indexStory+1})`
        },
        addMoments(index) {
          this.form.stories[index].moments.push({
            id:id,
            title: "",
            date: "",
            description: ""
          });
          id++
        },
        addStory() {
          this.form.stories.push({
            name: "",
            moments: []
          });
        },
        removeMoment(indexStory, indexMoment) {
          this.form.stories[indexStory].moments.splice(indexMoment, 1);
        },
        removeStory(index) {
          if (index == 0) {
            this.$emit("change-checked-story", false);
          } else {
            this.form.stories.splice(index, 1);
          }
        },
        storeInformation() {
          this.$emit("store", this.form.stories);

          

        }
      }
    };
</script>

<style>
.btn-rounded {
  border-radius: 50%;
}
</style>
