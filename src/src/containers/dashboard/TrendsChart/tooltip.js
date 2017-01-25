
import { connect } from 'react-redux';
import ToolTipComponent from '../../../components/Dashboard/TrendsChart/tooltip.js';

function mapStateToProps(state){
    let {currentYear} = state.barChartReducers;
    let {getX} = state.barChartReducers;
    let {getY} = state.barChartReducers;
    let {tooltipWidth} = state.barChartReducers;
    let {tooltipValue} = state.barChartReducers;
    let {tooltipDisplay} = state.barChartReducers;
    let {textAnchor} = state.barChartReducers;
    let {groupPadding} = state.barChartReducers;
    let {monthToolTip} = state.barChartReducers;

    return{
        currentYear : currentYear,
        getX : getX,
        getY : getY,
        tooltipWidth : tooltipWidth,
        tooltipValue : tooltipValue,
        tooltipDisplay : tooltipDisplay,
        textAnchor : textAnchor,
        groupPadding : groupPadding,
        monthToolTip : monthToolTip
    };
}


export default connect(mapStateToProps,null)(ToolTipComponent);