import { connect } from 'react-redux';
import YAxisMobileComponent from '../components/Dashboard/Trends-chart/YAxisMobileComponent.js';

function mapStateToProps(state){

    let {newData} = state.barChartReducers;
    let {barHeight} = state.barChartReducers;
    
    return{
        newData : newData,
        barHeight : barHeight
    };
}

export default connect(mapStateToProps)(YAxisMobileComponent);