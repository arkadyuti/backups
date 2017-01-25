import { connect } from 'react-redux';
import YAxisComponent from '../../../components/Dashboard/TrendsChart/y-axis.js';

function mapStateToProps(state){

    let {responseData} = state.barChartReducers;
    let {barHeight} = state.barChartReducers;
    
    return{
        responseData : responseData,
        barHeight : barHeight
    };
}

export default connect(mapStateToProps)(YAxisComponent);