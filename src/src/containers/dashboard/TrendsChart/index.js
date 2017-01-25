import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import TrendsChartComponent from '../../../components/Dashboard/TrendsChart/index.js';
import { getInitialData }  from '../../../actions/Dashboard/TrendsChart/trends-chart.js';
import '../../../components/Dashboard/TrendsChart/trends-chart.scss';

function mapStateToProps(state){

    let {currentYear} = state.barChartReducers;
    let {quarterData} = state.barChartReducers;
    let {fetching} = state.barChartReducers;
    let {leastYear} = state.barChartReducers;
    let {error} = state.barChartReducers;
    
    return{
        currentYear : currentYear,
        quarterData : quarterData,
        fetching : fetching,
        leastYear : leastYear,
        error : error
    };
}
function mapDispatchToProps(dispatch){
    return bindActionCreators({
        getInitialData:getInitialData
    },dispatch)
}

export default connect(mapStateToProps,mapDispatchToProps)(TrendsChartComponent);