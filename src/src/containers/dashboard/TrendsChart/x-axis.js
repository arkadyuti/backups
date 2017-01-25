import { connect } from 'react-redux';
import XAxisComponent from '../../../components/Dashboard/TrendsChart/x-axis.js';

function mapStateToProps(state){
    
   let {Quarters} = state.barChartReducers;
    
    return{
        Quarters : Quarters
    };
}

export default connect(mapStateToProps)(XAxisComponent);