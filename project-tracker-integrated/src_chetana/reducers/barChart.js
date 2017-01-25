
export default function barChartReducers(state={
	responseData : {},
	fetching : true,
	error : null,
	newData : [],
  	colorNames : ["RED","GREEN","AT RISK"],
    colorData : ["#ee5835","#28c0ce","#5f45aa"],
    currentYear : 0,
    Qs : ["Q1","Q2","Q3","Q4"],
    barHeight : 226,
    barWidth : 340,
    qData : [],
    getX : 0,
	getY : 0,
	dValue : 0,
	grpPadding : 0,
	disp : "none",
	monthToolTip : ''
}, action){
	switch (action.type) {
	  case 'FETCH_DATA_SUCCESS':{
		let newState = Object.assign({}, state, {fetching : false,
				responseData : action.payload,
				currentYear : action.currentYear,
				newData : action.newData,
				qData : action.qData})
		return newState;
	  }
	  case 'FETCH_DATA_FAILURE':{
		let newState = Object.assign({}, state, {fetching : false,
				error : action.payload})
		return newState;
		}
	case 'SET_HOVER':{
		let newState = Object.assign({},state, {getX : action.getX, getY : action.getY, dValue : action.dValue, grpPadding : action.grpPadding, disp : action.disp, monthToolTip : action.monthToolTip})
		return newState;
	}
  }

  return state;
}