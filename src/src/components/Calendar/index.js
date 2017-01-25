import React, { Component } from 'react';



import moment from 'moment'
import momentRange from 'moment-range'

import LabelDescription from '../LabelDescription/index.js';
import getCalendar  from './get-calendar.js';

import './styles.scss';

let ClickOutHandler = require('react-onclickout'); 



let calendar, month, week, weeks, year;
export default class Calendar extends Component {
	constructor(props) {
		super(props);
		this.state={
			showCalendar:false,
			dayValue:moment(),
			date: moment(),
		    month:moment().month(),
			year:moment().year(),
		    calendar:getCalendar(moment().year(),moment().month())
		}
	}


	onClickOut(e) {
    	if(this.state.showCalendar && e.target.className.indexOf('date-picker-nav')=== -1){
    		this.calendarDisplay();
    	}
	} 


	
	calendarDisplay(){
		this.setState({showCalendar:!this.state.showCalendar})
	}
	setDate(day, e) {
		
		e.preventDefault();
		if(day.month() < this.state.month){
			this.previousMonth(e)
		}
		else if(day.month() > this.state.month){
			this.nextMonth(e)
		}



		(this.props.selectedTab === "staffing")
		?this.props.staffingEmployeeDetailUpdate(this.props.field.name,day.format("YYYY-MM-DD"))
		:this.props.updateUserInput(moment.utc(day).format(),this.props.field.name)
		
		this.setState({dayValue:day});
		this.calendarDisplay();
	}
	nextMonth(e) {
		e.preventDefault();
		if (this.state.month === 11) {
			month = 0;
			year = this.state.year + 1;
		} else {
			month = this.state.month + 1;
			year = this.state.year;
		}
		calendar= getCalendar(year, month);
		this.setState({month:month,year:year,calendar:calendar});
	}
	previousMonth(e) {
		e.preventDefault();
		if (!this.state.month) {
			month = 11;
			year = this.state.year - 1;
		} else {
			month = this.state.month - 1;
			year = this.state.year;
		}
		calendar= getCalendar(year, month);
		this.setState({month:month,year:year,calendar:calendar});
	}
	calendarViewMode() {
		
		return (this.props.requestType.type==='view') ?'cp-text cp-label-description':'cp-text';
	}

	enterClick(evnt){
		if (evnt.keyCode == 13) {
		   this.calendarDisplay()
		}
	}
	enterDate(day,e){
		if (e.keyCode == 13) {
		   this.setDate(day,e)
		}
	}
	enterNavigation(e){
		if(e.keyCode === 13){
			if(e.target.className.indexOf('date-picker-nav-previous')!== -1){
				this.previousMonth(e)
			}
			else if(e.target.className.indexOf('date-picker-nav-next')!== -1){
				this.nextMonth(e)
			}
		}

	}
	render(){

		let tabIndex = {tabIndex:0};
		var context = this;
		var setDate = this.setDate.bind(this);
		var weekCount = 0,dayList,isCurrentMonth,isToday,isSelected,dayClasses;
		var weeks = context.state.calendar.map(function(week) {
			weekCount++;
			dayList = []
			week.by('days', function(day) {
				dayList.push(day)
			})
			var days = dayList.map(function(day) {
				isCurrentMonth = day.month() == context.state.month;
				isToday = day.format('DD-MM-YYYY') == moment().format('DD-MM-YYYY')
				isSelected = day.format('DD-MM-YYYY') == context.state.dayValue.format('DD-MM-YYYY')
				dayClasses = "day";
				if (!isCurrentMonth) {
					dayClasses += " day-muted";
				}
				if (isSelected) {
					dayClasses += " day-selected";
				}
				if (isToday) {
					dayClasses += " day-today";
				}
				return( <div {...tabIndex}  onKeyDown={context.enterDate.bind(context, day)} key={ day.format('D-MM') } className='day-cell'>
					<div
					className = { dayClasses }
					onClick = { setDate.bind(this, day) } >{ day.format('D') }</div></div>)
			})
			return (<div className='date-picker-week' key={ weekCount }>{ days }</div>)
		})



		let EDITHTML = (this.props.requestType.type === 'view')?
				<LabelDescription field={this.props.field} />
			: <div>
			<ClickOutHandler onClickOut={this.onClickOut.bind(this)}> 
				<div className='calendar-field'>
                	<input className='input-field cp-input'
                		   value={ this.state.dayValue.format("D MMM YYYY") } 
                		   disabled/>
                	<span className='cp-floating-label cp-date-label'>{this.props.field.staticValue}</span>
                	<div>
                	<div className="cp-icon-field" >
                	<span   {...tabIndex}  onKeyDown={this.enterClick.bind(this)} className='ion-calendar calendar-icon' onClick={this.calendarDisplay.bind(this)}></span>
                	</div>
                	</div>
            	</div>
            	</ClickOutHandler>
            	<div className={"calendar "+(this.state.showCalendar?'show':'hide-calendar')} >
					<div>
						<div className='date-picker-week'>
							<span>
							<i {...tabIndex} className="date-picker-nav date-picker-nav-previous ion-ios-arrow-back" onClick={ this.previousMonth.bind(context) } onKeyDown={this.enterNavigation.bind(this)}></i>
							</span>
							<span colSpan="5"><span className="date-picker-nav">{ moment().month(this.state.month).format("MMMM") } { this.state.year }</span></span>
							<span>
							<i {...tabIndex} className="date-picker-nav date-picker-nav-next ion-ios-arrow-forward" onClick={ this.nextMonth.bind(context) } onKeyDown={this.enterNavigation.bind(this)}></i>
							</span>
						</div>
						<div className='date-picker-week'>
							<span className='week-day'>S</span>
							<span className='week-day'>M</span>
							<span className='week-day'>T</span>
							<span className='week-day'>W</span>
							<span className='week-day'>T</span>
							<span className='week-day'>F</span>
							<span className='week-day'>S</span>
						</div>
					</div>
						{weeks}
				</div>
			</div>


		return(<div key={this.props.field.id} className="cp-text">
        	{EDITHTML}
        	</div>
			);
	}
}

