import React, {Component} from 'react';
import './styles.scss';

//Component
import CheckBox from '../Checkbox/index';

/*
**FirstList Component for the Tech stack tab
*/
export default class SecondList extends Component{
  constructor(props) {
    super(props); 
    this.state={

    }
  }

  /*
 **Onchange event on the CheckBox component
 **label and subHeading are passed as parameters to generate the labels corresponding to each category
 **it return the Checkbox components based on the parameters passed
 */
  createCheckbox(subHeading,label) {
    return (
            <CheckBox 
                label={label}
                category = {subHeading} 
                handleCheckboxChange={this.addToBufferState.bind(this)}
                key={label+subHeading}
                mode = "secondList"
                requestType = {this.props.requestType}
                secondListBuffer = {this.props.secondListBuffer} />
    )
  }
  
  /* 
  **createCheckboxes contains the parameters as array and key 
  ** array contains the list items corresponding to each key
  ** It is mapped to render the CheckBox component
  */
  createCheckboxes(array,key) {
    return array.map((label) => this.createCheckbox(key,label));
  }

  /*
  ** addToBufferState contains the parameters as key and label
  ** addToBufferState is invoked on handleCheckboxChange event
  ** This function will push the checked CheckBox Component to the  selectedArrayLocal 
      depending upon their index value 
  */
  addToBufferState(key,label){

    let secondListSelectedArrayLocal = this.props.secondListBuffer[key].slice(0);
    let index;
    index = secondListSelectedArrayLocal.indexOf(label);
    /* 
    **if the CheckBox Component is checked then they are pushed to secondListSelectedArrayLocal
    */
    if(index === -1){  
        secondListSelectedArrayLocal.push(label);
    }
    /* 
    **if the CheckBox Component is being clicked again then they are removed from the
     secondListSelectedArrayLocal
    */
    else {
          secondListSelectedArrayLocal.splice(index, 1);
    }
    /*
    **In secondListTracker key and secondListSelectedArrayLocal are being passed as the parameters
    */
    this.props.secondListTracker(key,secondListSelectedArrayLocal);
  }
  
  /*
  **Here the list items containing the fields corresponding to the keys such as frameworks,building tools
   and testframeworks are being rendered
  */
  render() {
    let serverData = this.props.emptyJSON.techstack;
    let HTML="";
    let secondBuffer=[];
    let updatedSubHeading = [];

    Object.keys(serverData).forEach((key) => {      
      if(serverData[key].length>0){

        let labelList = serverData[key].slice(0);
        HTML =  this.createCheckboxes(labelList,key)
    
          updatedSubHeading.push(key);
          secondBuffer.push(HTML);
      }
      })

    /*
    **Here the correponding unordered list are being rendered as per the list items ddepending on the key
    */
    var FINALHTML = secondBuffer.map((markup,index) => {
        let subHeading = updatedSubHeading.shift();
         return  (
           <div key={this.props.configJSON.techstackTab.list[subHeading]+"List"}>
           <div className="cp-selected-sub-heading">{this.props.configJSON.techstackTab.list[subHeading]}</div>
              <ul key={"serverData "+index}  className="cp-selected" >
                    {markup}
              </ul>
          </div>
          )
        })  
    
    /*
    **Library content here is the wrapper for the firstlist unordered list data 
    */
    return(
        <div className= {this.props.secondListClass}>
        <div className = "cp-selected-list-heading">SELECTED</div>
        <div className = "cp-selected-list">
        {FINALHTML}
        </div>
        </div>
      )
  }
}



