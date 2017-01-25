import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import TrendsChartComponent from '../components/Dashboard/Trends-chart/TrendsChartComponent.js';
import { getInitialData }  from '../actions/barChartActions.js';

function mapStateToProps(state){
    return{
        currentYear : state.barChartReducers.currentYear,
        qData : state.barChartReducers.qData,
        fetching : state.barChartReducers.fetching
    };
}
function mapDispatchToProps(dispatch){
    return bindActionCreators({
        getInitialData:getInitialData
    },dispatch)
}

export default connect(mapStateToProps,mapDispatchToProps)(TrendsChartComponent);