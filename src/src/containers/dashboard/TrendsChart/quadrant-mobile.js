import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import { setHover }  from '../../../actions/Dashboard/TrendsChart/trends-chart.js';
import QuadrantMobileComponent from '../../../components/Dashboard/TrendsChart/quadrant-mobile.js';

function mapStateToProps(state){

    let {responseData} = state.barChartReducers;
    let {barHeight} = state.barChartReducers;
    let {quarterData} = state.barChartReducers;
    let {activeQuarter} = state.barChartReducers;

    return{

        responseData : responseData,
        barHeight : barHeight,
        quarterData : quarterData,
        activeQuarter : activeQuarter
    };
}

function mapDispatchToProps(dispatch){
    return bindActionCreators({
        setHover:setHover
    },dispatch)
}

export default connect(mapStateToProps,mapDispatchToProps)(QuadrantMobileComponent);