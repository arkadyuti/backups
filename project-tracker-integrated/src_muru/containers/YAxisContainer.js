import { connect } from 'react-redux';
import YAxisComponent from '../components/Dashboard/Trends-chart/YAxisComponent.js';

function mapStateToProps(state){

    let {newData} = state.barChartReducers;
    let {barHeight} = state.barChartReducers;
    
    return{
        newData : newData,
        barHeight : barHeight
    };
}

export default connect(mapStateToProps)(YAxisComponent);