import React from 'react';
import ReactDOMServer from 'react-dom/server'

import App from './src/components/App'

import config from './config';
import axios from 'axios';

const getApiUrl = contestId => {
	if(contestId){
		return `${config.serverUrl}/api/contest/${contestId}`;
	}
	return `${config.serverUrl}/api/contest`;
};

const getInitialData = (contestId, apiData) => {
	if(contestId){
		return{
			currentContestId: apiData._id,
			contest: {
				[apiData._id]: apiData
			}
		}
	}
	return{
		contest: apiData.contest
	}
}

const serverRender = (contestId) => 
	axios.get(getApiUrl(contestId))
	    .then(response => {
	    	const initialData = getInitialData(contestId, response.data)
	        return {
	        	initialMarkup: ReactDOMServer.renderToString(
		        	<App initialData={initialData} />
		        ),
		        initialData
	        } ;
	    })

export default serverRender;