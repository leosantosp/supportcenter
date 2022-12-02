function createGame(stage, player1, player2, gameHour, player1Score, player2Score){
    return `
        <li class="stage">
            <p class="stage-name">${stage}</p>
        </li>
        <li class="card-game">
            <img class="card-flag" src="./assets/images/icon=${player1}.svg" alt="Bandeira do ${player1}">
            <strong class="game-hour">${gameHour}</strong>
            <img class="card-flag" src="./assets/images/icon=${player2}.svg" alt="Bandeira da ${player2}">
        </li>
        <li class="score-game">
            <ul class="score-game-list">
                <li class="score-item">${player1Score}</li>
                <li class="score-item">x</li>
                <li class="score-item">${player2Score}</li>
            </ul>
        </li>
    `
}

let delay = -0.3;

function createCard(date, day, games){
    delay = delay + 0.3;

    return `
        <div class="card" style="animation-delay: ${delay}s">
        <h2 class="card-title">${date} <span>${day}</span></h2>

        <ul class="card-list">
            ${games}            
        </ul>
    </div>
    `
}

document.querySelector("#cards").innerHTML = 

        createCard("23/11", "quarta",
            createGame("Grupo F", "morocco", "croatia", "07:00", "0", "0") +
            createGame("Grupo E", "germany", "japan", "10:00", "1", "2") +
            createGame("Grupo E", "spain", "costa rica", "13:00", "7", "0") +
            createGame("Grupo F", "belgium", "canada", "16:00", "1", "0")
        ) +

        createCard("24/11", "quinta",
            createGame("Grupo G", "switzerland", "cameroon", "07:00", "1", "0") +
            createGame("Grupo H", "uruguay", "south korea", "10:00", "0", "0") +
            createGame("Grupo H", "portugal", "ghana", "13:00", "3", "2") +
            createGame("Grupo G", "brazil", "serbia", "16:00", "2", "0")
        ) +

        createCard("25/11", "sexta",
            createGame("Grupo B", "wales", "iran", "07:00", "0", "2") +
            createGame("Grupo A", "qatar", "senegal", "10:00", "0", "0") +
            createGame("Grupo A", "netherlands", "ecuador", "13:00", "0", "0") +
            createGame("Grupo B", "england", "usa", "16:00", "0", "0")
        ) +
        createCard("26/11", "sábado",
            createGame("Grupo D", "tunisia", "australia", "07:00", "0", "0") +
            createGame("Grupo C", "poland", "saudi arabia", "10:00", "0", "0") +
            createGame("Grupo D", "france", "denmark", "13:00", "0", "0") +
            createGame("Grupo C", "argentina", "mexico", "16:00", "0", "0")
        ) +

        createCard("27/11", "domingo",
            createGame("Grupo E", "japan", "costa rica", "07:00", "0", "0") +
            createGame("Grupo F", "belgium", "morocco", "10:00", "0", "0") +
            createGame("Grupo F", "croatia", "canada", "13:00", "0", "0") +
            createGame("Grupo E", "spain", "germany", "16:00", "0", "0")
        ) +

        createCard("28/11", "segunda",
            createGame("Grupo G", "cameroon", "serbia", "07:00", "0", "0") +
            createGame("Grupo H", "south korea", "ghana", "10:00", "0", "0") +
            createGame("Grupo G", "brazil", "switzerland", "13:00", "0", "0") +
            createGame("Grupo H", "portugal", "uruguay", "16:00", "0", "0")
        );

