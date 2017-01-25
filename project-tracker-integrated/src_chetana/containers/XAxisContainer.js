import { connect } from 'react-redux';
import XAxisComponent from '../components/Dashboard/Trends-chart/XAxisComponent.js';

function mapStateToProps(state){
    return{
        data : state.barChartReducers.responseData,
        currentYear : state.barChartReducers.currentYear,
        newData : state.barChartReducers.newData,
        colorNames : state.barChartReducers.colorNames,
        colorData : state.barChartReducers.colorData,
        Qs : state.barChartReducers.Qs,
        barHeight : state.barChartReducers.barHeight,
        barWidth : state.barChartReducers.barWidth
    };
}

export default connect(mapStateToProps)(XAxisComponent);