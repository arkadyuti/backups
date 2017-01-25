import React,{Component} from 'react';
import BREWSER from 'brewser';

//functions
import {checkboxFunction} from '../../constants/ProjectListConstants/checkbox-function.js'

export class CheckOption extends React.Component {
    
    constructor (props){
        super (props);

        this.checkboxChecked = this.checkboxChecked.bind(this);    
    }
    checkboxChecked(event){
        var breakPoint = 768;
        let result = checkboxFunction(event,this.props.options);
        if(BREWSER.br.windowWidth<=breakPoint){
            //when the device is rendered to mobileview
            this.props.giveUncheckedData(result.uncheckedOptions);
            this.props.giveCheckedData(result.selectedCheckOption);
            if(result.selectedCheckOption.length!=3){
                this.props.showErrorMessage();
               //call this action only when selectedCheckOption's length is not 3.
            }
            else {
                this.props.hideErrorMessage(); 
                //call this action otherwise         
            }
        }
        if(BREWSER.br.windowWidth>breakPoint) {
            //when the device is rendered to desktopview
            this.props.giveUncheckedDataDesktop(result.uncheckedOptionsDesktop);
            this.props.giveCheckedDataDesktop(result.selectedCheckOptionDesktop);
            if(result.selectedCheckOptionDesktop.length<3){
                this.props.showErrorMessage();
                //call this action only when selectedCheckOption's length is lessthan 3.
            }
            else {
                this.props.hideErrorMessage();
                //call this action otherwise             
            }
        }
    }

    render() {
        var checkBoxHTML = this.props.options.map((option, index)=>{
            return (<div key={index} className="checkboxContainer">
                        <label className="customizeOptionLabel">
                        <input 
                            className="customizeCheckBox"
                            id={index}
                            type="checkbox"
                            value={option.value}
                            onChange={this.checkboxChecked}
                            disabled={option.disabled ? true : false}
                            checked={option.checked ? true : false} />
                        <span className="customizeOptions" htmlFor={index} >{option.label} </span>
                        </label>
                    </div>)
            //This return function to have the checkboxs rendred in the popup according to the label in this.props.options 
        })

        return(
                <div>{checkBoxHTML}</div>
        )
    }       
}

CheckOption.propTypes={

      options:React.PropTypes.array,
      errorMessage:React.PropTypes.string,
      giveUncheckedData:React.PropTypes.func, 
      giveCheckedData:React.PropTypes.func,
      giveUncheckedDataDesktop:React.PropTypes.func,
      giveCheckedDataDesktop:React.PropTypes.func,
      showErrorMessage:React.PropTypes.func,
      hideErrorMessage:React.PropTypes.func,
}
   

