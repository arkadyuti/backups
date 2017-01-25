import { combineReducers } from 'redux';


//CreateProject Component Reducers
import selectedTab from './CreateProjectReducer/selected-tab';
import emptyJSON from './CreateProjectReducer/empty-json';
import configJSON from './CreateProjectReducer/config-json';
import firstListBuffer from './CreateProjectReducer/first-list-buffer';
import secondListBuffer from './CreateProjectReducer/second-list-buffer';
import staffingFormVisible from './CreateProjectReducer/staffing-form-display';
import validateTabNext from './CreateProjectReducer/validate-next-button';
import staffingEmployeeBuffer from './CreateProjectReducer/staffing-employee-details';
import requestType from './CreateProjectReducer/set-request-type.js';
import allFieldsCheck from './CreateProjectReducer/all-fields-check';


import toggleSidePanel from './toggle-side-panel.js';



//import skills from './fetchDataReducer.js';

import projectsDataReducer from './projectListReducer'
import customizeColumn from './ProjectListReducer/customize-column';
import openNeedsReducer from './openNeedsReducer'
import redStatusReducer from './redStatusReducer'
import formreducer from './form-reducer.js';

import barChartReducers from './Dashboard/TrendsChart/index';
import skills from './Dashboard/SkillBasedChart/index.js';

import statusChartData from './Dashboard/StatusChart/index';

//import statusChartInnerRadius from './Dashboard/statusChart/reducer-statusChartInnerRadius.js'

import statusChartRadius from './Dashboard/StatusChart/status-chart-radius'


const rootReducer = combineReducers({

		statusChartRadius,
		formreducer,
	  	toggleSidePanel,
	    barChartReducers,
	    skills,
	    statusChartData,
	    projectsDataReducer,
	  	openNeedsReducer,
	  	redStatusReducer,
	    customizeColumn,
	    firstListBuffer,
	    secondListBuffer,
	    emptyJSON,
	    selectedTab,
	    configJSON,
	    staffingFormVisible,
	    validateTabNext,
	    staffingEmployeeBuffer,
	    requestType,
	    allFieldsCheck

});

export default rootReducer;
