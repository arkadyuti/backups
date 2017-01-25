import * as types from './ActionTypes.js';
import axios from 'axios';

export function fetchData (skills) {
	return function (dispatch) {
		axios.get("http://localhost:3000/skills")
		.then((response) => {
			dispatch({type: types.FETCH_SKILL_SUCCESS, skills: response.data})
			/*console.log(response.data);*/
		})
		.catch((err) => {
			dispatch({type:types.FETCH_SKILL_FAILURE, skills:err})
		})
	}
}	