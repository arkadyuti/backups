import { connect } from 'react-redux';
import YAxisMobileComponent from '../../../components/Dashboard/TrendsChart/y-axis-mobile.js';

function mapStateToProps(state){

    let {responseData} = state.barChartReducers;
    let {barHeight} = state.barChartReducers;
    
    return{
        responseData : responseData,
        barHeight : barHeight
    };
}

export default connect(mapStateToProps,null)(YAxisMobileComponent);