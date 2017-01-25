import React,{Component} from 'react';
import "./styles.scss";

//Components
import TextComponent from '../Text/index.js';
import TextAreaInput from '../TextArea/index.js';
import RadioBox from '../Radio/index.js';
import Calendar from '../calendar';
import SelectComponent from '../Select/index.js';
import ButtonComponent from '../Button/index.js';


export default class Element extends Component {
            
    constructor(props) {
        super(props);
    }
    
    render(){

    /**
      * HTML - to render the Element component based on type from configJSON for respective tabs
    **/

    let HTML = this.props.list.map( (field,index) => {

            
        switch(this.props.configJSON[field].type){

          
            case 'text':
             return(
                <div className="col-md-4 col-sm-6 col-xs-12 cp-element" key={"number+"+index}>
                    <TextComponent requestType = {this.props.requestType}
                                   field = {this.props.configJSON[field]}
                                   emptyJSON   = {this.props.emptyJSON}
                                   configJSON = {this.props.configJSON}
                                   updateUserInput = {this.props.updateUserInput}
                                   updateUserInputStaffing = {this.props.updateUserInputStaffing}
                                   staffingEmployeeDetailUpdate = {this.props.staffingEmployeeDetailUpdate}
                                   selectedTab = {this.props.selectedTab}
                                   nextClick = {this.props.nextClick}
                                   staffingFormVisible = {this.props.staffingFormVisible}/>

                </div>
            );
            break;

            case 'radio': return(
                <div className="col-md-4 col-sm-6 col-xs-12 cp-element" key={"radio+"+index}>
                       <RadioBox requestType = {this.props.requestType}
                                 field = {this.props.configJSON[field]}
                                 emptyJSON   = {this.props.emptyJSON} 
                                 updateUserInput = {this.props.updateUserInput}/>
                </div>
            );
            break;
                    
            case 'select': return(
                <div className="col-md-4 col-sm-6 col-xs-12 cp-element" key={"select+"+index}>
                    <SelectComponent    requestType = {this.props.requestType}
                                        emptyJSON   = {this.props.emptyJSON} 
                                        field= {this.props.configJSON[field]}
                                        updateUserInput = {this.props.updateUserInput}/>
                </div>
            );
            break;

            case 'textarea': return(
                <div className="col-md-8 col-sm-6 col-xs-12 cp-element" key={"textarea+"+index}>
                    <TextAreaInput  requestType = {this.props.requestType}
                                    field = {this.props.configJSON[field]}
                                    emptyJSON   = {this.props.emptyJSON} 
                                    updateUserInput = {this.props.updateUserInput}
                                    updateUserInputStaffing = {this.props.updateUserInputStaffing}
                                    nextClick = {this.props.nextClick}/>
                </div>
            );
            break;  
            
          case 'date': return(
                <div className="col-md-4 col-sm-6 col-xs-12 cp-element" key={"date+"+index}>
                    <Calendar field = {this.props.configJSON[field]} 
                              emptyJSON = {this.props.emptyJSON}
                              requestType = {this.props.requestType}
                              selectedTab = {this.props.selectedTab}
                              updateUserInput = {this.props.updateUserInput}
                              staffingEmployeeDetailUpdate = {this.props.staffingEmployeeDetailUpdate}/>
                 </div>
            )
            break;

        }
    });

    /**
      * classNameCheck - to add className to row if staffing tab is the selectedTab
    **/
    
    let classNameCheck = (!this.props.staffingFlag)?'row cp-elements ':'row cp-staffing-form-elements cp-elements';


    /**
      * staffingFormClosingIcon - to render the close Button in staffing tab
    **/

    let staffingFormClosingIcon =  (!this.props.staffingFlag)?
                                    '':
                                    <span className="cp-close-icon ion-close-round"
                                           onClick={() => this.props.staffingFormDisplay('closed')}>
                                    </span>;   

            
    return (
      <div className={classNameCheck} key="elements">
        {staffingFormClosingIcon}
        {HTML}
       
      </div>
    )
}

}


