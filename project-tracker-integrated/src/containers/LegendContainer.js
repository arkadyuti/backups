import { connect } from 'react-redux';
import LegendComponent from '../components/Dashboard/Trends-chart/LegendComponent.js';

function mapStateToProps(state){

	let {colorNames} = state.barChartReducers;
	let {colorData} = state.barChartReducers;

    return{
        colorNames : colorNames,
        colorData : colorData
    };
}


export default connect(mapStateToProps)(LegendComponent)