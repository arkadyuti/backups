import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';

import statusChart from '../../../../components/Dashboard/StatusChart/root/index'
import { fetchStatusData } from '../../../../actions/Dashboard/StatusChart/status-chart';

function mapStateToProps(state) {
	// whatever returned will show up as props inside of
	// DonutChart. This acts as a psuedo state.
	// here status is either "waiting","success" or "failure" depending on ajax request for data
	return {
		data : state.statusChartData.data ,
		status : state.statusChartData.status
	}
}

function mapDispatchToProps(dispatch) {
	//whenever action is called , the result should be passed
	// to all our reducers
	return bindActionCreators({fetchStatusData},dispatch)
}

export default connect(mapStateToProps,mapDispatchToProps)(statusChart);

