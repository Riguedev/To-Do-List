import { updateState } from "./taskFunctions.js";
import { logOut } from "./taskFunctions.js";
import { createTask } from "./taskFunctions.js";
import { displayCreateTaskForm } from "./functionsDOM.js";

const addTask = document.getElementById("add");
let tasks = document.getElementsByClassName("task");
let icons = document.getElementsByClassName("delete");
const closeSession = document.getElementById("close");
const addTaskAbort = document.getElementById("add_task_abort");
const addTaskSubmit = document.getElementById("add_task_submit");

addTask.addEventListener("click", () => {
    displayCreateTaskForm();
});

addTaskAbort.addEventListener("click", (event) => {
    event.preventDefault();
    displayCreateTaskForm();
});

addTaskSubmit.addEventListener("click", (event) => {
    event.preventDefault();
    createTask();
})

closeSession.addEventListener("click", logOut)

Array.from(tasks).forEach((task) => {
    task.addEventListener("click", () => {
        updateState(task);
    })
})

Array.from(icons).forEach((icon) => {{
    const siblingTask = icon.previousElementSibling
    icon.addEventListener("click", () => {console.log(siblingTask)})
}})
