import { SEARCH } from '../../constants/ProjectListConstants/action-types';

//Action to handle search function
export default function searchData(result){
	
	return function(dispatch){
		dispatch({
			type:SEARCH,
			key:result.key,
			searchValue:result.searchValue,
			data:result.data,
			newTopics:result.newTopics
		})
	}
	
}
