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



document.querySelector('#previous-games').innerHTML = 
    createCard("20/11", "domingo",
        createGame("Grupo A", "qatar", "ecuador", "13:00", "0", "2")
    ) +

    createCard("21/11", "segunda",
        createGame("Grupo B", "england", "iran", "10:00", "6","2") +
        createGame("Grupo A", "senegal", "netherlands", "13:00", "0","2") + 
        createGame("Grupo B", "usa", "wales", "16:00", "1", "1")
    ) +
    createCard("22/11", "terça",
        createGame("Grupo C", "argentina", "saudi arabia", "07:00", "1","2") +
        createGame("Grupo D", "denmark", "tunisia", "10:00", "0","0") + 
        createGame("Grupo B", "mexico", "poland", "13:00", "0", "0") +
        createGame("Grupo D", "france", "australia", "16:00", "4", "1")
    )