import React from 'react'

import Header from './Header'
import ContestList from './ContestList'
import Contest from './Contest'
import * as api from '../api'

const pushState = (obj, url) =>
  window.history.pushState(obj, '', url);

const onPopState = handler => {
	window.onpopstate = handler;
}

class App extends React.Component {
	
	static propTypes = {
		initialData: React.PropTypes.object.isRequired
	}
	state = this.props.initialData;

	componentDidMount() {
		onPopState((event) => {
			this.setState({
				currentContestId: (event.state || {}).currentContestId
			})
		})
	}
	
	componentWillUnmount() {
		onPopState(null)
	}

	fetchContest = (contestId) => {
		pushState(
			{ currentContestId : contestId },
			`/contest/${contestId}`
		);

		api.fetchContest(contestId).then(contest => {
			this.setState({
				currentContestId: contest._id,
				contest: {
					...this.state.contest,
					[contest._id]: contest
				}
			})	
		})
		
	};
	fetchContestList = () => {
		pushState(
			{ currentContestId : null },
			'/'
		);

		api.fetchContestList().then(contests => {
			this.setState({
				currentContestId: null,
				contests
			})	
		})
		
	};
	fetchNames = (nameIds) => {
		if(nameIds.length ===0){
			return;
		}
		api.fetchNames(nameIds).then(names =>{
			this.setState({
				names
			})
		})
	}
	pageHeader(){
		if(this.state.currentContestId){
			return this.currentContest().contestName;
		}

		return 'Naming Contests';
	}
	currentContest(){
		return this.state.contest[this.state.currentContestId]
	}
	lookupName = (nameId) => {
		
		if(!this.state.names || !this.state.names[nameId]){
			return {
				name : '...'
			};
		}
		return this.state.names[nameId];
	}
	addName = (newName, contestId) => {
		api.addName(newName, contestId).then(response => 
			this.setState({
				contest: {
					...this.state.contest,
					[response.updatedContest._id]: response.updatedContest
				},
				names: {
					...this.state.names,
					[response.newName._id] : response.newName
				}
			})
		)
		.catch(console.error);
	}
	currentContent(){
		if(this.state.currentContestId){
			return <Contest 
				contestListClick = {this.fetchContestList}
				fetchNames = {this.fetchNames}
				lookupName = {this.lookupName}
				addName = {this.addName}
				{...this.currentContest() }/>;
		}
		return <ContestList 
					onContestClick={this.fetchContest}
					contest = {this.state.contest} />;
	}

	render(){
		return(
			<div>
				<Header messg={this.pageHeader()} />
				{this.currentContent()}
			</div>
		);
	}
};

export default App;