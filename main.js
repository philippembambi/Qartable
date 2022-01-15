const eventBus = new Vue(); //Bus d'événement
var application = new Vue({
    data: {
        playerHealth: 70,
        monsterHealth: 100,
        gameIsRunning: false,
        cacher: true,
        view: false,
        show: false
    },
    methods: {
        startGame: function() {
            this.gameIsRunning = true;
            this.playerHealth = 100;
            this.monsterHealth = 100;

        },
        attack: function(result) {
var max = 10;
var min = 3;
var degat = Math.max(Math.floor(Math.random() * max) + 1, min)
this.playerHealth -= degat;
return result;
        },
        specialAttack: function() {
        },
        heal: function() {
            var maxi = 95;
var mini = 90;
var degat = Math.max(Math.floor(Math.random() * maxi) + 1, mini)
this.playerHealth += 5;
if(this.playerHealth >= 95) {

    alert('Le seuil de compatibilité est atteint');
    this.gameIsRunning = false;
    return;
}
        },
    }
});

var application2 = new Vue({
    data: {
        show: false
    }
});

var application3 = new Vue({
    data: {
        show: false
    }
});

application.$mount('#Indexcontent'); //Exécuter l'application
application2.$mount('#page1'); //Exécuter l'application
application3.$mount('#divToPrint'); //Exécuter l'application