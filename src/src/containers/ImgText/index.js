import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import {ImageWithText} from '../../components/ImgText';
function mapStateToProps(state) {
    return{
        status:state.toggleSidePanel.status,
        headerData:state.toggleSidePanel.headerData,
        sideNavData:state.toggleSidePanel.sideNavData
    }
}



export default connect(mapStateToProps,null)(ImageWithText);