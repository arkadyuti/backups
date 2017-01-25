import { FETCH_DATA_SUCCESS, FETCH_DATA_FAILURE, SET_HOVER, SET_QUADRANT } from '../constants/TrendsChartActionTypes';

export default function barChartReducers(state={
	fetching : true,
	error : null,
	newData : [],
  	colorNames : ["RED","GREEN","AT RISK"],
    colorData : ["#ee5835","#28c0ce","#5f45aa"],
    currentYear : 0,
    Qs : ["Q1","Q2","Q3","Q4"],
	activeQ : "1",
    barHeight : 226,
    barWidth : 340,
    qData : [],
    getX : 0,
	getY : 0,
	dValue : 0,
	grpPadding : 0,
	disp : "none",
	monthToolTip : '',
	ttWidth : 0,
    textAnchor : "start"
}, action){
	switch (action.type) {
	  case FETCH_DATA_SUCCESS:{
		let newState = Object.assign({}, state,
			{
				fetching : false,
				currentYear : action.currentYear,
				newData : action.newData,
				qData : action.qData});
		return newState;
	  }
	  case FETCH_DATA_FAILURE:{
		let newState = Object.assign({}, state,
			{
				fetching : false,
				error : action.payload});
		return newState;
		}
	case SET_HOVER:{
		let newState = Object.assign({},state,
			{
				getX : action.getX,
				getY : action.getY,
				dValue : action.dValue,
				grpPadding : action.grpPadding,
				disp : action.disp,
				monthToolTip : action.monthToolTip,
				ttWidth : action.ttWidth,
				textAnchor : action.textAnchor});
		return newState;
	}
	case SET_QUADRANT:{
		let newState = Object.assign({},state,
			{
				activeQ : action.activeQ});
		return newState;
	}
  }

  return state;
}