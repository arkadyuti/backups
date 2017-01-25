import React, {Component} from 'react';
import ReactDOM from 'react-dom';
/*import {updateUserInput} from '../../actions/update-empty-json.js';*/


import "./styles.scss";

export default class RadioButton extends Component {
	constructor(props) {
		super(props);
		 this.state = {
           /*   selectedOption: ''*/
          }
	}

	/*
	* handleOptionChange - to toggle between radio buttons by resetting the local state
	* event - object type
	*/

	handleOptionChange(event) {
        /*  this.setState({selectedOption : event.target.value});*/
          this.props.updateUserInput(event.target.value, this.props.field.name)
      }

      render() { 
        let tabIndex = {tabIndex:0}
      	let RADIO = this.props.field.options.map( (option) => {
      					return (
							<label htmlFor={option} className="cp-radio-label" key={option} {...tabIndex}> 
                      			<input 	type={this.props.field.type}
                      					className="cp-radio" 
                      					name={this.props.field.name}
                      					id={option} 
                      					value={option}  
                      					defaultChecked={this.props.emptyJSON[this.props.field.name]}
                      					onBlur={this.handleOptionChange.bind(this)} />
                          			<span className="cp-radio-option">{option}</span> 
                    		</label>
                    	) 
					});
				

		return (
			<div className="cp-input cp-box-radio">
				{RADIO}
			</div>
		)
	}
}

