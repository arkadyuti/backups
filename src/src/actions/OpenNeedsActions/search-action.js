import { SEARCH_OPEN_NEEDS } from '../../constants/OpenNeedsConstants/action-types';

//Action to handle search function
export default function searchData(result){
	
	return function(dispatch){
		dispatch({
		type:SEARCH_OPEN_NEEDS,
		key:result.key,
		searchValue:result.searchValue,
		data:result.data,
		newTopics:result.newTopics,
		newPagerLinks:result.newPagerLinks
		})
	}

}