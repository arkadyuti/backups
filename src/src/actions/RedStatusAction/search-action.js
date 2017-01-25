import { SEARCH_RED_STATUS } from '../../constants/RedStatusConstants/columns-displayed';

//Action to handle search function
export default function searchData(result){
	
	return function(dispatch){
		dispatch({
			type:SEARCH_RED_STATUS,
			key:result.key,
			searchValue:result.searchValue,
			data:result.data
		})
	}

}
