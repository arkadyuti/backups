import React, { Component}  from 'react';
import ReactDOM, {render} from 'react-dom';
import { Router, Route, browserHistory } from 'react-router';
import {Link} from 'react-router';
import {SidePanel} from '../SidePanel';
import '../SidePanel/sidepanel.scss';

class ClickableImage extends Component {
	//Clickable image component with route
		render(){
			return(
					<div tabIndex="1">
					<Link to={this.props.routevalue }>
					<figure className={this.props.class} >
					<img src={this.props.src} onClick={this.props.onClick}/>
					</figure>
					</Link>
					</div>
				);
		}
}

export default ClickableImage;