import React,{Component} from 'react';
import ReactDOM from 'react-dom';
import './styles.scss';


import LabelDescription from '../LabelDescription/index.js';

export default class TextAreaInput extends Component{

    constructor(props) {
      super(props);
      this.state = {
          isvalidation: '',
          inputValue: '',
          isFocus:''
      };
    }



  componentWillMount() {

    this.setState({inputValue: this.props.emptyJSON[this.props.field.name]})
    // this is for first click of create,edit or view
  }

  componentWillReceiveProps(nextProps,nextState){

    //Handle create Transitions
    
    if(this.props.requestType.type === "edit" && nextProps.requestType.type === "create"){
      
      //this is for transition of edit to create
      this.setState({inputValue: nextProps.emptyJSON[this.props.field.name]})
      this.setState({showError: "false"})
    }
    if(this.props.requestType.type === "view" && nextProps.requestType.type === "create"){
      
      //this is for transition of view to create
      this.setState({inputValue: nextProps.emptyJSON[this.props.field.name]})
      this.setState({showError: "false"})
    }

    if(nextProps.emptyJSON[this.props.field.name] === this.state.inputValue && (this.props.requestType.type === "create" && nextProps.requestType.type === "create")){
      
      this.setState({inputValue: nextProps.emptyJSON[this.props.field.name]})
    }

    //Handle Edit Transitions
    if(nextProps.emptyJSON[this.props.field.name] === this.state.inputValue && (this.props.requestType.type === "edit" && nextProps.requestType.type === "edit")){

      this.setState({inputValue: nextProps.emptyJSON[this.props.field.name]})
    }

    if(this.props.requestType.type === "create" && nextProps.requestType.type === "edit"){
      
      //this is for transition of create to edit
      this.setState({inputValue: nextProps.emptyJSON[this.props.field.name]})
      this.setState({showError: "false"})
    } 
    if(this.props.requestType.type === "view" && nextProps.requestType.type === "edit"){
      
      //this is for transition of view to edit
      this.setState({inputValue: nextProps.emptyJSON[this.props.field.name]})
      this.setState({showError: "false"})
    }
  }


    /**
      * isActive - to add className to display error-message
      * value - true in all case and is used to compare with the local error-message state
    **/

    isActive(value){
      return ((value===this.state.isvalidation) ?'cp-red-error':'cp-hide');
    }


    /**
      * doValidation - to validate text field based on the input provided and save changes to the empty JSON
      * event - type object
    **/

    doValidation(event){
        var regular_exp = this.props.field.regex;
        this.setState({isFocus: 'false'})

        if(event.target.value== "" || (!regular_exp.test(event.target.value))){
            this.setState({isvalidation:'true'});
            this.props.updateUserInput(event.target.value,this.props.field.name);
        }
        else{
            this.setState({isvalidation:'false'});
            this.props.updateUserInput(event.target.value,this.props.field.name);
        }
    }


    /**
      * handleInputChange - to reset the state equal to the target value in the input field
      * event - type object
    **/


    handleInputChange(event) {
        this.setState({inputValue: event.target.value})
    }


    /**
      * handleLabelColor - to change the color of label on focus by adding a class
      * event - type object 
    **/

    handleLabelColor(event) {
        this.setState({isFocus: 'true'})
    }

    
  showFocusField(value) {
      return (value === this.state.isFocus) ?'cp-input cp-colored-field':'cp-input';
    }

    /**
      * onFocusLabelChange - to add className to change the color of the label on focus
      * value - true in all case and is used to compare with the local isFocus state
    **/
  

    onFocusLabelChange(value) {
      return 'cp-floating-label' + ((this.state.isFocus === value)? ' cp-label-blue':'');
    }


    render() {

      let HTML = (this.props.requestType.type === 'view')?
        <LabelDescription field={this.props.field} />
        
      : <div>
                <textarea className={this.showFocusField('true')}
                          id="textArea"
                          type={this.props.field.type} 
                          value = {this.state.inputValue} 
                          onBlur={this.doValidation.bind(this)}
                          onFocus = {this.handleLabelColor.bind(this)}
                          onChange={this.handleInputChange.bind(this)}
                          required
                          autoComplete="off"/>
                <label className ={this.onFocusLabelChange('true')}>{this.props.field.staticValue}</label>
                <span className ={this.isActive('true')}>{this.props.field.error}</span>
        </div>

      return(
            <div key={this.props.field.id} className="cp-textarea">
               {HTML}
            </div>
      )
    }
}






