<template>
  <div class="container">
    <div class="row">
        <div class="col-sm-12">
             <!-- Button trigger modal -->
                <button
                  type="button"
                  class="btn btn-primary"
                  data-toggle="modal"
                  data-target="#addNewTaskModal"
                >Add new Task</button>
        </div>
      <div class="col-12">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Number</th>
              <th scope="col">Task</th>
              <th></th>
              <th scope="col">isDone</th>
              <th scope="col">Share Task</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="task in arrayOfTask" :key="task.id">
              <th scope="row">{{task.id}}</th>
              <td>{{task.content}}</td>
              <td>

                <button
                  type="button"
                  class="btn btn-success"
                  data-toggle="modal"
                  data-target="#EditTaskModal"
                  @click="setCurrentTask(task)"
                >Edit</button>
                <button type="button" class="btn btn-danger" @click="deleteTask(task.id)">Delete</button>
              </td>
              <td>
                <input
                  type="checkbox"
                  name="isDone"
                  :checked="task.isDone"
                  @change="isChange($event,task.id)"
                />
              </td>
              <td>
                 <button type="button" class="btn btn-info" @click="shareTask(task.id)">Share</button>


              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="addNewTaskModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewTaskModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewTaskModalLabel">Add Task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="newTask">Task</label>
              <input type="text" name="newTask" id="newTask" v-model="newTask" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" @click="saveTask">Add</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="EditTaskModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="EditTaskModal"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="EditTaskModal">Edit Task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="editTask">Task</label>
              <input type="text" name="editTask" id="editTask" v-model="contentCurrentTask" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" @click="updateTask()">Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  props: ["tasks"],
  data() {
    return {
      arrayOfTask: null,
      websiteURL: "http://127.0.0.1:8000",
      checked: false,
      newTask: "",
      editTask: null,
      contentCurrentTask: "",
      errors:[]
    };
  },
  created() {
    this.arrayOfTask = JSON.parse(this.tasks);
  },
  methods: {
    setCurrentTask(task) {
      this.editTask = task;
      this.contentCurrentTask = task.content;
    },
    saveTask() {
        let self = this;
      axios
        .post(`${this.websiteURL}/task`, {
          content: this.newTask,
          check: false
        })
        .then(response => {
            let newTask = response.data;
            self.arrayOfTask.push(newTask);
        })
        .catch(e => {
            console.log(e.message);
          this.errors.push(e);
        });
    },
    shareTask(id){
       axios
        .post(`${this.websiteURL}/Shareable`, {
          task_id: id
        })
        .then(response => {
            if(response.data.task_id){
                  this.$toaster.info(response.data.task_id[0]);
            }
          this.showUpMessage(response);
        })
        .catch(e => {
          this.errors.push(e);
        });

    },
    updateTask() {
        let self = this;

      axios
        .put(`${this.websiteURL}/task/${this.editTask.id}`, {
          content: this.contentCurrentTask
        })
        .then(response => {
            var Index = self.arrayOfTask.indexOf(this.editTask);
          this.showUpMessage(response);
                      self.arrayOfTask[Index].content = this.contentCurrentTask;
        })
        .catch(e => {
          this.errors.push(e);
        });
    },
    showUpMessage(response) {
      if (response.data.success) {
        this.$toaster.success(response.data.success);
      }
      if (response.data.error) {
        this.$toaster.error(response.data.error);
      }
    },
    deleteTask(id) {
        let self = this;

        var r = confirm("Are you sure to delete this task ");
if (r == true) {
 axios
        .delete(`${this.websiteURL}/task/${id}`)
        .then(response => {

          this.showUpMessage(response);

          self.arrayOfTask.splice(self.arrayOfTask.findIndex(function(i){
    return i.id === id;
}), 1);

        })
        .catch(e => {
          this.errors.push(e);
        });
}


    },
    isChange(e, id, isDone) {
      axios
        .put(`${this.websiteURL}/task/${id}`, {
          isDone: e.target.checked,
          check: true
        })
        .then(response => {
          this.showUpMessage(response);
        })
        .catch(e => {
          this.errors.push(e);
        });
    }
  }
};
</script>
<style>
.container {
  padding: 2rem 0rem;
}

h4 {
  margin: 2rem 0rem 1rem;
}

td,
th {
  vertical-align: middle;
}
</style>
