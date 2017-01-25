import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import { setHover }  from '../actions/barChartActions.js';
import QuadrantComponent from '../components/Dashboard/Trends-chart/QuadrantComponent.js';

function mapStateToProps(state){
    return{
        data : state.barChartReducers.responseData,
        currentYear : state.barChartReducers.currentYear,
        newData : state.barChartReducers.newData,
        colorNames : state.barChartReducers.colorNames,
        colorData : state.barChartReducers.colorData,
        Qs : state.barChartReducers.Qs,
        barHeight : state.barChartReducers.barHeight,
        barWidth : state.barChartReducers.barWidth,
        qData : state.barChartReducers.qData,
        getX : state.barChartReducers.getX,
        getY : state.barChartReducers.getY,
        grpPadding : state.barChartReducers.grpPadding,
        dValue : state.barChartReducers.dValue,
        disp : state.barChartReducers.disp,
        monthToolTip : state.barChartReducers.monthToolTip
    };
}

function mapDispatchToProps(dispatch){
    return bindActionCreators({
        setHover:setHover
    },dispatch)
}

export default connect(mapStateToProps,mapDispatchToProps)(QuadrantComponent);