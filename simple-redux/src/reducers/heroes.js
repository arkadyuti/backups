var C = require("../constants"),
    initialState = require("../initialstate");

module.exports = function(state,action){
    var newstate = Object.assign({},state); // sloppily copying the old state here, so we never mutate it
    switch(action.type){
        case C.KILL_HERO:
            newstate[action.killer].kills += 1;
            return newstate;
        default: return state || initialState().heroes;
    }
};