/**
	Skill Based Chart Actions with AXIOS call
	@CONST URL_SKILL_BASED_CHART for API url
**/

import * as types from '../../../constants/Dashboard/skillBasedChart/action-types.js';
import {URL_SKILL_BASED_CHART} from '../../../constants/Dashboard/url/index.js';
import axios from 'axios';

//Actions to fetch skill
export function fetchSkillsAction () {
	return function (dispatch) {
		axios.get(URL_SKILL_BASED_CHART)
		.then((response) => {
			dispatch({type: types.FETCH_SKILL_SUCCESS, skills: response.data.skills})
		})
		.catch((err) => {
			dispatch({type:types.FETCH_SKILL_FAILURE, skills:err})
		})
	}
}