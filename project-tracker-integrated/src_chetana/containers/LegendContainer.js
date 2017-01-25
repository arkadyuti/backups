import { connect } from 'react-redux';
import LegendComponent from '../components/Dashboard/Trends-chart/LegendComponent.js';

function mapStateToProps(state){
    return{
        colorNames : state.barChartReducers.colorNames,
        colorData : state.barChartReducers.colorData
    };
}


export default connect(mapStateToProps)(LegendComponent)