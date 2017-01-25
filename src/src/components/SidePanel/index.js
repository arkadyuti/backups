import React, { Component}  from 'react';
import './sidepanel.scss';
import {Link} from 'react-router';
import Accordian from '../../containers/Accordian';
import ClickableImage from '../ClickableImage';
import ClickableIcon from '../ClickableIcon';
import ImageWithText from '../../containers/ImgText';

var listkey=[],i;
//Sidepanel list
const items ={
	list : {
		'Dashboard': 'link',
		'Projects':[{
			text:'Project List',
			icon: <span className="ion-navicon-round"></span>,
			route:'project-list'
		},
		{
			text:'Create Project',
			icon:<span className="ion-compose"></span>,
			route:'create-project'
		},
		{
			text:'Open Needs',
			icon: <span className="ion-ios-people"></span>,
			route:'open-needs'
		},
		{
			text:'Red Status',
			icon: <span className="ion-ios-minus"></span>,
			route:'red-status'
		}
		],
		'Reports': 'link',

	}
}

var sidePanelBackground =  require('./pattern.png');

//To provide background pattern
var backgroundStyle = {

	background:'url('+sidePanelBackground+') repeat'

} 
var logo = require('./sapient_DNA.png'); 




//ProjectListApp component enclosing list container and list component
class App extends Component {
	
	handleClose(){
		this.props.handleClose();	
	}
	render() {
		return (
			<div className="navigation-container" style={backgroundStyle} id='side-panel'>
			<div className='mobile-clickable'>
			<ClickableImage src={logo} class="logo" routevalue="/Dashboard"/>
			</div>
			<div className='mobile-user'>

			<ImageWithText src='' name='Aaron Paul'/>
			<div className='ion-android-close' onClick={this.handleClose.bind(this)}></div>
			</div>
			{this.props.children}
			</div>
			);
	}
}

class ListContainer extends Component {
	render() {
		return (
			<div className="sidepanel-flex">
			<div className="list-container">
			{this.props.children}
			</div>
			<div className='logout-display'>
			<ClickableIcon />
			</div>
			</div>
			)
	}
}
var colorChange={};
	//List component including Toggle Component 
	class ListComponent extends Component {
		constructor() {
			super();
			this.state = {
				count: localStorage.getItem( 'ListOption' ) || 0,
			};
		}
		componentWillMount(){

		}
		handleClick(e) {
			if(this.props.clicked){
				this.props.handleClick(!this.props.clicked);
				localStorage.setItem( 'SelectedOption', '');
				localStorage.setItem( 'ListOption', e.target.parentNode.dataset.index );
				
			}

			this.setState({
				count: e.target.parentNode.dataset.index 
			});

		}

		displayDropdown(value) {
			
			if((!this.props.clicked || localStorage.getItem('ListOption')!== '') ){
				
				if (value == this.state.count ) {
					return 'applyColor';
				}
			}
			return 'colorChange';
		}
		handleClose(){
			this.props.handleClose();
		}

		componentWillMount() {
			if( (localStorage.getItem('SelectedOption')=== "" && localStorage.getItem('ListOption')!==null)||(localStorage.getItem('SelectedOption')=== null && localStorage.getItem('ListOption')===null) ){
				
      this.props.handleClick() ;//only if clicked is false
  }
}


render() {
	listkey=Object.keys(items.list);
	const listdata=listkey.map((data,index)=>{
		if(typeof(items.list[data]) === 'string' && data !=='Reports'){
			return (<Link to={"/"+data} key={data} data-index={index}  onClick={this.handleClick.bind(this)}><li key={data} data-index={index} onClick={this.handleClose.bind(this)}  className="sidepanel-list" >
				<span className={`${this.displayDropdown(index)} list-items addHover ${this.props.clicked?'colorChange':''}`}  >{data}</span></li></Link>)
		}
		if(typeof(items.list[data]) === 'string' && data ==='Reports'){
			return (<li key={data} data-index={index}   className="sidepanel-list" >
				<Link  className="list-items" ><span   className="not-allowed">{data}</span></Link></li>)
		}
		
		else{
			return (
				<li key={data}><Accordian className="toggle-component" summary={data} details={items.list[data]} /></li>
				)			
		}
	})
			//returns the list in side component
			return (
				<div>
				<ul className="list">
				{listdata}
				
				</ul>
				</div>
				)
		}
	}

	//the entire sidepanel component
	export class SidePanel extends Component {
		render() {
			return (
				<App handleClose={this.props.handleClose} sideNavData={this.props.sideNavData}><ListContainer><ListComponent handleClose={this.props.handleClose} sideNavData={this.props.sideNavData} handleClick={this.props.handleClick} clicked={this.props.clicked} /></ListContainer></App>
				)

		}

	}




