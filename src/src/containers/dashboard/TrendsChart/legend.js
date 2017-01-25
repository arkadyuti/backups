import { connect } from 'react-redux';
import LegendComponent from '../../../components/Dashboard/TrendsChart/legend.js';

function mapStateToProps(state){

	let {colorNames} = state.barChartReducers;
	let {colorCodes} = state.barChartReducers;

    return{
        colorNames : colorNames,
        colorCodes : colorCodes
    };
}


export default connect(mapStateToProps)(LegendComponent)