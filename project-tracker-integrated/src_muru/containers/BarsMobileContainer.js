import { connect } from 'react-redux';
import BarsMobileComponent from '../components/Dashboard/Trends-chart/BarsMobileComponent.js';

function mapStateToProps(state){
	
    let {Qs} = state.barChartReducers;
	
    return{
        Qs : Qs
    };
}


export default connect(mapStateToProps)(BarsMobileComponent);


