import { connect } from 'react-redux';
import Arc from '../../../../components/Dashboard/StatusChart/arc/index'

function mapStateToProps(state) {
	// whatever returned will show up as props inside of 
	// arc. This acts as a pseudo state.
	return {
		Radius : state.statusChartRadius,
	}
}

export default connect(mapStateToProps)(Arc);