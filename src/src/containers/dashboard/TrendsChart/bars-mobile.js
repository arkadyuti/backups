import { connect } from 'react-redux';
import BarsMobileComponent from '../../../components/Dashboard/TrendsChart/bars-mobile.js';

function mapStateToProps(state){
	
    let {Quarters} = state.barChartReducers;
	
    return{
        Quarters : Quarters
    };
}


export default connect(mapStateToProps)(BarsMobileComponent);


