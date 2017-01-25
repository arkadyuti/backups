import { SORTING } from '../../constants/ProjectListConstants/action-types';

//Action to handle sort function
export default function sortData(result){
	return {
		type:SORTING,
		toggleFilter:result.toggleFilter,
		key:result.key,
		data:result.data,
		topics:result.newTopics
	}

}