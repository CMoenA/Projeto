//Print numbers from 1 to 100 on the terminal, and for multiples of 3, print "Ping", for multiples
//of 5, print "Pong", and for multiples of both, print "PingPong".

for (let i = 0; i<101; i++){
    if(i>0 && i%3==0){
        console.log(i+" Ping");
    }
    if(i%5==0){
        console.log(i+"Pong");
    }

    else{
        console.log(i);
    }
}

for (var i = 0; i < 100; i++) {

    if(i % 3 === 0 && i % 5 === 0) {
    console.log(i, "PingPong")
    } else if(i % 3 === 0) {
    console.log(i, "Ping")
    } else if(i % 5 === 0) {
    console.log(i, "Pong")
    } else {
    console.log(i)
    }
    
    }

    for (var i = 0; i < 100; i++) {

        let text = "";
        
        if(i % 3 === 0) {
        text += "Ping"
        }
        
        if(i % 5 === 0) {
        text += "Pong"
        }
        
        
        console.log(i, text)
        
        }

//Write a JavaScript function that takes an array of persons objects as an argument, and
//modifies the objects such that all married women have their last name changed to that of
//their husband's.

const persons = [{
    id: 4,
    firstname: "Ricardo",
    lastname: "Bernardes",
    gender: "male",
    married: 10
    },
    {
    id: 8,
    firstname: "Pedro",
    lastname: "Jaquim",
    gender: "male",
    married: null
    },
    {
    id: 10,
    firstname: "Maria",
    lastname: "Lurdes",
    gender: "female",
    married: 4
    },
    {
    id: 12,
    firstname: "Joana",
    lastname: "Silva",
    gender: "female",
    married: null
    }]