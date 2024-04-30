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
        console.log(response);
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
  todoListIndex(callback) {
    console.log("Getting todo list index!");
    this.request("/todo-lists/index/", callback);
  }
  todoListGet(id) {
    console.log("Getting todo list!");
    this.request("/todo-lists/get/" + id, function (data) {
      console.log(data);
    });
  }
  todoListDelete(id, callback) {
    console.log("Deleting todo list!");
    this.request("/todo-lists/delete/" + id, callback);
  }
  todoListCreate(input, callback) {
    console.log("Creating todo list!");
    this.request("/todo-lists/create/", callback, input);
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

class AppClass {
  load() {
    var app_class = this;
    API.todoListIndex(function (todo_lists) {
      todo_lists.forEach(function (todo_list) {
        app_class.add_list_to_interface(todo_list);
      });
    });
  }
  add_list_to_interface(todo_list) {
    var element = template_todo_list.cloneNode(true);
    element.querySelector("div[name=list-title]").innerHTML = todo_list.title;
    element.querySelector(".todo-list").setAttribute("data-id", todo_list.id);
    element
      .querySelector("div[name=delete]")
      .addEventListener("click", function () {
        delete_todo_list(this);
      });
    todo_lists_container.append(element);
  }
  add_todo_to_interface(todo) {
    var element = template_todo.cloneNode(true);
    var todo_container = document.querySelector(
      ".todo-list[data-id=35] .list-items"
    );
    element.querySelector("div.list-item-text").innerHTML = todo.title;
    element.querySelector(".list-item").setAttribute("data-id", todo.id);
    element
      .querySelector("div[name=delete]")
      .addEventListener("click", function () {
        delete_todo(this);
      });
    todo_container.append(element);
  }
}

const API = new TodoListAPI();
const App = new AppClass();
const todo_lists_container = document.getElementById("todo-lists-container");
const template_todo_list = document.getElementById("template-todo-list");
const template_todo = document.getElementById("template-todo");
const create_todo_list_btn = document.getElementById("create-list-btn");

function delete_todo_list(element) {
  var todo_list = element.closest(".todo-list");
  console.log(todo_list);
  API.todoListDelete(todo_list.getAttribute("data-id"), function () {
    todo_list.remove();
  });
}

function create_todo_list() {
  var title = prompt("Enter a title for todo list...");
  API.todoListCreate({ title: title }, function (todo_list) {
    App.add_list_to_interface(todo_list);
  });
}
function delete_todo(element) {
  var todo = element.closest(".list-item");
  console.log(todo);
  API.todoDelete(todo.getAttribute("data-id"), function () {
    todo.remove();
  });
}

function create_todo(event) {
  console.log(event);
  API.todoCreate({ title: title }, function (todo) {
    App.add_todo_to_interface(todo);
  });
}

create_todo_list_btn.addEventListener("click", create_todo_list);
App.load();
document.querySelectorAll(".new-to-do-box").forEach(function (element) {
  element.addEventListener("keypress", create_todo);
});
