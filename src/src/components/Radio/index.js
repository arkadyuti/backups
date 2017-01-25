import React,{Component} from 'react';
import RadioButton from '../RadioButton/index.js';

import LabelDescription from '../LabelDescription/index.js';

import "./styles.scss";

export default class RadioBox extends Component {
	constructor(props) {
		super(props);
		
	}


	render() {

		let HTML = (this.props.requestType.type === 'view')?
							<LabelDescription field={this.props.field} />
				
						: <div>
								<label className="cp-heading"> {this.props.field.staticValue} </label>
								<RadioButton emptyJSON = {this.props.emptyJSON}
											 field={this.props.field} 
											 updateUserInput = {this.props.updateUserInput}/>
						</div>
		

		return (
				<div className="cp-radio-button">
				 		{HTML}
				</div>
		)
	}
}

