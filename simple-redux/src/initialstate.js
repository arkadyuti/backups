var C = require("./constants");

module.exports = function(){
    return {
        heroes: {
            batman: {
                quote: "I'm batman.",
                kills: 0
            },
            superman: {
                quote: "I can fly!",
                kills: 0
            },
            spiderman: {
                quote: "Why don't you love me, Lois?",
                kills: 0
            },
            "he-man": {
                quote: "By the power of Grayskull!",
                kills: 0
            }
        },
        battlefield: {
            doing: {batman:C.WAITING,superman:C.WAITING,spiderman:C.WAITING,"he-man":C.WAITING},
            standing: 4,
            log: ["Ready.... fight!"]
        }
    };
};