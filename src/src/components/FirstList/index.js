import React, {Component} from 'react';
import './styles.scss';

//Component
import CheckBox from '../Checkbox/index';

/*
**FirstList Component for the Tech stack tab
*/
export default class FirstList extends Component{
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
                mode = "firstList"
                requestType = {this.props.requestType}
                emptyJSON  = {this.props.emptyJSON} />
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
    let selectedArrayLocal = this.props.firstListBuffer[key].slice(0);
    let index;
    index = selectedArrayLocal.indexOf(label);
    /* 
    **if the CheckBox Component is checked then they are pushed to selectedArrayLocal
    */
    if(index === -1){
         selectedArrayLocal.push(label)
    }
    /* 
    **if the CheckBox Component is being clicked again then they are removed from the selectedArrayLocal
    */
    else{
        selectedArrayLocal.splice(index, 1);
        }
    /*
    **In firstListTracker, secondListTracker key and selectedArrayLocal are being passed as the parameters
    */
    this.props.firstListTracker(key,selectedArrayLocal); 

  }
  

  /*
  **Here the list items containing the fields corresponding to the keys such as frameworks,building tools
   and testframeworks are being rendered
  */
  render() {
    let libraryData = this.props.configJSON.techstackTab.techstack;
    let HTML="";
    let buffer=[];
    let subHeading = this.props.configJSON.techstackTab.list;
    Object.keys(libraryData).forEach((key,index) => {
       if(libraryData[key].length>0){
            HTML = this.createCheckboxes(libraryData[key],key)
            buffer.push(HTML);
        }
    })
   
  /*
  **Here the correponding unordered list are being rendered as per the list items ddepending on the key
  */
    var FINALHTML = buffer.map((markup,index) => {
         return  (
                  <div key={subHeading.key(index)+"List"}>
                  <div className="cp-library-sub-heading">{subHeading.key(index)}</div>
                  <ul key={"libraryData "+index}  className="cp-library">
                    {markup}
                   </ul>
                   </div>
                  )
          })  
  /*
  **Library content here is the wrapper for the firstlist unordered list data 
  */
    return(
        <div className={this.props.firstListClass}>
           <div className = "cp-library-list-heading">LIBRARY</div>
            <div className = "cp-library-list">
              {FINALHTML}
            </div>
        </div>
      )
  }
}

