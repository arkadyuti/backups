import { connect } from 'react-redux';
import LegendMobileComponent from '../../../components/Dashboard/TrendsChart/legend-mobile.js';

function mapStateToProps(state){

   	let {colorNames} = state.barChartReducers;
	let {colorCodes} = state.barChartReducers;

    return{
        colorNames : colorNames,
        colorCodes : colorCodes
    };
}


export default connect(mapStateToProps)(LegendMobileComponent)