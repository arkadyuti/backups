import { CHANGE_PER_PAGE } from '../../constants/ProjectListConstants/action-types';

//This action is called to handle change in number of rows shown per page
export default function changePerPage(perPage,actionPerformed,end){
	
	return{
	 	type:CHANGE_PER_PAGE,
	 	perPage:perPage,
	 	actionPerformed:actionPerformed
	}

}