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

          <tr>
            <th scope="row">2</th>
            <td>Cristina</td>
            <td>
              <button type="button" class="btn btn-success">Edit</button>
            <button type="button" class="btn btn-danger">Delete</button>
            <button type="button" class="btn btn-success">Complete</button>
            </td>
            <td><input type="checkbox" name="isDone"></td>


          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>
</template>

<style>
.container {
  padding: 2rem 0rem;
}

h4 {
  margin: 2rem 0rem 1rem;
}

.table-image {

}
 td, th {
    vertical-align: middle;
  }
</style>
