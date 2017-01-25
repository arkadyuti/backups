// Here, state argument is not application state,
// only the state this reducer is responsible for.

export default function (state=null, action) {
	console.log(action.payload);
	switch(action.type) {
		case 'STATUS_CHART': 
		return action.payload
	}
	return state;
}