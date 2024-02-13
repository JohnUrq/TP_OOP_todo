console.log("js loaded");

class TodoListAPI {
  request(url, callback) {
    fetch("http://localhost:8888/Tom%20Lessons/TP_OOP/todo%20list/api" + url)
      .then(function (response) {
        return response.json();
      })
      .then(callback);
  }
  todoGet() {
    console.log("Getting todo");
    this.request("/todos/get/3", function (data) {
      console.log(data);
    });
  }
  todoDelete() {
    console.log("Deleting todo");
  }
  todoCreate() {
    console.log("Creating todo");
  }
  todoUpdate() {
    console.log("Updating todo");
  }
  todoListGet() {
    console.log("Getting todo list!");
    this.request("/todo-lists/get/17", function (data) {
      console.log(data);
    });
  }
  todoListDelete() {
    console.log("Deleting todo list!");
  }
  todoListCreate() {
    console.log("Creating todo list!");
  }
  todoListUpdate() {
    console.log("Updating todo list!");
  }
}

const API = new TodoListAPI();
