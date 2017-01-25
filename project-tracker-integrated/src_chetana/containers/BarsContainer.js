import { connect } from 'react-redux';
import BarsComponent from '../components/Dashboard/Trends-chart/BarsComponent.js';

function mapStateToProps(state){
    return{
        Qs : state.barChartReducers.Qs
    };
}


export default connect(mapStateToProps)(BarsComponent);


