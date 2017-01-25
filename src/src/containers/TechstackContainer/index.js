import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';


//Actions
import {    moveClick      } from '../../actions/CreateProjectActions/techstack-move-click';
import {    sendClick      } from '../../actions/CreateProjectActions/techstack-send-click';
import { firstListTracker  } from '../../actions/CreateProjectActions/techstack-firstlist-tracker';
import { secondListTracker } from '../../actions/CreateProjectActions/techstack-secondlist-tracker';
import { updateSecondListBuffer } from '../../actions/CreateProjectActions/techstack-update-secondlist-buffer';
import { resetSecondListBuffer } from '../../actions/CreateProjectActions/techstack-reset-secondlist-buffer';
import { resetFirstListBuffer } from '../../actions/CreateProjectActions/techstack-reset-firstlist-buffer';

//Components
import TechStack from '../../components/TechstackTab/index';

/*
**Helper function which is taking the current state and is returning the props
*/
function mapStateToProps(state){
  return {
    configJSON        : state.configJSON,
    emptyJSON         : state.emptyJSON,
    firstListBuffer   : state.firstListBuffer,
    secondListBuffer  : state.secondListBuffer,
    requestType       : state.requestType
  }
}

/*
**Helper function which is dispatching the actions
*/
function mapDispatchToProps(dispatch){
  return bindActionCreators({
            moveClick             : moveClick,
            sendClick             : sendClick,
            firstListTracker      : firstListTracker,
            secondListTracker     : secondListTracker,
            resetSecondListBuffer : resetSecondListBuffer,
            resetFirstListBuffer  : resetFirstListBuffer,
            updateSecondListBuffer : updateSecondListBuffer
          },dispatch); 
} 

/*
**Here the state and the action creators are being mapped to the techstack component
*/
export default connect(mapStateToProps,mapDispatchToProps)(TechStack);

