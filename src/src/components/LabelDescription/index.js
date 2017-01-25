import React, {Component} from 'react';
import ReactDOM from 'react-dom';

import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';


class LabelDescription extends Component {
	
	render() {
		return (
			<div className="cp-text cp-label-description">
    				<span className="cp-read-only-label">
						{this.props.field.staticValue}
					</span>
    			<p className="cp-read-only-para">
    				{this.props.emptyJSON[this.props.field.name]}
    			</p>
    		</div>
    	)
	}
}

function mapStateToProps(state) {
	return {
		emptyJSON  : state.emptyJSON
	}
}

export default connect(mapStateToProps)(LabelDescription);
