import { connect } from 'react-redux';
import XAxisComponent from '../components/Dashboard/Trends-chart/XAxisComponent.js';

function mapStateToProps(state){
    
   let {Qs} = state.barChartReducers;
    
    return{
        Qs : Qs
    };
}

export default connect(mapStateToProps)(XAxisComponent);