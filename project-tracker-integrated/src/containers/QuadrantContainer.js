import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import { setHover }  from '../actions/TrendsChartActions.js';
import QuadrantComponent from '../components/Dashboard/Trends-chart/QuadrantComponent.js';

function mapStateToProps(state){

        let {currentYear} = state.barChartReducers;
        let {newData} = state.barChartReducers;
        let {colorNames} = state.barChartReducers;
        let {colorData} = state.barChartReducers;
        let {Qs} = state.barChartReducers;
        let {barHeight} = state.barChartReducers;
        let {barWidth} = state.barChartReducers;
        let {qData} = state.barChartReducers;
        let {getX} = state.barChartReducers;
        let {getY} = state.barChartReducers;
        let {grpPadding} = state.barChartReducers;
        let {dValue} = state.barChartReducers;
        let {disp} = state.barChartReducers;
        let {monthToolTip} = state.barChartReducers;
        let {ttWidth} = state.barChartReducers;
        let {textAnchor} = state.barChartReducers;

    return{
        currentYear : currentYear,
        newData : newData,
        colorNames : colorNames,
        colorData : colorData,
        Qs : Qs,
        barHeight : barHeight,
        barWidth : barWidth,
        qData : qData,
        getX : getX,
        getY : getY,
        grpPadding : grpPadding,
        dValue : dValue,
        disp : disp,
        monthToolTip : monthToolTip,
        ttRectWidth : ttWidth,
        textAnchor : textAnchor
    };
}

function mapDispatchToProps(dispatch){
    return bindActionCreators({
        setHover:setHover
    },dispatch)
}

export default connect(mapStateToProps,mapDispatchToProps)(QuadrantComponent);