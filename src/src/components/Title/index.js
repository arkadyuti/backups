import React from 'react';
import './styles.scss';

export default class Title extends React.Component {

	render() {
		return (
			<div className="title-container">	
		      <span className="login-title bold">{this.props.title1}</span>
		      <span className="login-title">{this.props.title2}</span>
		    </div>
		);
  	}
}
