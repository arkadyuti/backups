
export default function (state, action) {
	switch(action.type) {
		case 'x': 
		return action.payload
	}

	return {
		x:80,
		y:-65
	};
}