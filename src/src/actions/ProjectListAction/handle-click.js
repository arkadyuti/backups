import { HANDLE_CLICK } from '../../constants/ProjectListConstants/action-types';
export default function handleClick(page,topics,actionPerformed,pageValue){
	return{
	 	type: HANDLE_CLICK,
	 	page:page,
	 	topics:topics,
	 	actionPerformed:actionPerformed,
	 	pageValue:pageValue
	}
}