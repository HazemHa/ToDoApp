<template>
  <div class="container">
  <div class="row">
    <div class="col-12">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Number</th>
            <th scope="col">Task</th>
            <th></th>
            <th scope="col">isDone</th>
          </tr>
        </thead>
        <tbody>

          <tr v-for="task in arrayOfTask" :key="task.id">
            <th scope="row">{{task.id}}</th>
            <td>{{task.content}}</td>
            <td>
              <button type="button" class="btn btn-success" @click="updateTask(task.id)">Edit</button>
            <button type="button" class="btn btn-danger" @click="deleteTask(task.id)">Delete</button>
            </td>
            <td><input type="checkbox" v-model="checked" name="isDone" @change="isChange(task.id,task.isDone)"></td>


          </tr>
{{checked}}
        </tbody>
      </table>
    </div>
  </div>
</div>
</template>
<script>
import axios from 'axios';

export default {
    props:['tasks'],
    data() {
        return {
            arrayOfTask: null,
            websiteURL:"http://127.0.0.1:8000",
            checked:false,
        }
    },
    created() {
        this.arrayOfTask = JSON.parse(this.tasks);
        console.log(this.arrayOfTask);
    },
    mounted() {

    },
    destroyed() {

    },
    methods: {
        saveTask(id){

  axios.post(`${this.websiteURL}/task`, {
      content: this.postBody,
      check:false
    })
    .then(response => {})
    .catch(e => {
      this.errors.push(e)
    })

        },
        updateTask(id){
             axios.put(`${this.websiteURL}/task/${id}`, {
      content: this.contentTask
    })
    .then(response => {})
    .catch(e => {
      this.errors.push(e)
    })



        },
        deleteTask(id){

             axios.delete(`${this.websiteURL}/task/${id}`)
    .then(response => {})
    .catch(e => {
      this.errors.push(e)
    })


        },
        refreshTasks(){

            axios.get(`${this.websiteURL}/task`)
    .then(response => {
      // JSON responses are automatically parsed.
      this.posts = response.data
    })
    .catch(e => {
      this.errors.push(e)
    })


        },
        isChange(id,isDone){
                axios.put(`${this.websiteURL}/task/${id}`, {
      isDone: this.checked,
      check:true
    })
    .then(response => {})
    .catch(e => {
      this.errors.push(e)
    })
        }
    },
}
</script>
<style>
.container {
  padding: 2rem 0rem;
}

h4 {
  margin: 2rem 0rem 1rem;
}

 td, th {
    vertical-align: middle;
  }
</style>
