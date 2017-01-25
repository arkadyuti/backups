import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import TrendsChartMobileComponent from '../components/Dashboard/Trends-chart/TrendsChartMobileComponent.js';
import { getInitialData,setQuadrant }  from '../actions/barChartActions.js';

function mapStateToProps(state){

    let {currentYear} = state.barChartReducers;
    let {qData} = state.barChartReducers;
    let {fetching} = state.barChartReducers;
    let {activeQ} = state.barChartReducers;

    return{
        currentYear : currentYear,
        qData : qData,
        fetching : fetching,
        activeQ : activeQ
    };
}
function mapDispatchToProps(dispatch){
    return bindActionCreators({
        getInitialData : getInitialData,
        setQuadrant : setQuadrant
    },dispatch)
}

export default connect(mapStateToProps,mapDispatchToProps)(TrendsChartMobileComponent);