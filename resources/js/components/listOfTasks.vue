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

          <tr v-for="task in tasks" :key="task.id">
            <th scope="row">{{task.id}}</th>
            <td>{{task.content}}</td>
            <td>
              <button type="button" class="btn btn-success" @click="updateTask(task.id)">Edit</button>
            <button type="button" class="btn btn-danger" @click="deleteTask(task.id)">Delete</button>
            <button type="button" class="btn btn-success" @click="saveTask(task.id)">Complete</button>
            </td>
            <td><input type="checkbox" :checked="task.isDone" name="isDone"></td>


          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>
</template>
<script>
export default {
    props:[],
    data() {
        return {
           tasks:[],
        }
    },
    created() {

    },
    mounted() {

    },
    destroyed() {

    },
    methods: {
        saveTask(id){

        },
        updateTask(id){

        },
        deleteTask(id){

        },
        refreshTasks(){

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
