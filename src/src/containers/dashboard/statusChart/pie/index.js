import { connect } from 'react-redux'
import Pie from '../../../../components/Dashboard/StatusChart/pie/index'

function mapStateToProps(state) {
	// whatever returned will show up as props inside of
	// pie. This acts as a psuedo state.
	return {
		outerRadius : state.statusChartRadius.outerRadius
	}
}

export default connect(mapStateToProps)(Pie);
