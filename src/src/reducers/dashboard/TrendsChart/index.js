import { FETCH_DATA_SUCCESS, FETCH_DATA_FAILURE, SET_HOVER, SET_QUARTER } from '../../../constants/Dashboard/trendsChart/action-types';

export default function barChartReducers(state={
	fetching : true,
	error : null,
	responseData : [],
  	colorNames : ["RED","GREEN","AT RISK"],
    colorCodes : ["#ee5835","#28c0ce","#5f45aa"],
    currentYear : 0,
	leastYear : 0,
    Quarters : ["Q1","Q2","Q3","Q4"],
	activeQuarter : "1",
    barHeight : 226,
    barWidth : 340,
    quarterData : [],
    getX : 0,
	getY : 0,
	tooltipValue : 0,
	groupPadding : 0,
	tooltipDisplay : "none",
	monthToolTip : '',
	tooltipWidth : 0,
    textAnchor : "start"
}, action){
	switch (action.type) {
	  case FETCH_DATA_SUCCESS:{
		let newState = Object.assign({}, state,
			{
				fetching : false,
				currentYear : action.currentYear,
                leastYear : action.leastYear,
                responseData : action.responseData,
                quarterData : action.quarterData,
                error : null});
		return newState;
	  }
	  case FETCH_DATA_FAILURE:{
		let newState = Object.assign({}, state,
			{
				fetching : false,
				error : action.err});
		return newState;
		}
	case SET_HOVER:{
		let newState = Object.assign({},state,
			{
				getX : action.getX,
				getY : action.getY,
                tooltipValue : action.tooltipValue,
				groupPadding : action.groupPadding,
                tooltipDisplay : action.tooltipDisplay,
				monthToolTip : action.monthToolTip,
                tooltipWidth : action.tooltipWidth,
				textAnchor : action.textAnchor});
		return newState;
	}
	case SET_QUARTER:{
		let newState = Object.assign({},state,
			{
                activeQuarter : action.activeQuarter});
		return newState;
	}
  }

  return state;
}