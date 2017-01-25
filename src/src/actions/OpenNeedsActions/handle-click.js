import { HANDLE_CLICK_OPEN_NEEDS } from '../../constants/OpenNeedsConstants/action-types';

//Action to handle page change
export default function handleClick(page,topics,token,count){
	
	return{
	 	type: HANDLE_CLICK_OPEN_NEEDS,
	 	page:page,
	 	topics:topics,
	 	token:token,
	 	count:count
	}

}