export function displayCreateTaskForm() {
    const element = document.getElementById("add_task_container");
    (element.style.display === "block") ? element.style.display = "none" : element.style.display = "block"
}