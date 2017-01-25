import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import TrendsChartComponent from '../components/Dashboard/Trends-chart/TrendsChartComponent.js';
import { getInitialData }  from '../actions/TrendsChartActions.js';

function mapStateToProps(state){

    let {currentYear} = state.barChartReducers;
    let {qData} = state.barChartReducers;
    let {fetching} = state.barChartReducers;
    
    return{
        currentYear : currentYear,
        qData : qData,
        fetching : fetching
    };
}
function mapDispatchToProps(dispatch){
    return bindActionCreators({
        getInitialData:getInitialData
    },dispatch)
}

export default connect(mapStateToProps,mapDispatchToProps)(TrendsChartComponent);