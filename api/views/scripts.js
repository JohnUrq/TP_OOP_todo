console.log("js loaded");

class TodoListAPI {
  request(url, callback, post_data) {
    var url_root =
      "http://localhost:8888/Tom%20Lessons/TP_OOP/todo%20list/TP_OOP_todo/api";
    var options;
    if (typeof post_data === "undefined") {
      options = { method: "GET" };
    } else {
      options = {
        method: "POST",
        body: JSON.stringify(post_data),
        headers: {
          "Content-Type": "application/json",
        },
      };
    }
    fetch(url_root + url, options)
      .then(function (response) {
        return response.json();
      })
      .then(callback);
  }
  todoIndex(list_id) {
    console.log("Getting todo index");
    this.request("/todos/index/" + list_id, function (data) {
      console.log(data);
    });
  }
  todoGet(id) {
    console.log("Getting todo");
    this.request("/todos/get/" + id, function (data) {
      console.log(data);
    });
  }
  todoDelete(id) {
    console.log("Deleting todo");
    this.request("/todos/delete/" + id, function (data) {
      console.log(data);
    });
  }
  todoCreate(input) {
    console.log("Creating todo");
    this.request(
      "/todos/create/",
      function (data) {
        console.log(data);
      },
      input
    );
  }
  todoUpdate(id, input) {
    console.log("Updating todo");
    this.request(
      "/todos/update/" + id,
      function (data) {
        console.log(data);
      },
      input
    );
  }
  todoListIndex() {
    console.log("Getting todo list index!");
    this.request("/todo-lists/index/", function (data) {
      console.log(data);
    });
  }
  todoListGet(id) {
    console.log("Getting todo list!");
    this.request("/todo-lists/get/" + id, function (data) {
      console.log(data);
    });
  }
  todoListDelete(id) {
    console.log("Deleting todo list!");
    this.request("/todo-lists/delete/" + id, function (data) {
      console.log(data);
    });
  }
  todoListCreate(input) {
    console.log("Creating todo list!");
    this.request(
      "/todo-lists/create/",
      function (data) {
        console.log(data);
      },
      input
    );
  }
  todoListUpdate(id, input) {
    console.log("Updating todo list!");
    this.request(
      "/todo-lists/update/" + id,
      function (data) {
        console.log(data);
      },
      input
    );
  }
}
const API = new TodoListAPI();

class AppClass {
  load() {
    var todo_lists = API.todoListIndex();
    console.log(todo_lists);
  }
}
const App = new AppClass();
