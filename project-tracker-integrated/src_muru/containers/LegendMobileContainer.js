import { connect } from 'react-redux';
import LegendMobileComponent from '../components/Dashboard/Trends-chart/LegendMobileComponent.js';

function mapStateToProps(state){

   	let {colorNames} = state.barChartReducers;
	let {colorData} = state.barChartReducers;

    return{
        colorNames : colorNames,
        colorData : colorData
    };
}


export default connect(mapStateToProps)(LegendMobileComponent)