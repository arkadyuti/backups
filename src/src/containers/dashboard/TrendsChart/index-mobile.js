import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import TrendsChartMobileComponent from '../../../components/Dashboard/TrendsChart/index-mobile.js';
import { getInitialData,setQuarter }  from '../../../actions/Dashboard/TrendsChart/trends-chart.js';
import '../../../components/Dashboard/TrendsChart/trends-chart.scss';

function mapStateToProps(state){

    let {currentYear} = state.barChartReducers;
    let {quarterData} = state.barChartReducers;
    let {fetching} = state.barChartReducers;
    let {activeQuarter} = state.barChartReducers;
    let {leastYear} = state.barChartReducers;
    let {error} = state.barChartReducers;

    return{
        currentYear : currentYear,
        quarterData : quarterData,
        fetching : fetching,
        activeQuarter : activeQuarter,
        leastYear : leastYear,
        error : error
    };
}
function mapDispatchToProps(dispatch){
    return bindActionCreators({
        getInitialData : getInitialData,
        setQuarter : setQuarter
    },dispatch)
}

export default connect(mapStateToProps,mapDispatchToProps)(TrendsChartMobileComponent);