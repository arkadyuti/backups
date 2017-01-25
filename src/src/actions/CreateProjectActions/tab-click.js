import {TAB_SELECTED} from '../../constants/CreateProjectConstants/action-types';

export function tabClick(tabname){
	return {
		type: TAB_SELECTED,
		payload : tabname,
		resetTabError : 'true',
		staffingFormDisplay : 'close',
		disableButton : 'false'
	}
}