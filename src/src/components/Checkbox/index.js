import React, {Component} from 'react';
import './styles.scss';

/*
**Checkbox Component
*/
export default class CheckBox extends Component {
  constructor(props) {
    super(props); 
    this.state={
      isChecked: ""
    }
  }
 
  /*
  **ComponentWillMount to set the state before rendering 
  **Checking the mode if it is in secondList mode ,set the state of the checkboxes as true
  **if the mode is not SecondList the the checkboxes state is kept as false
  */
  componentWillMount() {

    if(this.props.mode === "secondList"){
       this.setState({isChecked: true})
    }
    else if(this.props.mode === "firstList"){
      if(this.props.requestType.type === "edit"){

        let serverArray = this.props.emptyJSON.techstack[this.props.category].slice(0);
        let index = serverArray.indexOf(this.props.label)
        if(index > -1){
          this.setState({isChecked: true})
        }
        else{
          this.setState({isChecked: false})
        }       
       
      }
      else if(this.props.requestType.type === "create"){
        this.setState({isChecked: false})
      }
    }
  }


  componentWillReceiveProps(nextProps) {
    if(this.props.mode === "secondList"){
      let changedArray = nextProps.secondListBuffer[nextProps.category].slice(0);
      let index = changedArray.indexOf(nextProps.label);
        if(index>-1){
          this.setState({isChecked: true})
        }
    }
  }
  
  /*
  **toggleCheckbox is called on the onChange event of the the input type Checkbox
  **isChecked state is toggled ,hence changing the state of the Checkbox as checked and unchecked
  */
  toggleCheckbox() {
    this.setState({
      isChecked: !this.state.isChecked
    });
    /*
    **handleCheckboxChange is invoked on onChange event on the Checkbox
    **category is the subheading as Frameworks, Building Tools and Test Frameworks
    **label contains the corresponding list items associated with each category
    */
    this.props.handleCheckboxChange(this.props.category,this.props.label);
  }

    keyHandler(event){
    if (event.key === 'Enter') {
      this.setState({
        isChecked: !this.state.isChecked
      });

      this.props.handleCheckboxChange(this.props.category,this.props.label);
     }
     
  }


  render(){
    /*
    **labelController here is checking the mode if it is true then return the selected  
    */
    let labelController = () => {
        if(this.props.mode === "secondList"){
          return "selected"
        }
        else if(this.props.mode === "firstList"){
          return "library"
        }
    }   

    let tabIndex = {tabIndex:0}
    
    /*
    **list items are being rendered as library list item or selected list item based on the the mode 
    */
    if(this.props.requestType.type !== 'view'){
        return (
            <li key={this.props.label} className="cp-list-item">
                <input  type="checkbox"
                              className = "cp-checkbox"
                              id={this.props.label+labelController()}                            
                              checked={this.state.isChecked} 
                              onChange={this.toggleCheckbox.bind(this)}
                              />
                <label htmlFor={this.props.label+labelController()} className="cp-checkbox-label" onKeyPress = {this.keyHandler.bind(this)} {...tabIndex}>
                    {this.props.label}
                </label>
            </li>
        )
      }
          else{
            return(
            <li key={this.props.label} className="cp-list-item">
              <label htmlFor={this.props.label+labelController()} className="cp-checkbox-label">
                  {this.props.label}
              </label>
            </li>
            )
          }
  }
}

