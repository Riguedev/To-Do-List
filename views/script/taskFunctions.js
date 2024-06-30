export function updateState(task){
    const taskDOM = document.getElementById(task.id)
    const URL = "/Task/controllers/updateTaskState.php";
    let id = task.id;
    let state = taskDOM.classList[1];
    let taskState;

    if(state === "complete") {
        taskState = 1;
    } else if(state === "uncomplete") {
        taskState = 0;
    }
    
    fetch(URL, {
        method: "PUT",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            task_id: id,
            complete: taskState
          })
    })

    .then(response => response.json())
    .then(data => {
        if(data.taskInfo.complete == 1) {
            taskDOM.classList.remove("uncomplete")
            taskDOM.classList.add("complete")
        } else if(data.taskInfo.complete == 0) {
            taskDOM.classList.remove("complete")
            taskDOM.classList.add("uncomplete")
        }
    })

    .catch(error => {
        console.log(error)
    })

}

export function createTask() {
    const taskInput = document.getElementById("add_task_text");
    fetch("/Task/controllers/createTask.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            task: taskInput.value
        })
    })

    .then(response => {
        if(response.ok) {
            location.reload();
        }
    })
    .catch(error => {
        console.log(error)
    })
}

export function logOut() {

    const userConfirmed = confirm("¿Estás seguro de cerrar sesión?");

    if(userConfirmed) {
        fetch("../controllers/logout.php", {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
        .then(response => {
            if (response.ok) {
                window.location.href = '../index.php'; // Redirige al usuario después del cierre de sesión exitoso
            } else {
                console.error('Error en el cierre de sesión:', response.statusText);
            }
        })
        .catch(error => {
            console.error('Hubo un problema con la operación fetch:', error);
        });
    }
    
}
