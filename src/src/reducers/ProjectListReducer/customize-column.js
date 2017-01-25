import {POPUP_DISPLAYED, GOT_NEWDATA,SEND_LASTCHACKED_DESKTOP,RETURN_LAST_STATE,GOT_NEWDESKTOPDATA,SEND_LAST_CHACKED,GOT_SELECTEDDESKTOPDATA, GOT_SELECTEDDATA, GOT_COLUMN, SHOW_ERROR, HIDE_ERROR,SEND_THREE_CHECK, SEND_LAST_STATE,GOT_COLUMN_DESKTOP} from '../../constants/ProjectListConstants/action-types';
import {checkboxOptions,customizeOptionCheck,selectedCheckOptions} from '../../constants/ProjectListConstants/customize-checkbox-options';
export default function customizeColumn(state ={ 
    aptPopupVisible : false, 
    //this is an initial state to have the popup to hide and show on user action
    showErrorMessage : false,
    //this is an initial state to have the error in the popup to hide and show on user action
    selectedCheckOptionsDesktop : checkboxOptions,
    //this is an initial state to have the options in the popup as 6 options selected in the desktop view       
    selectedCheckOptions: selectedCheckOptions,
    //this is an initial state to have the options in the popup as 3 options selected in the mobile view       
    allCustomizeOptions:checkboxOptions,
    //this is an initial state to have the options rendred in the popup       
    columnCheckBox:checkboxOptions,
    //this is an initial state to have the options populated in the table
    errorMessage:"Atleast 3 checkboxes should be checked",
    //this is an initial state to have the error message in the popup in the desktop view  
    customizeOptions:checkboxOptions,
    //this is an initial state to have the options populated in the popup
    customizeOptionCheck:customizeOptionCheck,
    //this is an initial state to have the options in the popup as 3 options checked in the mobile view       
                    }, action){  
  switch(action.type) {
    case POPUP_DISPLAYED:
      return Object.assign({},state,{aptPopupVisible:!state.aptPopupVisible});
      //when this action called set the following state
    case GOT_NEWDATA:
      return Object.assign({},state,{allCustomizeOptions:action.payload});
      //when this action called set the following state
    case GOT_NEWDESKTOPDATA:
      return Object.assign({},state,{allCustomizeOptions:action.payload});
      //when this action called set the following state
    case GOT_COLUMN_DESKTOP :
      return Object.assign({},state,{columnCheckBox:action.columnCheckBoxDesktop});
      //when this action called set the following state
    case GOT_COLUMN :
      return Object.assign({},state,{columnCheckBox:action.columnCheckBox});
      //when this action called set the following state
    case GOT_SELECTEDDESKTOPDATA :
      return Object.assign({},state,{selectedCheckOptionsDesktop:action.payload});
      //when this action called set the following state
    case GOT_SELECTEDDATA :
      return Object.assign({},state,{selectedCheckOptions:action.payload});
      //when this action called set the following state
    case SHOW_ERROR :
      return Object.assign({},state,{showErrorMessage:true});
      //when this action called set the following state
    case HIDE_ERROR :
      return Object.assign({},state,{showErrorMessage:false});
      //when this action called set the following state
    case SEND_LASTCHACKED_DESKTOP :
      return Object.assign({},state,{allCustomizeOptions:action.sendLastChecked,
                                    customizeOptionCheck:action.sendLastChecked,
                                  selectedCheckOptionsDesktop:state.columnCheckBox,
                                  selectedCheckOptions:state.columnCheckBox});
      //when this action called set the following states
    case SEND_THREE_CHECK :
      return Object.assign({},state,{selectedCheckOptions:state.selectedCheckOptions,
                                allCustomizeOptions:state.customizeOptionCheck,
                                columnCheckBox:state.selectedCheckOptions,
                                errorMessage:action.errorMessagePhone});
      //when this action called set the following states
    case SEND_LAST_STATE :
      return Object.assign({},state,{selectedCheckOptionsDesktop:state.selectedCheckOptionsDesktop,
                                  allCustomizeOptions:state.allCustomizeOptions,
                                  columnCheckBox:state.columnCheckBox,
                                  errorMessage:state.errorMessage}
                                  );
      //when this action called set the following states
  }
  return state
}