import { connect } from 'react-redux';
import BarsComponent from '../components/Dashboard/Trends-chart/BarsComponent.js';

function mapStateToProps(state){

	let {Qs} = state.barChartReducers;
	
    return{
        Qs : Qs
    };
}


export default connect(mapStateToProps)(BarsComponent);


