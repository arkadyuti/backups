import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import { setHover }  from '../../../actions/Dashboard/TrendsChart/trends-chart.js';
import QuadrantComponent from '../../../components/Dashboard/TrendsChart/quadrant.js';

function mapStateToProps(state){

        let {responseData} = state.barChartReducers;
        let {barHeight} = state.barChartReducers;
        let {quarterData} = state.barChartReducers;
        let {textAnchor} = state.barChartReducers;

    return{
        responseData : responseData,
        barHeight : barHeight,
        quarterData : quarterData,
        textAnchor : textAnchor
    };
}

function mapDispatchToProps(dispatch){
    return bindActionCreators({
        setHover:setHover
    },dispatch)
}

export default connect(mapStateToProps,mapDispatchToProps)(QuadrantComponent);