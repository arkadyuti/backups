import {connect} from 'react-redux';
import {NotificationBadge} from '../../components/NotificationBadge';
function mapStateToProps(state) {
    return{
       
        notifications_count:state.toggleSidePanel.sideNavData.notifications_count
    }
}

export default connect(mapStateToProps,null)(NotificationBadge);