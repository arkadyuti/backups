import { connect } from 'react-redux';
import BarsComponent from '../../../components/Dashboard/TrendsChart/bars.js';

function mapStateToProps(state){

	let {Quarters} = state.barChartReducers;
	
    return{
        Quarters : Quarters
    };
}


export default connect(mapStateToProps)(BarsComponent);


